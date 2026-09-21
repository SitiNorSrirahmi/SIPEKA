<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">

    {{-- ==================== BACK ==================== --}}
    <a href="{{ route('berita.index') }}"
        class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors mb-6 group">
        <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Berita
    </a>

    {{-- ==================== HEADER ==================== --}}
    <div class="mb-6">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight leading-tight mb-4">
            {{ $berita->judul }}
        </h1>

        {{-- Meta info --}}
        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500">
            @if ($berita->penulis)
            <span class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ $berita->penulis->name }}
            </span>
            @endif

            <span class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $berita->created_at?->timezone('Asia/Makassar')->format('d M Y') }}
            </span>

            @if ($berita->created_at)
            <span class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $berita->created_at?->timezone('Asia/Makassar')->format('H:i') }} WITA
            </span>
            @endif
        </div>
    </div>

    {{-- ==================== GAMBAR UTAMA ==================== --}}
    @if ($berita->gambar)
    <div class="rounded-2xl overflow-hidden border border-slate-200 mb-8">
        <img src="{{ Storage::url($berita->gambar) }}"
            alt="{{ $berita->judul }}"
            class="w-full h-auto object-cover max-h-[500px]">
    </div>
    @endif

    {{-- ==================== ISI BERITA ==================== --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-10">
        <article class="prose prose-slate max-w-none
                        prose-headings:font-bold prose-headings:text-slate-900
                        prose-p:text-slate-700 prose-p:leading-relaxed prose-p:mb-4
                        prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-slate-900
                        prose-ul:my-4 prose-ol:my-4
                        prose-li:text-slate-700 prose-li:my-1
                        prose-blockquote:border-l-4 prose-blockquote:border-blue-500
                        prose-blockquote:bg-blue-50 prose-blockquote:py-2 prose-blockquote:px-4
                        prose-blockquote:rounded-r-lg prose-blockquote:not-italic
                        prose-img:rounded-xl prose-img:my-6">
            {!! nl2br(e($berita->konten)) !!}
        </article>
    </div>

</div>