<x-app-layout :title="'Completed Notes'">

    {{-- Flash Message --}}

    @if(session()->has('success'))
        <x-alert-success>{{ session()->get('success') }}</x-alert-success>
    @elseif(session()->has('error'))
        <x-alert-danger>{{ session()->get('error') }}</x-alert-danger>
    @endif

    <div class="relative overflow-x-auto rounded-lg px-2">
        <div class="bg-white dark:bg-gray-900 py-3">
            {{-- Search Form --}}
            <div class="flex justify-between">
                <form action="{{ route('complete.index') }}">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input name="search" value="{{ request()->get('search') }}"  type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                    </div>
                </form>

                <x-button onclick="return confirm('Are you sure to delete all this note?')" form="delete-all-complete-notes">Delete</x-button>
            </div>
        </div>

        <form id="delete-all-complete-notes" action="{{ route('notes.delete.all') }}" method="POST">
            @csrf
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-2">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="check-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3 text-center">
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
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input name="checkbox[]" value="{{ $note->id }}" type="checkbox" class="checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th class="px-6 py-2">
                        <div class="text-center">
                            <span>{{ ++$sl }}</span>
                        </div>
                    </th>
                    <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $note->title }}
                    </th>
                    <td class="px-6 py-2">
                        {{ $note->description }}
                    </td>
                    <td class="px-6 py-2 text-center">
                        {{--Restore Button--}}
                        <a href="{{ route('notes.restore', $note->id) }}" class="text-green-700 font-medium text-sm text-center inline-flex items-center dark:text-green-500 dark:hover:text-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>

                            <span class="sr-only">Icon description</span>
                        </a>
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
        </form>
    </div>
    <div class="mt-3 px-2">{{ $notes->links('pagination::tailwind') }}</div>

</x-app-layout>


<script>
    $(document).ready(function(){
        $('#check-all').click(function (){
            $('.checkbox').prop('checked', $(this).prop('checked'));
        });
    });
</script>
