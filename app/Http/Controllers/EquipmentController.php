<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\Review;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        try{
            return EquipmentResource::collection(Equipment::paginate(PAGINATE_NUMBER))->response()->setStatusCode(OK);
        }
        catch(Exception $e){
            abort(SERVER_ERROR, 'Server error');
        }
    }

    public function show(string $id)
    {
        try{
            return (new EquipmentResource(Equipment::findOrFail($id)))->response()->setStatusCode(OK);
        }
        //Chatgpt "What Exception is called when a findOrFail fails in laravel?"
        catch(ModelNotFoundException $e){
            abort(NOT_FOUND, 'Not found');
        }
        catch(Exception $e){
            abort(SERVER_ERROR, 'Server error');
        }
    }

    public function popularity(string $id)
    {
        try{
            $equipment = Equipment::findOrFail($id);

            $allRentals = Rental::all()->where('equipment_id', $id);
            $allReviews = Review::all();

            $selectedReviews = [];

            foreach($allRentals as $rental){
                foreach($allReviews as $review){
                    if($review->rental_id == $rental->id){
                        $selectedReviews[] = $review;
                    }
                }
            }

            //Chatgpt "How to turn a php array into a Laravel Collection"
            $selectedReviews = collect($selectedReviews);

            if($selectedReviews->count() == 0){
                return 0;
            }

            $popularityScore = ($allRentals->count() * 0.6) + ($selectedReviews->avg('rating'));

            return (response()->json(['popularity' => $popularityScore]))->setStatusCode(OK);
        }
        catch(ModelNotFoundException $e){
            abort(NOT_FOUND, 'Not found');
        }
        catch(Exception $e){
            abort(SERVER_ERROR, 'Server error');
        }
    }

    public function avgRental(Request $request, string $id){
        try{

            //Chatgpt "Comment faire la validation de format de date pour une query string en laravel"
            $validated = $request->validate([
                'minDate' => 'nullable|date|date_format:Y-m-d',
                'maxDate' => 'nullable|date|date_format:Y-m-d',
            ]);
            $minDate = $validated['minDate'] ?? null;
            $maxDate = $validated['maxDate'] ?? null;

            if($minDate != null && $maxDate != null && $minDate >= $maxDate){
                return (response()->json(['Erreur' => 'minDate doit etre inferieur a maxDate']))->setStatusCode(OK);
            }

            $rentals = Rental::all()->where('equipment_id', $id);

        if ($minDate) {
            $rentals->where('start_date', '>=', $minDate);
        }

        if ($maxDate) {
            $rentals->where('end_date', '<=', $maxDate);
        }

        $avgRental = $rentals->avg('total_price');

        return (response()->json(['avgRental' => $avgRental]))->setStatusCode(OK);
        }
        catch(ModelNotFoundException $e){
            abort(NOT_FOUND, 'Not found');
        }
        catch(Exception $e){
            abort(SERVER_ERROR, 'Server error');
        }
    }
}
