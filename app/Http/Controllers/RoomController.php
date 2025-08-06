<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::latest()->get(); // Fetch all rooms, newest first
        return view('room', compact('rooms'));
    }

    // Show room detail by type (frontend)
    public function show($type)
    {
        return view('room-details', ['type' => $type]);
    }

    // Show the room add form (admin)
    public function create()
    {
        return view('admin.room_add');
    }

    // Store the room in database (admin)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Save the uploaded image to public storage
        $imagePath = $request->file('image')->store('uploads/rooms', 'public');

        // Save room data to database
        Room::create([
            'title' => $request->title,
            'image' => $imagePath,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.rooms.add')->with('success', 'Room added successfully.');
    }
}
