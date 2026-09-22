@extends('layouts.admin')

@section('header', 'Edit Wilayah Rawan Bencana')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">

    {{-- ==================== BACK ==================== --}}
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors mb-3 sm:mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>

    @php
        $levelLabel = ucfirst($wilayahRawan->level_rawan ?? '-');
        $levelStyle = match(strtolower($wilayahRawan->level_rawan ?? '')) {
            'tinggi' => 'bg-rose-50 text-rose-700 border-rose-200',
            'sedang' => 'bg-amber-50 text-amber-700 border-amber-200',
            'rendah' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            default => 'bg-slate-50 text-slate-600 border-slate-200',
        };
        $levelDot = match(strtolower($wilayahRawan->level_rawan ?? '')) {
            'tinggi' => 'bg-rose-500',
            'sedang' => 'bg-amber-500',
            'rendah' => 'bg-emerald-500',
            default => 'bg-slate-400',
        };
    @endphp

    {{-- ==================== HEADER — SEJAJAR ==================== --}}
    <div class="flex items-center justify-between gap-3 mb-4 sm:mb-6">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div class="min-w-0">
                <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-slate-900 truncate">
                    Edit Wilayah Rawan Bencana
                </h1>
                <p class="text-[11px] sm:text-sm text-slate-500 truncate">
                    Perbarui informasi wilayah <span class="font-medium text-slate-700">{{ $wilayahRawan->kabupaten }}</span>
                </p>
            </div>
        </div>

        {{-- Badge level --}}
        <span class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-1.5 sm:py-2 rounded-full border text-[11px] sm:text-sm font-semibold {{ $levelStyle }} shrink-0">
            <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full {{ $levelDot }}"></span>
            {{ $levelLabel }}
        </span>
    </div>

    {{-- ==================== ERROR ==================== --}}
    @if ($errors->any())
    <div class="flex items-start gap-3 bg-rose-50 border border-rose-200 text-rose-700 p-3 sm:p-4 mb-4 sm:mb-6 rounded-2xl">
        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="text-sm font-semibold mb-1">Ada beberapa kesalahan:</p>
            <ul class="list-disc list-inside text-xs sm:text-sm space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- ==================== FORM ==================== --}}
    <form action="{{ route('admin.wilayah.update', $wilayahRawan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

            {{-- ============ LEFT: FORM ============ --}}
            <div class="lg:col-span-2 space-y-4 sm:space-y-6">

                {{-- CARD: INFORMASI WILAYAH --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Informasi Wilayah</h2>
                            <p class="text-[11px] sm:text-xs text-slate-400">Data dasar wilayah rawan</p>
                        </div>
                    </div>

                    <div class="space-y-4 sm:space-y-5">
                        {{-- Jenis Bencana --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Jenis Bencana <span class="text-rose-500">*</span>
                            </label>
                            <select name="id_bencana"
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                @foreach ($jenisBencana as $jb)
                                    <option value="{{ $jb->id }}" @selected(old('id_bencana', $wilayahRawan->id_bencana) == $jb->id)>
                                        {{ $jb->nama_bencana }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Grid 2 kolom: Kabupaten + Level --}}
                        <div class="grid grid-cols-2 gap-3 sm:gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Kabupaten/Kota <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="kabupaten" value="{{ old('kabupaten', $wilayahRawan->kabupaten) }}"
                                       placeholder="Kabupaten Banjar"
                                       class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-xs sm:text-sm text-slate-900 placeholder:text-slate-500">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Level <span class="text-rose-500">*</span>
                                </label>
                                <select name="level_rawan"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                    <option value="rendah" @selected(old('level_rawan', $wilayahRawan->level_rawan) === 'rendah')>Rendah</option>
                                    <option value="sedang" @selected(old('level_rawan', $wilayahRawan->level_rawan) === 'sedang')>Sedang</option>
                                    <option value="tinggi" @selected(old('level_rawan', $wilayahRawan->level_rawan) === 'tinggi')>Tinggi</option>
                                </select>
                            </div>
                        </div>

                        {{-- Sumber Data --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Sumber Data <span class="text-slate-400 normal-case tracking-normal font-normal hidden sm:inline">(opsional)</span>
                            </label>
                            <input type="text" name="sumber_data" value="{{ old('sumber_data', $wilayahRawan->sumber_data) }}"
                                   placeholder="Contoh: BPBD Kalsel 2024"
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-500">
                        </div>
                    </div>
                </div>

                {{-- CARD: DATA POLYGON --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Data Polygon</h2>
                            <p class="text-[11px] sm:text-xs text-slate-400">Format GeoJSON untuk area rawan</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                            GeoJSON Polygon <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="geom" rows="6 sm:rows-8"
                                  placeholder='{"type":"Polygon","coordinates":[[[114.59,-3.31],[114.60,-3.32],[114.58,-3.33],[114.59,-3.31]]]}'
                                  class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-xs sm:text-sm font-mono text-slate-900 placeholder:text-slate-500 leading-relaxed resize-y">{{ old('geom', json_encode($wilayahRawan->geom)) }}</textarea>
                        <p class="text-[10px] sm:text-[11px] text-slate-400 mt-2">
                            Salin GeoJSON Polygon dari <span class="font-medium text-slate-600">geojson.io</span> atau tool pemetaan lainnya.
                        </p>
                    </div>
                </div>

            </div>

            {{-- ============ RIGHT: SIDEBAR ============ --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-6 space-y-4 sm:space-y-6">

                    {{-- CARD: PREVIEW WILAYAH --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-blue-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-900 truncate max-w-full">{{ $wilayahRawan->kabupaten }}</p>
                            <p class="text-xs text-slate-500 truncate max-w-full mb-3">
                                {{ $wilayahRawan->jenisBencana->nama_bencana ?? '-' }}
                            </p>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-xs font-medium {{ $levelStyle }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $levelDot }}"></span>
                                {{ $levelLabel }}
                            </span>
                        </div>
                    </div>

                    {{-- CARD: INFO --}}
                    <div class="bg-slate-50/70 rounded-2xl border border-slate-100 p-4 sm:p-6">
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
                                    Perubahan data polygon akan langsung memperbarui tampilan peta wilayah rawan.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CARD: AKSI --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl text-sm font-semibold transition-colors mb-2 sm:mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.wilayah.index') }}"
                           class="w-full inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
@endsection