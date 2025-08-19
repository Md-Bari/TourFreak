<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusAdminController extends Controller
{
    // Show form + bus list
    public function index()
    {
        $buses = Bus::orderBy('start_time', 'asc')->get();
        return view('admin.buses.index', compact('buses'));
    }

    // Store new bus
    public function store(Request $request)
    {
        $request->validate([
            'bus_name'       => 'required|string|max:255',
            'start_location' => 'required|string|max:255',
            'end_location'   => 'required|string|max:255|different:start_location',
            'start_time'     => 'required|date',
        ]);

        Bus::create($request->all());

        return redirect()->back()->with('success', 'Bus added successfully!');
    }
}
