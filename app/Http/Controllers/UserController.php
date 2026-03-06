<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Database\QueryException;
use Exception;

class UserController extends Controller
{
    public function create(Request $request){

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

}
