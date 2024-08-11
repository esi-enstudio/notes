<x-app-layout :title="'Log In'">

    <div class="max-w-sm mx-auto mt-5 p-4">
        <h1 class="text-4xl dark:text-white text-gray-800 mb-5">Log In</h1>

        <form action="{{ route('login.store') }}" method="POST" class="p-4 bg-slate-200 dark:bg-slate-800 rounded">
            @csrf
            <div class="mb-5">
                <x-input-label for="email">Email</x-input-label>
                <x-input-field name="email" id="email" type="email" value="{{ old('email') }}" placeholder="info@example.com"/>
                @error('email') <span class="text-xs text-red-500 font-bold">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <x-input-label for="password">Password</x-input-label>
                <x-input-field name="password" id="password" type="password"/>
                @error('password') <span class="text-xs text-red-500 font-bold">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <x-input-checkbox name="remember" id="remember"/>
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
            </div>
            <x-button>Log In</x-button>
        </form>
    </div>

</x-app-layout>
