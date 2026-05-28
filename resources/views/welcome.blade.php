<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>gram — Share your world</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .blob1 { position:fixed;top:-20%;left:-15%;width:700px;height:700px;background:radial-gradient(circle,rgba(238,42,123,0.13),transparent 65%);pointer-events:none;z-index:0;animation:blobDrift 12s ease-in-out infinite alternate; }
        .blob2 { position:fixed;bottom:-20%;right:-10%;width:600px;height:600px;background:radial-gradient(circle,rgba(98,40,215,0.1),transparent 65%);pointer-events:none;z-index:0;animation:blobDrift 16s ease-in-out infinite alternate-reverse; }
        .blob3 { position:fixed;top:40%;left:30%;width:400px;height:400px;background:radial-gradient(circle,rgba(249,206,52,0.06),transparent 65%);pointer-events:none;z-index:0; }
        @keyframes blobDrift { from{transform:translate(0,0) scale(1);} to{transform:translate(40px,30px) scale(1.05);} }
        .feature-card { background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:20px;padding:28px;transition:all 0.3s ease; }
        .feature-card:hover { background:rgba(255,255,255,0.05);border-color:rgba(238,42,123,0.2);transform:translateY(-3px);box-shadow:0 20px 60px rgba(0,0,0,0.4); }
        .hero-badge { display:inline-flex;align-items:center;gap:8px;padding:6px 14px;background:rgba(238,42,123,0.1);border:1px solid rgba(238,42,123,0.2);border-radius:99px;font-size:12px;font-weight:600;color:#ee2a7b;margin-bottom:28px; }
        .stagger-1{animation:fadeUp .6s ease .1s both;}
        .stagger-2{animation:fadeUp .6s ease .2s both;}
        .stagger-3{animation:fadeUp .6s ease .3s both;}
        .stagger-4{animation:fadeUp .6s ease .4s both;}
        .stagger-5{animation:fadeUp .6s ease .5s both;}
        .stagger-6{animation:fadeUp .6s ease .6s both;}
        @keyframes fadeUp{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
    </style>
</head>
<body class="antialiased min-h-screen relative overflow-x-hidden" style="background:#0a0a0a;color:#f5f5f5;font-family:'DM Sans',sans-serif;">

    <div class="blob1"></div>
    <div class="blob2"></div>
    <div class="blob3"></div>

    {{-- Nav --}}
    <header class="fixed top-0 left-0 right-0 z-50" style="background:rgba(10,10,10,0.8);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,0.05);">
        <div class="max-w-5xl mx-auto px-6 h-14 flex items-center justify-between">
            <span style="font-family:'DM Serif Display',serif;font-size:24px;letter-spacing:-0.5px;background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">gram</span>
            @if (Route::has('login'))
                <div class="flex items-center gap-2">
                    @auth
                        <a href="{{ url('/') }}"
                           class="px-5 py-2 text-[13px] font-semibold rounded-xl transition-all"
                           style="background:linear-gradient(135deg,#f58529,#dd2a7b,#8134af,#515bd4);color:#fff;">
                            Open app
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 text-[13px] font-semibold rounded-xl text-[#a8a8a8] hover:text-[#f5f5f5] transition-colors">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-5 py-2 text-[13px] font-semibold rounded-xl"
                               style="background:linear-gradient(135deg,#f58529,#dd2a7b,#8134af,#515bd4);color:#fff;">
                                Sign up free
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>

    {{-- Hero --}}
    <main class="relative z-10 max-w-5xl mx-auto px-6 pt-32 pb-20">

        <div class="text-center mb-20">
            <div class="hero-badge stagger-1">
                <span style="width:6px;height:6px;border-radius:50%;background:linear-gradient(135deg,#f9ce34,#ee2a7b);display:inline-block;"></span>
                Built with Laravel & Livewire
            </div>

            <h1 class="stagger-2" style="font-family:'DM Serif Display',serif;font-size:clamp(52px,8vw,88px);line-height:1.02;letter-spacing:-2px;margin-bottom:24px;">
                Share your<br>
                <span style="background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    world.
                </span>
            </h1>

            <p class="stagger-3" style="font-size:18px;color:#737373;max-width:480px;margin:0 auto 40px;line-height:1.7;font-weight:300;">
                A beautifully crafted social platform. Post photos, discover people, and build your community.
            </p>

            <div class="stagger-4 flex items-center justify-center gap-3 flex-wrap">
                @guest
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 px-8 py-3.5 font-semibold text-[15px] rounded-2xl text-white"
                       style="background:linear-gradient(135deg,#f58529,#dd2a7b,#8134af,#515bd4);background-size:200%;box-shadow:0 8px 32px rgba(238,42,123,0.35);">
                        <i class="bx bx-rocket text-[18px]"></i>
                        Get started — it's free
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-2 px-8 py-3.5 font-semibold text-[15px] rounded-2xl text-[#a8a8a8] hover:text-[#f5f5f5] transition-colors"
                       style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);">
                        Sign in
                    </a>
                @else
                    <a href="{{ url('/') }}"
                       class="inline-flex items-center gap-2 px-8 py-3.5 font-semibold text-[15px] rounded-2xl text-white"
                       style="background:linear-gradient(135deg,#f58529,#dd2a7b,#8134af,#515bd4);box-shadow:0 8px 32px rgba(238,42,123,0.35);">
                        <i class="bx bx-home text-[18px]"></i> Go to feed
                    </a>
                @endauth
            </div>
        </div>

        {{-- Features grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-20">
            <div class="feature-card stagger-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-5"
                     style="background:rgba(238,42,123,0.1);border:1px solid rgba(238,42,123,0.15);">
                    <i class="bx bx-camera text-[24px]" style="background:linear-gradient(135deg,#f9ce34,#ee2a7b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></i>
                </div>
                <h3 style="font-size:16px;font-weight:700;color:#f5f5f5;margin-bottom:8px;">Share Moments</h3>
                <p style="font-size:13px;color:#555;line-height:1.7;">Upload and share your best photos with beautiful filters and captions.</p>
            </div>

            <div class="feature-card stagger-5">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-5"
                     style="background:rgba(98,40,215,0.1);border:1px solid rgba(98,40,215,0.15);">
                    <i class="bx bx-user-plus text-[24px]" style="background:linear-gradient(135deg,#ee2a7b,#6228d7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></i>
                </div>
                <h3 style="font-size:16px;font-weight:700;color:#f5f5f5;margin-bottom:8px;">Build Your Network</h3>
                <p style="font-size:13px;color:#555;line-height:1.7;">Follow friends and discover interesting people from around the world.</p>
            </div>

            <div class="feature-card stagger-6">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-5"
                     style="background:rgba(249,206,52,0.08);border:1px solid rgba(249,206,52,0.12);">
                    <i class="bx bx-compass text-[24px]" style="background:linear-gradient(135deg,#f9ce34,#f77737);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></i>
                </div>
                <h3 style="font-size:16px;font-weight:700;color:#f5f5f5;margin-bottom:8px;">Explore & Discover</h3>
                <p style="font-size:13px;color:#555;line-height:1.7;">Browse the explore page to find stunning new content every day.</p>
            </div>
        </div>

        {{-- Bottom mockup strip --}}
        <div class="text-center" style="border-top:1px solid rgba(255,255,255,0.05);padding-top:40px;">
            <p style="font-size:12px;color:#333;">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} · PHP v{{ PHP_VERSION }} ·
                <span style="background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-family:'DM Serif Display',serif;font-size:14px;">gram</span>
                © {{ date('Y') }}
            </p>
        </div>

    </main>

</body>
</html>
