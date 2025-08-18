<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // উইশলিস্ট পেজ দেখানোর জন্য
    public function index()
    {
        // নিশ্চিত করুন যে ব্যবহারকারী লগইন করা আছে
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to view your wishlist.');
        }

        // উইশলিস্টের আইটেমগুলো ad-এর তথ্য সহ খুঁজে বের করুন
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('ad')->get();

        return view('dashboard.wishlist', compact('wishlistItems'));
    }

    // উইশলিস্টে আইটেম যোগ করার জন্য
    public function add($ad_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to add items to your wishlist.');
        }

        $existingItem = Wishlist::where('user_id', Auth::id())->where('ad_id', $ad_id)->first();

        if ($existingItem) {
            return back()->with('info', 'This ad is already in your wishlist.');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'ad_id' => $ad_id,
        ]);

        return back()->with('success', 'Ad added to your wishlist successfully!');
    }

    // উইশলিস্ট থেকে আইটেম মুছে ফেলার জন্য
    public function remove($ad_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to manage your wishlist.');
        }

        Wishlist::where('user_id', Auth::id())->where('ad_id', $ad_id)->delete();

        return back()->with('success', 'Ad removed from your wishlist successfully!');
    }
}