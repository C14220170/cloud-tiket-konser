@props(['header' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Concert Tickets') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-[#0B0D1A] text-gray-100 antialiased">

    {{-- Navigation --}}
    <header class="sticky top-0 z-50">
        @include('layouts.navigation')
    </header>

    {{-- Optional Header --}}
    @if ($header)
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-md w-full">
            <div class="py-6 px-8">
                <h2 class="text-xl font-semibold">{{ $header }}</h2>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="min-h-screen p-0 m-0 w-full">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="border-t border-white/10 py-6 text-center text-gray-400 text-sm w-full">
        © {{ date('Y') }} Concert Ticket App — All rights reserved.
    </footer>

</body>
</html>
