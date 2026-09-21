@extends('layouts.admin')

@section('header', 'Kelola Data Kejadian Bencana')

@section('content')
<div class="max-w-6xl mx-auto">

    {{-- ==================== HEADER ==================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>
                Peta & Kejadian Bencana
            </h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data kejadian bencana di Kalimantan Selatan</p>
        </div>
        <a href="{{ route('admin.laporan.create') }}"
            class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kejadian
        </a>
    </div>

    {{-- ==================== SUCCESS ==================== --}}
    @if (session('success'))
    <div class="flex items-start gap-3 bg-green-50 border border-green-200 text-green-700 p-4 mb-5 rounded-xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm">{{ session('success') }}</span>
    </div>
    @endif

    {{-- ==================== KONTEN (peta + filter + tabel) ==================== --}}
    @include('admin.kejadian.index-content', ['showAksi' => true])

</div>
@endsection