<div class="glass rounded-3xl overflow-hidden" style="width:700px;max-width:95vw;height:540px;display:flex;flex-direction:column;">
    <div class="flex flex-col lg:flex-row h-full overflow-y-auto">

        {{-- Image --}}
        <div class="flex items-center justify-center bg-black lg:w-8/12 overflow-hidden" style="min-height:200px;">
            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $post->image) }}">
        </div>

        {{-- Right --}}
        <div class="lg:w-4/12 flex flex-col p-5" style="background:var(--surface-1);border-left:1px solid rgba(255,255,255,0.05);">
            {{-- Header --}}
            <div class="flex items-center gap-3 pb-4 border-b border-white/5 mb-4">
                <div class="avatar-ring" style="width:34px;height:34px;">
                    <img src="{{ auth()->user()->avatarUrl() }}" style="width:28px;height:28px;" class="rounded-full object-cover">
                </div>
                <a href="/{{ auth()->user()->username }}" class="text-[13px] font-semibold text-[#f5f5f5] hover:text-[#a8a8a8] transition-colors">
                    {{ auth()->user()->username }}
                </a>
            </div>

            <textarea placeholder="{{ __('Write a caption…') }}" wire:model="description"
                      class="flex-1 w-full bg-transparent text-[13px] text-[#f5f5f5] placeholder-[#444] resize-none outline-none border-none focus:ring-0 leading-relaxed"
                      style="min-height:180px;"></textarea>

            <div class="flex justify-between items-center border-t border-white/5 pt-3 mt-2 mb-4">
                <span class="text-[11px] text-[#444]">{{ strlen($description ?? '') }}/2200</span>
                <i class="bx bx-smile text-[18px] text-[#444]"></i>
            </div>

            <button wire:click="update"
                    class="btn-gradient w-full py-3 text-[14px] font-semibold" style="border-radius:12px;">
                {{ __('Save changes') }}
            </button>
        </div>
    </div>
</div>
