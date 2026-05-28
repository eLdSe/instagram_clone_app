<div>
    <button wire:click="toggle_like" class="nav-icon group" style="width:auto;height:auto;padding:6px;border-radius:10px;">
        @if ($post->liked(auth()->user()))
            <i class="bx bxs-heart text-[24px] text-red-500 group-hover:text-red-400 transition-colors heart-pop"></i>
        @else
            <i class="bx bx-heart text-[24px] text-[#f5f5f5] group-hover:text-red-400 transition-colors"></i>
        @endif
    </button>
</div>
