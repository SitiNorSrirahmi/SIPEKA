@extends($layout)

@section('header', 'Tentang SIPEKA')

@section('content')

{{-- WRAPPER UTAMA --}}
<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-10">

    {{-- ============ SECTION 1: HERO ============ --}}
    <section class="relative overflow-hidden rounded-2xl sm:rounded-3xl mb-8 sm:mb-12 h-[280px] sm:h-[400px] lg:h-[500px]" style="background: #0A1A3A;">

        <div class="absolute inset-0">
            <img src="{{ asset('images/thumbnail.png') }}"
                alt="SIPEKA"
                class="w-full h-full object-cover object-center">

            <div class="absolute inset-0"
                style="background: linear-gradient(to right, #0A1A3A 0%, #0A1A3A 30%, rgba(10,26,58,0.7) 60%, rgba(10,26,58,0.3) 100%);"></div>
        </div>

        <div class="relative h-full flex items-center px-6 sm:px-10 lg:px-16">
            <div class="max-w-lg">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black text-white mb-3 sm:mb-6 leading-tight">
                    Tentang <span class="text-yellow-400">SIPEKA</span>
                </h1>

                <p class="text-base sm:text-lg lg:text-xl text-white/90 font-medium mb-3 sm:mb-4 leading-snug">
                    Sistem Informasi Peta Kebencanaan<br>Kalimantan Selatan
                </p>

                <p class="text-xs sm:text-sm lg:text-base text-white/70 leading-relaxed">
                    SIPEKA adalah sistem informasi berbasis web yang menyediakan peta kebencanaan
                    dan informasi terkait bencana di wilayah Kalimantan Selatan.
                </p>
            </div>
        </div>
    </section>

    {{-- ============ SECTION 2: APA ITU SIPEKA ============ --}}
    <section class="mb-8 sm:mb-12 bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-12 border border-slate-200">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-start">

            <div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 mb-4 sm:mb-6 leading-tight">
                    Apa itu <span class="text-blue-600">SIPEKA</span>?
                </h2>

                <p class="text-sm sm:text-base lg:text-lg text-slate-600 leading-relaxed mb-4 sm:mb-5 text-justify">
                    SIPEKA adalah sistem informasi berbasis web yang menyediakan peta kebencanaan
                    dan informasi terkait bencana di wilayah Kalimantan Selatan.
                </p>
                <p class="text-sm sm:text-base lg:text-lg text-slate-600 leading-relaxed text-justify">
                    Aplikasi ini membantu masyarakat, petugas, dan admin dalam memantau, melaporkan,
                    dan mengelola data kebencanaan secara real-time.
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-10 border border-slate-200">
                <div class="flex items-start gap-4 sm:gap-5 mb-5 sm:mb-6">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 rounded-full bg-blue-600 flex items-center justify-center shrink-0 shadow-lg">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-slate-900 mb-2">Tujuan Kami</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed text-justify">
                            Menyediakan informasi kebencanaan yang akurat, real-time, dan mudah
                            diakses oleh seluruh pemangku kepentingan di Kalimantan Selatan.
                        </p>
                    </div>
                </div>

                <ul class="space-y-3 sm:space-y-4 mt-6 sm:mt-8">
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-sm sm:text-base text-slate-700">Meningkatkan kesiapsiagaan terhadap bencana</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-sm sm:text-base text-slate-700">Mempercepat proses informasi dan pelaporan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-sm sm:text-base text-slate-700">Mendukung pengambilan keputusan berbasis data</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-sm sm:text-base text-slate-700">Meningkatkan kesadaran masyarakat</span>
                    </li>
                </ul>
            </div>

        </div>
    </section>

    {{-- ============ SECTION 3: FITUR UTAMA ============ --}}
    <section class="mb-8 sm:mb-12">

        <div class="mb-6 sm:mb-10">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 mb-3 sm:mb-4">Fitur Utama</h2>
            <p class="text-sm sm:text-base text-slate-600 max-w-2xl">
                Berbagai fitur yang memudahkan pengguna dalam mengakses informasi kebencanaan.
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">

            <div class="group bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative">
                <div class="mb-3 sm:mb-5">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-blue-100 flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-slate-900 mb-1.5 sm:mb-2 text-sm sm:text-lg">Peta Kebencanaan</h3>
                <p class="text-[11px] sm:text-sm text-slate-600 leading-relaxed">Peta interaktif wilayah rawan bencana.</p>
            </div>

            <div class="group bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative">
                <div class="mb-3 sm:mb-5">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-slate-900 mb-1.5 sm:mb-2 text-sm sm:text-lg">Lapor Bencana</h3>
                <p class="text-[11px] sm:text-sm text-slate-600 leading-relaxed">Laporkan kejadian bencana langsung.</p>
            </div>

            <div class="group bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative">
                <div class="mb-3 sm:mb-5">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-purple-100 flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-slate-900 mb-1.5 sm:mb-2 text-sm sm:text-lg">Statistik</h3>
                <p class="text-[11px] sm:text-sm text-slate-600 leading-relaxed">Data statistik kebencanaan informatif.</p>
            </div>

            <div class="group bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative">
                <div class="mb-3 sm:mb-5">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-amber-100 flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-slate-900 mb-1.5 sm:mb-2 text-sm sm:text-lg">Berita</h3>
                <p class="text-[11px] sm:text-sm text-slate-600 leading-relaxed">Informasi & berita terkini.</p>
            </div>

            <div class="group bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative">
                <div class="mb-3 sm:mb-5">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-cyan-100 flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-slate-900 mb-1.5 sm:mb-2 text-sm sm:text-lg">Cek Status</h3>
                <p class="text-[11px] sm:text-sm text-slate-600 leading-relaxed">Cek status laporan bencana.</p>
            </div>

            <div class="group bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative">
                <div class="mb-3 sm:mb-5">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-pink-100 flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-slate-900 mb-1.5 sm:mb-2 text-sm sm:text-lg">Multi-Role</h3>
                <p class="text-[11px] sm:text-sm text-slate-600 leading-relaxed">Akses berbeda per role.</p>
            </div>

        </div>
    </section>

    {{-- ============ SECTION 4: TIM PENGEMBANG ============ --}}
    <section class="mb-4 pt-12">

        <div class="mb-8 sm:mb-10 text-center">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 mb-3 sm:mb-4">Tim Pengembang</h2>
            <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto">
                Dikembangkan oleh tim yang berdedikasi untuk menghadirkan solusi terbaik.
            </p>
        </div>

        <div class="max-w-4xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">

            {{-- ============ SIDIQ — HIJAU (EMERALD) ============ --}}
            <div class="team-card group relative" style="animation-delay: 0.1s;">

                <div class="relative overflow-hidden rounded-t-2xl" style="height: 240px;">
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-48 h-48 rounded-full blur-3xl opacity-50 pointer-events-none"
                        style="background: radial-gradient(circle, #10B981, transparent 70%);"></div>

                    <img src="{{ asset('images/tim/sidiq.png') }}"
                        alt="Muhamad Sidiq"
                        class="relative w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
                        style="filter: drop-shadow(0 15px 25px rgba(16, 185, 129, 0.4)); transform: scale(0.95); transform-origin: bottom center;">
                </div>

                <div class="relative bg-white rounded-b-2xl overflow-hidden transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl"
                    style="border: 1px solid rgba(16, 185, 129, 0.2); border-top: none; box-shadow: 0 2px 12px rgba(16, 185, 129, 0.08);">

                    <div class="absolute top-0 left-0 right-0 h-1"
                        style="background: linear-gradient(90deg, #34D399, #059669, #34D399);"></div>

                    <div class="pt-4 px-4 text-center">
                        <h3 class="text-base font-black text-slate-900 tracking-tight">Muhamad Sidiq</h3>
                    </div>

                    <div class="px-4 py-3">
                        <div class="rounded-xl px-3 py-2 text-center"
                            style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05)); border: 1px solid rgba(16, 185, 129, 0.2);">
                            <p class="text-[11px] font-bold tracking-wide" style="color: #059669;">
                                Frontend Developer & UI/UX
                            </p>
                        </div>
                    </div>

                    <div class="px-4 pb-4">
                        <div class="flex items-center gap-1.5 mb-2">
                            <svg class="w-3.5 h-3.5" style="color: #059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <p class="text-[9px] font-bold uppercase tracking-wider" style="color: #059669;">
                                Tugas & Tanggung Jawab:
                            </p>
                        </div>
                        <ul class="space-y-1.5 text-[11px] text-slate-600">
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #10B981;">✓</span>
                                <span>Merancang tampilan antarmuka (UI)</span>
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #10B981;">✓</span>
                                <span>Mengembangkan fitur frontend</span>
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #10B981;">✓</span>
                                <span>Mendesain pengalaman pengguna (UX)</span>
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #10B981;">✓</span>
                                <span>Memastikan tampilan responsive</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- ============ SITI — MERAH (RED) ============ --}}
            <div class="team-card group relative" style="animation-delay: 0.25s;">

                <div class="relative overflow-hidden rounded-t-2xl" style="height: 240px;">
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-48 h-48 rounded-full blur-3xl opacity-50 pointer-events-none"
                        style="background: radial-gradient(circle, #EF4444, transparent 70%);"></div>

                    <img src="{{ asset('images/tim/siti.png') }}"
                        alt="Siti Nor Srirahmi"
                        class="relative w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
                        style="filter: drop-shadow(0 15px 25px rgba(239, 68, 68, 0.4));">
                </div>

                <div class="relative bg-white rounded-b-2xl overflow-hidden transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl"
                    style="border: 1px solid rgba(239, 68, 68, 0.2); border-top: none; box-shadow: 0 2px 12px rgba(239, 68, 68, 0.08);">

                    <div class="absolute top-0 left-0 right-0 h-1"
                        style="background: linear-gradient(90deg, #F87171, #DC2626, #F87171);"></div>

                    <div class="pt-4 px-4 text-center">
                        <h3 class="text-base font-black text-slate-900 tracking-tight">Siti Nor Srirahmi</h3>
                    </div>

                    <div class="px-4 py-3">
                        <div class="rounded-xl px-3 py-2 text-center"
                            style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05)); border: 1px solid rgba(239, 68, 68, 0.2);">
                            <p class="text-[11px] font-bold tracking-wide" style="color: #DC2626;">
                                Backend Developer
                            </p>
                        </div>
                    </div>

                    <div class="px-4 pb-4">
                        <div class="flex items-center gap-1.5 mb-2">
                            <svg class="w-3.5 h-3.5" style="color: #DC2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <p class="text-[9px] font-bold uppercase tracking-wider" style="color: #DC2626;">
                                Tugas & Tanggung Jawab:
                            </p>
                        </div>
                        <ul class="space-y-1.5 text-[11px] text-slate-600">
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #EF4444;">✓</span>
                                <span>Merancang & membangun sistem aplikasi</span>
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #EF4444;">✓</span>
                                <span>Membuat struktur database</span>
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #EF4444;">✓</span>
                                <span>Mengatur sistem login & hak akses</span>
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #EF4444;">✓</span>
                                <span>Mengembangkan fitur backend</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- ============ ANDI — BIRU (BLUE) ============ --}}
            <div class="team-card group relative" style="animation-delay: 0.4s;">

                <div class="relative overflow-hidden rounded-t-2xl" style="height: 240px;">
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-48 h-48 rounded-full blur-3xl opacity-50 pointer-events-none"
                        style="background: radial-gradient(circle, #3B82F6, transparent 70%);"></div>

                    <img src="{{ asset('images/tim/andi.png') }}"
                        alt="Muhammad Andi Maulana"
                        class="relative w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105"
                        style="filter: drop-shadow(0 15px 25px rgba(59, 130, 246, 0.4));">
                </div>

                <div class="relative bg-white rounded-b-2xl overflow-hidden transition-all duration-500 group-hover:-translate-y-1 group-hover:shadow-xl"
                    style="border: 1px solid rgba(59, 130, 246, 0.2); border-top: none; box-shadow: 0 2px 12px rgba(59, 130, 246, 0.08);">

                    <div class="absolute top-0 left-0 right-0 h-1"
                        style="background: linear-gradient(90deg, #60A5FA, #2563EB, #60A5FA);"></div>

                    <div class="pt-4 px-4 text-center">
                        <h3 class="text-base font-black text-slate-900 tracking-tight">Muhammad Andi Maulana</h3>
                    </div>

                    <div class="px-4 py-3">
                        <div class="rounded-xl px-3 py-2 text-center"
                            style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05)); border: 1px solid rgba(59, 130, 246, 0.2);">
                            <p class="text-[11px] font-bold tracking-wide" style="color: #2563EB;">
                                Desain Visual & Aset
                            </p>
                        </div>
                    </div>

                    <div class="px-4 pb-4">
                        <div class="flex items-center gap-1.5 mb-2">
                            <svg class="w-3.5 h-3.5" style="color: #2563EB;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <p class="text-[9px] font-bold uppercase tracking-wider" style="color: #2563EB;">
                                Tugas & Tanggung Jawab:
                            </p>
                        </div>
                        <ul class="space-y-1.5 text-[11px] text-slate-600">
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #3B82F6;">✓</span>
                                <span>Merancang logo SIPEKA</span>
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #3B82F6;">✓</span>
                                <span>Menyiapkan aset visual</span>
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="mt-0.5 shrink-0 font-bold" style="color: #3B82F6;">✓</span>
                                <span>Mendukung kebutuhan desain</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

{{-- ============ ANIMASI FADE-IN ============ --}}
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .team-card {
        animation: fadeInUp 0.8s ease-out backwards;
    }
</style>

@endsection