<div class="text-[13px] font-semibold text-[#f5f5f5]">
    @if ($this->likes > 0)
        {{ number_format($this->likes) }} {{ $this->likes == 1 ? __('like') : __('likes') }}
    @endif
</div>
