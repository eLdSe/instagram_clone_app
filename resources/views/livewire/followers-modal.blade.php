<div class="flex flex-col glass rounded-1xl overflow-hidden" style="max-height:500px;min-width:360px;">
    <div class="relative flex items-center justify-center px-4 py-4 border-b border-white/5">
        <h2 class="text-[15px] font-semibold text-[#f5f5f5]">{{ __('Followers') }}</h2>
        <button wire:click="$emit('closeModal')"
                class="absolute right-4 text-[#555] hover:text-[#f5f5f5] transition-colors">
            <i class="bx bx-x text-[22px]"></i>
        </button>
    </div>
    <ul class="overflow-y-auto divide-y divide-white/5">
        @forelse($this->followers_list as $follower)
            <li class="flex items-center gap-3 px-4 py-3" wire:key="follower-{{ $follower->id }}">
                <div class="avatar-ring flex-shrink-0" style="width:38px;height:38px;">
                    <img src="{{ $follower->avatarUrl() }}" style="width:32px;height:32px;" class="rounded-full object-cover">
                </div>
                <div class="flex flex-col grow min-w-0">
                    <a href="/{{ $follower->username }}" class="text-[13px] font-semibold text-[#f5f5f5] hover:text-[#a8a8a8] truncate transition-colors">{{ $follower->username }}</a>
                    <span class="text-[12px] text-[#555] truncate">{{ $follower->name }}</span>
                </div>
                <livewire:follow-button :userId="$follower->id"
                    classes="btn-blue text-[13px] px-4 py-1.5 rounded-lg" />
            </li>
        @empty
            <li class="py-12 text-center text-[13px] text-[#555]">{{ __('No followers yet') }}</li>
        @endforelse
    </ul>
</div>
