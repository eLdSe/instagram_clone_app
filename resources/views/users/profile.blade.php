<x-app-layout>

    @if(session('success'))
    <div class="fixed top-20 right-5 z-50 animate-fade-up"
         x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         x-transition:leave="transition ease-in duration-300" x-transition:leave-end="opacity-0 translate-y-2">
        <div class="flex items-center gap-3 glass rounded-2xl px-5 py-3 text-[13px] text-green-400 border border-green-400/20 shadow-2xl">
            <i class="bx bx-check-circle text-[18px]"></i>
            {{ session('success') }}
        </div>
    </div>
    @endif

    {{-- Profile Header --}}
    <div class="pt-8 pb-0 animate-fade-up">
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8 mb-10">

            {{-- Avatar with animated gradient ring --}}
            <div class="flex-shrink-0 relative">
                <div class="avatar-ring-pulse" style="padding:3px;border-radius:50%;background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7);display:inline-block;">
                    <img src="{{ $user->avatarUrl() }}"
                         style="width:{{ $user->posts->count() > 0 ? '112' : '112' }}px;height:{{ $user->posts->count() > 0 ? '112' : '112' }}px;border-radius:50%;object-fit:cover;border:3px solid #0a0a0a;display:block;"
                         alt="{{ $user->username }}">
                </div>
                @if($user->id === auth()->id() ?? false)
                    <a href="/{{ $user->username }}/edit"
                       class="absolute bottom-0 right-0 w-8 h-8 rounded-full flex items-center justify-center"
                       style="background:linear-gradient(135deg,#f58529,#dd2a7b);border:2px solid #0a0a0a;">
                        <i class="bx bx-camera text-[14px] text-white"></i>
                    </a>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex flex-col gap-5 grow w-full">

                {{-- Username row --}}
                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-[22px] font-semibold text-[#f5f5f5] tracking-tight">{{ $user->username }}</h1>
                    @if($user->private_account)
                        <span class="badge"><i class="bx bx-lock-alt text-[11px]"></i> Private</span>
                    @endif
                    @auth
                        @if ($user->id === auth()->id())
                            <a href="/{{ $user->username }}/edit"
                               class="btn-ghost text-[13px] font-semibold px-4 py-2 rounded-xl">
                                {{ __('Edit profile') }}
                            </a>
                        @else
                            <livewire:follow-button :userId="$user->id"
                                classes="btn-gradient text-[13px] font-semibold px-5 py-2 rounded-xl" />
                            <a href="{{ route('chat.show', $user) }}"
                               class="btn-ghost text-[13px] font-semibold px-4 py-2 rounded-xl flex items-center gap-1.5">
                                <i class="bx bx-message-rounded text-[15px]"></i>
                                {{ __('Message') }}
                            </a>
                        @endif
                    @endauth
                    @guest
                        <a href="/{{ $user->username }}/follow"
                           class="btn-gradient text-[13px] font-semibold px-5 py-2 rounded-xl">{{ __('Follow') }}</a>
                    @endguest
                </div>

                {{-- Stats --}}
                <ul class="flex gap-7">
                    <li class="flex flex-col sm:flex-row sm:items-baseline sm:gap-1.5">
                        <span class="font-bold text-[17px] text-[#f5f5f5]">{{ number_format($user->posts->count()) }}</span>
                        <span class="text-[13px] text-[#737373]">{{ $user->posts->count() == 1 ? __('post') : __('posts') }}</span>
                    </li>
                    <livewire:followers :userId="$user->id" />
                    <livewire:following :userId="$user->id" />
                </ul>

                {{-- Bio --}}
                <div>
                    <p class="text-[14px] font-semibold text-[#f5f5f5]">{{ $user->name }}</p>
                    @if($user->bio)
                        <p class="text-[14px] text-[#a8a8a8] mt-1 leading-relaxed whitespace-pre-line">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Tab bar --}}
        <div style="border-top:1px solid rgba(255,255,255,0.06);">
            <div class="flex justify-center">
                <div class="flex items-center gap-1 px-4 py-3"
                     style="border-top:2px solid #f5f5f5;margin-top:-1px;">
                    <i class="bx bx-grid-alt text-[14px] text-[#f5f5f5]"></i>
                    <span class="text-[12px] font-bold text-[#f5f5f5] uppercase tracking-widest">{{ __('Posts') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Posts Grid --}}
    @if ($user->posts()->count() > 0 && ($user->private_account == false || auth()->id() == $user->id))
        <div class="grid grid-cols-3 gap-[2px] sm:gap-[3px] animate-fade-in">
            @foreach ($user->posts as $i => $post)
                <a href="/p/{{ $post->slug }}" class="post-thumb" style="aspect-ratio:1;">
                    <img src="{{ asset('storage/' . $post->image) }}" alt=""
                         style="width:100%;height:100%;object-fit:cover;display:block;">
                    <div class="overlay">
                        <span><i class="bx bxs-heart text-[16px]"></i> {{ $post->likes()->count() }}</span>
                        <span><i class="bx bxs-comment text-[16px]"></i> {{ $post->comments()->count() }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-24 gap-5 animate-fade-up">
            <div class="w-24 h-24 rounded-full flex items-center justify-center"
                 style="background:rgba(255,255,255,0.03);border:1.5px solid rgba(255,255,255,0.08);">
                <i class="bx bx-camera-off text-[40px] text-[#2a2a2a]"></i>
            </div>
            <div class="text-center">
                <p class="text-[18px] font-bold text-[#f5f5f5] mb-2">
                    @if ($user->private_account && $user->id != auth()->id())
                        {{ __('This account is private') }}
                    @else
                        {{ __('No posts yet') }}
                    @endif
                </p>
                <p class="text-[14px] text-[#555]">
                    @if ($user->private_account && $user->id != auth()->id())
                        {{ __('Follow this account to see their photos.') }}
                    @elseif(auth()->id() === $user->id)
                        {{ __('Share your first photo.') }}
                    @endif
                </p>
            </div>
            @if(auth()->id() === $user->id)
                <button onclick="Livewire.emit('openModal', 'create-post-modal')"
                        class="btn-gradient px-6 py-3 text-[14px] font-semibold mt-2" style="border-radius:14px;">
                    <i class="bx bx-plus mr-1"></i> {{ __('Create post') }}
                </button>
            @endif
        </div>
    @endif

</x-app-layout>
