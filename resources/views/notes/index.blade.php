<x-app-layout :title="'All Notes'">

    {{-- Flash Message --}}
    @if(session()->has('success'))
        <x-alert-success>{{ session()->get('success') }}</x-alert-success>
    @elseif(session()->has('error'))
        <x-alert-danger>{{ session()->get('success') }}</x-alert-danger>
    @endif

    <div class="relative overflow-x-auto rounded-lg px-2">
        <div class="flex justify-between gap-5 py-3 bg-white dark:bg-gray-900">
            {{-- Search Form --}}
            <div>
                <form action="{{ route('notes.index') }}">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input name="search" value="{{ request()->get('search') }}" type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                    </div>
                </form>
            </div>

            {{-- Add New Button --}}
            <x-link-button href="{{ route('notes.create') }}">Add New</x-link-button>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-2">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    SL
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($notes as $sl => $note)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th class="w-4 p-4">
                        <div class="text-center">
                            <span>{{ ++$sl }}</span>
                        </div>
                    </th>
                    <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('notes.show', $note->id) }}">
                            {{ $note->title }}
                        </a>
                    </th>
                    <td class="px-6 py-2">
                        {{ \Illuminate\Support\Str::limit($note->description, 20) }}
                    </td>
                    <td class="px-6 py-2 text-center">
                        <button type="submit" form="note-complete-{{ $note->id }}" class="text-green-700 hover:bg-green-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-full text-sm text-center inline-flex items-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:focus:ring-green-800 dark:hover:bg-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                            </svg>

                            <span class="sr-only">Icon description</span>
                        </button>
                        <form class="hidden" action="{{ route('notes.complete', $note->id) }}" method="POST" id="note-complete-{{ $note->id }}">@csrf</form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-2">
                        No data found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 px-2">{{ $notes->links('pagination::tailwind') }}</div>

</x-app-layout>
