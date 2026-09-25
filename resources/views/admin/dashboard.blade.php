@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')

@php
use App\Models\LaporanMasuk;
use App\Models\KejadianBencana;
use App\Models\User;
use App\Models\Berita;

$totalLaporan = LaporanMasuk::count();
$laporanPending = LaporanMasuk::where('status', 'pending')->count();

$totalKejadian = KejadianBencana::count();
$kejadianBulanIni = KejadianBencana::whereMonth('created_at', now()->month)
->whereYear('created_at', now()->year)
->count();

$totalPengguna = User::count();
$penggunaAktif = User::where('aktif', true)->count();

$totalBerita = Berita::count();
$beritaDraft = Berita::where('status', 'draft')->count();

$laporanPerluVerifikasi = LaporanMasuk::with('jenisBencana')
->where('status', 'pending')
->latest()
->take(5)
->get();

// ============ AKTIVITAS SISTEM (GABUNG & SORT) ============
$aktivitas = collect();

// 1. Verifikasi
LaporanMasuk::with(['jenisBencana', 'diverifikasiOleh'])
->whereNotNull('diverifikasi_oleh')
->latest('updated_at')
->take(5)
->get()
->each(function ($item) use ($aktivitas) {
$aktivitas->push([
'tipe' => 'verifikasi',
'waktu' => $item->updated_at,
'nama' => $item->diverifikasiOleh->name ?? 'Admin',
'jenis' => $item->jenisBencana->nama_bencana ?? '-',
'warna' => 'green',
]);
});

// 2. Laporan Baru
LaporanMasuk::with(['jenisBencana', 'dibuatOleh'])
->latest()
->take(5)
->get()
->each(function ($item) use ($aktivitas) {
$aktivitas->push([
'tipe' => 'laporan',
'waktu' => $item->created_at,
'nama' => $item->dibuatOleh->name ?? 'Petugas',
'jenis' => $item->jenisBencana->nama_bencana ?? '-',
'warna' => 'blue',
]);
});

// 3. Pengguna Baru
User::latest()
->take(5)
->get()
->each(function ($item) use ($aktivitas) {
$aktivitas->push([
'tipe' => 'pengguna',
'waktu' => $item->created_at,
'nama' => $item->name,
'jenis' => null,
'warna' => 'purple',
]);
});

// Sort by waktu (terbaru dulu) + ambil 10
$aktivitas = $aktivitas->sortByDesc('waktu')->take(10);

// Helper: time ago
function timeAgo($date) {
if (!$date) return 'Baru saja';
$diff = now()->diffInMinutes($date);
if ($diff < 1) return 'Baru saja' ;
    if ($diff < 60) return $diff . ' menit lalu' ;
    if ($diff < 1440) return floor($diff / 60) . ' jam lalu' ;
    if ($diff < 43200) return floor($diff / 1440) . ' hari lalu' ;
    return $date->format('d M Y');
    }
    @endphp

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseBtn {

            0%,
            100% {
                box-shadow: 0 4px 14px rgba(239, 68, 68, 0.35);
            }

            50% {
                box-shadow: 0 4px 20px rgba(239, 68, 68, 0.55);
            }
        }

        .anim-fade {
            animation: fadeInUp 0.5s ease-out both;
        }

        .anim-fade-1 {
            animation-delay: 0.05s;
        }

        .anim-fade-2 {
            animation-delay: 0.1s;
        }

        .anim-fade-3 {
            animation-delay: 0.15s;
        }

        .anim-fade-4 {
            animation-delay: 0.2s;
        }

        .anim-fade-5 {
            animation-delay: 0.25s;
        }

        .btn-pulse {
            animation: pulseBtn 2s ease-in-out infinite;
        }
    </style>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

        {{-- ==================== HEADER — SEJAJAR ==================== --}}
        <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6 anim-fade">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-600 flex items-center justify-center shrink-0 shadow-md">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-gray-800 truncate">Dashboard Admin SIPEKA</h1>
                    <p class="text-[11px] sm:text-sm text-gray-500 truncate">Selamat datang kembali, Admin SIPEKA!</p>
                </div>
            </div>
            <a href="{{ route('admin.laporan.create') }}"
                class="btn-pulse inline-flex items-center justify-center gap-1.5 sm:gap-2 bg-red-500 hover:bg-red-600 text-white px-3 sm:px-4 py-2 sm:py-2.5 rounded-lg sm:rounded-xl text-[11px] sm:text-xs font-bold shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5 shrink-0">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Buat Laporan
            </a>
        </div>

        {{-- ==================== 4 CARD STATISTIK ==================== --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-4 sm:mb-6">

            {{-- Laporan Masuk --}}
            <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-3.5 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 anim-fade anim-fade-1">
                <div class="flex items-start gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-600 font-bold leading-tight">Laporan Masuk</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-0.5 sm:mt-1">{{ $totalLaporan }}</p>
                        <p class="text-[10px] sm:text-xs text-gray-500 mt-0.5 sm:mt-1">{{ $laporanPending }} perlu verifikasi</p>
                    </div>
                </div>
            </div>

            {{-- Kejadian Bencana --}}
            <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-3.5 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 anim-fade anim-fade-2">
                <div class="flex items-start gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-green-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-600 font-bold leading-tight">Kejadian Bencana</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-0.5 sm:mt-1">{{ $totalKejadian }}</p>
                        <p class="text-[10px] sm:text-xs text-green-600 font-bold mt-0.5 sm:mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            {{ $kejadianBulanIni }} bulan ini
                        </p>
                    </div>
                </div>
            </div>

            {{-- Pengguna --}}
            <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-3.5 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 anim-fade anim-fade-3">
                <div class="flex items-start gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-purple-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-600 font-bold leading-tight">Pengguna</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-0.5 sm:mt-1">{{ $totalPengguna }}</p>
                        <p class="text-[10px] sm:text-xs text-green-600 font-bold mt-0.5 sm:mt-1 flex items-center gap-1">
                            <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            {{ $penggunaAktif }} aktif
                        </p>
                    </div>
                </div>
            </div>

            {{-- Berita --}}
            <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-3.5 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300 anim-fade anim-fade-4">
                <div class="flex items-start gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-orange-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-600 font-bold leading-tight">Berita</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-0.5 sm:mt-1">{{ $totalBerita }}</p>
                        <p class="text-[10px] sm:text-xs text-gray-500 mt-0.5 sm:mt-1">{{ $beritaDraft }} draft</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== 2 KOLOM ==================== --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">

            {{-- TABEL LAPORAN --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden anim-fade anim-fade-5">
                <div class="px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between">
                    <h2 class="font-bold text-sm sm:text-base text-gray-800 flex items-center gap-2">
                        <span class="text-blue-600">📋</span>
                        Laporan Masuk Perlu Verifikasi
                    </h2>
                    <a href="{{ route('admin.laporan.index') }}"
                        class="text-[10px] sm:text-xs text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center gap-1 group">
                        Lihat semua
                        <span class="group-hover:translate-x-0.5 transition-transform">→</span>
                    </a>
                </div>

                {{-- Desktop: tabel --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 border-y border-gray-100">
                                <th class="text-left px-6 py-3 font-bold text-gray-600 text-xs uppercase tracking-wider">Jenis</th>
                                <th class="text-left px-6 py-3 font-bold text-gray-600 text-xs uppercase tracking-wider">Lokasi</th>
                                <th class="text-left px-6 py-3 font-bold text-gray-600 text-xs uppercase tracking-wider">Tanggal</th>
                                <th class="text-center px-6 py-3 font-bold text-gray-600 text-xs uppercase tracking-wider">Status</th>
                                <th class="text-center px-6 py-3 font-bold text-gray-600 text-xs uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($laporanPerluVerifikasi as $item)
                            <tr class="hover:bg-blue-50/30 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-800 text-sm">
                                    {{ $item->jenisBencana->nama_bencana ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-700 text-sm">{{ $item->lokasi ?? '-' }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $item->kabupaten ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4 text-gray-600 text-sm">
                                    {{ $item->created_at?->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                        MENUNGGU
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.laporan.show', $item->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg border border-blue-300 text-blue-600 text-xs font-bold hover:bg-blue-50 transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center">
                                            <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 9l2 2 4-4" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-500">Tidak ada laporan yang perlu diverifikasi.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Mobile: card list — tombol Detail di kanan --}}
                <div class="md:hidden divide-y divide-gray-100">
                    @forelse ($laporanPerluVerifikasi as $item)
                    <div class="p-3 sm:p-4 hover:bg-blue-50/30 transition-colors">
                        <div class="flex items-center gap-2.5">
                            {{-- KIRI: Info --}}
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <p class="font-bold text-gray-800 text-sm truncate">
                                        {{ $item->jenisBencana->nama_bencana ?? '-' }}
                                    </p>
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[8px] font-bold bg-yellow-100 text-yellow-700 shrink-0">
                                        MENUNGGU
                                    </span>
                                </div>
                                <p class="text-[11px] text-gray-500 mt-0.5 truncate">
                                    📍 {{ $item->lokasi ?? '-' }}
                                </p>
                                <p class="text-[10px] text-gray-400 mt-0.5">
                                    {{ $item->created_at?->format('d M Y') }}
                                </p>
                            </div>

                            {{-- KANAN: Tombol Detail --}}
                            <a href="{{ route('admin.laporan.show', $item->id) }}"
                                class="shrink-0 inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-[10px] font-bold transition whitespace-nowrap">
                                Detail
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center">
                                <svg class="w-7 h-7 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 9l2 2 4-4" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium">Tidak ada laporan yang perlu diverifikasi.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- AKTIVITAS SISTEM (GABUNG & SORT) --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden anim-fade anim-fade-5">
                <div class="px-4 sm:px-6 py-3 sm:py-4">
                    <h2 class="font-bold text-sm sm:text-base text-gray-800 flex items-center gap-2">
                        <span class="text-orange-500">⚡</span>
                        Aktivitas Sistem
                    </h2>
                </div>
                <div class="px-4 sm:px-6 pb-2 max-h-[400px] overflow-y-auto">

                    {{-- Loop aktivitas (udah di-sort by waktu DESC) --}}
                    @forelse ($aktivitas as $item)
                    @php
                    $dotColor = match($item['warna']) {
                    'green' => 'bg-green-500',
                    'blue' => 'bg-blue-500',
                    'purple' => 'bg-purple-500',
                    default => 'bg-gray-500',
                    };
                    @endphp
                    <div class="flex items-start gap-3 py-3 sm:py-4 border-b border-gray-100">
                        <div class="w-2.5 h-2.5 rounded-full {{ $dotColor }} mt-1.5 shrink-0"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm text-gray-700 font-medium">
                                @if ($item['tipe'] === 'verifikasi')
                                <strong>{{ $item['nama'] }}</strong> memverifikasi laporan
                                <strong>{{ $item['jenis'] }}</strong>
                                @elseif ($item['tipe'] === 'laporan')
                                <strong>{{ $item['nama'] }}</strong> membuat laporan baru
                                <strong>{{ $item['jenis'] }}</strong>
                                @elseif ($item['tipe'] === 'pengguna')
                                Pengguna baru <strong>{{ $item['nama'] }}</strong> terdaftar
                                @endif
                            </p>
                            <p class="text-[10px] sm:text-xs text-gray-400 mt-1">{{ timeAgo($item['waktu']) }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="py-8 text-center">
                        <div class="flex flex-col items-center gap-2 text-gray-400">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm font-medium">Belum ada aktivitas</p>
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>

        </div>

    </div>
    @endsection