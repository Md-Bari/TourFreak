<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutMe;

class AboutController extends Controller
{
    // Show form with current About data for editing
    public function edit()
    {
        // Assuming you have only one About record
        $about = AboutMe::first();
        return view('admin.about.edit', compact('about'));
    }

    // Update About info in database
    public function update(Request $request)
    {
        $data = $request->validate([
            'bio' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $about = AboutMe::first();

        if (!$about) {
            // If no About record exists, create one
            $about = AboutMe::create($data);
        } else {
            $about->update($data);
        }

        return redirect('/admin/about/edit')->with('success', 'About section updated!');
    }
}
