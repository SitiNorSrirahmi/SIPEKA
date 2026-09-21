@extends('layouts.publik')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-12">

        {{-- ==================== HEADER ==================== --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-100 mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight mb-2">
                Cek Status Laporan
            </h1>
            <p class="text-sm text-slate-500">
                Masukkan token laporan Anda untuk melihat status verifikasi
            </p>
        </div>

        {{-- ==================== ERROR ==================== --}}
        @if ($errors->any())
            <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 p-4 mb-6 rounded-2xl">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-sm font-semibold mb-1">Ada beberapa kesalahan:</p>
                    <ul class="list-disc list-inside text-sm space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- ==================== FORM ==================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 mb-6">
            <form action="{{ route('cek-status.cari') }}" method="POST">
                @csrf

                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                    Token Laporan <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="token"
                       value="{{ old('token') }}"
                       placeholder="Contoh: LRP-A3F9K2"
                       autocomplete="off"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-base font-mono uppercase tracking-wider text-center text-slate-900 placeholder:text-slate-400 placeholder:normal-case placeholder:tracking-normal placeholder:font-sans">

                <p class="text-[11px] text-slate-400 mt-2 text-center">
                    Token diberikan saat Anda pertama kali mengirim laporan.
                </p>

                <button type="submit"
                        class="w-full mt-5 inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-bold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cek Status Laporan
                </button>
            </form>
        </div>

        {{-- ==================== HASIL PENCARIAN ==================== --}}
        @isset($laporan)
            @php
                $status = strtolower($laporan->status ?? 'pending');
                $statusConfig = match($status) {
                    'pending' => [
                        'label' => 'Menunggu Verifikasi',
                        'desc' => 'Laporan Anda sedang diperiksa oleh petugas.',
                        'bg' => 'from-amber-500 to-orange-500',
                        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                    'verified' => [
                        'label' => 'Terverifikasi',
                        'desc' => 'Laporan Anda sudah diverifikasi & dipublikasikan.',
                        'bg' => 'from-emerald-500 to-green-500',
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                    'ditolak', 'rejected' => [
                        'label' => 'Ditolak',
                        'desc' => 'Laporan Anda tidak dapat diproses.',
                        'bg' => 'from-rose-500 to-red-500',
                        'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                    default => [
                        'label' => ucfirst($laporan->status),
                        'desc' => 'Status laporan saat ini.',
                        'bg' => 'from-slate-500 to-slate-600',
                        'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    ],
                };
            @endphp

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- HERO STATUS --}}
                <div class="relative overflow-hidden bg-gradient-to-br {{ $statusConfig['bg'] }} p-6 sm:p-8">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20"></div>

                    <div class="relative flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center shrink-0">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $statusConfig['icon'] }}" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-white/70 font-bold mb-1">Status Laporan</p>
                            <p class="text-xl sm:text-2xl font-extrabold text-white leading-tight">
                                {{ $statusConfig['label'] }}
                            </p>
                            <p class="text-xs text-white/85 mt-1">{{ $statusConfig['desc'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- DETAIL LAPORAN --}}
                <div class="p-6 sm:p-8 space-y-1">

                    {{-- Token --}}
                    <div class="flex items-start gap-4 py-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400 mb-1">Token</p>
                            <p class="text-sm font-semibold text-slate-900 font-mono tracking-wider">
                                {{ $laporan->token ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- Jenis Bencana --}}
                    <div class="flex items-start gap-4 py-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400 mb-1">Jenis Bencana</p>
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $laporan->jenisBencana->nama_bencana ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- Lokasi --}}
                    <div class="flex items-start gap-4 py-4 border-b border-slate-100">
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
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $laporan->lokasi ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- Tanggal Laporan --}}
                    @if ($laporan->created_at)
                        <div class="flex items-start gap-4 py-4">
                            <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-slate-400 mb-1">Tanggal Laporan</p>
                                <p class="text-sm font-semibold text-slate-900">
                                    {{ $laporan->created_at->format('d F Y, H:i') }} WITA
                                </p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        @endisset

        {{-- ==================== INFO BAWAH ==================== --}}
        @if (!isset($laporan))
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5 flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-xs font-semibold text-blue-900 mb-1">Belum punya token?</p>
                    <p class="text-xs text-blue-700 leading-relaxed">
                        Token diberikan saat Anda pertama kali mengirim laporan bencana.
                        Jika Anda kehilangan token, silakan <strong>kirim laporan baru dengan data yang sama</strong> — token baru akan diberikan otomatis.
                    </p>
                </div>
            </div>
        @endif

    </div>
@endsection