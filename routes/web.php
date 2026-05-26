<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('spa'))->name('login');
    Route::post('/login', [LoginController::class, 'iniciarSesion']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('spa'))->name('dashboard');
    Route::get('/dashboard/{any}', fn() => view('spa'))->where('any', '.*');
    Route::post('/logout', [LoginController::class, 'cerrarSesion'])->name('logout');
});