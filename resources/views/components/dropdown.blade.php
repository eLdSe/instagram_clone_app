@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])
@php
    $alignClass = match($align) {
        'left'  => 'origin-top-left left-0',
        'top'   => 'origin-top',
        default => 'origin-top-right right-0',
    };
    $widthClass = match($width) {
        '96' => 'w-96',
        default => 'w-48',
    };
@endphp
<div class="relative" x-data="{ open: false }" @click.outside="open = false">
    <div @click="open = !open">{{ $trigger }}</div>
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-50 mt-2 {{ $widthClass }} {{ $alignClass }} glass rounded-2xl shadow-2xl overflow-hidden {{ $contentClasses }}"
         style="display:none;" @click="open = false">
        {{ $content }}
    </div>
</div>
