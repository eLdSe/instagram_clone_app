<div wire:poll.5000ms>
    @if($count > 0)
        <span class="absolute -top-1 -right-1 text-[10px] font-bold text-white bg-blue-500 rounded-full min-w-[16px] h-4 flex items-center justify-center px-1">
            {{ $count > 99 ? '99+' : $count }}
        </span>
    @endif
</div>
