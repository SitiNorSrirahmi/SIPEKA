@if (auth()->check() && auth()->user()->role === 'admin')
    @extends('layouts.admin')
    @section('header', 'Statistik Bencana')
    @section('content')
        @include('statistik.content')
    @endsection
@else
    {{-- Fallback: petugas & publik (nanti diupdate di iterasi 2 & 3) --}}
    <x-app-layout>
        @include('statistik.content')
    </x-app-layout>
@endif