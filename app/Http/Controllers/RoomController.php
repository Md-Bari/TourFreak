<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function show($type)
    {
        return view('room-details', ['type' => $type]);
    }
}
