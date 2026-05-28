<div class="flex flex-col glass rounded-1xl overflow-hidden" style="max-height:500px;min-width:360px;">
    <div class="relative flex items-center justify-center px-4 py-4 border-b border-white/5">
        <h2 class="text-[15px] font-semibold text-[#f5f5f5]">{{ __('Following') }}</h2>
        <button wire:click="$emit('closeModal')"
                class="absolute right-4 text-[#555] hover:text-[#f5f5f5] transition-colors">
            <i class="bx bx-x text-[22px]"></i>
        </button>
    </div>
    <ul class="overflow-y-auto divide-y divide-white/5">
        @forelse($this->following_list as $following)
            <li class="flex items-center gap-3 px-4 py-3" wire:key="following-{{ $following->id }}">
                <div class="avatar-ring flex-shrink-0" style="width:38px;height:38px;">
                    <img src="{{ $following->avatarUrl() }}" style="width:32px;height:32px;" class="rounded-full object-cover">
                </div>
                <div class="flex flex-col grow min-w-0">
                    <a href="/{{ $following->username }}" class="text-[13px] font-semibold text-[#f5f5f5] hover:text-[#a8a8a8] truncate transition-colors">{{ $following->username }}</a>
                    <span class="text-[12px] text-[#555] truncate">{{ $following->name }}</span>
                </div>
                <livewire:follow-button :userId="$following->id"
                    classes="btn-ghost text-[13px] px-4 py-1.5 rounded-lg" />
            </li>
        @empty
            <li class="py-12 text-center text-[13px] text-[#555]">{{ __('Not following anyone yet') }}</li>
        @endforelse
    </ul>
</div>
