<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ContactController;


// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/room', fn() => view('room'))->name('room');
Route::get('/facilities', fn() => view('facilities'))->name('facilities');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/about', fn() => view('about'))->name('about');

// -------------------- Auth --------------------
// Register
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Login
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// -------------------- Booking --------------------
Route::get('/booking', fn() => view('booking'))->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// -------------------- Dashboard --------------------
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/bookings', [UserController::class, 'bookings'])->name('bookings');
});

// -------------------- Flight & Bus Search --------------------
Route::get('/search-flight', [FlightController::class, 'search'])->name('flight.search');
Route::get('/bus-search', [BusController::class, 'search'])->name('tour.search');
Route::get('/search/bus', [BusController::class, 'search'])->name('bus.search');
Route::get('/tour/search', [TourSearchController::class, 'search'])->name('tour.search');

// -------------------- Contact --------------------
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');



Route::get('/admin/home', [AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware(['auth', 'is_admin']);
   


use App\Http\Controllers\TourPackageController;

Route::get('/', [TourPackageController::class, 'index'])->name('home');
Route::get('/admin/packages', [TourPackageController::class, 'admin']);
Route::post('/admin/packages/store', [TourPackageController::class, 'store']);
Route::delete('/admin/packages/delete/{id}', [TourPackageController::class, 'destroy']);
Route::get('/admin/packages', [TourPackageController::class, 'admin'])->name('admin.packages');
use App\Http\Controllers\TourSearchController;

Route::get('/tour/search', [TourSearchController::class, 'search'])->name('tour.search');
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/bookings', [UserController::class, 'bookings'])->name('bookings');
});
