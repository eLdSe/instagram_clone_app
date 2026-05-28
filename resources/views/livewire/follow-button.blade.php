<div>
    @if ($follow_state == 'Pending')
        <span class="inline-flex items-center justify-center px-4 py-[6px] text-[13px] font-semibold text-[#737373] bg-white/5 border border-white/10 rounded-xl cursor-default select-none">
            {{ __('Pending') }}
        </span>
    @else
        <button wire:click="toggle_follow"
                class="{{ $classes }} inline-flex items-center justify-center px-4 py-[6px] text-[13px] font-semibold rounded-xl transition-all duration-150 active:scale-95">
            {{ __($follow_state) }}
        </button>
    @endif
</div>
