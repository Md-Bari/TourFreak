<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\Room;
use App\Models\Order;
use App\Models\User;

class HomeController extends Controller
{
   public function index()
{
    $totalPackages = TourPackage::count();
    $totalRooms = Room::count();
    $totalBookings = Order::count();
    $totalUsers = User::count();
    $recentBookings = Order::with(['package', 'user'])
        ->latest()
        ->take(5)
        ->get();

    return view('admin.home', compact(
        'totalPackages',
        'totalRooms',
        'totalBookings',
        'totalUsers',
        'recentBookings'
    ));
}

}
