<x-app-layout>
<div class="max-w-xl mx-auto py-8 animate-fade-up">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-6 rounded-full" style="background:var(--ig-grad);"></div>
        <h1 class="text-[20px] font-semibold text-[#f5f5f5]">{{ __('Edit post') }}</h1>
    </div>

    @if ($errors->any())
        <div class="glass rounded-2xl p-4 mb-5 text-[13px] text-red-400 border border-red-500/20 bg-red-500/5">
            <ul class="list-disc pl-4 space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="/p/{{ $post->slug }}/update" method="post" enctype="multipart/form-data" class="glass rounded-3xl p-6 flex flex-col gap-5">
        @csrf @method('PATCH')
        <x-create-edit-form :post="$post" />
        <button type="submit" class="btn-gradient w-full py-3 text-[14px] font-semibold" style="border-radius:12px;">
            {{ __('Update Post') }}
        </button>
    </form>
</div>
</x-app-layout>
