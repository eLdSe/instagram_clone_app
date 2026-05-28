<x-guest-layout>
<x-auth-card>
    <x-slot name="logo"><span></span></x-slot>
    <h2 class="text-[20px] font-semibold text-[#f5f5f5] mb-2 text-center">{{ __('Confirm password') }}</h2>
    <p class="text-[13px] text-[#555] text-center mb-6">{{ __('Please confirm your password to continue.') }}</p>
    <form method="POST" action="{{ route('password.confirm') }}" class="flex flex-col gap-4">
        @csrf
        <div>
            <label class="block text-[12px] font-semibold text-[#737373] uppercase tracking-wider mb-1.5">{{ __('Password') }}</label>
            <input type="password" name="password" required autocomplete="current-password" class="inp" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>
        <button type="submit" class="btn-gradient w-full py-3 text-[14px] font-semibold" style="border-radius:12px;">
            {{ __('Confirm') }}
        </button>
    </form>
</x-auth-card>
</x-guest-layout>
