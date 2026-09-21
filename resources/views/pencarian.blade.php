@extends('layouts.publik')

@section('content')

<div class="bg-[#F0F4FB] min-h-screen py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">

        {{-- ==================== HEADER ==================== --}}
        <div class="mb-6">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors mb-4 group">
                <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Beranda
            </a>

            <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Hasil Pencarian
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Ditemukan <strong class="text-slate-700">{{ $hasil->total() }}</strong> kejadian untuk
                <span class="text-blue-600 font-semibold">"{{ $keyword }}"</span>
            </p>
        </div>

        {{-- ==================== HASIL ==================== --}}
        @if ($hasil->count() > 0)
        <div class="space-y-3">
            @foreach ($hasil as $item)
            <a href="{{ route('kejadian.show', $item->id) }}"
                class="group block bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden">

                <div class="flex items-center gap-4 p-5">

                    {{-- Ikon Jenis Bencana --}}
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    {{-- Info --}}
                    <div class="min-w-0 flex-1">
                        <h2 class="font-bold text-slate-900 text-sm mb-1 group-hover:text-blue-600 transition">
                            {{ $item->jenisBencana->nama_bencana ?? '-' }}
                        </h2>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-500">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $item->tanggal_kejadian?->format('d M Y') ?? '-' }}
                            </span>
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Korban: {{ $item->jumlah_korban ?? 0 }} orang
                            </span>
                        </div>
                    </div>

                    {{-- Tombol Detail --}}
                    <div class="hidden sm:flex items-center gap-1 text-xs font-bold text-blue-600 group-hover:gap-2 transition-all shrink-0">
                        Detail
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        @if ($hasil->hasPages())
        <div class="mt-8">
            {{ $hasil->links() }}
        </div>
        @endif
        @else
        {{-- EMPTY STATE --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-16 text-center">
            <div class="flex flex-col items-center gap-3">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <p class="text-sm font-semibold text-slate-600">Tidak ada hasil ditemukan</p>
                <p class="text-xs text-slate-400">
                    Tidak ditemukan kejadian untuk <strong class="text-slate-600">"{{ $keyword }}"</strong>.
                    Coba kata kunci lain.
                </p>

                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold transition mt-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
        @endif

    </div>
</div>

@endsection