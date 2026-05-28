@props(['active'])
@php
$classes = ($active ?? false)
    ? 'nav-icon active'
    : 'nav-icon';
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
