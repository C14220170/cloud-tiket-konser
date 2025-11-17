<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-100 antialiased">

    {{-- FULLSCREEN BACKGROUND (tanpa kotak) --}}
    <div class="min-h-screen flex items-center justify-center
                bg-gradient-to-b from-[#0A0F29] via-[#0a1138] to-[#010314]
                px-4 py-10">

        {{-- SLOT LANGSUNG JALAN, TANPA CARD --}}
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
