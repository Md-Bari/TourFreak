<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Get counts from the database
        $totalPackages = TourPackage::count();
        $totalRooms = Room::count();
        $totalBookings = Booking::count();
        $totalUsers = User::count();

        // Pass data to the admin/home.blade.php view
        return view('admin.home', compact(
            'totalPackages',
            'totalRooms',
            'totalBookings',
            'totalUsers'
        ));
    }
}
