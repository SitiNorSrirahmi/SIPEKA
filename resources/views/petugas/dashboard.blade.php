@extends('layouts.petugas')

@section('header', 'Dashboard Petugas')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

    {{-- ==================== HEADER — SEJAJAR ==================== --}}
    <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <div class="min-w-0">
                <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-gray-800 truncate">Dashboard Petugas SIPEKA</h1>
                <p class="text-[11px] sm:text-sm text-gray-500 truncate">Selamat datang kembali, {{ auth()->user()->name ?? 'Petugas' }}!</p>
            </div>
        </div>
        <a href="{{ route('petugas.laporan.create') }}"
            class="inline-flex items-center justify-center gap-1.5 sm:gap-2 bg-red-500 hover:bg-red-600 text-white px-3 sm:px-4 py-2 sm:py-2.5 rounded-lg sm:rounded-xl text-[11px] sm:text-xs font-bold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 shrink-0">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Buat Laporan
        </a>
    </div>

    {{-- ==================== 4 CARD STATISTIK ==================== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-4 sm:mb-6">

        {{-- Laporan Saya --}}
        <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-100 p-3.5 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-500 font-bold leading-tight">Laporan Saya</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-0.5 sm:mt-1">{{ $totalLaporan }}</p>
                    @if($totalPending > 0)
                    <p class="text-[10px] sm:text-[11px] text-yellow-600 font-semibold mt-0.5">
                        {{ $totalPending }} perlu diverifikasi
                    </p>
                    @else
                    <p class="text-[10px] sm:text-[11px] text-gray-400 font-medium mt-0.5">
                        Semua terverifikasi
                    </p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Terverifikasi --}}
        <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-100 p-3.5 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-green-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-500 font-bold leading-tight">Terverifikasi</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-0.5 sm:mt-1">{{ $totalVerified }}</p>
                    <p class="text-[10px] sm:text-[11px] text-green-600 font-semibold mt-0.5">
                        ↑ Laporan valid
                    </p>
                </div>
            </div>
        </div>

        {{-- Total Kejadian --}}
        <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-100 p-3.5 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-purple-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-500 font-bold leading-tight">Kejadian Bencana</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-0.5 sm:mt-1">{{ $totalKejadian }}</p>
                    <p class="text-[10px] sm:text-[11px] text-purple-600 font-semibold mt-0.5">
                        ↑ Data terpublikasi
                    </p>
                </div>
            </div>
        </div>

        {{-- Berita --}}
        <div class="bg-white rounded-xl sm:rounded-2xl border border-slate-100 p-3.5 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-amber-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-500 font-bold leading-tight">Berita</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-0.5 sm:mt-1">{{ $totalBerita }}</p>
                    <p class="text-[10px] sm:text-[11px] text-amber-600 font-semibold mt-0.5">
                        Berita terpublikasi
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== 2 KOLOM ==================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">

        {{-- KIRI (2/3): LAPORAN TERBARU --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="font-bold text-sm sm:text-base text-gray-800 flex items-center gap-2">
                    <span class="text-blue-600">📋</span>
                    Laporan Saya Terbaru
                </h2>
                <a href="{{ route('petugas.laporan-saya') }}"
                    class="text-[10px] sm:text-xs font-bold text-blue-600 hover:text-blue-800">
                    Lihat semua →
                </a>
            </div>

            @forelse ($laporanTerbaru as $item)
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-slate-100 last:border-b-0 hover:bg-blue-50/30 transition-colors">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0 flex-1">
                        <p class="font-bold text-sm text-gray-800">
                            {{ $item->jenisBencana->nama_bencana ?? '-' }}
                        </p>
                        <p class="text-xs text-gray-500 mt-0.5 truncate">
                            📍 {{ $item->lokasi ?? '-' }}
                        </p>
                        <p class="text-[10px] text-gray-400 mt-1.5">
                            {{ $item->created_at?->timezone('Asia/Makassar')->format('d M Y · H:i') }} WITA
                        </p>
                    </div>
                    <div class="shrink-0">
                        @php
                            $statusBadge = [
                                'verified' => 'bg-green-100 text-green-700',
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'rejected' => 'bg-red-100 text-red-700',
                            ][$item->status] ?? 'bg-gray-100 text-gray-600';

                            $statusLabel = [
                                'verified' => 'TERVERIFIKASI',
                                'pending' => 'MENUNGGU',
                                'rejected' => 'DITOLAK',
                            ][$item->status] ?? strtoupper($item->status ?? '-');
                        @endphp
                        <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-[9px] sm:text-[10px] font-bold {{ $statusBadge }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-4 sm:px-6 py-10 sm:py-16 text-center">
                <div class="flex flex-col items-center gap-3 text-gray-400">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Kamu belum membuat laporan.</p>
                    <a href="{{ route('petugas.laporan.create') }}"
                        class="text-xs font-bold text-blue-600 hover:text-blue-800">
                        Buat laporan pertama →
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        {{-- KANAN (1/3): AKTIVITAS SAYA --}}
        <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-slate-100">
                <h2 class="font-bold text-sm sm:text-base text-gray-800 flex items-center gap-2">
                    <span class="text-yellow-500">⚡</span>
                    Aktivitas Saya
                </h2>
            </div>

            <div class="p-4 sm:p-5 space-y-3 sm:space-y-4">
                @forelse ($laporanTerbaru as $item)
                <div class="flex items-start gap-3">
                    @php
                        $dotClass = [
                            'verified' => 'bg-green-500',
                            'pending' => 'bg-yellow-500',
                            'rejected' => 'bg-red-500',
                        ][$item->status] ?? 'bg-blue-500';

                        $statusText = [
                            'verified' => 'terverifikasi',
                            'pending' => 'menunggu',
                            'rejected' => 'ditolak',
                        ][$item->status] ?? '';

                        $statusTextColor = [
                            'verified' => 'text-green-600',
                            'pending' => 'text-yellow-600',
                            'rejected' => 'text-red-600',
                        ][$item->status] ?? '';
                    @endphp
                    <span class="w-2 h-2 rounded-full mt-1.5 shrink-0 {{ $dotClass }}"></span>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-gray-700 leading-snug">
                            <span class="font-bold text-gray-800">Anda</span>
                            membuat laporan
                            @if($statusText)
                                <span class="font-semibold {{ $statusTextColor }}">{{ $statusText }}</span>
                            @endif
                        </p>
                        <p class="text-[10px] text-gray-400 mt-0.5">
                            {{ $item->created_at?->timezone('Asia/Makassar')->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="text-center text-xs text-gray-400 py-6 sm:py-8">
                    Belum ada aktivitas.
                </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection