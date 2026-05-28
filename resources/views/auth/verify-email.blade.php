<x-guest-layout>
<x-auth-card>
    <x-slot name="logo"><span></span></x-slot>
    <div class="text-center mb-6">
        <div class="w-16 h-16 rounded-full glass flex items-center justify-center mx-auto mb-4">
            <i class="bx bx-envelope text-[32px]" style="background:var(--ig-grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></i>
        </div>
        <h2 class="text-[20px] font-semibold text-[#f5f5f5] mb-2">{{ __('Verify your email') }}</h2>
        <p class="text-[13px] text-[#555]">{{ __("We've sent a verification link to your email address.") }}</p>
    </div>
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-[13px] text-green-400 bg-green-400/10 border border-green-400/20 rounded-xl px-4 py-3 text-center">
            {{ __('A new verification link has been sent!') }}
        </div>
    @endif
    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-gradient w-full py-3 text-[14px] font-semibold" style="border-radius:12px;">
                {{ __('Resend Verification Email') }}
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-ghost w-full py-3 text-[13px] font-semibold" style="border-radius:12px;">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-auth-card>
</x-guest-layout>
