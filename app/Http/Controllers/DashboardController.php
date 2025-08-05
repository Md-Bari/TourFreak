<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBookings = Booking::count();
        $totalRevenue = Booking::sum('amount'); // Make sure 'amount' column exists
        $recentBookings = Booking::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalBookings',
            'totalRevenue',
            'recentBookings'
        ));
    }
}