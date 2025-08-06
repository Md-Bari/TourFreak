<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;

class TourSearchController extends Controller
{
    /**
     * Handle tour class search (e.g., mountain, sea, normal).
     */
    public function search(Request $request)
    {
        $request->validate([
            'class' => 'required|in:mountain,sea,normal',
        ]);

        $class = $request->input('class');
        $packages = TourPackage::where('class', $class)->get();

        return view('packages_user', compact('packages', 'class'));
    }
}
