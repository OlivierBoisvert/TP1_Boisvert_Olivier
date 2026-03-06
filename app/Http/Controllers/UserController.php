<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserController extends Controller
{
    public function create(UserRequest $request){

        try{
            $user = User::create($request->validated());
            return (new UserResource($user))->response()->setStatusCode(OK);
        }
        catch(QueryException $e){
            abort(INVALID_DATA, 'Invalid data');
        }
        catch(Exception $e){
            abort(SERVER_ERROR, 'Server error');
        }
    }

    public function update(UserRequest $request, string $id){
        try{
            $user = User::findOrFail($id);
            $user->update($request);
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
