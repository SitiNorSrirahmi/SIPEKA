@if (auth()->check() && auth()->user()->role === 'admin')
    @extends('layouts.admin')
    @section('header', 'Buat Laporan')
    @section('content')
        @include('laporan.form')
    @endsection
@else
    {{-- Fallback: petugas & publik (nanti diupdate di iterasi 2 & 3) --}}
    <x-app-layout>
        @include('laporan.form')
    </x-app-layout>
@endif