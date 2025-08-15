<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show order form
    public function showOrderForm($id)
    {
        $package = TourPackage::findOrFail($id);
        return view('order.order', compact('package'));
    }

    // Store order data
    public function store(Request $request)
    {
        $request->validate([
            'package_id'     => 'required|exists:tour_packages,id',
            'person_count'   => 'required|integer|min:1',
            'extra_package'  => 'nullable|string|max:255',
        ]);

        $package = TourPackage::findOrFail($request->package_id);
        $user = Auth::user();

        $total_price = $package->price * $request->person_count;

        Order::create([
            'package_id'     => $package->id,
            'title'          => $package->title,
            'price'          => $package->price,
            'person_count'   => $request->person_count,
            'extra_package'  => $request->extra_package ?? 'None',
            'total_price'    => $total_price,
            'user_name'      => $user->name,
            'user_phone'     => $user->phone,
            'user_id'        => $user->id,
        ]);

        return redirect()->route('example1')->with('success', 'Order placed successfully!');
    }
}
