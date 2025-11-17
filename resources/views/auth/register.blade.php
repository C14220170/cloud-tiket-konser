<x-guest-layout>

<div class="w-full max-w-md mx-auto px-6">

    {{-- TITLE --}}
    <h1 class="text-3xl font-bold text-center text-indigo-300 mb-8">
        Create an Account
    </h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- NAME --}}
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" class="text-indigo-300"/>
            <x-text-input
                id="name"
                class="block mt-1 w-full bg-[#0A1530]/60 border border-white/10 text-gray-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        {{-- EMAIL --}}
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-indigo-300"/>
            <x-text-input
                id="email"
                class="block mt-1 w-full bg-[#0A1530]/60 border border-white/10 text-gray-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        {{-- PASSWORD --}}
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" class="text-indigo-300"/>
            <x-text-input
                id="password"
                class="block mt-1 w-full bg-[#0A1530]/60 border border-white/10 text-gray-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-indigo-300"/>
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full bg-[#0A1530]/60 border border-white/10 text-gray-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        {{-- ACTIONS --}}
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}"
                class="text-sm text-indigo-300 hover:text-indigo-400 transition underline">
                Already registered?
            </a>

            <button
                class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold shadow-lg shadow-indigo-500/30 transition">
                Register
            </button>
        </div>

    </form>

</div>

</x-guest-layout>
