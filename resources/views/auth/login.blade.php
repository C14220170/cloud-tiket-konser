<x-guest-layout>

<div class="min-h-screen flex flex-col items-center justify-center 
            bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314] 
            px-6 py-10">

    {{-- TITLE --}}
    <h1 class="text-4xl font-bold text-indigo-300 drop-shadow mb-10 text-center">
        Login to Your Account
    </h1>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-indigo-300" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}"
          class="w-full max-w-md space-y-6">
        @csrf

        {{-- EMAIL --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-indigo-200" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-[#0A1530]/60 backdrop-blur-lg
                       border border-white/10 text-gray-200 rounded-full px-4 py-3
                       focus:ring-indigo-500 focus:border-indigo-500"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        {{-- PASSWORD --}}
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-indigo-200" />
            <x-text-input id="password"
                class="block mt-1 w-full bg-[#0A1530]/60 backdrop-blur-lg
                       border border-white/10 text-gray-200 rounded-full px-4 py-3
                       focus:ring-indigo-500 focus:border-indigo-500"
                type="password" name="password" required autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        {{-- REMEMBER ME --}}
        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center text-gray-300 cursor-pointer">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 bg-[#0A1530]/60
                              focus:ring-indigo-500"
                       name="remember">
                <span class="ms-2 text-sm">Remember me</span>
            </label>
        </div>

        {{-- ACTIONS --}}
        <div class="flex items-center justify-between pt-2">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-indigo-300 hover:text-indigo-400 transition underline">
                    Forgot your password?
                </a>
            @endif

            <button
                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full 
                       font-semibold shadow-lg shadow-indigo-500/30 transition">
                Log in
            </button>
        </div>

    </form>
</div>

</x-guest-layout>
