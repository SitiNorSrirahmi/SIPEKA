@extends('layouts.admin')

@section('header', 'Edit Berita')

@section('content')
<div class="max-w-6xl mx-auto px-2">

    {{-- ==================== BACK ==================== --}}
    <a href="{{ url()->previous() }}"
        class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>

    {{-- ==================== HEADER ==================== --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight leading-tight mb-1.5">
                Edit Berita
            </h1>
            <p class="text-sm text-slate-500">
                Perbarui informasi dan konten berita
            </p>
        </div>

        @php
        $isPublished = $berita->status === 'published';
        @endphp
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-semibold
                {{ $isPublished
                    ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                    : 'bg-slate-50 text-slate-600 border-slate-200' }}">
            <span class="w-2 h-2 rounded-full {{ $isPublished ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
            {{ ucfirst($berita->status) }}
        </span>
    </div>

    {{-- ==================== ERROR ==================== --}}
    @if ($errors->any())
    <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 p-4 mb-6 rounded-2xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="text-sm font-semibold mb-1">Ada beberapa kesalahan:</p>
            <ul class="list-disc list-inside text-sm space-y-0.5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- ==================== FORM WRAPPER ==================== --}}
    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ============ LEFT: FORM ============ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- CARD: KONTEN BERITA --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Konten Berita</h2>
                            <p class="text-xs text-slate-400">Judul dan isi berita</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- Judul --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Judul <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
                                placeholder="Masukkan judul berita"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
                        </div>

                        {{-- Konten --}}
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                                Konten <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="konten" rows="10"
                                placeholder="Tulis isi berita di sini..."
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-400 leading-relaxed resize-y">{{ old('konten', $berita->konten) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- CARD: PENGATURAN --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Pengaturan</h2>
                            <p class="text-xs text-slate-400">Status publikasi berita</p>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                            Status Publikasi <span class="text-rose-500">*</span>
                        </label>
                        <select name="status"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                            <option value="draft" @selected(old('status', $berita->status) === 'draft')>Draft</option>
                            <option value="published" @selected(old('status', $berita->status) === 'published')>Published</option>
                        </select>
                    </div>
                </div>

            </div>

            {{-- ============ RIGHT: SIDEBAR ============ --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-6 space-y-6">

                    {{-- CARD: GAMBAR --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-slate-900">Gambar Utama</h2>
                                <p class="text-xs text-slate-400">Thumbnail berita</p>
                            </div>
                        </div>

                        {{-- Preview Gambar --}}
                        <div class="rounded-xl overflow-hidden bg-slate-100 aspect-video mb-4">
                            @if ($berita->gambar)
                            <img src="{{ Storage::url($berita->gambar) }}"
                                class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex flex-col items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center mb-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-xs text-slate-400">Belum ada gambar</p>
                            </div>
                            @endif
                        </div>

                        {{-- Input File --}}
                        <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">
                            Ganti Gambar
                        </label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 file:cursor-pointer cursor-pointer border border-slate-200 rounded-xl bg-slate-50/50 p-1.5 transition">
                        <p class="text-[11px] text-slate-400 mt-2">Kosongkan jika tidak ingin mengubah</p>
                    </div>

                    {{-- CARD: INFO --}}
                    <div class="bg-slate-50/70 rounded-2xl border border-slate-100 p-6">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-semibold text-slate-900 mb-1">Perhatian</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Status "Published" akan menampilkan berita ke halaman publik. Pastikan konten sudah final.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD: AKSI --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-colors mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.berita.index') }}"
                            class="w-full inline-flex items-center justify-center px-6 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
@endsection