<?php

namespace App\Http\Controllers;

use App\Models\BusBook;
use App\Models\Order;
use App\Models\RoomBooking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $tourBookings = Order::with('package')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        $roomBookings = RoomBooking::with('room')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        $busBookings = BusBook::where('user_id', $userId)
            ->latest()
            ->get();

        return view('dashboard.dashboard', [
            'tourBookingsCount' => $tourBookings->count(),
            'roomBookingsCount' => $roomBookings->count(),
            'busBookingsCount' => $busBookings->count(),
            'unreadNotificationsCount' => Auth::user()->unreadNotifications()->count(),
            'recentBookings' => $tourBookings->take(3),
            'recentRooms' => $roomBookings->take(2),
        ]);
    }
}
