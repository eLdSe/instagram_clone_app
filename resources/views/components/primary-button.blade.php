<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-gradient inline-flex items-center justify-center px-5 py-2.5 text-[13px] font-semibold']) }}>
    {{ $slot }}
</button>
