<div class="flex flex-col flex-1 overflow-hidden" wire:poll.3000ms style="height: 100%;">
    {{-- Messages list --}}
    <div class="flex-1 overflow-y-auto px-5 py-4 space-y-3" id="chat-messages">
        @forelse($messages as $message)
            <div class="flex {{ $message->isMine() ? 'justify-end' : 'justify-start' }} items-end gap-2">
                @if(!$message->isMine())
                    <img src="{{ $message->sender->avatarUrl() }}"
                         class="w-7 h-7 rounded-full object-cover flex-shrink-0 mb-1">
                @endif
                <div class="max-w-[70%]">
                    <div class="px-4 py-2.5 rounded-2xl text-sm leading-relaxed
                        {{ $message->isMine() ? 'rounded-br-sm' : 'rounded-bl-sm' }}"
                         style="{{ $message->isMine()
                            ? 'background: linear-gradient(135deg, #0095f6, #1aa1f7); color: #fff;'
                            : 'background: var(--bg-secondary); color: var(--text-primary);'
                        }}">
                        {{ $message->body }}
                    </div>
                    <div class="flex items-center gap-1 mt-1 {{ $message->isMine() ? 'justify-end' : 'justify-start' }}">
                        <span class="text-[10px]" style="color: var(--text-muted);">
                            {{ $message->created_at->format('H:i') }}
                        </span>
                        @if($message->isMine())
                            @if($message->isRead())
                                <span class="text-[10px] text-blue-400">✓✓</span>
                            @else
                                <span class="text-[10px]" style="color: var(--text-muted);">✓</span>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center h-full gap-3 py-12">
                <i class="bx bx-message-rounded text-5xl" style="color: var(--text-muted);"></i>
                <p class="text-sm" style="color: var(--text-muted);">Начните переписку</p>
            </div>
        @endforelse
    </div>

    {{-- Input bar --}}
    <div class="flex-shrink-0 px-4 py-3 border-t" style="border-color: var(--border-color);">
        <div class="flex items-center gap-3">
            <div class="flex-1 flex items-center rounded-full px-4 py-2.5"
                 style="background: var(--bg-secondary); border: 1px solid var(--border-color);">
                <input wire:model="newMessage"
                       wire:keydown.enter="sendMessage"
                       type="text"
                       placeholder="Сообщение..."
                       class="flex-1 bg-transparent outline-none text-sm"
                       style="color: var(--text-primary);"
                       maxlength="1000">
            </div>
            <button wire:click="sendMessage"
                    class="flex items-center justify-center w-10 h-10 rounded-full transition-all"
                    style="background: #0095f6; color: white;">
                <i class="bx bx-send text-[18px]"></i>
            </button>
        </div>
    </div>
</div>

<script>
    function scrollChatToBottom() {
        const el = document.getElementById('chat-messages');
        if (el) el.scrollTop = el.scrollHeight;
    }
    scrollChatToBottom();
    window.addEventListener('livewire:update', scrollChatToBottom);
</script>
