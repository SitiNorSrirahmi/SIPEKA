<div class="bg-[#F0F4FB] min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">

        {{-- ==================== BACK ==================== --}}
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors mb-6 group">
            <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        {{-- ==================== MAIN CARD ==================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

                {{-- ============ LEFT: DATA GRID ============ --}}
                <div class="lg:col-span-3">

                    {{-- Jenis Bencana --}}
                    <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400 mb-1">Jenis Bencana</p>
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $kejadianBencana->jenisBencana->nama_bencana ?? '-' }}
                            </p>
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
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $kejadianBencana->laporanMasuk->lokasi ?? '-' }}
                            </p>
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
                            <p class="text-sm font-semibold text-slate-900 font-mono">
                                {{ $kejadianBencana->latitude ?? '-' }}, {{ $kejadianBencana->longitude ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- Jumlah Korban --}}
                    <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400 mb-1">Jumlah Korban</p>
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $kejadianBencana->jumlah_korban ?? 0 }} orang
                            </p>
                        </div>
                    </div>

                    {{-- Estimasi Kerugian --}}
                    <div class="flex items-start gap-4 py-5 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400 mb-1">Estimasi Kerugian</p>
                            <p class="text-sm font-semibold text-slate-900">
                                Rp{{ number_format($kejadianBencana->estimasi_kerugian ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- Tanggal Kejadian --}}
                    <div class="flex items-start gap-4 py-5">
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400 mb-1">Tanggal Kejadian</p>
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $kejadianBencana->tanggal_kejadian?->format('d F Y') ?? '-' }}
                            </p>
                        </div>
                    </div>

                </div>

                {{-- ============ RIGHT: FOTO ============ --}}
                <div class="lg:col-span-2">
                    <div class="rounded-2xl overflow-hidden bg-slate-100 aspect-[3/4] lg:aspect-auto lg:h-full min-h-[420px]">
                        @if ($kejadianBencana->laporanMasuk && $kejadianBencana->laporanMasuk->sumber)
                        <img src="{{ Storage::url($kejadianBencana->laporanMasuk->sumber) }}"
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

        </div>
    </div>
</div>