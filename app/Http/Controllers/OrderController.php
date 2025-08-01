<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show order form with package details
    public function showOrderForm($id)
    {
        $package = TourPackage::findOrFail($id);
        return view('order.order', compact('package'));
    }

    // Handle order submission
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:tour_packages,id',
            'person_count' => 'required|integer|min:1',
            'extra_package' => 'nullable|string|max:255',
        ]);

        $package = TourPackage::findOrFail($request->package_id);
        $user = Auth::user();

        $total_price = $package->price * $request->person_count;

        $order = Order::create([
            'package_id'     => $package->id,
            'title'          => $package->title,
            'price'          => $package->price,
            'person_count'   => $request->person_count,
            'extra_package'  => $request->extra_package ?? 'None',
            'total_price'    => $total_price,
            'user_name'      => $user->name,       // ✅ New
            'user_phone'     => $user->phone,      // ✅ New
            'user_id'        => $user->id,         // (Optional) if tracking by user
        ]);

        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
