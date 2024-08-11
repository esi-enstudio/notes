<x-app-layout :title="'Create New'">

    <form action="{{ route('notes.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <x-input-label for="title">Title</x-input-label>
            <x-input-field name="title" id="title" value="{{ old('title') }}"/>
            @error('title') <span class="text-xs text-red-500 font-bold">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <x-input-label for="description">Description</x-input-label>
            <x-input-textarea name="description" id="description">{{ old('description') }}</x-input-textarea>
            @error('description') <span class="text-xs text-red-500 font-bold">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between">
            <x-button>Save</x-button>

            <a href="{{ route('notes.index') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
        </div>
    </form>

</x-app-layout>
