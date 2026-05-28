<div class="max-h-80 overflow-y-auto">
    <div class="px-4 py-3 border-b border-white/5">
        <h3 class="text-[13px] font-semibold text-[#f5f5f5]">{{ __('Follow Requests') }}</h3>
    </div>
    <ul class="divide-y divide-white/5">
        @forelse(auth()->user()->pending_followers as $pending)
            <li class="flex items-center gap-3 px-4 py-3" wire:key="user-{{ $pending->id }}">
                <div class="avatar-ring flex-shrink-0" style="width:38px;height:38px;">
                    <img src="{{ $pending->avatarUrl() }}" style="width:32px;height:32px;" class="rounded-full object-cover">
                </div>
                <div class="flex flex-col grow min-w-0">
                    <a href="/{{ $pending->username }}" class="text-[13px] font-semibold text-[#f5f5f5] hover:text-[#a8a8a8] truncate transition-colors">{{ $pending->username }}</a>
                    <span class="text-[11px] text-[#555] truncate">{{ $pending->name }}</span>
                </div>
                @auth
                <div class="flex gap-2 flex-shrink-0">
                    <button wire:click="confirm({{ $pending->id }})"
                            class="btn-gradient text-[12px] font-semibold px-3 py-1.5" style="border-radius:8px;">{{ __('Confirm') }}</button>
                    <button wire:click="delete({{ $pending->id }})"
                            class="btn-ghost text-[12px] font-semibold px-3 py-1.5" style="border-radius:8px;">{{ __('Delete') }}</button>
                </div>
                @endauth
            </li>
        @empty
            <li class="py-8 text-center text-[13px] text-[#555]">{{ __('No pending requests') }}</li>
        @endforelse
    </ul>
</div>
