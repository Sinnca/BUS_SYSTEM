<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\Api\ReservationController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Trip search (public)
Route::get('/trips/search', [TripController::class, 'search']);
Route::get('/trips/{trip}', [TripController::class, 'show']);
Route::get('/trips/{trip}/seats', [TripController::class, 'seats']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Reservations
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store'])->middleware('throttle:10,1');
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);

