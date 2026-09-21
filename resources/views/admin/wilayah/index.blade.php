@extends('layouts.admin')

@section('header', 'Kelola Wilayah Rawan Bencana')

@section('content')
    <div class="max-w-6xl mx-auto">

        {{-- ==================== HEADER ==================== --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Wilayah Rawan Bencana
                </h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data wilayah rawan bencana di Kalimantan Selatan</p>
            </div>
            <a href="{{ route('admin.wilayah.create') }}"
               class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Wilayah
            </a>
        </div>

        {{-- ==================== SUCCESS ==================== --}}
        @if (session('success'))
            <div class="flex items-start gap-3 bg-green-50 border border-green-200 text-green-700 p-4 mb-5 rounded-xl">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm">{{ session('success') }}</span>
            </div>
        @endif

        {{-- ==================== PETA ==================== --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <h2 class="font-bold text-base text-gray-800 flex items-center gap-2">
                    <span class="text-blue-600">🗺️</span>
                    Peta Sebaran Wilayah Rawan
                </h2>
                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs">
                    <span class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-sm" style="background:#1e40af;"></span>
                        <span class="text-gray-500">Banjir</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-sm" style="background:#991b1b;"></span>
                        <span class="text-gray-500">Karhutla</span>
                    </span>
                </div>
            </div>

            <div id="peta-wilayah" style="height: 400px; z-index: 0;"></div>

            <div id="peta-empty" class="px-6 py-3 border-t border-gray-100 bg-amber-50/50 text-xs text-amber-700 hidden">
                ⚠️ Belum ada data wilayah rawan. Peta akan otomatis menampilkan polygon setelah data ditambahkan.
            </div>
        </div>

        {{-- ==================== FILTER ==================== --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <select name="id_bencana"
                        class="px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                    <option value="">Semua Jenis Bencana</option>
                    @foreach ($jenisBencana as $jb)
                        <option value="{{ $jb->id }}" @selected(request('id_bencana') == $jb->id)>
                            {{ $jb->nama_bencana }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="kabupaten" value="{{ request('kabupaten') }}"
                       placeholder="Cari kabupaten..."
                       class="px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition md:col-span-2">

                <div class="flex gap-2">
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.wilayah.index') }}"
                       class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-semibold text-center transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- ==================== TABEL ==================== --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">ID</th>
                            <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Jenis Bencana</th>
                            <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Kabupaten</th>
                            <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Level Rawan</th>
                            <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Sumber Data</th>
                            <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($wilayah as $item)
                            @php
                                $level = strtolower($item->level_rawan ?? '');
                                $levelStyle = match($level) {
                                    'tinggi', 'high' => 'bg-red-100 text-red-700 ring-red-200',
                                    'sedang', 'medium' => 'bg-yellow-100 text-yellow-700 ring-yellow-200',
                                    'rendah', 'low' => 'bg-green-100 text-green-700 ring-green-200',
                                    default => 'bg-gray-100 text-gray-600 ring-gray-200',
                                };
                                $levelDot = match($level) {
                                    'tinggi', 'high' => 'bg-red-500',
                                    'sedang', 'medium' => 'bg-yellow-500',
                                    'rendah', 'low' => 'bg-green-500',
                                    default => 'bg-gray-400',
                                };
                            @endphp

                            <tr class="hover:bg-blue-50/30 transition-colors">
                                <td class="px-5 py-3.5 font-mono text-xs text-gray-500">#{{ $item->id }}</td>
                                <td class="px-5 py-3.5 font-semibold text-gray-800 text-sm">
                                    {{ $item->jenisBencana->nama_bencana ?? '-' }}
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-gray-700 text-sm">{{ $item->kabupaten ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide ring-1 {{ $levelStyle }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $levelDot }}"></span>
                                        {{ $item->level_rawan ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-gray-600 text-sm">{{ $item->sumber_data ?? '-' }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.wilayah.edit', $item->id) }}"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 transition"
                                           title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.wilayah.destroy', $item->id) }}" method="POST"
                                              class="inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 transition"
                                                    title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3 text-gray-400">
                                        <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-medium">Belum ada data wilayah rawan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($wilayah->hasPages())
                <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $wilayah->links() }}
                </div>
            @endif
        </div>

    </div>

    {{-- ==================== LEAFLET + GLOBE MINIMAP ==================== --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="https://unpkg.com/d3@7"></script>
    <script src="https://unpkg.com/topojson-client@3"></script>
    <script src="https://unpkg.com/leaflet-globe-minimap@2.0.1/dist/leaflet-globe-minimap.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const mapEl = document.getElementById('peta-wilayah');
        if (!mapEl) return;

        const map = L.map('peta-wilayah').setView([-3.0, 115.5], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Globe minimap
        try {
            L.control.globe({
                position: 'bottomright',
                globeSize: 120,
            }).addTo(map);
        } catch (e) {
            console.warn('Globe minimap gagal dimuat:', e);
        }

        // ============================================================
        // WARNA PER JENIS BENCANA × LEVEL
        // ============================================================
        const colorMap = {
            'banjir': {
                rendah: '#93c5fd',
                sedang: '#3b82f6',
                tinggi: '#1e40af',
            },
            'karhutla': {
                rendah: '#fca5a5',
                sedang: '#ef4444',
                tinggi: '#991b1b',
            },
            'longsor': {
                rendah: '#d6b28c',
                sedang: '#a16207',
                tinggi: '#713f12',
            },
            'kebakaran': {
                rendah: '#fed7aa',
                sedang: '#f97316',
                tinggi: '#9a3412',
            },
        };

        const fallbackColor = {
            rendah: '#d1d5db',
            sedang: '#6b7280',
            tinggi: '#374151',
        };

        function getColor(jenis, level) {
            const jenisKey = (jenis || '').toLowerCase().trim();
            const levelKey = (level || '').toLowerCase().trim();
            const normalizedJenis = jenisKey.replace(/\s+/g, '');

            for (const key in colorMap) {
                if (normalizedJenis.includes(key) || key.includes(normalizedJenis)) {
                    return colorMap[key][levelKey] || fallbackColor[levelKey] || '#6b7280';
                }
            }

            return fallbackColor[levelKey] || '#6b7280';
        }

        // Variabel global untuk bounds Kalsel
        let kalselBounds = null;

        // ============ BACA FILTER DARI URL ============
        const urlParams = new URLSearchParams(window.location.search);
        const filterBencana = urlParams.get('id_bencana');     // id jenis bencana (string)
        const filterKabupaten = urlParams.get('kabupaten');    // kata kunci kabupaten

        // ============ LOAD GEOJSON + HIGHLIGHT KALSEL ============
        fetch('{{ asset("geojson/indonesia-province-simple.json") }}')
            .then(res => res.json())
            .then(geojson => {

                const kalselFeature = geojson.features.find(f =>
                    f.properties && f.properties.Propinsi &&
                    f.properties.Propinsi.toUpperCase().includes('KALIMANTAN SELATAN')
                );

                if (kalselFeature) {
                    const kalselLayer = L.geoJSON(kalselFeature, {
                        style: {
                            color: '#1e40af',
                            weight: 2,
                            fillColor: '#3b82f6',
                            fillOpacity: 0.05,
                            dashArray: '4,4'
                        }
                    }).addTo(map);

                    kalselBounds = kalselLayer.getBounds();

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

                    // ============ TOMBOL FOKUS KE KALSEL ============
                    const FokusControl = L.Control.extend({
                        options: { position: 'topright' },
                        onAdd: function () {
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

                            btn.onmouseenter = function () {
                                btn.style.background = '#f0f4fb';
                                btn.style.transform = 'scale(1.05)';
                            };
                            btn.onmouseleave = function () {
                                btn.style.background = 'white';
                                btn.style.transform = 'scale(1)';
                            };

                            L.DomEvent.disableClickPropagation(btn);
                            L.DomEvent.on(btn, 'click', function (e) {
                                L.DomEvent.stopPropagation(e);
                                if (kalselBounds) {
                                    map.flyToBounds(kalselBounds, {
                                        padding: [20, 20],
                                        duration: 1.2
                                    });
                                }
                            });

                            return btn;
                        }
                    });

                    map.addControl(new FokusControl());
                }

                // ============ DATA WILAYAH RAWAN (DENGAN FILTER) ============
                let apiUrl = '/api/wilayah-rawan';
                if (filterBencana) {
                    apiUrl += '?id_bencana=' + encodeURIComponent(filterBencana);
                }

                fetch(apiUrl)
                    .then(res => res.json())
                    .then(data => {
                        // Filter tambahan by kabupaten (kalau ada)
                        let filtered = data;
                        if (filterKabupaten) {
                            const keyword = filterKabupaten.toLowerCase();
                            filtered = data.filter(item =>
                                (item.kabupaten || '').toLowerCase().includes(keyword)
                            );
                        }

                        if (!Array.isArray(filtered) || filtered.length === 0) {
                            const emptyInfo = document.getElementById('peta-empty');
                            if (emptyInfo) {
                                emptyInfo.textContent = '⚠️ Tidak ada wilayah rawan yang cocok dengan filter.';
                                emptyInfo.classList.remove('hidden');
                            }
                            return;
                        }

                        filtered.forEach(function (item) {
                            if (!item.geom || !item.geom.coordinates) return;

                            const warna = getColor(item.jenis_bencana, item.level_rawan);

                            if (item.geom.type === 'Polygon' || item.geom.type === 'MultiPolygon') {
                                const layer = L.geoJSON(item.geom, {
                                    style: {
                                        color: warna,
                                        fillColor: warna,
                                        fillOpacity: 0.55,
                                        weight: 2,
                                    }
                                });

                                layer.bindPopup(
                                    '<div style="font-family: Plus Jakarta Sans, system-ui, sans-serif; min-width: 220px;">' +
                                        '<div style="display:flex; align-items:center; gap:8px; margin-bottom:10px;">' +
                                            '<span style="display:inline-flex; align-items:center; gap:6px; padding:4px 10px; border-radius:999px; font-size:10px; font-weight:800; letter-spacing:0.5px; text-transform:uppercase; background:' + warna + '20; color:' + warna + '; border:1px solid ' + warna + '40;">' +
                                                '<span style="width:6px; height:6px; border-radius:999px; background:' + warna + ';"></span>' +
                                                (item.level_rawan || '-').toUpperCase() +
                                            '</span>' +
                                        '</div>' +

                                        '<p style="font-weight:800; font-size:15px; color:#0f172a; margin:0 0 10px 0; line-height:1.3;">' +
                                            (item.jenis_bencana || '-') +
                                        '</p>' +

                                        '<div style="display:flex; align-items:flex-start; gap:8px; margin-bottom:8px;">' +
                                            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" style="flex-shrink:0; margin-top:2px;">' +
                                                '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>' +
                                                '<path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>' +
                                            '</svg>' +
                                            '<span style="font-size:12px; color:#475569; line-height:1.5;">' +
                                                (item.kabupaten || '-') +
                                            '</span>' +
                                        '</div>' +

                                        (item.sumber_data ?
                                            '<div style="display:flex; align-items:flex-start; gap:8px;">' +
                                                '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" style="flex-shrink:0; margin-top:2px;">' +
                                                    '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>' +
                                                '</svg>' +
                                                '<span style="font-size:12px; color:#475569; line-height:1.5;">' +
                                                    item.sumber_data +
                                                '</span>' +
                                            '</div>'
                                        : '') +

                                    '</div>'
                                );

                                layer.addTo(map);
                            }
                        });
                    });
            })
            .catch(err => {
                console.error('Gagal load GeoJSON:', err);
            });
    });
    </script>
@endsection