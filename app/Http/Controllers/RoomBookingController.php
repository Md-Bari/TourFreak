<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomBooking;
use Illuminate\Support\Facades\Auth;

class RoomBookingController extends Controller
{
    // Show room booking page
    public function create($roomId, Request $request)
    {
        $room = Room::findOrFail($roomId);

        // Optional: get days from query string (from show.blade.php)
        $days = $request->query('days', 1);

        return view('order.roombooking', compact('room', 'days'));
    }

    // Store room booking
    public function store(Request $request)
    {
        $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1',
        ]);

        $room = Room::findOrFail($request->room_id);
        $user = Auth::user();

        // Calculate nights
        $checkIn = new \DateTime($request->check_in);
        $checkOut = new \DateTime($request->check_out);
        $nights = $checkOut->diff($checkIn)->days;

        // Total price + 15% VAT
        $subtotal = $room->price_per_night * $nights * $request->guests;
        $vat      = $subtotal * 0.15;
        $total    = $subtotal + $vat;

        // Save booking
        RoomBooking::create([
            'user_id'     => $user->id,
            'room_id'     => $room->id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guests'      => $request->guests,
            'nights'      => $nights,
            'total_price' => $total,
            'status'      => 'Pending',
        ]);

        return redirect()->route('roombooking.create', $room->id)
            ->with('success', 'Room booked successfully! Total: ৳' . number_format($total, 2));
    }

    // Show user's bookings
    public function myBookings()
    {
        $bookings = RoomBooking::with('room')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('home', compact('bookings'));
    }

    // Cancel booking
    public function cancel($id)
    {
        $booking = RoomBooking::findOrFail($id);

        if ($booking->status === 'Paid') {
            return redirect()->back()->with('error', 'Paid bookings cannot be canceled.');
        }

        $booking->delete();

        return redirect()->back()->with('success', 'Booking canceled successfully.');
    }
}
