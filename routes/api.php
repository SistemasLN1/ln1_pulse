<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Rutas públicas — no requieren token
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas — requieren token Bearer
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usuario', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
});