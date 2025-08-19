<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\Room;
use App\Models\Order;
use App\Models\User;
use App\Models\Bus;


class HomeController extends Controller
{
   public function index()
{
    $totalPackages = TourPackage::count();
    $totalRooms = Room::count();
    $totalBuses = Bus::count(); // new
    $totalBookings = Order::count();
    $totalUsers = User::count();
    $recentBookings = Order::with(['package', 'user'])
        ->latest()
        ->take(5)
        ->get();

    return view('admin.home', compact(
        'totalPackages',
        'totalRooms',
        'totalBuses',
        'totalBookings',
        'totalUsers',
        'recentBookings'
    ));
}

}
