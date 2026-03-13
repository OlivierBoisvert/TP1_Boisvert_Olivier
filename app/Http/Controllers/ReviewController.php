<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use OpenApi\Attributes as OA;

class ReviewController extends Controller
{
    #[OA\Delete(
            path: "/api/reviews/{id}",
            summary: "Supprimer un avis",
            tags: ["Reviews"],
            parameters: [
                new OA\Parameter(
                    name: "id",
                    description: "Review ID",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: "integer")
                )
            ],
            responses: [
                new OA\Response(
                    response: "204", description: "No Content"
                ),
                new OA\Response(
                    response: "404", description: "Avis non trouvé"
                )
            ]
    )]
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
