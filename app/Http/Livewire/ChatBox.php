<?php

namespace App\Http\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;

class ChatBox extends Component
{
    public Conversation $conversation;
    public string $newMessage = '';

    public function mount(Conversation $conversation)
    {
        $this->conversation = $conversation;
        $this->markAsRead();
    }

    public function sendMessage()
    {
        $trimmed = trim($this->newMessage);
        if (!$trimmed) return;

        Message::create([
            'conversation_id' => $this->conversation->id,
            'sender_id'       => auth()->id(),
            'body'            => $trimmed,
        ]);

        $this->conversation->update(['last_message_at' => now()]);
        $this->newMessage = '';
    }

    public function markAsRead()
    {
        Message::where('conversation_id', $this->conversation->id)
            ->where('sender_id', '!=', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public function render()
    {
        $this->markAsRead();

        $messages = Message::where('conversation_id', $this->conversation->id)
            ->with('sender')
            ->orderBy('created_at')
            ->get();

        return view('livewire.chat-box', ['messages' => $messages]);
    }
}