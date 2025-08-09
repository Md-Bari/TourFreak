<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\TourPackage;

class RoomController extends Controller
{
    /**
     * Homepage view (welcome.blade.php)
     */
    public function welcome()
    {
        $rooms = Room::latest()->take(8)->get(); // 8 latest rooms
        $packages = TourPackage::latest()->get(); // all packages

        return view('welcome', compact('rooms', 'packages'));
    }

    /**
     * Show all rooms (room.blade.php)
     */
    public function index()
    {
        $rooms = Room::latest()->get();
        return view('room', compact('rooms'));
    }

    /**
     * Show single room by type
     */
    public function show($type)
    {
        $room = Room::whereRaw('LOWER(title) = ?', [strtolower($type)])->firstOrFail();
        return view('room-details', compact('room'));
    }

    /**
     * Admin room add form
     */
    public function create()
    {
        return view('admin.room_add');
    }

    /**
     * Store a new room
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Upload image
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/images'), $imageName);

        // Save room
        Room::create([
            'title' => $request->title,
            'image' => $imageName,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.rooms.add')->with('success', 'Room added successfully.');
    }
}
