<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShopController;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Public routes
Route::get('/shops', [ShopController::class, 'index']);
Route::get('/shops/{shop}', [ShopController::class, 'show']);
Route::get('/shops/{shop}/barbers', [BarberController::class, 'index']);
Route::get('/shops/{shop}/services', [ServiceController::class, 'index']);

// Private routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/shops/{shop}/theme', [ShopController::class, 'theme']);
    Route::post('/shops', [ShopController::class, 'store']);
    Route::put('/shops/{shop}', [ShopController::class, 'update']);
    Route::delete('/shops/{shop}', [ShopController::class, 'delete']);
    Route::post('/shops/{shop}/restore', [ShopController::class, 'restore'])->withTrashed();

    Route::post('/services/{shop}', [ServiceController::class, 'store']);
    Route::put('/services/{service}/shop/{shop}', [ServiceController::class, 'update']);
    Route::delete('/services/{service}/shop/{shop}', [ServiceController::class, 'delete']);

    Route::post('/barber/{shop}', [BarberController::class, 'store']);
    Route::put('/barber/{barber}/shop/{shop}', [BarberController::class, 'update']);
    Route::delete('/barber/{barber}/shop/{shop}', [BarberController::class, 'delete']);
    Route::get('/barber/{barber}/shop/{shop}/restore', [BarberController::class, 'restore'])->withTrashed();


    Route::get('/appointment/shop/{shop}', [AppointmentController::class, 'index']);
    Route::get('/appointment/{appointment}', [AppointmentController::class, 'show']);
    Route::post('/appointment/shop/{shop}/barber/{barber}/service/{service}', [AppointmentController::class, 'store']);
});
