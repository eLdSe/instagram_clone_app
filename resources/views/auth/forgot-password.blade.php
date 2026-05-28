<x-guest-layout>
<x-auth-card>
    <x-slot name="logo"><span></span></x-slot>
    <h2 class="text-[20px] font-semibold text-[#f5f5f5] mb-2 text-center">Reset password</h2>
    <p class="text-[13px] text-[#555] text-center mb-6">{{ __("Enter your email and we'll send you a reset link.") }}</p>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
        @csrf
        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Email') }}</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="inp" placeholder="you@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>
        <button type="submit" class="btn-gradient w-full py-3 text-[14px] font-semibold" style="border-radius:12px;">
            {{ __('Send Reset Link') }}
        </button>
        <a href="{{ route('login') }}" class="text-center text-[13px] text-[#555] hover:text-[#a8a8a8] transition-colors">← {{ __('Back to login') }}</a>
    </form>
</x-auth-card>
</x-guest-layout>
