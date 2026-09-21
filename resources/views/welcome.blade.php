@extends('layouts.publik')

@section('content')

    {{-- ==================== HERO SECTION ==================== --}}
    <section class="pt-8 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            {{-- Hero Card — Navy Polos --}}
            <div class="relative isolate overflow-hidden rounded-3xl shadow-xl bg-gradient-to-br from-[#0A1A3A] via-[#13294b] to-[#0D2440]">

                {{-- Dekorasi blur --}}
                <div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl -mt-32"></div>
                <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-yellow-400/10 rounded-full blur-3xl -mb-24"></div>

                {{-- KONTEN --}}
                <div class="relative z-10 p-8 sm:p-12 lg:p-16 lg:py-20">
                    <div class="max-w-2xl">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight mb-5">
                            Sistem Informasi<br>
                            Pemetaan Bencana<br>
                            <span class="text-yellow-400">Kalimantan Selatan</span>
                        </h1>

                        <p class="text-sm sm:text-base text-blue-100/90 leading-relaxed mb-8 max-w-xl">
                            Pantau informasi bencana secara cepat dan akurat melalui SIPEKA.
                            Dukung bersama upaya mitigasi dan keselamatan masyarakat Kalimantan Selatan.
                        </p>

                        {{-- Search --}}
                        <form action="{{ route('pencarian.index') }}" method="GET">
                            <div class="flex flex-col sm:flex-row gap-2 max-w-xl">
                                <div class="relative flex-1">
                                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <input type="text" name="keyword" required
                                           placeholder="Cari lokasi atau jenis bencana..."
                                           class="w-full pl-11 pr-4 py-3.5 rounded-xl border-0 bg-white text-sm text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-yellow-400 outline-none transition">
                                </div>
                                <button type="submit"
                                        class="inline-flex items-center justify-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white px-7 py-3.5 rounded-xl text-sm font-bold transition whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ==================== 4 CARD STATISTIK ==================== --}}
    <section class="pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </div>
                        <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold">Total Kejadian</p>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800">{{ $totalKejadian }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold">Korban Meninggal</p>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800">{{ $totalKorbanMeninggal }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-yellow-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold">Korban Luka</p>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800">{{ $totalKorbanLuka }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold">Kerugian</p>
                    </div>
                    <p class="text-xl font-extrabold text-slate-800 truncate"
                       title="Rp{{ number_format($totalKerugian ?? 0, 0, ',', '.') }}">
                        Rp{{ number_format($totalKerugian ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== 2 KOLOM: WILAYAH (2/3) + BERITA (1/3) ==================== --}}
    <section class="pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="font-bold text-sm text-slate-900 flex items-center gap-2">
                            <span class="text-red-500">📍</span>
                            Wilayah Rawan
                        </h2>
                        <a href="{{ route('wilayahrawan.index') }}"
                           class="text-[11px] font-bold text-blue-600 hover:text-blue-800">
                            Lihat semua →
                        </a>
                    </div>
                    <div id="peta-wilayah-mini" class="flex-1" style="min-height: 420px; z-index: 0;"></div>
                </div>

                <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="font-bold text-sm text-slate-900 flex items-center gap-2">
                            <span class="text-blue-600">📰</span>
                            Berita Terbaru
                        </h2>
                        <a href="{{ route('berita.index') }}"
                           class="text-[11px] font-bold text-blue-600 hover:text-blue-800">
                            Lihat semua →
                        </a>
                    </div>
                    <div class="flex-1 divide-y divide-slate-100">
                        @forelse ($beritaTerbaru as $item)
                            <a href="{{ route('berita.show', $item->id) }}"
                               class="flex items-start gap-3 p-4 hover:bg-blue-50/40 transition group">
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 shrink-0">
                                    @if ($item->gambar)
                                        <img src="{{ Storage::url($item->gambar) }}"
                                             alt="{{ $item->judul }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                            <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-bold text-slate-800 text-xs leading-snug line-clamp-2 mb-1">
                                        {{ $item->judul }}
                                    </h3>
                                    <p class="text-[10px] text-slate-400">
                                        {{ $item->created_at?->timezone('Asia/Makassar')->format('d M Y') }}
                                        · {{ $item->created_at?->timezone('Asia/Makassar')->format('H:i') }} WITA
                                    </p>
                                </div>
                            </a>
                        @empty
                            <div class="p-6 text-center text-xs text-slate-400">
                                Belum ada berita.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

{{-- ==================== LEAFLET CSS & JS ==================== --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script src="https://unpkg.com/d3@7"></script>
<script src="https://unpkg.com/topojson-client@3"></script>
<script src="https://unpkg.com/leaflet-globe-minimap@2.0.1/dist/leaflet-globe-minimap.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let kalselFeatureCache = null;

    async function loadKalselGeoJSON() {
        if (kalselFeatureCache) return kalselFeatureCache;
        try {
            const res = await fetch('{{ asset("geojson/indonesia-province-simple.json") }}');
            const geojson = await res.json();
            const kalselFeature = geojson.features.find(f =>
                f.properties && f.properties.Propinsi &&
                f.properties.Propinsi.toUpperCase().includes('KALIMANTAN SELATAN')
            );
            kalselFeatureCache = kalselFeature;
            return kalselFeature;
        } catch (err) {
            console.warn('Gagal load GeoJSON:', err);
            return null;
        }
    }

    (async function() {
        const el = document.getElementById('peta-wilayah-mini');
        if (!el) return;

        const map = L.map('peta-wilayah-mini').setView([-3.0, 115.5], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OSM'
        }).addTo(map);

        const kalselFeature = await loadKalselGeoJSON();

        if (kalselFeature) {
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

            const worldRing = [[-180, -90], [180, -90], [180, 90], [-180, 90], [-180, -90]];
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
                geometry: { type: 'Polygon', coordinates: [worldRing, ...kalselHoles] },
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

            map.fitBounds(kalselLayer.getBounds(), { padding: [20, 20] });
        }

        const colorMap = {
            'banjir': { rendah: '#93c5fd', sedang: '#3b82f6', tinggi: '#1e40af' },
            'karhutla': { rendah: '#fca5a5', sedang: '#ef4444', tinggi: '#991b1b' },
            'longsor': { rendah: '#d6b28c', sedang: '#a16207', tinggi: '#713f12' },
            'kebakaran': { rendah: '#fed7aa', sedang: '#f97316', tinggi: '#9a3412' },
        };

        function getColor(jenis, level) {
            const jenisKey = (jenis || '').toLowerCase().trim();
            const levelKey = (level || '').toLowerCase().trim();
            const normalizedJenis = jenisKey.replace(/\s+/g, '');

            for (const key in colorMap) {
                if (normalizedJenis.includes(key) || key.includes(normalizedJenis)) {
                    return colorMap[key][levelKey] || '#6b7280';
                }
            }
            return '#6b7280';
        }

        try {
            const res = await fetch('/api/wilayah-rawan');
            const data = await res.json();

            data.forEach(function (item) {
                if (!item.geom || !item.geom.coordinates) return;
                const warna = getColor(item.jenis_bencana, item.level_rawan);

                if (item.geom.type === 'Polygon' || item.geom.type === 'MultiPolygon') {
                    L.geoJSON(item.geom, {
                        style: {
                            color: warna,
                            fillColor: warna,
                            fillOpacity: 0.55,
                            weight: 2,
                        }
                    }).addTo(map).bindPopup(
                        '<div style="font-family: Plus Jakarta Sans, sans-serif; min-width: 140px;">' +
                            '<p style="font-weight:700; font-size:12px; margin:0 0 4px 0;">' + (item.jenis_bencana || '-') + '</p>' +
                            '<p style="font-size:11px; color:#475569; margin:0;">' + (item.kabupaten || '-') + ' · ' + (item.level_rawan || '-') + '</p>' +
                        '</div>'
                    );
                }
            });
        } catch (err) {
            console.warn('Gagal load wilayah rawan:', err);
        }
    })();

});
</script>