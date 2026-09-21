@extends('layouts.admin')

@section('header', 'Tambah Wilayah Rawan Bencana')

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
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight leading-tight mb-1.5">
            Tambah Wilayah Rawan Bencana
        </h1>
        <p class="text-sm text-slate-500">
            Daftarkan wilayah rawan bencana baru untuk SIPEKA
        </p>
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
    <form action="{{ route('admin.wilayah.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ============ LEFT: FORM ============ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- CARD: INFORMASI WILAYAH --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Informasi Wilayah</h2>
                            <p class="text-xs text-slate-400">Data dasar wilayah rawan</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- Jenis Bencana --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Jenis Bencana <span class="text-rose-500">*</span>
                            </label>
                            <select name="id_bencana"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                @foreach ($jenisBencana as $jb)
                                <option value="{{ $jb->id }}" @selected(old('id_bencana')==$jb->id)>
                                    {{ $jb->nama_bencana }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Grid 2 kolom: Kabupaten + Level --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Kabupaten/Kota <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="kabupaten" value="{{ old('kabupaten') }}"
                                    placeholder="Contoh: Kabupaten Banjar"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-500">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Level Kerawanan <span class="text-rose-500">*</span>
                                </label>
                                <select name="level_rawan"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                    <option value="rendah" @selected(old('level_rawan')==='rendah' )>Rendah</option>
                                    <option value="sedang" @selected(old('level_rawan')==='sedang' )>Sedang</option>
                                    <option value="tinggi" @selected(old('level_rawan')==='tinggi' )>Tinggi</option>
                                </select>
                            </div>
                        </div>

                        {{-- Sumber Data --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Sumber Data <span class="text-slate-400 normal-case tracking-normal font-normal">(opsional)</span>
                            </label>
                            <input type="text" name="sumber_data" value="{{ old('sumber_data') }}"
                                placeholder="Contoh: BPBD Kalsel 2024"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-500">
                        </div>
                    </div>
                </div>

                {{-- CARD: DATA POLYGON --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Data Polygon</h2>
                            <p class="text-xs text-slate-400">Format GeoJSON untuk area rawan</p>
                        </div>
                    </div>

                    {{-- Geom --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                            GeoJSON Polygon <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="geom" rows="8"
                            placeholder='{"type":"Polygon","coordinates":[[[114.59,-3.31],[114.60,-3.32],[114.58,-3.33],[114.59,-3.31]]]}'
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm font-mono text-slate-900 placeholder:text-slate-500 leading-relaxed resize-y">{{ old('geom') }}</textarea>
                        <p class="text-[11px] text-slate-400 mt-2">
                            Salin GeoJSON Polygon dari <span class="font-medium text-slate-600">geojson.io</span> atau tool pemetaan lainnya.
                        </p>
                    </div>
                </div>

            </div>

            {{-- ============ RIGHT: SIDEBAR ============ --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-6 space-y-6">

                    {{-- CARD: INFO --}}
                    <div class="bg-slate-50/70 rounded-2xl border border-slate-100 p-6">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-semibold text-slate-900 mb-1">Informasi</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">
                                    Data polygon digunakan untuk menampilkan area rawan pada peta interaktif SIPEKA.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD: LEVEL KERAWANAN --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <h3 class="text-xs font-semibold text-slate-900 uppercase tracking-wider mb-4">
                            Panduan Level
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-start gap-3">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                                <div>
                                    <p class="font-medium text-slate-900">Rendah</p>
                                    <p class="text-xs text-slate-500">Risiko kecil, pengawasan berkala.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-2 h-2 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                                <div>
                                    <p class="font-medium text-slate-900">Sedang</p>
                                    <p class="text-xs text-slate-500">Perlu perhatian & mitigasi rutin.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-2 h-2 rounded-full bg-rose-500 mt-1.5 shrink-0"></span>
                                <div>
                                    <p class="font-medium text-slate-900">Tinggi</p>
                                    <p class="text-xs text-slate-500">Prioritas utama, rawan terjadi bencana.</p>
                                </div>
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
                            Simpan Wilayah
                        </button>
                        <a href="{{ route('admin.wilayah.index') }}"
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