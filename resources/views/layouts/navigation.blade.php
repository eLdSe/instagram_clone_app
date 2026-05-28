<nav x-data="{ open: false }" class="glass fixed top-0 left-0 right-0 z-50" style="border-left:none;border-right:none;border-top:none;">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex items-center justify-between h-[60px] gap-4">

            {{-- Logo --}}
            <a href="{{ route('home_page') }}" class="flex-shrink-0 group">
                <span class="font-serif text-[22px] font-normal text-gradient tracking-tight" style="font-family:'DM Serif Display',serif; letter-spacing:-0.5px;">
                    gram
                </span>
            </a>

            {{-- Search --}}
            <div class="hidden sm:flex flex-1 max-w-xs">
                <livewire:search />
            </div>

            

            {{-- Nav Icons --}}
            @auth
            <div class="hidden md:flex items-center gap-1">

                {{-- Home --}}
                <a href="{{ route('home_page') }}" class="nav-icon {{ url()->current() == route('home_page') ? 'active' : '' }}">
                    {!! url()->current() == route('home_page')
                        ? '<i class="bx bxs-home-alt-2 text-[22px]"></i>'
                        : '<i class="bx bx-home-alt-2 text-[22px]"></i>' !!}
                </a>

                {{-- Explore --}}
                <a href="{{ route('explore') }}" class="nav-icon {{ url()->current() == route('explore') ? 'active' : '' }}">
                    {!! url()->current() == route('explore')
                        ? '<i class="bx bxs-compass text-[22px]"></i>'
                        : '<i class="bx bx-compass text-[22px]"></i>' !!}
                </a>

                {{-- Create --}}
                <button onclick="Livewire.emit('openModal', 'create-post-modal')"
                        class="nav-icon" title="{{ __('New Post') }}">
                    <i class="bx bx-plus-circle text-[22px]"></i>
                </button>

                {{-- Messages --}}
                <a href="{{ route('chat.index') }}" class="nav-icon relative" title="{{ __('Messages') }}">
                    <i class="bx bx-message-rounded-dots text-[22px]"></i>
                    <livewire:unread-messages-count />
                </a>

                {{-- Notifications --}}
                <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                    <button @click="open = !open" class="nav-icon relative">
                        <i class="bx bx-bell text-[22px]"></i>
                        <livewire:pending-followers-count />
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-80 glass rounded-2xl overflow-hidden shadow-2xl"
                         style="display:none; top:100%;">
                        <livewire:pending-followers-list />
                    </div>
                </div>
                <div
                    x-data="{
                        theme: localStorage.getItem('theme')
                            || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark'),

                        toggle() {
                            this.theme = this.theme === 'light' ? 'dark' : 'light'
                            document.documentElement.dataset.theme = this.theme
                            localStorage.setItem('theme', this.theme)
                        }
                    }"
                    x-init="$nextTick(() => document.documentElement.dataset.theme = theme)"
                >
                    <button
                        @click="toggle"
                        class="
                            flex items-center justify-center
                            w-10 h-10
                            rounded-xl

                            text-[var(--text-secondary)]
                            hover:text-[var(--text-primary)]

                            hover:bg-white/5
                            border border-transparent hover:border-white/10

                            transition-all duration-200 ease-out
                            active:scale-95

                            focus:outline-none focus:ring-2 focus:ring-pink-500/40
                        "
                    >
                        <!-- SUN -->
                        <svg
                            x-show="theme === 'dark'"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 3v1m0 16v1m8.66-9H21M3 12H2m15.36 6.36l.7.7M5.64 5.64l-.7-.7m12.02-2.12l-.7.7M6.34 17.66l-.7.7M12 7a5 5 0 100 10 5 5 0 000-10z"/>
                        </svg>

                        <!-- MOON -->
                        <svg
                            x-show="theme === 'light'"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M21 12.8A8.5 8.5 0 1111.2 3a6.5 6.5 0 009.8 9.8z"/>
                        </svg>
                    </button>
                </div>


                {{-- Profile --}}
                <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                    <button @click="open = !open" class="ml-1">
                        <div class="avatar-ring" style="width:36px;height:36px;">
                            <img src="{{ auth()->user()->avatarUrl() }}"
                                 style="width:30px;height:30px;"
                                 class="rounded-full">
                        </div>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-52 glass rounded-2xl overflow-hidden shadow-2xl py-2"
                         style="display:none; top:100%;">
                        <a href="{{ route('user_profile', auth()->user()) }}"
                           class="flex items-center gap-3 px-4 py-3 text-[13px] font-medium text-[#a8a8a8] hover:text-[#f5f5f5] hover:bg-white/5 transition-all duration-150">
                            <i class="bx bx-user text-lg"></i> {{ __('Profile') }}
                        </a>
                        <div class="divider mx-3"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-3 text-[13px] font-medium text-[#a8a8a8] hover:text-[#f5f5f5] hover:bg-white/5 transition-all duration-150">
                                <i class="bx bx-log-out text-lg"></i> {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endauth

            @guest
            <div class="hidden md:flex items-center gap-2">
                <a href="/login"
                   class="btn-ghost text-[13px] font-semibold px-4 py-2">{{ __('Log in') }}</a>
                <a href="/register"
                   class="btn-gradient text-[13px] font-semibold px-4 py-2">{{ __('Sign up') }}</a>
            </div>
            @endguest

            {{-- Mobile hamburger --}}
            <button @click="open = !open" class="md:hidden nav-icon">
                <i :class="open ? 'bx bx-x text-[22px]' : 'bx bx-menu text-[22px]'" class="bx text-[22px]"></i>
            </button>

        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-transition class="md:hidden glass border-t border-white/5 pb-4 pt-2" style="display:none;">
        @guest
            <a class="block px-5 py-3 text-[14px] font-medium text-[#a8a8a8] hover:text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
            <a class="block px-5 py-3 text-[14px] font-medium text-[#a8a8a8] hover:text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
        @endguest
        @auth
            <a class="block px-5 py-3 text-[14px] font-medium text-[#a8a8a8] hover:text-white" href="{{ route('home_page') }}">{{ __('Home') }}</a>
            <a class="block px-5 py-3 text-[14px] font-medium text-[#a8a8a8] hover:text-white" href="{{ route('explore') }}">{{ __('Explore') }}</a>
            <button onclick="Livewire.emit('openModal', 'create-post-modal')"
                    class="block w-full text-left px-5 py-3 text-[14px] font-medium text-[#a8a8a8] hover:text-white">{{ __('New Post') }}</button>
            <a class="block px-5 py-3 text-[14px] font-medium text-[#a8a8a8] hover:text-white" href="{{ route('user_profile', auth()->user()) }}">{{ __('Profile') }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-5 py-3 text-[14px] font-medium text-[#a8a8a8] hover:text-white">{{ __('Log Out') }}</button>
            </form>
        @endauth
    </div>
</nav>
