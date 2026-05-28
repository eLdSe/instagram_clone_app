<x-guest-layout>
<x-auth-card>
    <x-slot name="logo"><span></span></x-slot>

    <h2 class="text-[20px] font-semibold text-[#f5f5f5] mb-6 text-center">Welcome back</h2>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
        @csrf

        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Email') }}</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="inp" placeholder="you@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Password') }}</label>
            <input type="password" name="password" required autocomplete="current-password"
                   class="inp" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between text-[12px] text-[#737373] mt-1">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember"
                       class="rounded border-white/10 bg-white/5 text-[#ee2a7b] focus:ring-[#ee2a7b]/30 focus:ring-1">
                <span>{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="hover:text-[#a8a8a8] transition-colors">{{ __('Forgot password?') }}</a>
            @endif
        </div>

        <button type="submit" class="btn-gradient w-full py-3 text-[14px] font-semibold mt-2" style="border-radius:12px;">
            {{ __('Log in') }}
        </button>

        <div class="flex items-center gap-3 my-1">
            <div class="flex-1 divider"></div>
            <span class="text-[11px] text-[#444] font-semibold uppercase tracking-widest">or</span>
            <div class="flex-1 divider"></div>
        </div>

        <a href="/register"
           class="btn-ghost w-full py-3 text-[14px] font-semibold text-center block" style="border-radius:12px;">
            {{ __("Don't have an account? Sign up") }}
        </a>
    </form>
</x-auth-card>
</x-guest-layout>
