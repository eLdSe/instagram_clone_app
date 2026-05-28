<x-app-layout>
<div class="flex gap-12 justify-center pt-4">

    {{-- Feed --}}
    <div class="w-full max-w-[470px] flex-shrink-0">
        <livewire:posts-list />
    </div>

    {{-- Sidebar --}}
    <div class="hidden lg:flex lg:flex-col w-[300px] flex-shrink-0 pt-2 sticky top-20 self-start max-h-[calc(100vh-80px)] overflow-y-auto">

        {{-- Current user card --}}
        <div class="flex items-center gap-3 mb-6 p-1">
            <a href="/{{ auth()->user()->username }}">
                <div style="padding:2px;border-radius:50%;background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7);flex-shrink:0;display:inline-block;">
                    <img src="{{ auth()->user()->avatarUrl() }}"
                         style="width:50px;height:50px;border-radius:50%;object-fit:cover;border:2.5px solid #0a0a0a;display:block;"
                         alt="">
                </div>
            </a>
            <div class="flex flex-col grow min-w-0">
                <a href="/{{ auth()->user()->username }}"
                   class="text-[14px] font-bold text-[#f5f5f5] hover:text-[#a8a8a8] transition-colors truncate">
                    {{ auth()->user()->username }}
                </a>
                <span class="text-[13px] text-[#555] truncate">{{ auth()->user()->name }}</span>
            </div>
            <form id="sid-logout" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
            <button onclick="document.getElementById('sid-logout').submit()"
                    class="text-[12px] font-bold text-[#737373] hover:text-[#f5f5f5] transition-colors flex-shrink-0">
                {{ __('Switch') }}
            </button>
        </div>

        {{-- Suggested --}}
        @if(isset($suggested_users) && count($suggested_users) > 0)
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <span class="section-label">{{ __('Suggested for you') }}</span>
                <a href="{{ route('explore') }}"
                   class="text-[12px] font-bold text-[#f5f5f5] hover:text-[#a8a8a8] transition-colors">{{ __('See All') }}</a>
            </div>

            <ul class="flex flex-col gap-4">
                @foreach ($suggested_users as $user)
                    <li class="flex items-center gap-3">
                        <a href="/{{ $user->username }}" class="flex-shrink-0">
                            <div style="padding:2px;border-radius:50%;background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7);display:inline-block;">
                                <img src="{{ $user->avatarUrl() }}"
                                     style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid #111;display:block;"
                                     alt="">
                            </div>
                        </a>
                        <div class="flex flex-col grow min-w-0">
                            <div class="flex items-center gap-1.5">
                                <a href="/{{ $user->username }}"
                                   class="text-[13px] font-semibold text-[#f5f5f5] hover:text-[#a8a8a8] transition-colors truncate">
                                    {{ $user->username }}
                                </a>
                                @if(auth()->user()->is_follower($user))
                                    <span class="badge text-[10px] py-[1px] px-2">follows you</span>
                                @endif
                            </div>
                            <span class="text-[12px] text-[#555] truncate">{{ $user->name }}</span>
                        </div>
                        @if (auth()->user()->is_pending($user))
                            <span class="text-[12px] font-semibold text-[#444] flex-shrink-0">{{ __('Pending') }}</span>
                        @else
                            <livewire:follow-button :userId="$user->id"
                                classes="text-[13px] font-bold flex-shrink-0 grad-text" />
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Footer links --}}
        <div class="mt-6 text-[11px] leading-loose" style="color:#2a2a2a;">
            <p>
                <span class="font-bold text-[#f5f5f5] mr-1"> © {{ date('Y') }} </span>
                <span style="font-family:'DM Serif Display',serif;font-size:14px;background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"> gram</span>
            </p>
        </div>
    </div>

</div>
</x-app-layout>