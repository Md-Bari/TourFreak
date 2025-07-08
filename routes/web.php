<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Register routes
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/register', [RegisterController::class, 'create'])->name('register.show');
// Login routes
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Booking routes
Route::get('/booking', function () {
    return view('booking');
});
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Dashboard route (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



