<x-app-layout>
<div class="mt-4 animate-fade-up">

    {{-- Desktop: side-by-side. Mobile: stacked --}}
    <div class="flex flex-col md:flex-row glass rounded-3xl overflow-hidden"
         style="min-height:520px;max-height:92vh;">

        {{-- Image --}}
        <div class="md:w-[58%] flex items-center justify-center bg-black overflow-hidden flex-shrink-0"
             style="min-height:300px;">
            <img class="w-full h-full object-contain"
                 style="max-height:92vh;"
                 src="{{ asset('storage/' . $post->image) }}"
                 alt="{{ $post->description }}">
        </div>

        {{-- Right panel --}}
        <div class="md:w-[42%] flex flex-col min-h-0" style="background:var(--surface-1);border-left:1px solid rgba(255,255,255,0.05);">

            {{-- Header --}}
            <div class="flex items-center gap-3 px-5 py-4 flex-shrink-0" style="border-bottom:1px solid rgba(255,255,255,0.05);">
                <a href="/{{ $post->owner->username }}">
                    <div class="avatar-ring avatar-ring-pulse" style="width:38px;height:38px;">
                        <img src="{{ $post->owner->avatarUrl() }}" style="width:32px;height:32px;" class="rounded-full object-cover">
                    </div>
                </a>
                <div class="flex flex-col grow min-w-0">
                    <a href="/{{ $post->owner->username }}"
                       class="text-[14px] font-semibold text-[#f5f5f5] hover:text-[#a8a8a8] transition-colors truncate">
                        {{ $post->owner->username }}
                    </a>
                    <span class="text-[11px] text-[#444] uppercase tracking-widest">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>
                <div class="flex items-center gap-3 flex-shrink-0">
                    @cannot('update', $post)
                        <livewire:follow-button :userId="$post->owner->id"
                            classes="btn-gradient text-[12px] font-semibold px-4 py-1.5 rounded-lg" />
                    @endcannot
                    @can('update', $post)
                        <button onclick="Livewire.emit('openModal', 'edit-post-modal', {{ json_encode([$post->id]) }})"
                                class="nav-icon" style="width:32px;height:32px;border-radius:8px;">
                            <i class="bx bx-edit text-[18px]"></i>
                        </button>
                        <form action="/p/{{ $post->slug }}/delete" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this post?')"
                                    class="nav-icon text-red-500 hover:text-red-400" style="width:32px;height:32px;border-radius:8px;">
                                <i class="bx bx-trash text-[18px]"></i>
                            </button>
                        </form>
                    @endcan
                </div>
            </div>

            {{-- Scrollable content --}}
            <div class="flex-1 overflow-y-auto min-h-0" id="comments-scroll">

                {{-- Caption --}}
                @if($post->description)
                <div class="flex items-start gap-3 px-5 py-4" style="border-bottom:1px solid rgba(255,255,255,0.04);">
                    <a href="/{{ $post->owner->username }}" class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full overflow-hidden">
                            <img src="{{ $post->owner->avatarUrl() }}" class="w-full h-full object-cover">
                        </div>
                    </a>
                    <div class="text-[13px] text-[#d4d4d4] leading-relaxed min-w-0">
                        <a href="/{{ $post->owner->username }}" class="font-semibold text-[#f5f5f5] hover:text-[#a8a8a8] mr-1.5 transition-colors">{{ $post->owner->username }}</a>{{ $post->description }}
                    </div>
                </div>
                @endif

                {{-- Comments --}}
                <div class="flex flex-col px-5 py-3 gap-5">
                    @forelse($post->comments as $comment)
                        <div class="flex items-start gap-3 group" wire:key="comment-{{ $comment->id }}">
                            <a href="/{{ $comment->owner->username }}" class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full overflow-hidden border" style="border-color:rgba(255,255,255,0.07);">
                                    <img src="{{ $comment->owner->avatarUrl() }}" class="w-full h-full object-cover">
                                </div>
                            </a>
                            <div class="flex flex-col grow min-w-0">
                                <div class="text-[13px] leading-relaxed text-[#d4d4d4]">
                                    <a href="/{{ $comment->owner->username }}" class="font-semibold text-[#f5f5f5] hover:text-[#a8a8a8] mr-1.5 transition-colors">{{ $comment->owner->username }}</a>{{ $comment->body }}
                                </div>
                                <span class="text-[11px] text-[#444] mt-1 uppercase tracking-widest">{{ $comment->created_at->diffForHumans(null, true, true) }}</span>
                            </div>
                            {{-- Like comment icon placeholder --}}
                            <button class="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity text-[#555] hover:text-red-400 mt-0.5">
                                <i class="bx bx-heart text-[16px]"></i>
                            </button>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-10 gap-2">
                            <i class="bx bx-comment text-[32px] text-[#333]"></i>
                            <p class="text-[13px] text-[#555]">{{ __('No comments yet') }}</p>
                            <p class="text-[12px] text-[#333]">{{ __('Be the first to comment.') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Actions + likes --}}
            <div class="flex-shrink-0" style="border-top:1px solid rgba(255,255,255,0.05);">
                <div class="flex items-center gap-1 px-4 pt-3 pb-1">
                    <livewire:like :post="$post" />
                    <button onclick="document.getElementById('show-comment-input').focus()"
                            class="nav-icon" style="width:38px;height:38px;border-radius:10px;">
                        <i class="bx bx-comment text-[22px]"></i>
                    </button>
                    <div class="flex-1"></div>
                    <button class="nav-icon" style="width:38px;height:38px;border-radius:10px;">
                        <i class="bx bx-bookmark text-[22px]"></i>
                    </button>
                </div>
                <div class="px-5 pb-2">
                    <livewire:likedby :post="$post" />
                </div>
            </div>

            {{-- Comment input --}}
            <div class="flex-shrink-0 px-5 py-3" style="border-top:1px solid rgba(255,255,255,0.05);">
                @auth
                <form action="/p/{{ $post->slug }}/comment" method="POST">
                    @csrf
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                            <img src="{{ auth()->user()->avatarUrl() }}" class="w-full h-full object-cover">
                        </div>
                        <textarea id="show-comment-input" name="body" rows="1"
                                  placeholder="{{ __('Add a comment…') }}"
                                  class="grow bg-transparent border-none resize-none focus:ring-0 outline-none text-[13px] text-[#f5f5f5] placeholder-[#444] p-0 leading-relaxed"
                                  style="max-height:80px;overflow-y:auto;"></textarea>
                        <button type="submit"
                                class="text-[13px] font-bold flex-shrink-0 grad-text">
                            {{ __('Post') }}
                        </button>
                    </div>
                </form>
                @else
                <p class="text-center text-[13px] text-[#555] py-1">
                    <a href="{{ route('login') }}" class="grad-text font-semibold">{{ __('Log in') }}</a>
                    {{ __('to leave a comment.') }}
                </p>
                @endauth
            </div>

        </div>
    </div>

    {{-- Related posts suggestion --}}
    @if($post->owner->posts->count() > 1)
    <div class="mt-12 mb-4">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-1 h-5 rounded-full" style="background:var(--ig-grad);"></div>
            <span class="text-[14px] font-semibold text-[#f5f5f5]">{{ __('More from') }} {{ $post->owner->username }}</span>
        </div>
        <div class="grid grid-cols-3 gap-[3px]">
            @foreach($post->owner->posts->where('id', '!=', $post->id)->take(6) as $related)
                <a href="/p/{{ $related->slug }}" class="post-thumb aspect-square">
                    <img src="{{ asset('storage/' . $related->image) }}" alt="">
                    <div class="overlay">
                        <span><i class="bx bxs-heart text-[14px]"></i> {{ $related->likes()->count() }}</span>
                        <span><i class="bx bxs-comment text-[14px]"></i> {{ $related->comments()->count() }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
</x-app-layout>