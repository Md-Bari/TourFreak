<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\Room;
use App\Models\Order;
use App\Models\User;
use App\Models\Bus;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        // Dashboard statistics
        $totalPackages = TourPackage::count();
        $totalRooms = Room::count();
        $totalBuses = Bus::count();
        $totalBookings = Order::count();
        $totalUsers = User::count();

        // Bookings
        $recentBookings = Order::with(['package', 'user'])
            ->latest()
            ->take(10) // show latest 10 in dashboard by default
            ->get();

        $allBookings = Order::with(['package', 'user'])
            ->latest()
            ->get(); // used for "Show All" toggle

        // Customer messages
        $messages = Contact::latest()->take(10)->get();

        // Pass to view
        return view('admin.home', compact(
            'totalPackages',
            'totalRooms',
            'totalBuses',
            'totalBookings',
            'totalUsers',
            'recentBookings',
            'allBookings',
            'messages'
        ));
    }
}
