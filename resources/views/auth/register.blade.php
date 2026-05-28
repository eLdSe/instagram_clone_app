<x-guest-layout>
<x-auth-card>
    <x-slot name="logo"><span></span></x-slot>

    <h2 class="text-[20px] font-semibold text-[#f5f5f5] mb-1 text-center">Create account</h2>
    <p class="text-[13px] text-[#555] text-center mb-6">Sign up to see photos from your friends.</p>

    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
        @csrf

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Name') }}</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus class="inp" placeholder="Full name">
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>
            <div>
                <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Username') }}</label>
                <input type="text" name="username" value="{{ old('username') }}" required class="inp" placeholder="@username">
                <x-input-error :messages="$errors->get('username')" class="mt-1" />
            </div>
        </div>

        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Email') }}</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="inp" placeholder="you@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Password') }}</label>
            <input type="password" name="password" required autocomplete="new-password" class="inp" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" required class="inp" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <button type="submit" class="btn-gradient w-full py-3 text-[14px] font-semibold mt-1" style="border-radius:12px;">
            {{ __('Create Account') }}
        </button>

        <p class="text-center text-[12px] text-[#555]">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="text-[#a8a8a8] hover:text-[#f5f5f5] font-semibold transition-colors">{{ __('Log in') }}</a>
        </p>
    </form>
</x-auth-card>
</x-guest-layout>
