@props(['status'])
@if ($status)
    <div {{ $attributes->merge(['class' => 'text-[13px] text-green-400 bg-green-400/10 border border-green-400/20 rounded-xl px-4 py-3']) }}>
        {{ $status }}
    </div>
@endif
