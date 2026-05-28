<div class="min-h-screen flex items-center justify-center px-4 py-12 relative overflow-hidden">

    {{-- Ambient blobs --}}
    <div style="position:fixed;top:-30%;left:-20%;width:600px;height:600px;background:radial-gradient(circle,rgba(238,42,123,0.12),transparent 70%);pointer-events:none;z-index:0;"></div>
    <div style="position:fixed;bottom:-20%;right:-10%;width:500px;height:500px;background:radial-gradient(circle,rgba(98,40,215,0.1),transparent 70%);pointer-events:none;z-index:0;"></div>

    <div class="relative z-10 w-full max-w-[400px] animate-fade-up">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <span class="text-gradient" style="font-family:'DM Serif Display',serif;font-size:42px;letter-spacing:-1px;">gram</span>
            <p class="text-[13px] text-[#555] mt-2">Share your world</p>
        </div>

        {{-- Card --}}
        <div class="glass rounded-3xl p-8" style="box-shadow:0 24px 80px rgba(0,0,0,0.5);">
            {{ $slot }}
        </div>

        {{-- Logo slot (hidden — kept for compatibility) --}}
        <div style="display:none;">{{ $logo }}</div>

    </div>
</div>
