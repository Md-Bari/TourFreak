<?php

use Illuminate\Support\Facades\Route;

// Auth Controllers
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Dashboard
use App\Http\Controllers\DashboardController;

// Messages
use App\Http\Controllers\MessageController;

// Booking Controllers
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomBookingController;
use App\Http\Controllers\OrderController;

// Transportation
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusAdminController;

// Contact
use App\Http\Controllers\ContactController;

// Tour Packages
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\TourSearchController;

// Users / Profile / Settings
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;

// Rooms
use App\Http\Controllers\RoomController;

// Payment
use App\Http\Controllers\SslCommerzPaymentController;

// Ads / Wishlist / Notifications / Support
use App\Http\Controllers\MyAdsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SupportController;

// Home
use App\Http\Controllers\HomeController;

// -----------------------
// Public Routes
// -----------------------
Route::get('/', [RoomController::class, 'welcome'])->name('home');
Route::get('/room', [RoomController::class, 'index'])->name('room');
Route::get('/room-details/{type}', [RoomController::class, 'show'])->name('room.details');
Route::get('/room/{id}', [RoomController::class, 'show1'])->name('room.show');

Route::view('/facilities', 'facilities')->name('facilities');
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');

// -----------------------
// Authentication Routes
// -----------------------
Route::get('/auth/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/auth/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/auth/login', [LoginController::class, 'create'])->name('login');
Route::post('/auth/login', [LoginController::class, 'store'])->name('login.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// -----------------------
// Authenticated Routes
// -----------------------
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/messages/{senderId}', [MessageController::class, 'getConversation'])->name('messages.conversation');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    // Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
    Route::put('/settings/notifications', [SettingsController::class, 'updateNotificationPreferences'])->name('settings.notifications.update');

    // Orders / Bookings
    Route::get('/order/{id}', [OrderController::class, 'showOrderForm'])->name('order.page');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/my-bookings', [OrderController::class, 'myBookings'])->name('my.bookings');
    Route::delete('/orders/cancel/{id}', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Room Booking
    Route::get('/room-booking/{room}', [RoomBookingController::class, 'create'])->name('roombooking.create');
    Route::post('/room-booking', [RoomBookingController::class, 'store'])->name('roombooking.store');
    Route::get('/my-room-bookings', [RoomBookingController::class, 'myBookings'])->name('roombooking.mybookings');
    Route::delete('/room-booking/cancel/{id}', [RoomBookingController::class, 'cancel'])->name('roombooking.cancel');

    // My Ads
    Route::get('/my-ads', [MyAdsController::class, 'index'])->name('my-ads');

    // Wishlist
    Route::post('/wishlist/add/{ad_id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{ad_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::get('/my-wishlist', [WishlistController::class, 'index'])->name('my-wishlist');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');

    // Support
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');
    Route::get('/support/create', [SupportController::class, 'create'])->name('support.create');
    Route::post('/support/store', [SupportController::class, 'store'])->name('support.store');
    Route::get('/support/{ticket_id}', [SupportController::class, 'show'])->name('support.show');
});

// -----------------------
// Admin / Management Routes
// -----------------------
Route::prefix('admin')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

    // Rooms
    Route::get('/room_add', [RoomController::class, 'create'])->name('admin.rooms.add');
    Route::post('/room/store', [RoomController::class, 'store'])->name('admin.rooms.store');

    // Tour Packages
    Route::get('/packages', [TourPackageController::class, 'index'])->name('admin.packages');
    Route::post('/packages/store', [TourPackageController::class, 'store'])->name('admin.packages.store');
    Route::get('/packages/edit/{id}', [TourPackageController::class, 'edit'])->name('admin.packages.edit');
    Route::put('/packages/update/{id}', [TourPackageController::class, 'update'])->name('admin.packages.update');
    Route::delete('/packages/delete/{id}', [TourPackageController::class, 'destroy'])->name('admin.packages.delete');

    // Bus Admin
    Route::get('/buses', [BusAdminController::class, 'index'])->name('admin.buses.index');
    Route::post('/buses', [BusAdminController::class, 'store'])->name('admin.buses.store');
});

// -----------------------
// Flight, Bus, Tour Search
// -----------------------
Route::get('/search-flight', [FlightController::class, 'search'])->name('flight.search');
Route::get('/bus-search', [BusController::class, 'search'])->name('bus.search');
Route::get('/tour/search', [TourSearchController::class, 'search'])->name('tour.search');

// Bus booking
Route::get('/bus/seat-selection', [BusController::class, 'seatSelection'])->name('bus.seatSelection');
Route::post('/bus/book-seats', [BusController::class, 'bookSeats'])->name('bus.bookSeats');
Route::post('/bus/toggle-seat', [BusController::class, 'toggleSeat'])->name('bus.toggleSeat');
Route::post('/bus/payment', [BusController::class, 'payment'])->name('bus.payment');
Route::delete('/bus/cancel/{id}', [BusController::class, 'cancel'])->name('bus.cancel');

// -----------------------
// Reviews
// -----------------------
Route::post('/submit-review', [TourPackageController::class, 'storeReview'])->name('review.submit')->middleware('auth');

// -----------------------
// Contact Form
// -----------------------
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// -----------------------
// SSLCommerz Payment
// -----------------------
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('example1');
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->name('example2');
Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('pay.via.ajax');
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('ipn');
