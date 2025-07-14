<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BusController;


// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/room', function () {
    return view('room');
})->name('room');

Route::get('/facilities', function () {
    return view('facilities');
})->name('facilities');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');


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
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/search-flight', [FlightController::class, 'search'])->name('flight.search');
Route::get('/bus-search', [BusController::class, 'search'])->name('bus.search');

