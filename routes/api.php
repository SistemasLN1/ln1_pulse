<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usuario', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

    Route::middleware('permission:ver_dashboard')->get('/dashboard', fn() => response()->json(['mensaje' => 'Bienvenido al dashboard']));
    Route::middleware('permission:gestionar_usuarios')->get('/usuarios', fn() => response()->json(['mensaje' => 'Lista de usuarios']));
    Route::middleware('permission:ver_proyectos')->get('/proyectos', fn() => response()->json(['mensaje' => 'Lista de proyectos']));
});
