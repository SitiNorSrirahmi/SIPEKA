<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Statistik Bencana</h1>

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded">
                <p class="text-sm text-gray-600">Total Kejadian</p>
                <p class="text-2xl font-bold">{{ $totalKejadian }}</p>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <p class="text-sm text-gray-600">Korban Meninggal</p>
                <p class="text-2xl font-bold">{{ $totalKorbanMeninggal }}</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded">
                <p class="text-sm text-gray-600">Korban Luka</p>
                <p class="text-2xl font-bold">{{ $totalKorbanLuka }}</p>
            </div>
        </div>

        <h2 class="font-semibold mb-2">Per Jenis Bencana</h2>
        <table class="w-full border-collapse border mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Jenis Bencana</th>
                    <th class="border p-2">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perJenis as $item)
                    <tr>
                        <td class="border p-2">{{ $item->nama_bencana }}</td>
                        <td class="border p-2">{{ $item->total }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="border p-2 text-center">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>

        <h2 class="font-semibold mb-2">Per Periode (Bulanan)</h2>
        <table class="w-full border-collapse border mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Bulan</th>
                    <th class="border p-2">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($perPeriode as $item)
                    <tr>
                        <td class="border p-2">{{ $item->bulan }}</td>
                        <td class="border p-2">{{ $item->total }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="border p-2 text-center">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>

        <h2 class="font-semibold mb-2">Daftar Kejadian</h2>
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Jenis</th>
                    @if ($isAdmin)
                        <th class="border p-2">Lokasi</th>
                    @endif
                    <th class="border p-2">Tanggal</th>
                    @if ($isAdmin)
                        <th class="border p-2">Status</th>
                    @endif
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($daftarKejadian as $item)
                    <tr>
                        <td class="border p-2">{{ $item->jenisBencana->nama_bencana ?? '-' }}</td>
                        @if ($isAdmin)
                            <td class="border p-2">{{ $item->lokasi }}</td>
                        @endif
                        <td class="border p-2">{{ $item->tanggal_kejadian?->format('d M Y') }}</td>
                        @if ($isAdmin)
                            <td class="border p-2">{{ ucfirst($item->status) }}</td>
                            <td class="border p-2">
                                @if ($item->status === 'verified' && $item->kejadianBencana)
                                    <a href="{{ route('kejadian.show', $item->kejadianBencana->id) }}" class="text-blue-600 text-sm">Detail</a>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                        @else
                            <td class="border p-2">
                                <a href="{{ route('kejadian.show', $item->id) }}" class="text-blue-600 text-sm">Detail</a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr><td colspan="{{ $isAdmin ? 5 : 3 }}" class="border p-2 text-center">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $daftarKejadian->links() }}
    </div>
</x-app-layout>