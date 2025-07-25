<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::all();
        return view('welcome', compact('packages'));
    }

    public function admin()
    {
        $packages = TourPackage::all();
        return view('admin.packages', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'class' => 'required|in:mountain,sea,normal',
            'image' => 'required',
            'features' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        TourPackage::create($request->all());

        return redirect()->back()->with('success', 'Package added successfully');
    }

    public function destroy($id)
    {
        TourPackage::destroy($id);
        return redirect()->back()->with('success', 'Package deleted');
    }
}
