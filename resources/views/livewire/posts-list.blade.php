<div class="w-full max-w-[470px] mx-auto">
    @forelse ($this->posts as $post)
        <livewire:post :post="$post" :wire:key="'post_'.$post->id" />
    @empty
        <div class="flex flex-col items-center justify-center py-24 gap-4 animate-fade-up">
            <div class="w-20 h-20 rounded-full glass flex items-center justify-center mb-2">
                <i class="bx bx-camera text-[36px] text-[#333]"></i>
            </div>
            <h2 class="text-[20px] font-semibold text-[#f5f5f5]">{{ __('No posts yet') }}</h2>
            <p class="text-[14px] text-[#555] text-center max-w-xs">
                {{ __('Follow people to see their posts here.') }}
            </p>
        </div>
    @endforelse
</div>
