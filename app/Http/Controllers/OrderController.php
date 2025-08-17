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
            'package_id'    => 'required|exists:tour_packages,id',
            'person_count'  => 'required|integer|min:1',
            'extra_package' => 'nullable|string|max:255',
        ]);

        $package = TourPackage::findOrFail($request->package_id);
        $user    = Auth::user();

        // total price = package price * persons + 15% VAT
        $subtotal = $package->price * $request->person_count;
        $vat      = $subtotal * 0.15;
        $total    = $subtotal + $vat;

        // save into orders table
        Order::create([
            'user_id'       => $user->id,
            'package_id'    => $package->id,
            'name'          => $user->name,
            'email'         => $user->email ?? 'noemail@example.com',
            'phone'         => $user->phone ?? 'N/A',
            'address'       => $request->address ?? null,
            'amount'        => $total,
            'currency'      => 'BDT',
            'transaction_id' => uniqid('txn_'), // fake transaction id
            'status'        => 'Pending',
        ]);

        return redirect()->route('example2')
            ->with('success', 'Order placed successfully!');
    }
  public function myBookings(): \Illuminate\View\View
{
    $orders = Order::with('package')
        ->where('user_id', Auth::id())   // ✅ This will never be undefined
        ->get();

    return view('dashboard.bookings', compact('orders'));
}
public function cancel($id)
{
    $order = Order::findOrFail($id);

    // Optional: Only allow cancellation if status is not Paid
    if ($order->status === 'Paid') {
        return redirect()->back()->with('error', 'Paid bookings cannot be canceled.');
    }

    $order->delete();

    return redirect()->back()->with('success', 'Booking canceled successfully.');
}

}
