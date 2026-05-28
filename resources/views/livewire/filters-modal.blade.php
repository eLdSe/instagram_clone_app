<div class="glass rounded-1xl overflow-hidden" style="width:1024px;max-width:95vw;height:580px;display:flex;flex-direction:column;">

    {{-- Header --}}
    <div class="relative flex items-center justify-center px-5 py-4 border-b border-white/5 flex-shrink-0">
        <h2 class="text-[15px] font-semibold text-[#f5f5f5]">{{ __('Edit & Share') }}</h2>
        <button wire:click="publish"
                class="absolute right-5 btn-gradient px-4 py-1.5 text-[13px] font-semibold" style="border-radius:8px;">
            {{ __('Share') }}
        </button>
    </div>

    <div class="flex flex-col lg:flex-row flex-1 overflow-hidden">

        {{-- Image preview --}}
        <div class="flex items-center justify-center bg-black lg:w-7/12 overflow-hidden" style="min-height:200px;">
            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $filtered_image) }}">
        </div>

        {{-- Divider --}}
        <div class="hidden lg:block w-px" style="background:rgba(255,255,255,0.05);"></div>

        {{-- Right panel --}}
        <div class="lg:w-5/12 flex flex-col overflow-y-auto" style="background:var(--surface-1);">

            {{-- User + Caption --}}
            <div class="p-5 border-b border-white/5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="avatar-ring flex-shrink-0" style="width:34px;height:34px;">
                        <img src="{{ auth()->user()->avatarUrl() }}" style="width:28px;height:28px;" class="rounded-full object-cover">
                    </div>
                    <span class="text-[14px] font-semibold text-[#f5f5f5]">{{ auth()->user()->username }}</span>
                </div>
                <textarea wire:model="description"
                          placeholder="{{ __('Write a caption…') }}"
                          class="w-full bg-transparent text-[13px] text-[#f5f5f5] placeholder-[#444] resize-none outline-none border-none focus:ring-0 leading-relaxed"
                          style="min-height:80px;max-height:120px;"></textarea>
                <div class="flex justify-end pt-2">
                    <span class="text-[11px] text-[#444]">{{ strlen($description ?? '') }}/2200</span>
                </div>
                @error('description')
                    <p class="text-[12px] text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Filters --}}
            <div class="p-5">
                <p class="text-[12px] font-bold text-[#737373] uppercase tracking-widest mb-4">{{ __('Filters') }}</p>
                <div class="grid grid-cols-3 gap-3">
                    @foreach ($filters as $filter)
                        <div class="flex flex-col items-center gap-2 cursor-pointer group"
                             wire:click="filter_{{ strtolower($filter) }}">
                            <div class="w-full aspect-square overflow-hidden rounded-xl border transition-all duration-150"
                                 style="border-color:rgba(255,255,255,0.06);"
                                 x-data
                                 @mouseenter="$el.style.borderColor='rgba(238,42,123,0.5)'"
                                 @mouseleave="$el.style.borderColor='rgba(255,255,255,0.06)'">
                                <img src="{{ asset('storage/filters_thumb/' . $filter . '.jpg') }}"
                                     alt="{{ $filter }}"
                                     class="w-full h-full object-cover group-hover:opacity-90 transition-opacity">
                            </div>
                            <span class="text-[11px] text-[#555] group-hover:text-[#a8a8a8] transition-colors text-center font-medium">
                                {{ $filter }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
