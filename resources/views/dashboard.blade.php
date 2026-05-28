<x-app-layout>
<div class="py-12 animate-fade-up">
    <div class="max-w-lg mx-auto text-center">
        <div class="glass rounded-3xl p-10">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5"
                 style="background:rgba(0,149,246,0.1);border:1px solid rgba(0,149,246,0.2);">
                <i class="bx bx-check-shield text-[32px] text-[#0095f6]"></i>
            </div>
            <h2 class="text-[22px] font-semibold text-[#f5f5f5] mb-2">{{ __("You're logged in!") }}</h2>
            <p class="text-[14px] text-[#555] mb-6">Welcome back. Ready to share something?</p>
            <a href="{{ route('home_page') }}"
               class="btn-gradient inline-flex items-center gap-2 px-6 py-3 text-[14px] font-semibold" style="border-radius:14px;">
                <i class="bx bx-home text-[18px]"></i> Go to Feed
            </a>
        </div>
    </div>
</div>
</x-app-layout>
