<x-app-layout>
<div class="pt-6 animate-fade-up">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-1 h-6 rounded-full" style="background:var(--ig-grad);"></div>
            <h1 class="text-[20px] font-semibold text-[#f5f5f5]">{{ __('Explore') }}</h1>
        </div>
        <span class="section-label">{{ $posts->count() }} {{ __('posts') }}</span>
    </div>

    {{-- Grid --}}
    <div class="explore-grid">
        @foreach($posts as $i => $post)
            @php $featured = ($i % 9 === 0 || $i % 9 === 7); @endphp
            <a href="/p/{{ $post->slug }}"
               class="post-thumb {{ $featured ? 'col-span-2 row-span-2' : '' }}">
                <img src="{{ asset('storage/' . $post->image) }}" alt=""
                     style="width:100%;height:100%;object-fit:cover;display:block;aspect-ratio:1;">
                <div class="overlay">
                    <span><i class="bx bxs-heart text-[{{ $featured ? '18' : '14' }}px]"></i> {{ $post->likes()->count() }}</span>
                    <span><i class="bx bxs-comment text-[{{ $featured ? '18' : '14' }}px]"></i> {{ $post->comments()->count() }}</span>
                </div>
            </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $posts->links() }}
    </div>

</div>
</x-app-layout>