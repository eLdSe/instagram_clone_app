@props(['active'])
<a {{ $attributes->merge(['class' => 'block px-5 py-3 text-[14px] font-medium text-[#a8a8a8] hover:text-white transition-colors']) }}>{{ $slot }}</a>
