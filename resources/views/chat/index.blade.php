<x-app-layout>
    <div class="max-w-2xl mx-auto py-6">
        <div class="card rounded-2xl overflow-hidden" style="background: var(--bg-card); border: 1px solid var(--border-color);">
            <div class="px-5 py-4 border-b" style="border-color: var(--border-color);">
                <h2 class="font-semibold text-lg" style="color: var(--text-primary);">{{ __('Messages') }}</h2>
            </div>

            @forelse($conversations as $conv)
                @php $other = $conv->otherUser(); $unread = $conv->unreadCount(); @endphp
                <a href="{{ route('chat.conversation', $conv) }}"
                   class="flex items-center gap-3 px-5 py-3 transition-colors hover:bg-white/5">
                    <div class="relative flex-shrink-0">
                        <img src="{{ $other->avatarUrl() }}"
                             class="w-12 h-12 rounded-full object-cover"
                             style="border: 2px solid var(--border-color);">
                        @if($unread > 0)
                            <span class="absolute -top-0.5 -right-0.5 w-3 h-3 rounded-full bg-blue-500 border-2"
                                  style="border-color: var(--bg-card);"></span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-sm" style="color: var(--text-primary);">{{ $other->username }}</span>
                            @if($conv->last_message_at)
                                <span class="text-xs" style="color: var(--text-muted);">{{ $conv->last_message_at->diffForHumans(null, true) }}</span>
                            @endif
                        </div>
                        @php $lastMsg = $conv->messages->last(); @endphp
                        @if($lastMsg)
                            <p class="text-sm truncate mt-0.5 {{ $unread > 0 ? 'font-semibold' : '' }}"
                               style="color: {{ $unread > 0 ? 'var(--text-primary)' : 'var(--text-muted)' }};">
                                {{ $lastMsg->sender_id === auth()->id() ? __('You') . ': ' : '' }}{{ $lastMsg->body }}
                            </p>
                        @endif
                    </div>
                    @if($unread > 0)
                        <span class="flex-shrink-0 text-xs font-bold text-white bg-blue-500 rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $unread > 9 ? '9+' : $unread }}
                        </span>
                    @endif
                </a>
            @empty
                <div class="flex flex-col items-center justify-center py-16 gap-3">
                    <i class="bx bx-message-rounded-dots text-5xl" style="color: var(--text-muted);"></i>
                    <p class="text-sm" style="color: var(--text-muted);">{{ __('No messages yet') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
