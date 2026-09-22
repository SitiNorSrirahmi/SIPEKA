@extends('layouts.admin')

@section('header', 'Kelola Berita')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

    {{-- ==================== HEADER ==================== --}}
    <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            <div class="min-w-0">
                <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-slate-900 truncate">Kelola Berita</h1>
                <p class="text-[11px] sm:text-sm text-slate-500 truncate">Kelola publikasi berita dan informasi SIPEKA</p>
            </div>
        </div>
        <a href="{{ route('admin.berita.create') }}"
           class="inline-flex items-center justify-center gap-1.5 sm:gap-2 bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 sm:py-2.5 rounded-lg sm:rounded-xl text-[11px] sm:text-xs font-bold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 shrink-0">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Berita
        </a>
    </div>

    {{-- ==================== SUCCESS ==================== --}}
    @if (session('success'))
    <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 sm:p-4 mb-4 sm:mb-6 rounded-2xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="text-xs sm:text-sm font-medium">{{ session('success') }}</p>
    </div>
    @endif

    {{-- ==================== TABLE CARD ==================== --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">

        {{-- Table Header Bar --}}
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-xs font-semibold text-slate-900 uppercase tracking-wider">Daftar Berita</h2>
            <span class="text-[10px] sm:text-xs text-slate-400">
                Total <span class="font-semibold text-slate-700">{{ $berita->total() }}</span>
            </span>
        </div>

        {{-- ============ Desktop: tabel ============ --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider px-6 py-3 w-24">Gambar</th>
                        <th class="text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider px-6 py-3">Judul</th>
                        <th class="text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider px-6 py-3">Penulis</th>
                        <th class="text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider px-6 py-3">Status</th>
                        <th class="text-right text-[11px] font-semibold text-slate-500 uppercase tracking-wider px-6 py-3 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($berita as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}"
                                     class="w-14 h-14 object-cover rounded-xl border border-slate-100">
                            @else
                                <div class="w-14 h-14 rounded-xl bg-slate-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-slate-900 line-clamp-2 max-w-md">
                                {{ $item->judul }}
                            </p>
                        </td>

                        <td class="px-6 py-4">
                            <p class="text-sm text-slate-600">{{ $item->penulis->name ?? '-' }}</p>
                        </td>

                        <td class="px-6 py-4">
                            @php $isPublished = $item->status === 'published'; @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-semibold
                                {{ $isPublished
                                    ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                                    : 'bg-slate-50 text-slate-600 border-slate-200' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $isPublished ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('admin.berita.edit', $item->id) }}"
                                   class="w-9 h-9 rounded-lg flex items-center justify-center bg-blue-50 border border-blue-200 text-blue-600 hover:bg-blue-100 hover:border-blue-300 transition-colors"
                                   title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST"
                                      class="inline" onsubmit="return confirm('Yakin hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-9 h-9 rounded-lg flex items-center justify-center bg-rose-50 border border-rose-200 text-rose-600 hover:bg-rose-100 hover:border-rose-300 transition-colors"
                                            title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-slate-700 mb-1">Belum ada berita</p>
                                <p class="text-xs text-slate-400 mb-4">Mulai tambahkan berita pertama Anda</p>
                                <a href="{{ route('admin.berita.create') }}"
                                   class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-700">
                                    + Tambah Berita
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ============ Mobile: card list (tombol di kanan) ============ --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse ($berita as $item)
                @php $isPublished = $item->status === 'published'; @endphp
                <div class="p-3 sm:p-4 hover:bg-slate-50/50 transition-colors">
                    <div class="flex items-center gap-3">
                        {{-- Gambar --}}
                        <div class="shrink-0">
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}"
                                     class="w-14 h-14 object-cover rounded-xl border border-slate-100">
                            @else
                                <div class="w-14 h-14 rounded-xl bg-slate-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info (kiri) --}}
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-1.5 mb-0.5">
                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full border text-[8px] font-bold shrink-0
                                    {{ $isPublished
                                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                                        : 'bg-slate-50 text-slate-600 border-slate-200' }}">
                                    <span class="w-1 h-1 rounded-full {{ $isPublished ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    {{ strtoupper($item->status) }}
                                </span>
                            </div>
                            <p class="font-bold text-slate-900 text-sm line-clamp-2 leading-snug">
                                {{ $item->judul }}
                            </p>
                            <p class="text-[10px] text-slate-500 mt-0.5 truncate">
                                ✍️ {{ $item->penulis->name ?? '-' }}
                            </p>
                        </div>

                        {{-- Tombol (kanan) — stack vertical --}}
                        <div class="shrink-0 flex flex-col gap-1.5">
                            <a href="{{ route('admin.berita.edit', $item->id) }}"
                               class="inline-flex items-center justify-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-[10px] font-bold transition whitespace-nowrap"
                               title="Edit">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-1 bg-rose-50 hover:bg-rose-100 text-rose-700 px-3 py-1.5 rounded-lg text-[10px] font-bold transition whitespace-nowrap"
                                        title="Hapus">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-700 mb-1">Belum ada berita</p>
                        <p class="text-xs text-slate-400 mb-4">Mulai tambahkan berita pertama Anda</p>
                        <a href="{{ route('admin.berita.create') }}"
                           class="inline-flex items-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-700">
                            + Tambah Berita
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($berita->hasPages())
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-t border-slate-100">
                {{ $berita->links() }}
            </div>
        @endif
    </div>

</div>
@endsection