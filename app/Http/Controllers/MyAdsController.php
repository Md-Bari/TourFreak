<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ad;

class MyAdsController extends Controller
{
    public function index()
    {
        $myAds = Ad::where('user_id', Auth::id())->latest()->get();
        return view('dashboard.my-ads', compact('myAds'));
    }
}