<div class="max-w-6xl mx-auto px-4 sm:px-6 py-6 sm:py-8">

    {{-- ==================== FILTER ==================== --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-3 sm:p-4 mb-4 sm:mb-6">
        <form method="GET" class="flex flex-row gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari berita..."
                class="flex-1 px-3 sm:px-4 py-2.5 rounded-lg border border-slate-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            <button type="submit"
                class="inline-flex items-center justify-center gap-1.5 sm:gap-2 bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-5 py-2.5 rounded-lg text-sm font-semibold transition shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span class="hidden sm:inline">Cari</span>
            </button>
        </form>
    </div>

    {{-- ==================== GRID BERITA ==================== --}}
    @if ($berita->count() > 0)
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
        @foreach ($berita as $item)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md overflow-hidden transition-all duration-300 hover:-translate-y-1 flex flex-col">

            {{-- GAMBAR --}}
            <a href="{{ route('berita.show', $item->id) }}" class="block relative aspect-video bg-slate-100 overflow-hidden group">
                @if ($item->gambar)
                <img src="{{ Storage::url($item->gambar) }}"
                    alt="{{ $item->judul }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full flex items-center justify-center bg-slate-100">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif
            </a>

            {{-- ISI --}}
            <div class="p-3 sm:p-4 flex flex-col flex-1">
                {{-- JUDUL --}}
                <h3 class="font-bold text-slate-900 text-xs sm:text-sm leading-snug line-clamp-2 min-h-[2rem] sm:min-h-[2.5rem]">
                    <a href="{{ route('berita.show', $item->id) }}" class="hover:text-blue-600 transition">
                        {{ $item->judul }}
                    </a>
                </h3>

                {{-- TANGGAL --}}
                <p class="text-[10px] sm:text-[11px] text-slate-400 mt-1.5">
                    {{ $item->created_at?->timezone('Asia/Makassar')->format('d M Y') }}
                </p>

                {{-- TOMBOL DETAIL --}}
                <div class="mt-auto pt-3">
                    <a href="{{ route('berita.show', $item->id) }}"
                        class="w-full inline-flex items-center justify-center gap-1 sm:gap-1.5 bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-[10px] sm:text-xs font-bold transition">
                        Detail
                        <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    @if ($berita->hasPages())
    <div class="mt-4 sm:mt-6">
        {{ $berita->links() }}
    </div>
    @endif
    @else
    {{-- EMPTY STATE --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 sm:p-16 text-center">
        <div class="flex flex-col items-center gap-3">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            <p class="text-sm font-semibold text-slate-600">Belum ada berita</p>
            <p class="text-xs text-slate-400">Berita yang dipublikasikan akan muncul di sini.</p>
        </div>
    </div>
    @endif

</div>