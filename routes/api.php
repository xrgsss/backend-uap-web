<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; // <<< WAJIB
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JerseyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/jerseys', [JerseyController::class, 'store']);
    Route::put('/jerseys/{id}', [JerseyController::class, 'update']);
    Route::delete('/jerseys/{id}', [JerseyController::class, 'destroy']);
});

Route::get('/jerseys', [JerseyController::class, 'index']);
Route::get('/jerseys/{id}', [JerseyController::class, 'show']);
