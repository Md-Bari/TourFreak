<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    // Show all rooms (frontend)
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

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // unique filename
            $image->move(public_path('assets/images'), $imageName); // move to /public/assets/images
        } else {
            $imageName = null; // or use a default image name
        }

        // Save room to DB
        Room::create([
            'title' => $request->title,
            'image' => $imageName, // only the filename
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.rooms.add')->with('success', 'Room added successfully.');
    }
}
