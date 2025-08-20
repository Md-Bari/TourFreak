<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        // Send OTP via Email
        Mail::raw("Your OTP code is: $otp. It will expire in 10 minutes.", function ($msg) use ($user) {
            $msg->to($user->email)->subject('Email Verification OTP');
        });

        return redirect()->route('otp.verify.form', $user->id)
            ->with('status', 'We have sent you an OTP to your email. Please verify.');
    }

    public function showOtpForm($id)
    {
        $user = User::findOrFail($id);
        return view('auth.verify-otp', compact('user'));
    }

    public function verifyOtp(Request $request, $id)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $user = User::findOrFail($id);

        if ($user->otp_code == $request->otp && now()->lt($user->otp_expires_at)) {
            $user->email_verified_at = now();
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            Auth::login($user);

            return redirect()->route('home')->with('status', 'Your email has been verified successfully!');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP']);
    }
}
