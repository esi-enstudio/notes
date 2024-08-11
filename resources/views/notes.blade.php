<x-app-layout>
    @if(session()->has('success'))
        <x-alert-success>{{ session()->get('success') }}</x-alert-success>
    @endif

<h1 class="text-gray-700 dark:text-white">Active Notes: {{ \App\Models\Note::whereNull('complete_at')->count() }}</h1>
<h1 class="text-gray-700 dark:text-white">Complete Notes: {{ \App\Models\Note::whereNotNull('complete_at')->count() }}</h1>

</x-app-layout>
