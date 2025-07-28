<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Show all rooms
    public function index()
    {
        $rooms = Room::all(); // fetch all rooms
        return view('room', compact('rooms')); // pass to view as 'rooms'
    }

    // Show single room details
    public function show($id)
    {
        $room = Room::findOrFail($id); // fetch room by id
        return view('room-detail', compact('room')); // pass to detail view
    }
}
