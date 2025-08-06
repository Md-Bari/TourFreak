<?php


namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::all();
        // Show admin package management if on admin route, else show welcome
        if (request()->routeIs('admin.packages')) {
            return view('admin.packages', compact('packages'));
        }
        return view('welcome', compact('packages'));
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

    public function edit($id)
    {
        $package = TourPackage::findOrFail($id);
        return view('admin.edit_package', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'class' => 'required|in:mountain,sea,normal',
            'image' => 'required',
            'features' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $package = TourPackage::findOrFail($id);
        $package->update($request->all());

        return redirect()->route('admin.packages')->with('success', 'Package updated successfully');
    }

    public function destroy($id)
    {
        TourPackage::destroy($id);
        return redirect()->back()->with('success', 'Package deleted');
    }
}
