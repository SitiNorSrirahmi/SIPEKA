{{-- ==================== PETA ==================== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-4 sm:mb-6">
    <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-3">
        <h2 class="font-bold text-sm sm:text-base text-gray-800 flex items-center gap-2">
            <span class="text-blue-600">🗺️</span>
            Peta Sebaran Kejadian
        </h2>
        <div class="flex flex-wrap items-center gap-x-3 sm:gap-x-4 gap-y-2 text-xs">
            <span class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-full" style="background:#1e40af;"></span>
                <span class="text-gray-500">Banjir</span>
            </span>
            <span class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-full" style="background:#991b1b;"></span>
                <span class="text-gray-500">Karhutla</span>
            </span>
        </div>
    </div>

    <div id="peta-kejadian" class="h-[300px] sm:h-[400px]" style="z-index: 0;"></div>

    <div id="peta-empty" class="px-4 sm:px-6 py-3 border-t border-gray-100 bg-amber-50/50 text-xs text-amber-700 hidden">
        ⚠️ Belum ada data kejadian. Peta akan otomatis menampilkan marker setelah data ditambahkan.
    </div>
</div>

{{-- ==================== FILTER ==================== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5 mb-4 sm:mb-6">
    <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 sm:gap-3">
        <select name="id_bencana"
            class="px-3 sm:px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            <option value="">Semua Jenis Bencana</option>
            @foreach ($jenisBencana as $jb)
            <option value="{{ $jb->id }}" @selected(request('id_bencana')==$jb->id)>
                {{ $jb->nama_bencana }}
            </option>
            @endforeach
        </select>

        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari lokasi..."
            class="px-3 sm:px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition sm:col-span-1 md:col-span-2">

        <div class="flex gap-2 sm:col-span-2 md:col-span-1">
            <button type="submit"
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold transition">
                Filter
            </button>
            <a href="{{ url()->current() }}"
                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-semibold text-center transition">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- ==================== TABEL ==================== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    {{-- Desktop: tabel --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">ID</th>
                    <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Jenis Bencana</th>
                    <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Korban</th>
                    <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Kerugian</th>
                    <th class="text-left px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Tanggal</th>
                    @if (!empty($showAksi) && $showAksi)
                    <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                    @else
                    <th class="text-center px-5 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Detail</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($kejadian as $item)
                <tr class="hover:bg-blue-50/30 transition-colors">
                    <td class="px-5 py-3.5 font-mono text-xs text-gray-500">#{{ $item->id }}</td>
                    <td class="px-5 py-3.5 font-semibold text-gray-800 text-sm">
                        {{ $item->jenisBencana->nama_bencana ?? '-' }}
                    </td>
                    <td class="px-5 py-3.5 text-center">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                            {{ $item->jumlah_korban ?? 0 }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-gray-700 text-sm">
                        Rp{{ number_format($item->estimasi_kerugian ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="px-5 py-3.5 text-gray-600 text-sm">
                        {{ $item->tanggal_kejadian?->format('d M Y') ?? '-' }}
                    </td>

                    @if (!empty($showAksi) && $showAksi)
                    {{-- KOLOM AKSI (ADMIN) --}}
                    <td class="px-5 py-3.5">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.kejadian.edit', $item->id) }}"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 transition"
                                title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>

                            <form action="{{ route('admin.kejadian.destroy', $item->id) }}" method="POST"
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
                    @else
                    {{-- KOLOM DETAIL (GUEST/PETUGAS) --}}
                    <td class="px-5 py-3.5 text-center">
                        <a href="{{ route('kejadian.show', $item->id) }}"
                            class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 text-xs font-bold transition">
                            Lihat
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </td>
                    @endif
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
                            <p class="text-sm font-medium">Belum ada data kejadian bencana.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ==================== Mobile: card list ==================== --}}
    <div class="md:hidden divide-y divide-gray-100">
        @forelse ($kejadian as $item)
            <div class="p-4 hover:bg-blue-50/30 transition-colors">
                <div class="flex items-center gap-3">
                    {{-- KIRI: Info --}}
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="font-mono text-[10px] text-gray-400">#{{ $item->id }}</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold bg-red-100 text-red-700">
                                {{ $item->jumlah_korban ?? 0 }} korban
                            </span>
                        </div>
                        <p class="font-bold text-gray-800 text-sm mb-1">
                            {{ $item->jenisBencana->nama_bencana ?? '-' }}
                        </p>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-0.5 text-[10px] text-gray-500">
                            <span>
                                <span class="text-gray-400 uppercase font-bold">Kerugian:</span>
                                <span class="font-semibold">Rp{{ number_format($item->estimasi_kerugian ?? 0, 0, ',', '.') }}</span>
                            </span>
                            <span>
                                <span class="text-gray-400 uppercase font-bold">Tanggal:</span>
                                <span class="font-semibold">{{ $item->tanggal_kejadian?->format('d M Y') ?? '-' }}</span>
                            </span>
                        </div>
                    </div>

                    {{-- KANAN: Tombol --}}
                    <div class="shrink-0">
                        @if (!empty($showAksi) && $showAksi)
                            {{-- Aksi admin (mobile) --}}
                            <div class="flex flex-col gap-1">
                                <a href="{{ route('admin.kejadian.edit', $item->id) }}"
                                    class="inline-flex items-center justify-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-[10px] font-bold transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.kejadian.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-1 bg-red-50 hover:bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-[10px] font-bold transition">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @else
                            {{-- Detail (guest/petugas) --}}
                            <a href="{{ route('kejadian.show', $item->id) }}"
                                class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-[10px] font-bold transition whitespace-nowrap">
                                Lihat
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="p-8 text-center">
                <div class="flex flex-col items-center gap-3 text-gray-400">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium">Belum ada data kejadian.</p>
                </div>
            </div>
        @endforelse
    </div>

    @if ($kejadian->hasPages())
    <div class="px-4 sm:px-5 py-3 sm:py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $kejadian->links() }}
    </div>
    @endif
</div>

{{-- ==================== LEAFLET + MARKERCLUSTER + GLOBE ==================== --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<script src="https://unpkg.com/d3@7"></script>
<script src="https://unpkg.com/topojson-client@3"></script>
<script src="https://unpkg.com/leaflet-globe-minimap@2.0.1/dist/leaflet-globe-minimap.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mapEl = document.getElementById('peta-kejadian');
        if (!mapEl) return;

        const map = L.map('peta-kejadian').setView([-3.0, 115.5], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        try {
            L.control.globe({
                position: 'bottomright',
                globeSize: 120,
            }).addTo(map);
        } catch (e) {
            console.warn('Globe minimap gagal dimuat:', e);
        }

        const markers = L.markerClusterGroup({
            showCoverageOnHover: false,
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            iconCreateFunction: function(cluster) {
                const count = cluster.getChildCount();
                return L.divIcon({
                    html: '<div style="background:#1e40af; color:white; border-radius:50%; width:40px; height:40px; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:13px; box-shadow:0 4px 12px rgba(30,64,175,0.4); border:3px solid white;">' + count + '</div>',
                    className: 'custom-cluster',
                    iconSize: [40, 40]
                });
            }
        });
        map.addLayer(markers);

        const markerColor = {
            'banjir': '#1e40af',
            'karhutla': '#991b1b',
            'longsor': '#a16207',
            'kebakaran': '#f97316',
            'angin': '#10b981',
            'tsunami': '#06b6d4',
            'kekeringan': '#d97706',
        };

        function getMarkerColor(jenis) {
            const key = (jenis || '').toLowerCase().replace(/\s+/g, '');
            for (const k in markerColor) {
                if (key.includes(k) || k.includes(key)) {
                    return markerColor[k];
                }
            }
            return '#6b7280';
        }

        let kalselBounds = null;

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

                    const worldRing = [
                        [-180, -90], [180, -90], [180, 90], [-180, 90], [-180, -90]
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
                                width: 34px; height: 34px; background: white;
                                border: 2px solid rgba(0,0,0,0.2); border-radius: 6px;
                                cursor: pointer; font-size: 16px;
                                display: flex; align-items: center; justify-content: center;
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
                                if (kalselBounds) {
                                    map.flyToBounds(kalselBounds, {
                                        padding: [20, 20], duration: 1.2
                                    });
                                }
                            });

                            return btn;
                        }
                    });

                    map.addControl(new FokusControl());
                }

                fetch('/api/kejadian')
                    .then(res => res.json())
                    .then(data => {
                        if (!Array.isArray(data) || data.length === 0) {
                            const emptyInfo = document.getElementById('peta-empty');
                            if (emptyInfo) emptyInfo.classList.remove('hidden');
                            return;
                        }

                        data.forEach(function(item) {
                            if (!item.latitude || !item.longitude) return;

                            const lat = parseFloat(item.latitude);
                            const lng = parseFloat(item.longitude);
                            if (isNaN(lat) || isNaN(lng)) return;

                            const warna = getMarkerColor(item.jenis_bencana);

                            const markerIcon = L.divIcon({
                                html: '<div style="position:relative;">' +
                                    '<svg width="32" height="40" viewBox="0 0 24 30" fill="none">' +
                                    '<path d="M12 0C5.4 0 0 5.4 0 12c0 9 12 18 12 18s12-9 12-18c0-6.6-5.4-12-12-12z" fill="' + warna + '" stroke="white" stroke-width="1.5"/>' +
                                    '<circle cx="12" cy="12" r="4.5" fill="white"/>' +
                                    '</svg>' +
                                    '</div>',
                                className: 'custom-marker',
                                iconSize: [32, 40],
                                iconAnchor: [16, 40],
                                popupAnchor: [0, -40]
                            });

                            const marker = L.marker([lat, lng], { icon: markerIcon });

                            const kerugian = item.estimasi_kerugian ?
                                'Rp' + parseInt(item.estimasi_kerugian).toLocaleString('id-ID') :
                                '-';

                            marker.bindPopup(
                                '<div style="font-family: Plus Jakarta Sans, system-ui, sans-serif; min-width: 220px;">' +
                                '<span style="display:inline-flex; align-items:center; gap:6px; padding:4px 10px; border-radius:999px; font-size:10px; font-weight:800; letter-spacing:0.5px; text-transform:uppercase; background:' + warna + '20; color:' + warna + '; border:1px solid ' + warna + '40; margin-bottom:10px;">' +
                                '<span style="width:6px; height:6px; border-radius:999px; background:' + warna + ';"></span>' +
                                (item.jenis_bencana || '-') +
                                '</span>' +

                                '<p style="font-size:12px; color:#475569; margin:8px 0 4px 0;">' +
                                '<strong style="color:#0f172a;">Korban:</strong> ' + (item.jumlah_korban || 0) + ' orang' +
                                '</p>' +
                                '<p style="font-size:12px; color:#475569; margin:0 0 4px 0;">' +
                                '<strong style="color:#0f172a;">Kerugian:</strong> ' + kerugian +
                                '</p>' +
                                '<p style="font-size:12px; color:#475569; margin:0 0 12px 0;">' +
                                '<strong style="color:#0f172a;">Tanggal:</strong> ' + (item.tanggal_kejadian || '-') +
                                '</p>' +

                                '<a href="/kejadian/' + item.id + '" style="display:inline-flex; align-items:center; gap:4px; padding:6px 12px; border-radius:8px; background:' + warna + '; color:white; font-size:11px; font-weight:700; text-decoration:none;">' +
                                'Detail Kejadian →' +
                                '</a>' +
                                '</div>'
                            );

                            markers.addLayer(marker);
                        });
                    });
            })
            .catch(err => {
                console.error('Gagal load GeoJSON:', err);
            });
    });
</script>