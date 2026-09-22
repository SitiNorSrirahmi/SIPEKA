@extends('layouts.petugas')

@section('header', 'Laporan Saya')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

    {{-- ==================== TOMBOL BUAT LAPORAN ==================== --}}
    <div class="flex justify-end mb-4 sm:mb-6">
        <a href="{{ route('petugas.laporan.create') }}"
            class="inline-flex items-center gap-1.5 sm:gap-2 bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-5 py-2 sm:py-2.5 rounded-lg sm:rounded-xl text-[11px] sm:text-sm font-bold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Buat Laporan
        </a>
    </div>

    {{-- ==================== SUCCESS ==================== --}}
    @if (session('success'))
    <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 sm:p-4 mb-4 sm:mb-5 rounded-xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-xs sm:text-sm font-medium">{{ session('success') }}</span>
    </div>
    @endif

    {{-- ==================== TABEL ==================== --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[640px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left px-4 sm:px-6 py-3 font-bold text-gray-500 text-[10px] sm:text-xs uppercase tracking-wider">Jenis Bencana</th>
                        <th class="text-left px-4 sm:px-6 py-3 font-bold text-gray-500 text-[10px] sm:text-xs uppercase tracking-wider">Lokasi</th>
                        <th class="text-center px-4 sm:px-6 py-3 font-bold text-gray-500 text-[10px] sm:text-xs uppercase tracking-wider">Korban</th>
                        <th class="text-center px-4 sm:px-6 py-3 font-bold text-gray-500 text-[10px] sm:text-xs uppercase tracking-wider">Status</th>
                        <th class="text-left px-4 sm:px-6 py-3 font-bold text-gray-500 text-[10px] sm:text-xs uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($laporan as $item)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        <td class="px-4 sm:px-6 py-3 sm:py-4 font-semibold text-gray-800 text-xs sm:text-sm">
                            {{ $item->jenisBencana->nama_bencana ?? '-' }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-700 text-xs sm:text-sm">
                            {{ $item->lokasi ?? '-' }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4">
                            <div class="flex flex-col items-center gap-1 text-[10px] sm:text-xs">
                                <span class="inline-flex items-center gap-1 px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full font-bold bg-red-100 text-red-700 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Meninggal: {{ $item->jumlah_korban_meninggal ?? 0 }}
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full font-bold bg-yellow-100 text-yellow-700 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                    Luka: {{ $item->jumlah_korban_luka ?? 0 }}
                                </span>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 text-center">
                            @if($item->status === 'verified')
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-[9px] sm:text-[10px] font-bold bg-green-100 text-green-700 whitespace-nowrap">
                                    TERVERIFIKASI
                                </span>
                            @elseif($item->status === 'pending')
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-[9px] sm:text-[10px] font-bold bg-yellow-100 text-yellow-700 whitespace-nowrap">
                                    MENUNGGU
                                </span>
                            @elseif($item->status === 'rejected')
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-[9px] sm:text-[10px] font-bold bg-red-100 text-red-700 whitespace-nowrap">
                                    DITOLAK
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-[9px] sm:text-[10px] font-bold bg-gray-100 text-gray-600 whitespace-nowrap">
                                    {{ strtoupper($item->status ?? '-') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-600 text-xs sm:text-sm whitespace-nowrap">
                            {{ $item->created_at?->timezone('Asia/Makassar')->format('d M Y') ?? '-' }}
                            <span class="text-[10px] text-gray-400 block">
                                {{ $item->created_at?->timezone('Asia/Makassar')->format('H:i') }} WITA
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium">Kamu belum membuat laporan.</p>
                                <a href="{{ route('petugas.laporan.create') }}"
                                   class="text-xs font-bold text-blue-600 hover:text-blue-800">
                                    Buat laporan pertama →
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ==================== PAGINATION ==================== --}}
        @if($laporan->hasPages())
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $laporan->links() }}
            </div>
        @endif

    </div>
</div>
@endsection