<div>
    @if ($this->count > 0)
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full min-w-[16px] h-4 flex items-center justify-center px-1"
              style="animation: pulse-dot 2s infinite;">
            {{ $this->count }}
        </span>
    @endif
</div>
