<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPEKA') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Plus Jakarta Sans', 'Figtree', sans-serif !important;
        }

        /* Sidebar fixed — diam waktu scroll */
        .sidebar-fixed {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 16rem;
            z-index: 40;
            overflow-y: auto;
        }

        /* Konten di kanan — kasih margin-left */
        .content-wrapper {
            margin-left: 16rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Padding untuk semua halaman admin */
        .content-body {
            padding: 1.5rem 2rem;
            flex: 1;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">

    {{-- SIDEBAR (FIXED) --}}
    <div class="sidebar-fixed">
        @include('layouts.admin.sidebar')
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="content-wrapper">

        {{-- HEADER --}}
        @hasSection('header')
        <header class="bg-white shadow-sm sticky top-0 z-30">
            <div class="px-8 py-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    @yield('header')
                </h2>
            </div>
        </header>
        @endif

        {{-- ISI HALAMAN --}}
        <main class="content-body">
            @yield('content')
        </main>
    </div>

</body>

</html>