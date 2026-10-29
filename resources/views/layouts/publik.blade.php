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
    </style>
</head>
{{-- PERUBAHAN: Tambah flex flex-col min-h-screen agar footer selalu di bawah --}}
<body class="font-sans antialiased bg-gray-50 flex flex-col min-h-screen">

    {{-- NAVBAR --}}
    @include('layouts.publik.navbar')

    {{-- KONTEN UTAMA --}}
    {{-- PERUBAHAN: Hapus min-h-screen, ganti jadi flex-grow agar mengisi sisa ruang --}}
    <main class="flex-grow w-full">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    {{-- PERUBAHAN: Hapus mt-12 agar tidak ada celah putih --}}
    <footer class="bg-[#0A1A3A] text-white/70 text-xs py-4 w-full">
        <div class="w-full mx-auto px-6 text-center">
            SIPEKA v1.0 &nbsp;•&nbsp; © {{ date('Y') }} — Kalimantan Selatan
        </div>
    </footer>

</body>
</html>