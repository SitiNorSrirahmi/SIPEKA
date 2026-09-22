<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPEKA') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            font-family: 'Plus Jakarta Sans', 'Figtree', sans-serif !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">

    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">

        {{-- SIDEBAR --}}
        @include('layouts.petugas.sidebar')

        {{-- KONTEN UTAMA --}}
        <div class="flex-1 flex flex-col min-w-0">

            @hasSection('header')
            {{-- HEADER PUTIH: senada dengan admin --}}
            <header class="bg-white shadow-sm sticky top-0 z-40">
                <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-3">

                    {{-- Tombol hamburger (cuma mobile) --}}
                    <button type="button"
                        @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
                        @yield('header')
                    </h2>
                </div>
            </header>
            @endif

            <main class="flex-1">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>