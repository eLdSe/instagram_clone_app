<x-app-layout>
    <div class="flex gap-4 py-6" style="height: calc(100vh - 100px);">
        {{-- Sidebar: conversations list --}}
        <div class="hidden md:flex flex-col w-64 flex-shrink-0 card rounded-2xl overflow-hidden"
             style="background: var(--bg-card); border: 1px solid var(--border-color);">
            <div class="px-4 py-4 border-b" style="border-color: var(--border-color);">
                <span class="font-semibold" style="color: var(--text-primary);">{{ __('Messages') }}</span>
            </div>
            <div class="flex-1 overflow-y-auto">
                @forelse($conversations as $conv)
                    @php $other = $conv->otherUser(); $unread = $conv->unreadCount(); @endphp
                    <a href="{{ route('chat.conversation', $conv) }}"
                       class="flex items-center gap-3 px-4 py-3 transition-colors hover:bg-white/5 {{ $conv->id === $conversation->id ? 'bg-white/5' : '' }}">
                        <div class="relative flex-shrink-0">
                            <img src="{{ $other->avatarUrl() }}"
                                 class="w-10 h-10 rounded-full object-cover">
                            @if($unread > 0)
                                <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-blue-500 border-2"
                                      style="border-color: var(--bg-card);"></span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate" style="color: var(--text-primary);">{{ $other->username }}</p>
                        </div>
                    </a>
                @empty
                    <div class="flex items-center justify-center py-8">
                        <p class="text-sm" style="color: var(--text-muted);">{{ __('No conversations') }}</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Main chat area --}}
        <div class="flex-1 flex flex-col card rounded-2xl overflow-hidden"
             style="background: var(--bg-card); border: 1px solid var(--border-color);">
            {{-- Chat header --}}
            @php $otherUser = $conversation->otherUser(); @endphp
            <div class="flex items-center gap-3 px-5 py-4 border-b flex-shrink-0"
                 style="border-color: var(--border-color);">
                <a href="{{ route('chat.index') }}" class="md:hidden nav-icon">
                    <i class="bx bx-arrow-back text-[20px]"></i>
                </a>
                <a href="{{ route('user_profile', $otherUser) }}" class="flex items-center gap-3">
                    <img src="{{ $otherUser->avatarUrl() }}"
                         class="w-10 h-10 rounded-full object-cover">
                    <span class="font-semibold" style="color: var(--text-primary);">{{ $otherUser->username }}</span>
                </a>
            </div>

            {{-- Messages --}}
            <livewire:chat-box :conversation="$conversation" />
        </div>
    </div>
</x-app-layout>
