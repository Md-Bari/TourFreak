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
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\TourSearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;

// -------------------- Static Pages --------------------
Route::get('/', [TourPackageController::class, 'index'])->name('home');

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

// -------------------- admin --------------------
Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
Route::get('/admin/packages', [TourPackageController::class, 'index'])->name('admin.packages');
Route::post('/admin/packages/store', [TourPackageController::class, 'store'])->name('admin.packages.store');
Route::get('/admin/packages/edit/{id}', [TourPackageController::class, 'edit'])->name('admin.packages.edit');
Route::delete('/admin/packages/delete/{id}', [TourPackageController::class, 'destroy'])->name('admin.packages.delete');
Route::put('/admin/packages/update/{id}', [TourPackageController::class, 'update'])->name('admin.packages.update');


Route::get('/room-details/{type}', [RoomController::class, 'show'])->name('room.details');

// Room Add Page
Route::get('/admin/room_add', [RoomController::class, 'create'])->name('admin.rooms.add');
Route::post('/admin/room/store', [RoomController::class, 'store'])->name('admin.rooms.store');
Route::get('/room', [RoomController::class, 'index'])->name('room');



//order page

use App\Http\Controllers\OrderController;

Route::get('/order/{id}', [OrderController::class, 'showOrderForm'])->name('order.page');  // Show order form
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::middleware('auth')->group(function () {
    Route::get('/order/{id}', [OrderController::class, 'showOrderForm'])->name('order.form');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
});
