@extends('layouts.admin')

@section('header', 'Tambah Wilayah Rawan Bencana')

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

    {{-- ==================== HEADER — SEJAJAR ==================== --}}
    <div class="flex items-center gap-3 mb-4 sm:mb-6">
        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <div class="min-w-0">
            <h1 class="text-base sm:text-xl lg:text-2xl font-bold text-slate-900 truncate">
                Tambah Wilayah Rawan Bencana
            </h1>
            <p class="text-[11px] sm:text-sm text-slate-500 truncate">
                Daftarkan wilayah rawan bencana baru untuk SIPEKA
            </p>
        </div>
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
    <form action="{{ route('admin.wilayah.store') }}" method="POST" id="form-wilayah">
        @csrf

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
                            <select name="id_bencana" id="id_bencana"
                                class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                @foreach ($jenisBencana as $jb)
                                <option value="{{ $jb->id }}" data-nama="{{ $jb->nama_bencana }}" @selected(old('id_bencana')==$jb->id)>
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
                                <input type="text" name="kabupaten" id="input-kabupaten" value="{{ old('kabupaten') }}"
                                    placeholder="Otomatis terisi"
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-xs sm:text-sm text-slate-900 placeholder:text-slate-500">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                    Level <span class="text-rose-500">*</span>
                                </label>
                                <select name="level_rawan" id="level_rawan"
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900">
                                    <option value="rendah" @selected(old('level_rawan')==='rendah' )>Rendah</option>
                                    <option value="sedang" @selected(old('level_rawan')==='sedang' )>Sedang</option>
                                    <option value="tinggi" @selected(old('level_rawan')==='tinggi' )>Tinggi</option>
                                </select>
                            </div>
                        </div>

                        {{-- Sumber Data --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                                Sumber Data <span class="text-slate-400 normal-case tracking-normal font-normal hidden sm:inline">(opsional)</span>
                            </label>
                            <input type="text" name="sumber_data" value="{{ old('sumber_data') }}"
                                placeholder="Contoh: BPBD Kalsel 2024"
                                class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-sm text-slate-900 placeholder:text-slate-500">
                        </div>
                    </div>
                </div>

                {{-- CARD: PETA POLYGON --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Gambar Polygon di Peta</h2>
                            <p class="text-[11px] sm:text-xs text-slate-400">Klik titik demi titik, klik titik pertama untuk menutup</p>
                        </div>
                    </div>

                    {{-- Petunjuk --}}
                    <div class="flex items-start gap-2 bg-blue-50 border border-blue-200 text-blue-700 p-2.5 sm:p-3 mb-3 sm:mb-4 rounded-xl text-[11px] sm:text-xs">
                        <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>
                            <strong>Klik di peta</strong> untuk bikin titik polygon.
                            <strong>Klik titik pertama</strong> untuk menutup polygon.
                            Toolbar di kiri atas untuk <strong>gambar, edit, atau hapus</strong>.
                            Warna otomatis mengikuti <strong>jenis & level</strong>.
                        </span>
                    </div>

                    {{-- Peta tinggi responsive --}}
                    <div id="peta-polygon" class="rounded-xl overflow-hidden border border-slate-200 h-[300px] sm:h-[400px]" style="z-index: 0;"></div>
                </div>

                {{-- CARD: DATA POLYGON --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 lg:p-7">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-50 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Data Polygon (GeoJSON)</h2>
                            <p class="text-[11px] sm:text-xs text-slate-400">Terisi otomatis dari peta. Bisa diedit manual.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-900 uppercase tracking-wider mb-2">
                            GeoJSON Polygon <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="geom" id="input-geom" rows="6"
                            placeholder='Gambar polygon di peta, otomatis terisi di sini...'
                            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition text-xs sm:text-sm font-mono text-slate-900 placeholder:text-slate-500 leading-relaxed resize-y">{{ old('geom') }}</textarea>
                        <p class="text-[10px] sm:text-[11px] text-slate-400 mt-2">
                            GeoJSON ini juga bisa dipaste manual dari <span class="font-medium text-slate-600">geojson.io</span>.
                        </p>
                    </div>
                </div>

            </div>

            {{-- ============ RIGHT: SIDEBAR ============ --}}
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-6 space-y-4 sm:space-y-6">

                    {{-- CARD: INFO --}}
                    <div class="bg-slate-50/70 rounded-2xl border border-slate-100 p-4 sm:p-6">
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
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6">
                        <h3 class="text-xs font-semibold text-slate-900 uppercase tracking-wider mb-4">
                            Panduan Level
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-start gap-3">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                                <div>
                                    <p class="font-medium text-slate-900">Rendah</p>
                                    <p class="text-xs text-slate-500">Warna muda, risiko kecil.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-2 h-2 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                                <div>
                                    <p class="font-medium text-slate-900">Sedang</p>
                                    <p class="text-xs text-slate-500">Warna normal, perlu perhatian.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-2 h-2 rounded-full bg-rose-500 mt-1.5 shrink-0"></span>
                                <div>
                                    <p class="font-medium text-slate-900">Tinggi</p>
                                    <p class="text-xs text-slate-500">Warna gelap, prioritas utama.</p>
                                </div>
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
                            Simpan Wilayah
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

{{-- ==================== LEAFLET + LEAFLET.DRAW CSS ==================== --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mapEl = document.getElementById('peta-polygon');
    if (!mapEl) return;

    const inputGeom = document.getElementById('input-geom');
    const inputKabupaten = document.getElementById('input-kabupaten');
    const selectJenis = document.getElementById('id_bencana');
    const selectLevel = document.getElementById('level_rawan');

    const colorMap = {
        'banjir':    { rendah: '#93c5fd', sedang: '#3b82f6', tinggi: '#1e40af' },
        'karhutla':  { rendah: '#fca5a5', sedang: '#ef4444', tinggi: '#991b1b' },
        'longsor':   { rendah: '#d6b28c', sedang: '#a16207', tinggi: '#713f12' },
        'kebakaran': { rendah: '#fed7aa', sedang: '#f97316', tinggi: '#9a3412' },
    };

    function getPolygonColor() {
        const jenisKey = (selectJenis.options[selectJenis.selectedIndex].dataset.nama || '').toLowerCase().trim();
        const levelKey = (selectLevel.value || '').toLowerCase().trim();
        const normalizedJenis = jenisKey.replace(/\s+/g, '');

        for (const key in colorMap) {
            if (normalizedJenis.includes(key) || key.includes(normalizedJenis)) {
                return colorMap[key][levelKey] || '#6b7280';
            }
        }
        return '#6b7280';
    }

    const map = L.map('peta-polygon').setView([-3.0, 115.5], 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    fetch('{{ asset("geojson/indonesia-province-simple.json") }}')
        .then(res => res.json())
        .then(geojson => {
            const kalselFeature = geojson.features.find(f =>
                f.properties && f.properties.Propinsi &&
                f.properties.Propinsi.toUpperCase().includes('KALIMANTAN SELATAN')
            );

            if (!kalselFeature) return;

            const kalselLayer = L.geoJSON(kalselFeature, {
                style: {
                    color: '#1e40af',
                    weight: 2,
                    fillColor: '#3b82f6',
                    fillOpacity: 0.1,
                    dashArray: '4,4',
                    interactive: false
                }
            }).addTo(map);

            const kalselBounds = kalselLayer.getBounds();

            const worldRing = [
                [-180, -90],
                [180, -90],
                [180, 90],
                [-180, 90],
                [-180, -90]
            ];

            let kalselHoles = [];
            if (kalselFeature.geometry.type === 'Polygon') {
                kalselHoles = kalselFeature.geometry.coordinates;
            } else if (kalselFeature.geometry.type === 'MultiPolygon') {
                kalselFeature.geometry.coordinates.forEach(poly => {
                    poly.forEach(ring => kalselHoles.push(ring));
                });
            }

            L.geoJSON({
                type: 'Feature',
                geometry: {
                    type: 'Polygon',
                    coordinates: [worldRing, ...kalselHoles]
                },
                properties: {}
            }, {
                style: {
                    color: 'transparent',
                    weight: 0,
                    fillColor: '#0f172a',
                    fillOpacity: 0.55,
                    interactive: false
                }
            }).addTo(map);

            map.fitBounds(kalselBounds, { padding: [20, 20] });

            const FokusControl = L.Control.extend({
                options: { position: 'topright' },
                onAdd: function() {
                    const btn = L.DomUtil.create('button', 'leaflet-bar');
                    btn.innerHTML = '🎯';
                    btn.title = 'Kembali ke Kalimantan Selatan';
                    btn.style.cssText = `
                        width: 34px;
                        height: 34px;
                        background: white;
                        border: 2px solid rgba(0,0,0,0.2);
                        border-radius: 6px;
                        cursor: pointer;
                        font-size: 16px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        transition: all 0.2s ease;
                        box-shadow: 0 1px 4px rgba(0,0,0,0.15);
                    `;

                    btn.onmouseenter = function() {
                        btn.style.background = '#f0f4fb';
                        btn.style.transform = 'scale(1.05)';
                    };
                    btn.onmouseleave = function() {
                        btn.style.background = 'white';
                        btn.style.transform = 'scale(1)';
                    };

                    L.DomEvent.disableClickPropagation(btn);
                    L.DomEvent.on(btn, 'click', function(e) {
                        L.DomEvent.stopPropagation(e);
                        map.flyToBounds(kalselBounds, {
                            padding: [20, 20],
                            duration: 1.2
                        });
                    });

                    return btn;
                }
            });
            map.addControl(new FokusControl());
        })
        .catch(err => console.warn('Gagal load GeoJSON:', err));

    const drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    const drawControl = new L.Control.Draw({
        position: 'topleft',
        draw: {
            polygon: {
                allowIntersection: false,
                showArea: true,
                shapeOptions: {
                    color: getPolygonColor(),
                    fillColor: getPolygonColor(),
                    fillOpacity: 0.4,
                    weight: 2,
                }
            },
            polyline: false,
            rectangle: false,
            circle: false,
            circlemarker: false,
            marker: false,
        },
        edit: {
            featureGroup: drawnItems,
            remove: true,
        }
    });
    map.addControl(drawControl);

    const initialGeom = inputGeom.value.trim();
    if (initialGeom) {
        try {
            const parsed = JSON.parse(initialGeom);
            const layer = L.geoJSON(parsed, {
                style: {
                    color: getPolygonColor(),
                    fillColor: getPolygonColor(),
                    fillOpacity: 0.4,
                    weight: 2,
                }
            });
            drawnItems.addLayer(layer);
            map.fitBounds(layer.getBounds(), { padding: [20, 20] });
        } catch (e) {
            console.warn('GeoJSON awal tidak valid:', e);
        }
    }

    function updatePolygonColor() {
        const warna = getPolygonColor();
        drawnItems.eachLayer(function (layer) {
            if (layer.setStyle) {
                layer.setStyle({
                    color: warna,
                    fillColor: warna,
                });
            }
        });
    }

    selectJenis.addEventListener('change', updatePolygonColor);
    selectLevel.addEventListener('change', updatePolygonColor);

    map.on(L.Draw.Event.CREATED, function (e) {
        const layer = e.layer;
        const warna = getPolygonColor();

        layer.setStyle({
            color: warna,
            fillColor: warna,
            fillOpacity: 0.4,
            weight: 2,
        });

        drawnItems.addLayer(layer);
        updateGeomInput();

        const center = layer.getBounds().getCenter();
        reverseGeocodeKabupaten(center.lat, center.lng);
    });

    map.on(L.Draw.Event.EDITED, function (e) {
        updateGeomInput();
    });

    map.on(L.Draw.Event.DELETED, function (e) {
        updateGeomInput();
    });

    function updateGeomInput() {
        if (drawnItems.getLayers().length === 0) {
            inputGeom.value = '';
            return;
        }

        const layer = drawnItems.getLayers()[0];
        const geojson = layer.toGeoJSON();
        inputGeom.value = JSON.stringify(geojson.geometry);
    }

    let lastGeocodeKey = null;

    async function reverseGeocodeKabupaten(lat, lng) {
        const key = lat.toFixed(3) + ',' + lng.toFixed(3);
        if (key === lastGeocodeKey) return;
        lastGeocodeKey = key;

        try {
            const res = await fetch(
                'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng + '&zoom=10&addressdetails=1&accept-language=id'
            );
            const data = await res.json();

            if (data && data.address) {
                const addr = data.address;
                const kabupaten = addr.city || addr.town || addr.county || addr.state_district || addr.state || '';

                if (kabupaten && inputKabupaten.value.trim() === '') {
                    inputKabupaten.value = kabupaten;
                }
            }
        } catch (err) {
            console.warn('Reverse geocode gagal:', err);
        }
    }
});
</script>