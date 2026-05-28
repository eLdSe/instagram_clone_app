<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UnreadMessagesCount extends Component
{
    public function render()
    {
        $count = auth()->user()->unreadMessagesCount();
        return view('livewire.unread-messages-count', ['count' => $count]);
    }
}
