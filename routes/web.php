<?php

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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\MyAdsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SupportController; // SupportController যুক্ত করা হয়েছে

// Homepage showing rooms and tours
Route::get('/', [RoomController::class, 'welcome'])->name('home');

// Rooms routes
Route::get('/room', [RoomController::class, 'index'])->name('room');
Route::get('/room-details/{type}', [RoomController::class, 'show'])->name('room.details');

// Admin routes for rooms
Route::get('/admin/room_add', [RoomController::class, 'create'])->name('admin.rooms.add');
Route::post('/admin/room/store', [RoomController::class, 'store'])->name('admin.rooms.store');

// Tour package admin routes
Route::get('/admin/packages', [TourPackageController::class, 'index'])->name('admin.packages');
Route::post('/admin/packages/store', [TourPackageController::class, 'store'])->name('admin.packages.store');
Route::get('/admin/packages/edit/{id}', [TourPackageController::class, 'edit'])->name('admin.packages.edit');
Route::put('/admin/packages/update/{id}', [TourPackageController::class, 'update'])->name('admin.packages.update');
Route::delete('/admin/packages/delete/{id}', [TourPackageController::class, 'destroy'])->name('admin.packages.delete');

// Static pages
Route::view('/facilities', 'facilities')->name('facilities');
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');
Route::view('/booking', 'booking')->name('booking');

// Auth routes
Route::get('/auth/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/auth/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/auth/login', [LoginController::class, 'create'])->name('login');
Route::post('/auth/login', [LoginController::class, 'store'])->name('login.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Booking submission
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
    
    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');
    // Order routes
    Route::get('/order/{id}', [OrderController::class, 'showOrderForm'])->name('order.page');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/my-bookings', [OrderController::class, 'myBookings'])->name('my.bookings');
    Route::post('/reviews', [OrderController::class, 'storeReview'])->name('reviews.store');
    Route::delete('/orders/cancel/{id}', [OrderController::class, 'cancel'])->name('orders.cancel');

    // My Ads
    Route::get('/my-ads', [MyAdsController::class, 'index'])->name('my-ads');

    // Wishlist
    Route::post('/wishlist/add/{ad_id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{ad_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    // My Ads route
    Route::get('/my-ads', [MyAdsController::class, 'index'])->name('my-ads');

    // Wishlist routes
    Route::post('/wishlist/add/{ad_id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{ad_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Wishlist page route
    Route::get('/my-wishlist', [WishlistController::class, 'index'])->name('my-wishlist');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Support routes
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');
    Route::get('/support/create', [SupportController::class, 'create'])->name('support.create');
    Route::post('/support/store', [SupportController::class, 'store'])->name('support.store');
    Route::get('/support/{ticket_id}', [SupportController::class, 'show'])->name('support.show');
});


Route::post('/submit-review', [TourPackageController::class, 'storeReview'])
    ->name('review.submit')
    ->middleware('auth');
Route::post('/review', [TourPackageController::class, 'storeReview'])->name('review.submit');


// Search routes
Route::get('/search-flight', [FlightController::class, 'search'])->name('flight.search');
Route::get('/bus-search', [BusController::class, 'search'])->name('bus.search');
Route::get('/tour/search', [TourSearchController::class, 'search'])->name('tour.search');

// Contact form
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Admin home
Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');

// SSLCommerz payment routes
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('example1');
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->name('example2');
Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('pay.via.ajax');
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('ipn');
