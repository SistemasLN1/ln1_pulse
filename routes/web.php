<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Redirige según si el usuario está autenticado o no
Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

// Solo accesible sin sesión activa
Route::middleware('guest')->group(function () {

    Route::get('/login', function () { return view('spa'); })->name('login');

    Route::post('/login', [LoginController::class, 'iniciarSesion']);
});

// Solo accesible con sesión activa
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () { return view('spa'); })->name('dashboard');

    Route::get('/dashboard/{any}', function () { return view('spa'); })->where('any', '.*');

    Route::post('/logout', [LoginController::class, 'cerrarSesion']);
});