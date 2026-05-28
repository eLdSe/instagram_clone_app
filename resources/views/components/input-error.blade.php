@props(['messages'])
@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-[12px] text-red-400 space-y-0.5 mt-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
