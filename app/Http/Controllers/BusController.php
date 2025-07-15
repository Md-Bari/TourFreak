<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusController extends Controller
{
    public function search(Request $request)
    {
        // Handle the search logic
        return view('bus.results'); // Adjust the view name as needed
    }
}
