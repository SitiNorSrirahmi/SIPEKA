@extends('layouts.admin')

@section('header', 'Kelola Laporan')

@section('content')
    <div class="max-w-6xl mx-auto">

        {{-- ==================== HEADER ==================== --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Kelola Laporan
                </h1>
                <p class="text-sm text-gray-500 mt-1">Daftar semua laporan bencana yang masuk ke sistem</p>
            </div>
        </div>

        {{-- ==================== SUCCESS ==================== --}}
        @if (session('success'))
            <div class="flex items-start gap-3 bg-green-50 border border-green-200 text-green-700 p-4 mb-5 rounded-xl">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm">{{ session('success') }}</span>
            </div>
        @endif

        {{-- ==================== TABEL ==================== --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
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
                                    <div class="flex items-center justify-center">
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

            {{-- PAGINATION --}}
            @if ($laporan->hasPages())
                <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $laporan->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection