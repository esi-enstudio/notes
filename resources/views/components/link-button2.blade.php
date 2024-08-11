@props(['type' => 'submit'])

<button type="{{ $type }}" {{ $attributes }} class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $slot }}</button>
