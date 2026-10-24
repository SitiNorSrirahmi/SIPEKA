@php
    if (!function_exists('formatRupiahSingkat')) {
        function formatRupiahSingkat($angka) {
            if ($angka >= 1000000000000) {
                $val = $angka / 1000000000000;
                return 'Rp' . ($val == floor($val) ? number_format($val, 0, ',', '.') : number_format($val, 1, ',', '.')) . ' T';
            } elseif ($angka >= 1000000000) {
                $val = $angka / 1000000000;
                return 'Rp' . ($val == floor($val) ? number_format($val, 0, ',', '.') : number_format($val, 1, ',', '.')) . ' M';
            } elseif ($angka >= 1000000) {
                $val = $angka / 1000000;
                return 'Rp' . ($val == floor($val) ? number_format($val, 0, ',', '.') : number_format($val, 1, ',', '.')) . ' Jt';
            } elseif ($angka >= 1000) {
                $val = $angka / 1000;
                return 'Rp' . ($val == floor($val) ? number_format($val, 0, ',', '.') : number_format($val, 1, ',', '.')) . ' Rb';
            }
            return 'Rp' . number_format($angka, 0, ',', '.');
        }
    }

    $bulanNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $tahunTersedia = $perPeriode->map(function($item) { return substr($item->bulan, 0, 4); })->unique()->sort()->values();
    $tahunAktif = request('tahun', $tahunTersedia->last() ?? date('Y'));

    $dataPerBulan = [];
    foreach ($perPeriode as $item) {
        if (substr($item->bulan, 0, 4) == $tahunAktif) {
            $bulanNum = (int) substr($item->bulan, 5, 2);
            $dataPerBulan[$bulanNum] = $item->total;
        }
    }

    $barData = [];
    for ($i = 1; $i <= 12; $i++) {
        $total = $dataPerBulan[$i] ?? 0;
        $barData[] = ['label' => $bulanNames[$i - 1], 'total' => $total];
    }

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
        $legendData[] = ['nama' => $item->nama_bencana, 'total' => $item->total, 'color' => $color];
    }
    $gradientCSS = implode(', ', $gradientParts);
@endphp
<div class="w-full space-y-5">
    {{-- 4 CARD STATISTIK --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-blue-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[9px] sm:text-xs uppercase tracking-wider text-gray-500 font-bold leading-tight">Total Kejadian</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-1">{{ $statTotalKejadian ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-red-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[9px] sm:text-xs uppercase tracking-wider text-gray-500 font-bold leading-tight">Korban Meninggal</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-1">{{ $statTotalKorbanMeninggal ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-yellow-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[9px] sm:text-xs uppercase tracking-wider text-gray-500 font-bold leading-tight">Korban Luka</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-gray-800 mt-1">{{ $statTotalKorbanLuka ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-100 p-4 sm:p-5 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-start gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-green-100 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[9px] sm:text-xs uppercase tracking-wider text-gray-500 font-bold leading-tight">Kerugian</p>
                    <p class="text-lg sm:text-2xl font-extrabold text-gray-800 mt-1 cursor-help truncate" title="Rp{{ number_format($statTotalKerugian ?? 0, 0, ',', '.') }}">{{ formatRupiahSingkat($statTotalKerugian ?? 0) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 3 KOLOM: GRAFIK & TABEL --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">
        
        {{-- Donut Chart --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-6">
            <h2 class="font-bold text-sm sm:text-base text-gray-800 flex items-center gap-2 mb-4">
                <span class="text-blue-600">🥧</span> Grafik per Jenis
            </h2>
            <div class="flex flex-col items-center gap-6">
                <div class="relative shrink-0 donut-wrap" data-gradient="{{ $gradientCSS }}" style="width: 140px; height: 140px;">
                    <div class="w-full h-full rounded-full donut-inner"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-white rounded-full flex flex-col items-center justify-center" style="width: 90px; height: 90px;">
                            <p class="text-xl font-extrabold text-gray-800">{{ $statTotalKejadian ?? 0 }}</p>
                            <p class="text-[9px] uppercase tracking-wider text-gray-400 font-bold">Total</p>
                        </div>
                    </div>
                </div>
                <div class="w-full space-y-2">
                    @forelse($legendData as $row)
                        <div class="flex items-center justify-between text-xs sm:text-sm">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="w-3 h-3 rounded-full shrink-0 legend-dot" data-color="{{ $row['color'] }}"></span>
                                <span class="text-gray-700 truncate">{{ $row['nama'] }}</span>
                            </div>
                            <span class="text-gray-500 font-semibold">{{ $row['total'] }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 text-center">Belum ada data.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Bar Chart --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-6">
            <div class="flex items-center justify-between gap-2 mb-4">
                <h2 class="font-bold text-sm sm:text-base text-gray-800 flex items-center gap-2">
                    <span class="text-blue-600">📊</span> Kejadian per Bulan
                </h2>
                @if($tahunTersedia->isNotEmpty())
                    <form method="GET" class="flex items-center gap-2">
                        <select name="tahun" onchange="this.form.submit()" class="px-2 py-1 rounded-lg border border-gray-300 text-[10px] sm:text-xs font-bold text-gray-700 bg-white outline-none">
                            @foreach($tahunTersedia as $tahun)
                                <option value="{{ $tahun }}" @selected($tahun == $tahunAktif)>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </div>
            <div class="h-[200px] sm:h-[240px]">
                <canvas id="chartPerBulan"></canvas>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-[10px] sm:text-xs">
                <span class="text-gray-500">Total tahun <strong class="text-gray-700">{{ $tahunAktif }}</strong>:</span>
                <span class="font-bold text-blue-600">{{ array_sum($dataPerBulan) }}</span>
            </div>
        </div>

        {{-- DAFTAR KEJADIAN --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                <span class="text-red-500">📍</span>
                <h2 class="font-bold text-sm sm:text-base text-gray-800">Daftar Kejadian</h2>
            </div>
            
            {{-- DESKTOP: Tabel (Teks Wrap, Gak Kepotong) --}}
            <div class="hidden md:block flex-1">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="text-left px-4 py-3 font-bold text-gray-600 text-xs uppercase tracking-wider">Jenis</th>
                            <th class="text-left px-4 py-3 font-bold text-gray-600 text-xs uppercase tracking-wider">Lokasi</th>
                            <th class="text-center px-4 py-3 font-bold text-gray-600 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($daftarKejadian as $item)
                            <tr class="hover:bg-blue-50/30 transition-colors">
                                <td class="px-4 py-4 font-semibold text-gray-800 text-sm align-top">{{ $item->jenisBencana->nama_bencana ?? '-' }}</td>
                                <td class="px-4 py-4 text-gray-600 text-xs max-w-[250px] whitespace-normal leading-relaxed align-top" title="{{ $isAdmin ? ($item->lokasi ?? '-') : ($item->laporanMasuk->lokasi ?? '-') }}">
                                    {{ $isAdmin ? ($item->lokasi ?? '-') : ($item->laporanMasuk->lokasi ?? '-') }}
                                </td>
                                <td class="px-4 py-4 text-center align-top">
                                    @if ($isAdmin)
                                        @if (($item->status ?? '') === 'verified' && $item->kejadianBencana)
                                            <a href="{{ route('kejadian.show', $item->kejadianBencana->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-blue-400 text-blue-600 text-[10px] font-bold hover:bg-blue-50 transition">Detail</a>
                                        @else
                                            <span class="text-gray-300 text-xs">-</span>
                                        @endif
                                    @else
                                        <a href="{{ route('kejadian.show', $item->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-blue-400 text-blue-600 text-[10px] font-bold hover:bg-blue-50 transition">Detail</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-4 py-12 text-center text-sm text-gray-400">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MOBILE: Card Mewah --}}
            <div class="md:hidden flex-1 bg-gray-50/30">
                @forelse ($daftarKejadian as $item)
                    <div class="p-4 bg-white border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <div class="min-w-0 flex-1">
                                <h3 class="font-bold text-gray-800 text-sm truncate">{{ $item->jenisBencana->nama_bencana ?? '-' }}</h3>
                                <p class="text-[11px] text-gray-500 mt-1 flex items-center gap-1">
                                    <svg class="w-3 h-3 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    <span class="truncate">{{ $isAdmin ? ($item->lokasi ?? '-') : ($item->laporanMasuk->lokasi ?? '-') }}</span>
                                </p>
                            </div>
                            @if ($isAdmin)
                                @if(($item->status ?? '') === 'verified')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[8px] font-bold bg-green-100 text-green-700 border border-green-200 shrink-0">TERVERIFIKASI</span>
                                @elseif(($item->status ?? '') === 'pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[8px] font-bold bg-yellow-100 text-yellow-700 border border-yellow-200 shrink-0">MENUNGGU</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[8px] font-bold bg-red-100 text-red-700 border border-red-200 shrink-0">DITOLAK</span>
                                @endif
                            @endif
                        </div>

                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-50">
                            <span class="text-[10px] text-gray-400 font-medium flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                {{ $item->tanggal_kejadian?->format('d M Y') ?? $item->created_at?->format('d M Y') }}
                            </span>
                            
                            @if ($isAdmin)
                                @if (($item->status ?? '') === 'verified' && $item->kejadianBencana)
                                    <a href="{{ route('kejadian.show', $item->kejadianBencana->id) }}" class="text-[11px] font-bold text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                                        Detail <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('kejadian.show', $item->id) }}" class="text-[11px] font-bold text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                                    Detail <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-xs text-gray-400">Belum ada data kejadian.</div>
                @endforelse
            </div>
            
            @if($daftarKejadian->hasPages())
                <div class="p-2 border-t border-gray-100 bg-gray-50/50">{{ $daftarKejadian->links() }}</div>
            @endif
        </div>

    </div>
</div>

<script id="chart-data-per-bulan" type="application/json">
{ "labels": {!! json_encode(array_column($barData, 'label')) !!}, "values": {!! json_encode(array_column($barData, 'total')) !!} }
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.donut-wrap').forEach(function (wrap) {
        var gradient = wrap.getAttribute('data-gradient');
        var inner = wrap.querySelector('.donut-inner');
        if (gradient && inner) { inner.style.background = 'conic-gradient(' + gradient + ')'; }
        else if (inner) { inner.style.background = '#e5e7eb'; }
    });
    document.querySelectorAll('.legend-dot').forEach(function (dot) {
        var color = dot.getAttribute('data-color');
        if (color) dot.style.backgroundColor = color;
    });
    var canvas = document.getElementById('chartPerBulan');
    if (!canvas) return;
    var dataEl = document.getElementById('chart-data-per-bulan');
    if (!dataEl) return;
    var chartData = JSON.parse(dataEl.textContent);
    new Chart(canvas.getContext('2d'), {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Jumlah Kejadian',
                data: chartData.values,
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                hoverBackgroundColor: 'rgba(37, 99, 235, 1)',
                borderRadius: 6,
                borderSkipped: false,
                maxBarThickness: 40,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a', padding: 10, titleFont: { size: 12, weight: 'bold' }, bodyFont: { size: 12 }, displayColors: false,
                    callbacks: { label: function(context) { return context.parsed.y + ' kejadian'; } }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 9 }, color: '#64748b' } },
                y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 9 }, color: '#94a3b8', precision: 0 }, grid: { color: '#f1f5f9', drawBorder: false } }
            }
        }
    });
});
</script>