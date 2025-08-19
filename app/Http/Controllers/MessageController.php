<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('sender')->orderBy('created_at', 'desc')->get();
        return view('frontend.messages.index', compact('messages'));
    }

    public function getConversation($senderId)
    {
        $messages = Message::where(function($query) use ($senderId) {
            $query->where('sender_id', $senderId)
                  ->where('receiver_id', auth()->id());
        })->orWhere(function($query) use ($senderId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $senderId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $validated['receiver_id'],
            'message' => $validated['message']
        ]);

        return response()->json($message);
    }
}
