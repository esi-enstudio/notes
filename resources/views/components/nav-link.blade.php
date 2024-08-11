@props(['active' => false])

<a {{ $attributes }} class="{{ $active ? 'text-white bg-blue-700  md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }} block py-2 px-3 text-gray-900 rounded  md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">{{ $slot }}</a>
