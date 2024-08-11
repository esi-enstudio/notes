<x-app-layout :title="'Register'">

    <div class="max-w-sm mx-auto mt-5 p-4">
        <h1 class="text-4xl dark:text-white text-gray-800 mb-5">Register</h1>

        <form action="{{ route('register.store') }}" method="POST" class="p-4 bg-slate-200 dark:bg-slate-800 rounded">
            @csrf
            <div class="mb-5">
                <x-input-label for="name">Name</x-input-label>
                <x-input-field name="name" id="name" value="{{ old('name') }}" placeholder="Jhon Doe"/>
                @error('name') <span class="text-xs text-red-500 font-bold">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5">
                <x-input-label for="email">Email</x-input-label>
                <x-input-field name="email" id="email" value="{{ old('email') }}" type="email" placeholder="info@example.com"/>
                @error('email') <span class="text-xs text-red-500 font-bold">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <x-input-label for="password">Password</x-input-label>
                <x-input-field name="password" id="password" type="password"/>
                @error('password') <span class="text-xs text-red-500 font-bold">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <x-input-label for="password_confirmation">Confirm Password</x-input-label>
                <x-input-field name="password_confirmation" id="password_confirmation" type="password"/>
            </div>

            <x-button>Register</x-button>
        </form>
    </div>

</x-app-layout>
