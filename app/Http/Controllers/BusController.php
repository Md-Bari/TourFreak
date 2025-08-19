<?php

namespace App\Http\Controllers;

use App\Models\BusBook;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusController extends Controller
{
    // =========================
    // Search available buses
    // =========================
    public function search(Request $request)
    {
        $request->validate([
            'start' => 'required|string',
            'end'   => 'required|string',
            'date'  => 'required|date',
        ]);

        $buses = Bus::where('start_location', $request->start)
            ->where('end_location', $request->end)
            ->get();

        if ($buses->isEmpty()) {
            return back()->with('error', '❌ No buses found for this route.');
        }

        return view('bus.search_results', [
            'buses' => $buses,
            'date'  => $request->date
        ]);
    }

    // =========================
    // Show seat selection page
    // =========================
    public function seatSelection(Request $request)
    {
        $start = $request->start;
        $end   = $request->end;
        $date  = $request->date;

        if (!$start || !$end || !$date) {
            return redirect()->route('home')->with('error', '⚠ Please search a bus first.');
        }

        // Fetch already booked seats
        $bookedSeats = BusBook::where('start_location', $start)
            ->where('end_location', $end)
            ->where('journey_date', $date)
            ->pluck('seat_number')
            ->toArray();

        return view('bus.seat_selection', compact('start', 'end', 'date', 'bookedSeats'));
    }

    // =========================
    // Toggle seat booking (Ajax)
    // =========================
    public function toggleSeat(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthorized']);
        }

        $seat  = $request->seat;
        $start = $request->start_location;
        $end   = $request->end_location;
        $date  = $request->journey_date;

        // Check if seat is already booked
        $existing = BusBook::where([
            'start_location' => $start,
            'end_location'  => $end,
            'journey_date'  => $date,
            'seat_number'   => $seat,
        ])->first();

        if ($existing) {
            if ($existing->user_id == Auth::id()) {
                $existing->delete();
                return response()->json(['status' => 'unbooked']);
            }
            return response()->json(['status' => 'taken']);
        }

        // Otherwise, create booking
        BusBook::create([
            'start_location' => $start,
            'end_location'   => $end,
            'journey_date'   => $date,
            'journey_time'   => now()->format('H:i'),
            'user_id'        => Auth::id(),
            'seat_number'    => $seat,
            'status'         => 'booked',
        ]);

        return response()->json(['status' => 'booked']);
    }

    // =========================
    // Payment Page
    // =========================
    public function payment(Request $request)
    {
        // Convert seats string to array if needed
        $seats = is_array($request->seats) ? $request->seats : explode(',', $request->seats);

        $pricePerSeat = 500; // Example fixed price
        $totalPrice = count($seats) * $pricePerSeat;

        return view('bus.payment', compact('seats', 'totalPrice'));
    }
    public function cancel($id)
    {
        $busBooking = BusBook::findOrFail($id);

        if ($busBooking->user_id != Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        if ($busBooking->status === 'paid') {
            return back()->with('error', 'Paid tickets cannot be canceled.');
        }

        $busBooking->delete();

        return back()->with('success', 'Bus ticket canceled successfully.');
    }
}
