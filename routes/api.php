<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

Route::get('/equipment', [EquipmentController::class, 'index']);
Route::get('/equipment/{id}', [EquipmentController::class, 'show']);
Route::get('/equipment/{id}/popularity', [EquipmentController::class, 'popularity']);
Route::get('/equipment/{id}/avgRental', [EquipmentController::class, 'avgRental']);

Route::post('/users', [UserController::class, 'create']);
Route::put('/users/{id}', [UserController::class, 'update']);

Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);
