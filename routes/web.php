<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\BookingController;

Route::get('/booking', function () {
    return view('booking');
});

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');


