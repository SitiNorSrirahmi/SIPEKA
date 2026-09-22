@extends('layouts.admin')

@section('header', 'Verifikasi Laporan')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

    {{-- ==================== HEADER ==================== --}}
    <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6">
        <div class="min-w-0">
            <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Verifikasi Laporan
            </h1>
            <p class="text-[11px] sm:text-sm text-gray-500 mt-1 truncate">Tinjau dan verifikasi laporan bencana yang masuk</p>
        </div>
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
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">ID</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Lokasi</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Pelapor</th>
                        <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Korban</th>
                        <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Status</th>
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
                        @endphp

                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-5 py-3.5 font-mono text-xs text-gray-500">#{{ $item->id }}</td>
                            <td class="px-5 py-3.5">
                                <p class="font-semibold text-gray-800 text-sm">{{ $item->lokasi ?? '-' }}</p>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shrink-0 shadow-sm">
                                        <span class="text-white font-bold text-xs">
                                            {{ strtoupper(substr($item->pelapor_nama ?? 'A', 0, 1)) }}
                                        </span>
                                    </div>
                                    <p class="text-gray-700 text-sm">{{ $item->pelapor_nama ?? '-' }}</p>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex flex-col gap-1">
                                    <span class="inline-flex items-center gap-1.5 text-xs text-gray-600">
                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                        Meninggal: <strong class="text-gray-800">{{ $item->jumlah_korban_meninggal ?? 0 }}</strong>
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 text-xs text-gray-600">
                                        <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                        Luka: <strong class="text-gray-800">{{ $item->jumlah_korban_luka ?? 0 }}</strong>
                                    </span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide ring-1 {{ $statusColor }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }}"></span>
                                    {{ $item->status ?? 'pending' }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-2">
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

                                    <form action="{{ route('admin.laporan.verifikasi', $item->id) }}" method="POST"
                                          class="inline" onsubmit="return confirm('Verifikasi laporan ini?')">
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-50 hover:bg-green-100 text-green-700 transition"
                                                title="Verifikasi">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.laporan.tolak', $item->id) }}" method="POST"
                                          class="inline" onsubmit="return confirm('Tolak laporan ini?')">
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 transition"
                                                title="Tolak">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-600">Tidak ada laporan pending</p>
                                    <p class="text-xs text-gray-400">Semua laporan sudah diverifikasi</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ============ Mobile: card list — tombol di kanan (stack vertical) ============ --}}
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
                @endphp

                <div class="p-3 sm:p-4 hover:bg-blue-50/30 transition-colors">
                    {{-- Row atas: ID + Status --}}
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="font-mono text-[10px] text-gray-400">#{{ $item->id }}</span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[8px] font-bold tracking-wide {{ $statusColor }}">
                            <span class="w-1 h-1 rounded-full {{ $statusDot }}"></span>
                            {{ strtoupper($item->status ?? 'PENDING') }}
                        </span>
                    </div>

                    {{-- Info + tombol (kanan) --}}
                    <div class="flex items-center gap-3">
                        {{-- KIRI: Info --}}
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-gray-800 text-sm truncate">
                                📍 {{ $item->lokasi ?? '-' }}
                            </p>
                            <p class="text-[11px] text-gray-500 mt-0.5 truncate">
                                👤 {{ $item->pelapor_nama ?? '-' }}
                            </p>
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-0.5 mt-1 text-[10px] text-gray-500">
                                <span class="inline-flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Meninggal: {{ $item->jumlah_korban_meninggal ?? 0 }}
                                </span>
                                <span class="inline-flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                    Luka: {{ $item->jumlah_korban_luka ?? 0 }}
                                </span>
                            </div>
                        </div>

                        {{-- KANAN: Tombol stack vertical --}}
                        <div class="shrink-0 flex flex-col gap-1.5">
                            {{-- Detail --}}
                            <a href="{{ route('admin.laporan.show', $item->id) }}"
                               class="inline-flex items-center justify-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-[10px] font-bold transition whitespace-nowrap"
                               title="Detail">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>

                            {{-- Verifikasi --}}
                            <form action="{{ route('admin.laporan.verifikasi', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Verifikasi laporan ini?')">
                                @csrf
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-1 bg-green-50 hover:bg-green-100 text-green-700 px-3 py-1.5 rounded-lg text-[10px] font-bold transition whitespace-nowrap"
                                        title="Verifikasi">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Verifikasi
                                </button>
                            </form>

                            {{-- Tolak --}}
                            <form action="{{ route('admin.laporan.tolak', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Tolak laporan ini?')">
                                @csrf
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-1 bg-red-50 hover:bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-[10px] font-bold transition whitespace-nowrap"
                                        title="Tolak">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center">
                    <div class="flex flex-col items-center gap-3 text-gray-400">
                        <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-600">Tidak ada laporan pending</p>
                        <p class="text-xs text-gray-400">Semua laporan sudah diverifikasi</p>
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