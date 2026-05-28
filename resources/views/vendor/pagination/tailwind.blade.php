@if ($paginator->hasPages())
<nav class="flex items-center justify-center gap-2 py-8">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="w-9 h-9 flex items-center justify-center rounded-xl text-[#333] cursor-not-allowed" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);">
            <i class="bx bx-chevron-left text-[18px]"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}"
           class="w-9 h-9 flex items-center justify-center rounded-xl text-[#737373] hover:text-[#f5f5f5] transition-colors"
           style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);">
            <i class="bx bx-chevron-left text-[18px]"></i>
        </a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="w-9 h-9 flex items-center justify-center text-[13px] text-[#555]">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="w-9 h-9 flex items-center justify-center rounded-xl text-[13px] font-bold text-white"
                          style="background:linear-gradient(135deg,#f58529,#dd2a7b);">{{ $page }}</span>
                @else
                    <a href="{{ $url }}"
                       class="w-9 h-9 flex items-center justify-center rounded-xl text-[13px] font-medium text-[#737373] hover:text-[#f5f5f5] transition-colors"
                       style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
           class="w-9 h-9 flex items-center justify-center rounded-xl text-[#737373] hover:text-[#f5f5f5] transition-colors"
           style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);">
            <i class="bx bx-chevron-right text-[18px]"></i>
        </a>
    @else
        <span class="w-9 h-9 flex items-center justify-center rounded-xl text-[#333] cursor-not-allowed" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.05);">
            <i class="bx bx-chevron-right text-[18px]"></i>
        </span>
    @endif
</nav>
@endif
