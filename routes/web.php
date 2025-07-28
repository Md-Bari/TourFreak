<?php

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

Route::get('/bus-search', [BusController::class, 'search'])->name('tour.search');


// Add this route
Route::get('/search/bus', [BusController::class, 'search'])->name('bus.search');


// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');


Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
use App\Http\Controllers\AdminController;

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
