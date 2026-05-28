<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <script>
        const saved = localStorage.getItem('theme');
        const preferred = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
        document.documentElement.dataset.theme = saved || preferred;
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gram') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased">

    @include('layouts.navigation')

    <main class="max-w-5xl mx-auto px-4 pb-16" style="padding-top: 72px;">
        {{ $slot }}
    </main>

    {{-- Mobile bottom navigation --}}
    @auth
    <nav class="mobile-nav md:hidden">
        <a href="{{ route('home_page') }}" class="nav-icon {{ url()->current() == route('home_page') ? 'active' : '' }}">
            {!! url()->current() == route('home_page') ? '<i class="bx bxs-home-alt-2 text-[24px]"></i>' : '<i class="bx bx-home-alt-2 text-[24px]"></i>' !!}
        </a>
        <a href="{{ route('explore') }}" class="nav-icon {{ url()->current() == route('explore') ? 'active' : '' }}">
            {!! url()->current() == route('explore') ? '<i class="bx bxs-compass text-[24px]"></i>' : '<i class="bx bx-compass text-[24px]"></i>' !!}
        </a>
        <button onclick="Livewire.emit('openModal', 'create-post-modal')"
                class="w-10 h-10 flex items-center justify-center rounded-2xl"
                style="background:linear-gradient(135deg,#f58529,#dd2a7b,#8134af,#515bd4);">
            <i class="bx bx-plus text-[22px] text-white"></i>
        </button>
        <a href="{{ route('user_profile', auth()->user()) }}" class="nav-icon">
            <img src="{{ auth()->user()->avatarUrl() }}"
                 class="w-7 h-7 rounded-full object-cover border-2"
                 style="border-color: {{ url()->current() == route('user_profile', auth()->user()) ? '#ee2a7b' : 'rgba(255,255,255,0.15)' }}">
        </a>
    </nav>
    @endauth

    @livewireScripts
    @livewire('livewire-ui-modal')
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

    <style>
        .card { animation: fadeUp 0.5s ease both; }
        .card:nth-child(1) { animation-delay: 0.05s; }
        .card:nth-child(2) { animation-delay: 0.10s; }
        .card:nth-child(3) { animation-delay: 0.15s; }
        .card:nth-child(4) { animation-delay: 0.20s; }
        .card:nth-child(5) { animation-delay: 0.25s; }
    </style>
</body>
</html>
