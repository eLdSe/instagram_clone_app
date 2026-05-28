<div class="card">

    {{-- Header --}}
    <div class="card-header gap-3">
        <div class="avatar-ring flex-shrink-0" style="width:38px;height:38px;">
            <img src="{{ $post->owner->avatarUrl() }}" style="width:32px;height:32px;" class="rounded-full object-cover">
        </div>
        <a href="/{{ $post->owner->username }}"
           class="font-semibold text-[14px] text-[#f5f5f5] hover:text-[#a8a8a8] transition-colors grow truncate">
            {{ $post->owner->username }}
        </a>
        <button class="text-[#555] hover:text-[#a8a8a8] transition-colors">
            <i class="bx bx-dots-horizontal-rounded text-[20px]"></i>
        </button>
    </div>

    {{-- Image --}}
    <div class="relative overflow-hidden bg-black" style="max-height:560px;">
        <img class="w-full object-cover" style="display:block;" src="{{ asset('storage/' . $post->image) }}">
    </div>

    {{-- Actions --}}
    <div class="px-4 pt-3 pb-1 flex items-center gap-2">
        <livewire:like :post="$post" />
        <a href="/p/{{ $post->slug }}" class="nav-icon text-[#f5f5f5]">
            <i class="bx bx-comment text-[24px]"></i>
        </a>
        <div class="flex-1"></div>
    </div>

    {{-- Likes count --}}
    <div class="px-4 pb-2">
        <livewire:likedby :post="$post" />
    </div>

    {{-- Caption --}}
    <div class="px-4 pb-2 text-[13px] leading-relaxed">
        <a href="/{{ $post->owner->username }}" class="font-semibold text-[#f5f5f5] hover:text-[#a8a8a8] transition-colors mr-1">{{ $post->owner->username }}</a>
        <span class="text-[#d4d4d4]">{{ $post->description }}</span>
    </div>

    @if ($post->comments()->count() > 0)
        <a href="/p/{{ $post->slug }}" class="px-4 pb-2 block text-[13px] text-[#555] hover:text-[#a8a8a8] transition-colors">
            View all {{ $post->comments()->count() }} {{ __('comments') }}
        </a>
    @endif

    <div class="px-4 pb-3 text-[10px] text-[#333] uppercase tracking-widest font-medium">
        {{ $post->created_at->diffForHumans() }}
    </div>

    {{-- Comment form --}}
    <div class="card-footer">
        <form action="/p/{{ $post->slug }}/comment" method="POST">
            @csrf
            <div class="flex items-center gap-3">
                <i class="bx bx-smile text-[22px] text-[#555]"></i>
                <textarea name="body" placeholder="{{ __('Add a comment…') }}" autocomplete="off"
                          class="grow bg-transparent border-none resize-none focus:ring-0 outline-none h-5 max-h-40 overflow-y-hidden text-[13px] text-[#f5f5f5] placeholder-[#444] p-0"></textarea>
                <button type="submit" class="text-[13px] font-semibold flex-shrink-0 transition-colors"
                        style="background:var(--ig-grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    {{ __('Post') }}
                </button>
            </div>
        </form>
    </div>
</div>
