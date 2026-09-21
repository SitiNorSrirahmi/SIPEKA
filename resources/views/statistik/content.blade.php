@php
    // Helper: format rupiah singkat
    function formatRupiahSingkat($angka) {
        if ($angka >= 1000000000000) {
            return 'Rp' . number_format($angka / 1000000000000, 1, ',', '.') . ' T';
        } elseif ($angka >= 1000000000) {
            return 'Rp' . number_format($angka / 1000000000, 1, ',', '.') . ' M';
        } elseif ($angka >= 1000000) {
            return 'Rp' . number_format($angka / 1000000, 1, ',', '.') . ' Jt';
        } elseif ($angka >= 1000) {
            return 'Rp' . number_format($angka / 1000, 0, ',', '.') . ' Rb';
        }
        return 'Rp' . number_format($angka, 0, ',', '.');
    }

    // ===== Generate 12 bulan =====
    $bulanNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    // Kumpulkan tahun yang tersedia dari $perPeriode
    $tahunTersedia = $perPeriode->map(function($item) {
        return substr($item->bulan, 0, 4);
    })->unique()->sort()->values();

    // Tahun aktif — dari query ?tahun=, default tahun terbaru
    $tahunAktif = request('tahun', $tahunTersedia->last() ?? date('Y'));

    // Ambil data per bulan untuk tahun aktif
    $dataPerBulan = [];
    foreach ($perPeriode as $item) {
        if (substr($item->bulan, 0, 4) == $tahunAktif) {
            $bulanNum = (int) substr($item->bulan, 5, 2);
            $dataPerBulan[$bulanNum] = $item->total;
        }
    }

    // Isi semua bulan (0 kalau nggak ada data)
    $barData = [];
    $maxTotal = !empty($dataPerBulan) ? max($dataPerBulan) : 1;
    for ($i = 1; $i <= 12; $i++) {
        $total = $dataPerBulan[$i] ?? 0;
        $barData[] = [
            'label' => $bulanNames[$i - 1],
            'total' => $total,
            'height' => $total > 0 ? max(($total / $maxTotal) * 100, 8) : 2,
        ];
    }

    // ===== Donut =====
    $totalAll = $perJenis->sum('total');
    $palette = ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#ef4444', '#06b6d4', '#ec4899', '#84cc16'];
    $gradientParts = [];
    $cumulative = 0;
    $legendData = [];
    foreach ($perJenis as $i => $item) {
        $start = $totalAll > 0 ? ($cumulative / $totalAll) * 100 : 0;
        $cumulative += $item->total;
        $end = $totalAll > 0 ? ($cumulative / $totalAll) * 100 : 0;
        $color = $palette[$i % count($palette)];
        $gradientParts[] = $color . ' ' . $start . '% ' . $end . '%';
        $legendData[] = [
            'nama' => $item->nama_bencana,
            'total' => $item->total,
            'color' => $color,
        ];
    }
    $gradientCSS = implode(', ', $gradientParts);
@endphp

<div class="max-w-6xl mx-auto">

    {{-- ==================== HEADER ==================== --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Statistik Bencana — SIPEKA
        </h1>
        <p class="text-sm text-gray-500 mt-1">Data dan grafik kejadian bencana di Kalimantan Selatan</p>
    </div>

    {{-- ==================== 4 CARD STATISTIK ==================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        {{-- Total Kejadian --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs uppercase tracking-wider text-gray-500 font-bold">Total Kejadian</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalKejadian }}</p>
                </div>
            </div>
        </div>

        {{-- Korban Meninggal --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs uppercase tracking-wider text-gray-500 font-bold">Korban Meninggal</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalKorbanMeninggal }}</p>
                </div>
            </div>
        </div>

        {{-- Korban Luka --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs uppercase tracking-wider text-gray-500 font-bold">Korban Luka</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalKorbanLuka }}</p>
                </div>
            </div>
        </div>

        {{-- Kerugian — PAKAI FORMAT SINGKAT --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs uppercase tracking-wider text-gray-500 font-bold">Kerugian</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1 cursor-help truncate"
                       title="Rp{{ number_format($totalKerugian, 0, ',', '.') }}">
                        {{ formatRupiahSingkat($totalKerugian) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== 2 GRAFIK ==================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">

        {{-- ============ DONUT CHART ============ --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-bold text-base text-gray-800 flex items-center gap-2 mb-4">
                <span class="text-blue-600">🥧</span>
                Grafik per Jenis
            </h2>

            <div class="flex flex-col sm:flex-row items-center gap-6">
                <div class="relative shrink-0 donut-wrap" data-gradient="{{ $gradientCSS }}" style="width: 180px; height: 180px;">
                    <div class="w-full h-full rounded-full donut-inner"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-white rounded-full flex flex-col items-center justify-center"
                             style="width: 120px; height: 120px;">
                            <p class="text-2xl font-extrabold text-gray-800">{{ $totalKejadian }}</p>
                            <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Total</p>
                        </div>
                    </div>
                </div>

                <div class="flex-1 space-y-2 w-full">
                    @forelse($legendData as $row)
                        <div class="flex items-center gap-2 text-sm">
                            <span class="w-3 h-3 rounded-full shrink-0 legend-dot" data-color="{{ $row['color'] }}"></span>
                            <span class="text-gray-700 flex-1 truncate">{{ $row['nama'] }}</span>
                            <span class="text-gray-500 font-semibold">{{ $row['total'] }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 text-center">Belum ada data.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ============ BAR CHART (12 BULAN + FILTER TAHUN) ============ --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-base text-gray-800 flex items-center gap-2">
                    <span class="text-blue-600">📊</span>
                    Kejadian per Bulan
                </h2>

                @if($tahunTersedia->isNotEmpty())
                    <form method="GET" class="flex items-center gap-2">
                        <select name="tahun" onchange="this.form.submit()"
                                class="px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-bold text-gray-700 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition cursor-pointer">
                            @foreach($tahunTersedia as $tahun)
                                <option value="{{ $tahun }}" @selected($tahun == $tahunAktif)>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </div>

            <div class="flex items-end justify-between gap-1 h-48">
                @foreach($barData as $bar)
                    <div class="flex-1 flex flex-col items-center gap-2 group">
                        <div class="w-full flex flex-col justify-end" style="height: 100%;">
                            <div class="w-full bg-blue-500 hover:bg-blue-600 rounded-t-md transition-all duration-300 relative bar-chart"
                                 data-height="{{ $bar['height'] }}">
                                <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-700 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                    {{ $bar['total'] }}
                                </span>
                            </div>
                        </div>
                        <span class="text-[10px] font-semibold text-gray-500">{{ $bar['label'] }}</span>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-xs">
                <span class="text-gray-500">Total kejadian tahun <strong class="text-gray-700">{{ $tahunAktif }}</strong>:</span>
                <span class="font-bold text-blue-600">{{ array_sum($dataPerBulan) }}</span>
            </div>
        </div>
    </div>

    {{-- ==================== DAFTAR KEJADIAN ==================== --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 flex items-center justify-between">
            <h2 class="font-bold text-base text-gray-800 flex items-center gap-2">
                <span class="text-red-500">📍</span>
                Kejadian per Kabupaten
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-y border-gray-100">
                        <th class="text-left px-6 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Jenis</th>
                        <th class="text-left px-6 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Lokasi</th>
                        <th class="text-left px-6 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Kabupaten</th>
                        <th class="text-left px-6 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Tanggal</th>
                        @if ($isAdmin)
                            <th class="text-center px-6 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Status</th>
                        @endif
                        <th class="text-center px-6 py-3 font-bold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($daftarKejadian as $item)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-800 text-sm">
                                {{ $item->jenisBencana->nama_bencana ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-700 text-sm">
                                {{ $isAdmin ? ($item->lokasi ?? '-') : ($item->laporanMasuk->lokasi ?? '-') }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-sm">
                                {{ $isAdmin ? ($item->kabupaten ?? '-') : ($item->laporanMasuk->kabupaten ?? '-') }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-sm">
                                {{ $item->tanggal_kejadian?->format('d M Y') ?? $item->created_at?->format('d M Y') }}
                            </td>
                            @if ($isAdmin)
                                <td class="px-6 py-4 text-center">
                                    @if(($item->status ?? '') === 'verified')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700">
                                            TERVERIFIKASI
                                        </span>
                                    @elseif(($item->status ?? '') === 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-yellow-100 text-yellow-700">
                                            MENUNGGU
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700">
                                            DITOLAK
                                        </span>
                                    @endif
                                </td>
                            @endif
                            <td class="px-6 py-4 text-center">
                                @if ($isAdmin)
                                    @if (($item->status ?? '') === 'verified' && $item->kejadianBencana)
                                        <a href="{{ route('kejadian.show', $item->kejadianBencana->id) }}"
                                           class="inline-flex items-center px-3 py-1.5 rounded-lg border border-blue-400 text-blue-600 text-[10px] font-bold hover:bg-blue-50 transition">
                                            Detail
                                        </a>
                                    @else
                                        <span class="text-gray-300 text-xs">-</span>
                                    @endif
                                @else
                                    <a href="{{ route('kejadian.show', $item->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 rounded-lg border border-blue-400 text-blue-600 text-[10px] font-bold hover:bg-blue-50 transition">
                                        Detail
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $isAdmin ? 6 : 5 }}" class="px-6 py-12 text-center text-sm text-gray-400">
                                Belum ada data kejadian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($daftarKejadian->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $daftarKejadian->links() }}
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.donut-wrap').forEach(function (wrap) {
        var gradient = wrap.getAttribute('data-gradient');
        var inner = wrap.querySelector('.donut-inner');
        if (gradient && inner) {
            inner.style.background = 'conic-gradient(' + gradient + ')';
        } else if (inner) {
            inner.style.background = '#e5e7eb';
        }
    });

    document.querySelectorAll('.legend-dot').forEach(function (dot) {
        var color = dot.getAttribute('data-color');
        if (color) dot.style.backgroundColor = color;
    });

    document.querySelectorAll('.bar-chart').forEach(function (bar) {
        var height = bar.getAttribute('data-height');
        if (height) bar.style.height = height + '%';
    });
});
</script>