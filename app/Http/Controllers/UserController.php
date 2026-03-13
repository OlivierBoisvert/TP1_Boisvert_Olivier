<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    #[OA\Post(
            path: "/api/users",
            summary: "Créer un utilisateur",
            tags: ["Users"],
            requestBody: new OA\RequestBody(
                required: true,
                content: [
                    new OA\JsonContent(
                        required: ["first_name", "last_name", "email", "phone"],
                        properties: [
                            //https://github.com/DarkaOnLine/L5-Swagger/wiki/Examples pour le maxLength et format
                            new OA\Property(property: "first_name", type: "string", maxLength: 50, example: "Jane"),
                            new OA\Property(property: "last_name", type: "string", maxLength: 50, example: "Doe"),
                            new OA\Property(property: "email", type: "string", format: "email", maxLength: 50, example: "janedoe@gmail.com"),
                            new OA\Property(property: "phone", type: "string", maxLength: 12, example: "1231231234")
                        ]
                    )
                ]
            ),
            responses: [
                new OA\Response(
                    response: "201", description: "Utilisateur créé"
                ),
                new OA\Response(
                    response: "422", description: "Données invalides"
                )
            ]
    )]
    public function create(UserRequest $request){

        try{
            $user = User::create($request->validated());
            return (new UserResource($user))->response()->setStatusCode(CREATED);
        }
        catch(QueryException $e){
            abort(INVALID_DATA, 'Invalid data');
        }
        catch(Exception $e){
            abort(SERVER_ERROR, 'Server error');
        }
    }
    
    #[OA\Put(
            path: "/api/users/{id}",
            summary: "Modifier un utilisateur",
            tags: ["Users"],
            parameters: [
                new OA\Parameter(
                    name: "id",
                    description: "User ID",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(type: "integer")
                )
            ],
            requestBody: new OA\RequestBody(
                required: true,
                content: [
                    new OA\JsonContent(
                        required: ["first_name", "last_name", "email", "phone"],
                        properties: [
                            new OA\Property(property: "first_name", type: "string", maxLength: 50, example: "Jane"),
                            new OA\Property(property: "last_name", type: "string", maxLength: 50, example: "Doe"),
                            new OA\Property(property: "email", type: "string", format: "email", maxLength: 50, example: "janedoe@gmail.com"),
                            new OA\Property(property: "phone", type: "string", maxLength: 12, example: "1231231234")
                        ]
                    )
                ]
            ),
            responses: [
                new OA\Response(
                    response: "201", description: "Utilisateur modifié"
                ),
                new OA\Response(
                    response: "404", description: "Utilisateur non trouvé"
                )
            ]
    )]
    public function update(UserRequest $request, string $id){
        try{
            $user = User::findOrFail($id);
            $user->update($request->validated());
            return (new UserResource($user))->response()->setStatusCode(CREATED);
        }
        catch(ModelNotFoundException $e){
            abort(NOT_FOUND, 'Not found');
        }
        catch(Exception $e){
            abort(SERVER_ERROR, 'Server error');
        }
    }
}
