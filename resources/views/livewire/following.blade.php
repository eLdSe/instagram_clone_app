<div>
    <li class="flex flex-col items-center gap-0.5 cursor-pointer group"
        onclick="Livewire.emit('openModal', 'following-modal', {{ json_encode(['userId' => $userId]) }})">
        <span class="font-bold text-[16px] text-[#f5f5f5] group-hover:text-gradient transition-colors">{{ $this->count }}</span>
        <span class="text-[12px] text-[#737373] group-hover:text-[#a8a8a8] transition-colors">{{ __('following') }}</span>
    </li>
</div>
