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
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'features' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        // Handle image upload
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/images'), $imageName);

        TourPackage::create([
            'title' => $request->title,
            'class' => $request->class,
            'image' => $imageName,
            'features' => $request->features,
            'description' => $request->description,
            'price' => $request->price,
        ]);

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'features' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $package = TourPackage::findOrFail($id);

        // If new image uploaded
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/images'), $imageName);

            // Optional: delete old image if exists
            $oldImage = public_path('assets/images/' . $package->image);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            $package->image = $imageName;
        }

        $package->title = $request->title;
        $package->class = $request->class;
        $package->features = $request->features;
        $package->description = $request->description;
        $package->price = $request->price;

        $package->save();

        return redirect()->route('admin.packages')->with('success', 'Package updated successfully');
    }

    public function destroy($id)
    {
        $package = TourPackage::findOrFail($id);

        // Optional: delete image file
        $oldImage = public_path('assets/images/' . $package->image);
        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        $package->delete();

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
