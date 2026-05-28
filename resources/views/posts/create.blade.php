<x-app-layout>

    <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-xl p-8 max-w-2xl mx-auto">

        {{-- Title --}}
        <h1 class="text-[22px] font-semibold text-[#f5f5f5] mb-8 pb-4 border-b border-[#2a2a2a]">
            {{ __('Create a new post') }}
        </h1>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="w-full bg-red-500/10 border border-red-500/30 text-red-400 p-4 mb-6 rounded-xl">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-[13px]">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="/p/create" method="post" class="w-full" enctype="multipart/form-data">
            @csrf
            <x-create-edit-form />
            <button
                type="submit"
                class="mt-6 w-full py-[8px] bg-[#0095f6] hover:bg-[#1aa1f7] active:scale-95 text-white text-[14px] font-semibold rounded-lg transition-all duration-150 cursor-pointer"
            >
                {{ __('Create Post') }}
            </button>
        </form>

    </div>

</x-app-layout>