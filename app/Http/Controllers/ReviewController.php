<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ReviewController extends Controller
{
    public function destroy(string $id){
        try{
            $review = Review::findOrFail($id);
            $review->delete();

            return response()->noContent()->setStatusCode(NO_CONTENT);
        }
        catch(ModelNotFoundException $e){
            abort(NOT_FOUND, 'Not found');
        }
        catch(Exception $e){
            abort(SERVER_ERROR, 'Server error');
        }
    }
}
