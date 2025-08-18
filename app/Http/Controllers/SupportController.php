<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SupportController extends Controller
{
    /**
     * ইউজারের সব টিকেট দেখাবে।
     */
    public function index()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())->latest()->get();
        return view('support.index', compact('tickets'));
    }

    /**
     * নতুন টিকেট তৈরির ফর্ম দেখাবে।
     */
    public function create()
    {
        return view('support.create');
    }

    /**
     * নতুন টিকেট ডেটাবেসে সেভ করবে।
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'ticket_id' => Str::random(10), // একটি র্যান্ডম টিকেট আইডি
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('support.index')->with('success', 'Support ticket created successfully!');
    }

    /**
     * একটি নির্দিষ্ট টিকেট দেখাবে।
     */
    public function show($ticket_id)
    {
        $ticket = SupportTicket::where('ticket_id', $ticket_id)
                                ->where('user_id', Auth::id())
                                ->firstOrFail();
        
        return view('support.show', compact('ticket'));
    }
}
