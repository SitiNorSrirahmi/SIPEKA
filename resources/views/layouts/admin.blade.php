<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPEKA') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        @include('layouts.admin.sidebar')

        {{-- KONTEN UTAMA --}}
        <div class="flex-1 flex flex-col min-w-0">

            @hasSection('header')
                <header class="bg-white shadow-sm">
                    <div class="px-8 py-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            @yield('header')
                        </h2>
                    </div>
                </header>
            @endif

            <main class="flex-1 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>