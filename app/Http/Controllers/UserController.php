<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        return view('dashboard.profile');
    }

    public function edit()
    {
        return view('dashboard.profile-edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
    public function bookings()
    {
        return view('dashboard.bookings');
    }
}
