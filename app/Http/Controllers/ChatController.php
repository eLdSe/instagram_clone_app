<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = auth()->user()->conversations()->get();
        return view('chat.index', compact('conversations'));
    }

    public function show(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('chat.index');
        }

        $conversation = Conversation::findOrCreate(auth()->id(), $user->id);
        return redirect()->route('chat.conversation', $conversation);
    }

    public function conversation(Conversation $conversation)
    {
        // Make sure auth user belongs to this conversation
        if ($conversation->user_one_id !== auth()->id() && $conversation->user_two_id !== auth()->id()) {
            abort(403);
        }

        $conversations = auth()->user()->conversations()->get();
        return view('chat.show', compact('conversation', 'conversations'));
    }
}
