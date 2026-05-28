<div class="glass rounded-1xl overflow-hidden" style="width:1024px;max-width:95vw;height:540px;display:flex;flex-direction:column;">

    {{-- Header --}}
    <div class="relative flex items-center justify-center px-5 py-4 border-b border-white/5">
        <h2 class="text-[15px] font-semibold text-[#f5f5f5]">{{ __('Create new post') }}</h2>
        @if ($image)
            <button wire:click="save_temp"
                    class="absolute right-5 text-[13px] font-bold"
                    style="background:var(--ig-grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                {{ __('Next') }} →
            </button>
        @endif
    </div>

    {{-- Preview --}}
    @if ($image)
        <div class="flex-1 flex items-center justify-center bg-black overflow-hidden">
            <img class="w-full h-full object-cover" src="{{ $image->temporaryUrl() }}">
        </div>
    @else
        <div class="flex-1 flex flex-col items-center justify-center gap-4 px-8"
             style="background:radial-gradient(circle at 50% 80%,rgba(238,42,123,0.05),transparent 70%);">

            <div class="w-20 h-20 rounded-full glass flex items-center justify-center mb-2 border border-white/10"
                 style="background:rgba(238,42,123,0.08);">
                <svg width="36" height="36" fill="none" viewBox="0 0 97.6 77.3">
                    <path d="M16.3 24h.3c2.8-.2 4.9-2.6 4.8-5.4-.2-2.8-2.6-4.9-5.4-4.8s-4.9 2.6-4.8 5.4c.1 2.7 2.4 4.8 5.1 4.8zm-2.4-7.2c.5-.6 1.3-1 2.1-1h.2c1.7 0 3.1 1.4 3.1 3.1 0 1.7-1.4 3.1-3.1 3.1-1.7 0-3.1-1.4-3.1-3.1 0-.8.3-1.5.8-2.1z" fill="rgba(238,42,123,0.6)"/>
                    <path d="M84.7 18.4 58 16.9l-.2-3c-.3-5.7-5.2-10.1-11-9.8L12.9 6c-5.7.3-10.1 5.3-9.8 11L5 51v.8c.7 5.2 5.1 9.1 10.3 9.1h.6l21.7-1.2v.6c-.3 5.7 4 10.7 9.8 11l34 2h.6c5.5 0 10.1-4.3 10.4-9.8l2-34c.4-5.8-4-10.7-9.7-11.1z" fill="rgba(238,42,123,0.4)"/>
                </svg>
            </div>

            <p class="text-[20px] font-light text-[#f5f5f5]">{{ __('Drag photos here') }}</p>
            <p class="text-[13px] text-[#555]">{{ __('PNG, JPG, HEIC up to 50MB') }}</p>

            <input type="file" class="hidden" id="createFileInput" wire:model="image">
            <button onclick="document.getElementById('createFileInput').click()"
                    class="btn-gradient px-6 py-2.5 text-[14px] font-semibold mt-1" style="border-radius:12px;">
                {{ __('Select from computer') }}
            </button>
        </div>
    @endif
</div>
