<?php

use App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;

// Rutas públicas (sin auth)
Route::view('/', 'welcome');

// Rutas protegidas por auth y verificación de email
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('chirps', [ChirpController::class, 'index'])->name('chirps');
    Route::view('profile', 'profile')->name('profile');
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__ . '/auth.php';
