<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10 relative">
    
    {{-- Background Ornamen (Biar Mewah) --}}
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-blue-50/50 to-transparent -z-10 pointer-events-none"></div>

    {{-- GRID UTAMA: 8 Kolom Kiri, 4 Kolom Kanan --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
        
        {{-- KIRI: BERITA UTAMA (8/12) --}}
        <div class="lg:col-span-8">
            {{-- HEADER MEWAH --}}
            <div class="mb-8 relative">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-[1.15] mb-6">
                    {{ $berita->judul }}
                </h1>

                {{-- Meta info --}}
                <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-xs sm:text-sm text-slate-500 border-b border-slate-200 pb-6">
                    @if ($berita->penulis)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold shadow-md">
                            {{ substr($berita->penulis->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-sm">{{ $berita->penulis->name }}</p>
                            <p class="text-[10px] text-slate-400 uppercase tracking-wider">Penulis</p>
                        </div>
                    </div>
                    <div class="w-px h-8 bg-slate-200 hidden sm:block"></div>
                    @endif
                    
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        <span class="font-medium">{{ $berita->created_at?->timezone('Asia/Makassar')->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="font-medium">{{ $berita->created_at?->timezone('Asia/Makassar')->format('H:i') }} WITA</span>
                    </div>
                </div>
            </div>

            {{-- GAMBAR UTAMA MEWAH --}}
            @if ($berita->getFirstMediaUrl('gambar'))
            <div class="rounded-3xl overflow-hidden border-4 border-white shadow-2xl mb-10 group relative">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                <img src="{{ $berita->getFirstMediaUrl('gambar') }}" alt="{{ $berita->judul }}" class="w-full h-auto object-cover max-h-[350px] sm:max-h-[450px] lg:max-h-[550px] group-hover:scale-[1.02] transition-transform duration-700">
            </div>
            @endif

            {{-- ISI BERITA (RATA KIRI-KANAN & GLASSMORPHISM) --}}
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 sm:p-10 lg:p-12 relative z-10">
                <article class="prose prose-sm sm:prose-base lg:prose-lg prose-slate max-w-none
                                text-justify /* <--- INI YANG BIKIN RATA KIRI-KANAN */
                                prose-headings:font-bold prose-headings:text-slate-900 prose-headings:text-left
                                prose-p:text-slate-700 prose-p:leading-loose prose-p:mb-6 prose-p:indent-8
                                prose-a:text-blue-600 prose-a:font-semibold prose-a:no-underline hover:prose-a:underline
                                prose-strong:text-slate-900
                                prose-ul:my-6 prose-ol:my-6
                                prose-li:text-slate-700 prose-li:my-2
                                prose-blockquote:border-l-4 prose-blockquote:border-blue-500
                                prose-blockquote:bg-blue-50/50 prose-blockquote:py-4 prose-blockquote:px-6
                                prose-blockquote:rounded-r-2xl prose-blockquote:not-italic prose-blockquote:text-slate-800 prose-blockquote:font-medium prose-blockquote:shadow-sm
                                prose-img:rounded-2xl prose-img:my-10 prose-img:shadow-lg prose-img:border prose-img:border-slate-100">
                    {!! nl2br(e($berita->konten)) !!}
                </article>
            </div>
        </div>

        {{-- KANAN: SIDEBAR REKOMENDASI (4/12) --}}
        <div class="lg:col-span-4">
            <div class="sticky top-28">
                
                {{-- Kotak Sidebar --}}
                <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/40 overflow-hidden">
                    
                    {{-- Judul Sidebar --}}
                    <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-500 shadow-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                        </div>
                        <h2 class="font-extrabold text-base text-slate-900 tracking-tight">Berita Lainnya</h2>
                    </div>

                    {{-- List Berita --}}
                    <div class="p-3">
                        @if(isset($beritaLain) && $beritaLain->count() > 0)
                            @foreach($beritaLain as $item)
                                {{-- ITEM LIST HORIZONTAL MEWAH --}}
                                <a href="{{ route('berita.show', $item->id) }}" class="flex items-start gap-4 p-3 rounded-2xl hover:bg-slate-50 transition-all duration-300 group border border-transparent hover:border-slate-100 hover:shadow-sm">
                                    
                                    {{-- Gambar Kiri --}}
                                    <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 shrink-0 shadow-sm relative">
                                        @if ($item->getFirstMediaUrl('gambar'))
                                            <img src="{{ $item->getFirstMediaUrl('gambar') }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                                <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 ring-1 ring-inset ring-black/5 rounded-xl pointer-events-none"></div>
                                    </div>
                                    
                                    {{-- Teks Kanan --}}
                                    <div class="min-w-0 flex-1 py-1">
                                        <h3 class="font-bold text-[13px] text-slate-800 group-hover:text-blue-600 transition-colors leading-snug line-clamp-2 mb-1.5">
                                            {{ $item->judul }}
                                        </h3>
                                        <p class="text-[10px] text-slate-400 font-medium flex items-center gap-1.5 uppercase tracking-wider">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            {{ $item->created_at?->timezone('Asia/Makassar')->format('d M Y') }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="text-center text-xs text-slate-400 py-8">
                                Belum ada berita lainnya.
                            </div>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</div>