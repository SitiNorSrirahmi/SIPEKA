@extends('layouts.admin')

@section('header', 'Detail Laporan')

@section('content')
    <div class="max-w-[1400px] mx-auto px-2">

        {{-- ==================== BACK ==================== --}}
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        @php
            $status = strtolower($laporanMasuk->status ?? 'pending');
            $statusLabel = match($status) {
                'pending' => 'Menunggu',
                'verified', 'diverifikasi' => 'Diverifikasi',
                'ditolak', 'rejected' => 'Ditolak',
                default => ucfirst($laporanMasuk->status ?? '-'),
            };
            $statusStyle = match($status) {
                'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                'verified', 'diverifikasi' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'ditolak', 'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                default => 'bg-slate-50 text-slate-600 border-slate-200',
            };
            $statusDot = match($status) {
                'pending' => 'bg-amber-500',
                'verified', 'diverifikasi' => 'bg-emerald-500',
                'ditolak', 'rejected' => 'bg-rose-500',
                default => 'bg-slate-400',
            };
            $boxConfig = match(true) {
                in_array($status, ['verified', 'diverifikasi']) => [
                    'iconBg' => 'bg-emerald-100',
                    'iconColor' => 'text-emerald-600',
                    'title' => 'Verified',
                    'desc' => 'Laporan telah diverifikasi dan disetujui.',
                ],
                $status === 'pending' => [
                    'iconBg' => 'bg-amber-100',
                    'iconColor' => 'text-amber-600',
                    'title' => 'Menunggu',
                    'desc' => 'Laporan menunggu verifikasi dari admin.',
                ],
                in_array($status, ['ditolak', 'rejected']) => [
                    'iconBg' => 'bg-rose-100',
                    'iconColor' => 'text-rose-600',
                    'title' => 'Ditolak',
                    'desc' => 'Laporan telah ditolak.',
                ],
                default => [
                    'iconBg' => 'bg-slate-100',
                    'iconColor' => 'text-slate-600',
                    'title' => $statusLabel,
                    'desc' => 'Status laporan saat ini.',
                ],
            };
        @endphp

        {{-- ==================== HEADER ==================== --}}
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight leading-tight mb-1.5">
                    Detail Laporan
                </h1>
                <p class="text-sm text-slate-500">
                    Informasi lengkap mengenai laporan bencana
                </p>
            </div>

            <div class="flex flex-col items-start sm:items-end gap-2">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold {{ $statusStyle }}">
                    <span class="w-2 h-2 rounded-full {{ $statusDot }}"></span>
                    {{ $statusLabel }}
                </span>
                <p class="text-xs text-slate-400">
                    {{ $laporanMasuk->created_at?->format('d M Y') ?? '-' }} • {{ $laporanMasuk->created_at?->format('H:i') ?? '-' }}
                </p>
            </div>
        </div>

        {{-- ==================== MAIN CARD ==================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

                {{-- ============ LEFT: DATA GRID ============ --}}
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-1">

                        {{-- Token --}}
                        <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M15 5v2m0 4v2m0 4v2M5 5h11a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Token</p>
                                <p class="text-sm font-semibold text-slate-900 truncate">{{ $laporanMasuk->token ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Lokasi</p>
                                <p class="text-sm font-semibold text-slate-900 truncate">{{ $laporanMasuk->lokasi ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- Koordinat --}}
                        <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Koordinat</p>
                                <p class="text-sm font-semibold text-slate-900 truncate">
                                    {{ $laporanMasuk->latitude ?? '-' }}, {{ $laporanMasuk->longitude ?? '-' }}
                                </p>
                            </div>
                        </div>

                        {{-- Jenis Bencana --}}
                        <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Jenis Bencana</p>
                                <p class="text-sm font-semibold text-slate-900 truncate">
                                    {{ $laporanMasuk->jenisBencana->nama_bencana ?? '-' }}
                                </p>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Deskripsi</p>
                                <p class="text-sm font-semibold text-slate-900 line-clamp-2">
                                    {{ $laporanMasuk->deskripsi ?? '-' }}
                                </p>
                            </div>
                        </div>

                        {{-- Korban --}}
                        <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Korban</p>
                                <p class="text-sm font-semibold text-slate-900">
                                    Meninggal: {{ $laporanMasuk->jumlah_korban_meninggal ?? 0 }},
                                    Luka: {{ $laporanMasuk->jumlah_korban_luka ?? 0 }}
                                </p>
                            </div>
                        </div>

                        {{-- Estimasi Kerugian --}}
                        <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Estimasi Kerugian</p>
                                <p class="text-sm font-semibold text-slate-900 truncate">
                                    Rp{{ number_format($laporanMasuk->estimasi_kerugian ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        {{-- Tanggal Kejadian --}}
                        <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Tanggal Kejadian</p>
                                <p class="text-sm font-semibold text-slate-900 truncate">
                                    {{ $laporanMasuk->tanggal_kejadian?->format('d M Y') ?? '-' }}
                                </p>
                            </div>
                        </div>

                        {{-- Pelapor --}}
                        <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Pelapor</p>
                                <p class="text-sm font-semibold text-slate-900 truncate">
                                    {{ $laporanMasuk->pelapor_nama ?? ($laporanMasuk->dibuatOleh->name ?? '-') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- ============ STATUS BOX ============ --}}
                    <div class="mt-6 rounded-2xl bg-slate-50/70 border border-slate-100 p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full {{ $boxConfig['iconBg'] }} flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 {{ $boxConfig['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 mb-1">Status</p>
                                <p class="text-xl font-bold text-slate-900 mb-1">{{ $boxConfig['title'] }}</p>
                                <p class="text-sm text-slate-500">{{ $boxConfig['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============ RIGHT: FOTO ============ --}}
                <div class="lg:col-span-2">
                    <div class="rounded-2xl overflow-hidden bg-slate-100 aspect-[3/4] lg:aspect-auto lg:h-full min-h-[420px]">
                        @if ($laporanMasuk->sumber)
                            <img src="{{ Storage::url($laporanMasuk->sumber) }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100">
                                <div class="w-14 h-14 rounded-full bg-slate-200 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-400 font-medium">Tidak ada foto</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ============ AKSI (kalau pending) ============ --}}
            @if ($laporanMasuk->status === 'pending')
                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row gap-3">
                    <form action="{{ route('admin.laporan.verifikasi', $laporanMasuk->id) }}" method="POST"
                          class="flex-1" onsubmit="return confirm('Verifikasi laporan ini?')">
                        @csrf
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            Verifikasi
                        </button>
                    </form>

                    <form action="{{ route('admin.laporan.tolak', $laporanMasuk->id) }}" method="POST"
                          class="flex-1" onsubmit="return confirm('Tolak laporan ini?')">
                        @csrf
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-6 py-3 rounded-xl text-sm font-semibold transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Tolak
                        </button>
                    </form>
                </div>
            @endif
        </div>

    </div>
@endsection