<?php

use Illuminate\Support\Facades\Route;

// Redirige según si el usuario está autenticado o no
Route::get('/', function () {
    return auth()->check()
        ? redirect('/dashboard')
        : redirect('/login');
});

// Solo accesible sin sesión activa
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('spa');
    });
});

// Solo accesible con sesión activa
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('spa');
    });

    Route::get('/dashboard/{any}', function () {
        return view('spa');
    })->where('any', '.*');

    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    });
});