<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
})->name('login');
Route::view('/login', 'login');


Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\BookingController;

Route::get('/booking', function () {
    return view('booking');
});

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/', function () {
    return view('welcome');
})->name('home');

use App\Http\Controllers\RegisterController;

// Show register page (GET)
Route::get('/register', [RegisterController::class, 'show'])->name('register.form');

// Handle form submission (POST)
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

use App\Http\Controllers\AuthController;

Route::get('/login', function() {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/dashboard', function () {
    return 'Welcome to your dashboard!';
})->middleware('auth.custom');

