<x-guest-layout>
<x-auth-card>
    <x-slot name="logo"><span></span></x-slot>
    <h2 class="text-[20px] font-semibold text-[#f5f5f5] mb-6 text-center">{{ __('Set new password') }}</h2>
    <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-4">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Email') }}</label>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="inp">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>
        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Password') }}</label>
            <input type="password" name="password" required class="inp" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>
        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" required class="inp" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>
        <button type="submit" class="btn-gradient w-full py-3 text-[14px] font-semibold" style="border-radius:12px;">
            {{ __('Reset Password') }}
        </button>
    </form>
</x-auth-card>
</x-guest-layout>
