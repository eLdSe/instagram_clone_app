<div class="relative w-full">
    <div class="relative">
        <i class="bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-[#555] text-[16px] pointer-events-none"></i>
        <input type="text" name="search" wire:model="searchInput"
               placeholder="{{ __('Search') }}"
               autocomplete="off"
               class="inp w-full md:w-72 pl-9 pr-8 py-2 text-[13px] rounded-xl"
               style="background:rgba(255,255,255,0.05);">
        @if(!empty($searchInput))
            <button class="absolute right-3 top-1/2 -translate-y-1/2" wire:click="clear">
                <i class="bx bx-x text-[#555] hover:text-[#a8a8a8] text-[18px] transition-colors"></i>
            </button>
        @endif
    </div>

    @if (!empty($results) && !empty($searchInput))
        <ul class="absolute top-full mt-2 left-0 right-0 glass rounded-2xl overflow-hidden shadow-2xl z-50 divide-y divide-white/5 animate-fade-in">
            @forelse($results as $result)
                <li wire:key="user-{{ $result->id }}"
                    wire:click="goto('{{ $result->username }}')"
                    class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-white/5 transition-colors">
                    <div class="avatar-ring flex-shrink-0" style="width:36px;height:36px;">
                        <img src="{{ $result->avatarUrl() }}" style="width:30px;height:30px;" class="rounded-full object-cover">
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-[13px] font-semibold text-[#f5f5f5] truncate">{{ $result->username }}</span>
                        <span class="text-[12px] text-[#555] truncate">{{ $result->name }}</span>
                    </div>
                </li>
            @empty
                <li class="py-8 text-center text-[13px] text-[#555]">{{ __('No results found') }}</li>
            @endforelse
        </ul>
    @endif
</div>
