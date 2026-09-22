@extends('layouts.admin')

@section('header', 'Edit Data Kejadian Bencana')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

    {{-- ==================== BACK ==================== --}}
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors mb-3 sm:mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>

    @php
        $status = strtolower($kejadianBencana->status_data ?? 'published');
        $statusLabel = match($status) {
            'published' => 'Published',
            'draft' => 'Draft',
            'pending' => 'Pending',
            default => ucfirst($kejadianBencana->status_data ?? '-'),
        };
        $statusStyle = match($status) {
            'published' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'draft' => 'bg-slate-50 text-slate-600 border-slate-200',
            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
            default => 'bg-slate-50 text-slate-600 border-slate-200',
        };
        $statusDot = match($status) {
            'published' => 'bg-emerald-500',
            'draft' => 'bg-slate-400',
            'pending' => 'bg-amber-500',
            default => 'bg-slate-400',
        };
    @endphp

    {{-- ==================== HEADER — SEJAJAR ==================== --}}
    <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div class="min-w-0">
                <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-slate-900 truncate">
                    Edit Data Kejadian Bencana
                </h1>
                <p class="text-[11px] sm:text-sm text-slate-500 truncate">
                    Perbarui informasi kejadian <span class="font-medium text-slate-700">{{ $kejadianBencana->jenisBencana->nama_bencana ?? '' }}</span>
                </p>
            </div>
        </div>

        {{-- Badge status --}}
        <span class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full border text-[11px] sm:text-sm font-semibold {{ $statusStyle }} shrink-0">
            <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full {{ $statusDot }}"></span>
            {{ $statusLabel }}
        </span>
    </div>

    {{-- ==================== ERROR ==================== --}}
    @if ($errors->any())
    <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 p-3 sm:p-4 mb-4 sm:mb-6 rounded-2xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="text-sm font-semibold mb-1">Ada beberapa kesalahan:</p>
            <ul class="list-disc list-inside text-xs sm:text-sm space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- ==================== FORM ==================== --}}
    <form action="{{ route('admin.kejadian.update', $kejadianBencana->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

            {{-- ============ LEFT: FORM ============ --}}
            <div class="lg:col-span-2 space-y-4 sm:space-y-6">

                {{-- CARD: DATA KEJADIAN --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Data Kejadian</h2>
                            <p class="text-[11px] sm:text-xs text-slate-400">Jenis bencana & lokasi kejadian</p>
                        </div>
                    </div>

                    <div class="space-y-4 sm:space-y-5">
                        {{-- Jenis Bencana --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Jenis Bencana <span class="text-rose-500">*</span>
                            </label>
                            <select name="id_bencana"
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                @foreach ($jenisBencana as $jb)
                                    <option value="{{ $jb->id }}" @selected(old('id_bencana', $kejadianBencana->id_bencana) == $jb->id)>
                                        {{ $jb->nama_bencana }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Grid 2 kolom: Latitude + Longitude --}}
                        <div class="grid grid-cols-2 gap-3 sm:gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Latitude <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="latitude" value="{{ old('latitude', $kejadianBencana->latitude) }}"
                                       placeholder="-3.3194"
                                       class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-xs sm:text-sm font-mono text-slate-900 placeholder:text-slate-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Longitude <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="longitude" value="{{ old('longitude', $kejadianBencana->longitude) }}"
                                       placeholder="114.5908"
                                       class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-xs sm:text-sm font-mono text-slate-900 placeholder:text-slate-500">
                            </div>
                        </div>

                        {{-- Tanggal Kejadian --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Tanggal Kejadian <span class="text-rose-500">*</span>
                            </label>
                            <input type="date" name="tanggal_kejadian"
                                   value="{{ old('tanggal_kejadian', $kejadianBencana->tanggal_kejadian?->format('Y-m-d')) }}"
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                        </div>
                    </div>
                </div>

                {{-- CARD: KORBAN & KERUGIAN --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-rose-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Korban & Kerugian</h2>
                            <p class="text-[11px] sm:text-xs text-slate-400">Data dampak bencana</p>
                        </div>
                    </div>

                    <div class="space-y-4 sm:space-y-5">
                        {{-- Jumlah Korban --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Jumlah Korban
                            </label>
                            <input type="number" name="jumlah_korban" value="{{ old('jumlah_korban', $kejadianBencana->jumlah_korban) }}" min="0"
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                        </div>

                        {{-- Estimasi Kerugian --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Estimasi Kerugian (Rp)
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 sm:pl-4 text-slate-500 text-sm font-semibold pointer-events-none">Rp</span>
                                <input type="number" name="estimasi_kerugian" value="{{ old('estimasi_kerugian', $kejadianBencana->estimasi_kerugian) }}" min="0"
                                       placeholder="0"
                                       class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ============ RIGHT: SIDEBAR ============ --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-6 space-y-4 sm:space-y-6">

                    {{-- CARD: PREVIEW KEJADIAN --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-blue-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-900 truncate max-w-full">
                                {{ $kejadianBencana->jenisBencana->nama_bencana ?? '-' }}
                            </p>
                            <p class="text-xs text-slate-500 truncate max-w-full mb-3">
                                {{ $kejadianBencana->laporanMasuk->lokasi ?? '-' }}
                            </p>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-medium {{ $statusStyle }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }}"></span>
                                {{ $statusLabel }}
                            </span>
                        </div>
                    </div>

                    {{-- CARD: INFO --}}
                    <div class="bg-slate-50/70 rounded-2xl border border-slate-100 p-4 sm:p-6">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-semibold text-slate-900 mb-1">Perhatian</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Perubahan koordinat akan memperbarui posisi kejadian di peta.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD: AKSI --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl text-sm font-semibold transition-colors mb-2 sm:mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.kejadian.index') }}"
                           class="w-full inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
@endsection