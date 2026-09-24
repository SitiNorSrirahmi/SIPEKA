@extends('layouts.admin')

@section('header', 'Kelola Laporan')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

    {{-- ==================== HEADER ==================== --}}
    <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6">
        <div class="min-w-0">
            <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Kelola Laporan
            </h1>
            <p class="text-[11px] sm:text-sm text-gray-500 mt-1 truncate">Daftar semua laporan bencana yang masuk ke sistem</p>
        </div>

        {{-- TOMBOL BUAT LAPORAN --}}
        <a href="{{ route('admin.laporan.create') }}"
           class="shrink-0 inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-bold transition shadow-sm whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            <span class="hidden sm:inline">Buat Laporan</span>
            <span class="sm:hidden">Buat</span>
        </a>
    </div>

    {{-- ==================== SUCCESS ==================== --}}
    @if (session('success'))
    <div class="flex items-start gap-3 bg-green-50 border border-green-200 text-green-700 p-3 sm:p-4 mb-4 sm:mb-5 rounded-xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-xs sm:text-sm">{{ session('success') }}</span>
    </div>
    @endif

    {{-- ==================== TABEL ==================== --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- Desktop: tabel --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Token</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Jenis Bencana</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Lokasi</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Pelapor</th>
                        <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Status</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Tanggal</th>
                        <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($laporan as $item)
                        @php
                            $status = strtolower($item->status ?? 'pending');
                            $statusColor = match($status) {
                                'pending' => 'bg-yellow-100 text-yellow-700 ring-yellow-200',
                                'verified', 'diverifikasi' => 'bg-green-100 text-green-700 ring-green-200',
                                'ditolak', 'rejected' => 'bg-red-100 text-red-700 ring-red-200',
                                default => 'bg-gray-100 text-gray-600 ring-gray-200',
                            };
                            $statusDot = match($status) {
                                'pending' => 'bg-yellow-500',
                                'verified', 'diverifikasi' => 'bg-green-500',
                                'ditolak', 'rejected' => 'bg-red-500',
                                default => 'bg-gray-500',
                            };
                            $statusLabel = match($status) {
                                'pending' => 'MENUNGGU',
                                'verified', 'diverifikasi' => 'TERVERIFIKASI',
                                'ditolak', 'rejected' => 'DITOLAK',
                                default => strtoupper($item->status ?? 'UNKNOWN'),
                            };
                            $pelapor = $item->pelapor_nama ?? ($item->dibuatOleh->name ?? '-');
                            $isPending = in_array($status, ['pending', 'menunggu']);
                        @endphp

                        <tr class="hover:bg-blue-50/30 transition-colors">
                            {{-- TOKEN --}}
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2 py-1 rounded-md bg-gray-100 text-gray-700 font-mono text-[10px] font-bold tracking-wide">
                                    {{ $item->token ?? '-' }}
                                </span>
                            </td>

                            {{-- JENIS BENCANA --}}
                            <td class="px-5 py-3.5 font-semibold text-gray-800 text-sm">
                                {{ $item->jenisBencana->nama_bencana ?? '-' }}
                            </td>

                            {{-- LOKASI --}}
                            <td class="px-5 py-3.5">
                                <p class="text-gray-700 text-sm">
                                    {{ $item->lokasi ?? '-' }}
                                </p>
                            </td>

                            {{-- PELAPOR --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shrink-0 shadow-sm">
                                        <span class="text-white font-bold text-xs">
                                            {{ strtoupper(substr($pelapor, 0, 1)) }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 text-sm">
                                        {{ $pelapor }}
                                    </p>
                                </div>
                            </td>

                            {{-- STATUS --}}
                            <td class="px-5 py-3.5 text-center">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold tracking-wide ring-1 {{ $statusColor }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }}"></span>
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            {{-- TANGGAL --}}
                            <td class="px-5 py-3.5 text-gray-600 text-sm">
                                {{ $item->created_at?->format('d M Y') ?? '-' }}
                            </td>

                            {{-- AKSI --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.laporan.show', $item->id) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 transition"
                                       title="Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    {{-- VERIFIKASI & TOLAK (cuma kalau pending) --}}
                                    @if ($isPending)
                                        {{-- VERIFIKASI --}}
                                        <form action="{{ route('admin.laporan.verifikasi', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                    onclick="return confirm('Verifikasi laporan {{ $item->token }}?')"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-50 hover:bg-green-100 text-green-700 transition"
                                                    title="Verifikasi">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>

                                        {{-- TOLAK --}}
                                        <form action="{{ route('admin.laporan.tolak', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                    onclick="return confirm('Tolak laporan {{ $item->token }}?')"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 transition"
                                                    title="Tolak">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-600">Belum ada laporan</p>
                                    <p class="text-xs text-gray-400">Laporan yang masuk akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile: card list --}}
        <div class="md:hidden divide-y divide-gray-100">
            @forelse ($laporan as $item)
                @php
                    $status = strtolower($item->status ?? 'pending');
                    $statusColor = match($status) {
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'verified', 'diverifikasi' => 'bg-green-100 text-green-700',
                        'ditolak', 'rejected' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-600',
                    };
                    $statusDot = match($status) {
                        'pending' => 'bg-yellow-500',
                        'verified', 'diverifikasi' => 'bg-green-500',
                        'ditolak', 'rejected' => 'bg-red-500',
                        default => 'bg-gray-500',
                    };
                    $statusLabel = match($status) {
                        'pending' => 'MENUNGGU',
                        'verified', 'diverifikasi' => 'TERVERIFIKASI',
                        'ditolak', 'rejected' => 'DITOLAK',
                        default => strtoupper($item->status ?? 'UNKNOWN'),
                    };
                    $pelapor = $item->pelapor_nama ?? ($item->dibuatOleh->name ?? '-');
                    $isPending = in_array($status, ['pending', 'menunggu']);
                @endphp

                <div class="p-3 sm:p-4 hover:bg-blue-50/30 transition-colors">
                    {{-- Row atas: Token + Status --}}
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-gray-100 text-gray-700 font-mono text-[9px] font-bold tracking-wide">
                            {{ $item->token ?? '-' }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[8px] font-bold tracking-wide {{ $statusColor }}">
                            <span class="w-1 h-1 rounded-full {{ $statusDot }}"></span>
                            {{ $statusLabel }}
                        </span>
                    </div>

                    {{-- Info utama --}}
                    <div class="flex items-center gap-2.5">
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-gray-800 text-sm truncate">
                                {{ $item->jenisBencana->nama_bencana ?? '-' }}
                            </p>
                            <p class="text-[11px] text-gray-500 mt-0.5 truncate">
                                📍 {{ $item->lokasi ?? '-' }}
                            </p>
                            <p class="text-[10px] text-gray-400 mt-0.5 truncate">
                                👤 {{ $pelapor }} · {{ $item->created_at?->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center gap-1.5 mt-3">
                        {{-- DETAIL --}}
                        <a href="{{ route('admin.laporan.show', $item->id) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-[10px] font-bold transition">
                            Detail
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        {{-- VERIFIKASI (kalau pending) --}}
                        @if ($isPending)
                            <form action="{{ route('admin.laporan.verifikasi', $item->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                        onclick="return confirm('Verifikasi laporan {{ $item->token }}?')"
                                        class="w-full inline-flex items-center justify-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-[10px] font-bold transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Verifikasi
                                </button>
                            </form>

                            {{-- TOLAK --}}
                            <form action="{{ route('admin.laporan.tolak', $item->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                        onclick="return confirm('Tolak laporan {{ $item->token }}?')"
                                        class="w-full inline-flex items-center justify-center gap-1 bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-[10px] font-bold transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Tolak
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="p-6 text-center">
                    <div class="flex flex-col items-center gap-3 text-gray-400">
                        <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-600">Belum ada laporan</p>
                        <p class="text-xs text-gray-400">Laporan yang masuk akan muncul di sini.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if ($laporan->hasPages())
            <div class="px-4 sm:px-5 py-3 sm:py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $laporan->links() }}
            </div>
        @endif
    </div>

</div>
@endsection