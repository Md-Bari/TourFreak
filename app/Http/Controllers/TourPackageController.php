<?php


namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;
use App\Models\Review;
class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::with(['reviews.user'])->get();

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
    public function storeReview(Request $request)
{
    $request->validate([
        'package_id' => 'required|exists:tour_packages,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
    ]);

    Review::create([
        'user_id' => auth()->id(),
        'package_id' => $request->package_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success', 'Thank you for your review!');
}
}
