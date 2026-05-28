@props(['value'])
<label {{ $attributes->merge(['class' => 'block text-[12px] font-semibold text-[#737373] uppercase tracking-wider']) }}>
    {{ $value ?? $slot }}
</label>
