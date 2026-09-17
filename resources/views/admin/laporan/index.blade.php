<x-app-layout>
    <div class="p-6 max-w-5xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Kelola Laporan</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Token</th>
                    <th class="border p-2">Jenis Bencana</th>
                    <th class="border p-2">Lokasi</th>
                    <th class="border p-2">Pelapor</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                    <tr>
                        <td class="border p-2 font-mono text-sm">{{ $item->token ?? '-' }}</td>
                        <td class="border p-2">{{ $item->jenisBencana->nama_bencana ?? '-' }}</td>
                        <td class="border p-2">{{ $item->lokasi }}</td>
                        <td class="border p-2">{{ $item->pelapor_nama ?? $item->dibuatOleh->name ?? '-' }}</td>
                        <td class="border p-2">
                            @if ($item->status === 'pending')
                                <span class="text-yellow-600">Menunggu</span>
                            @elseif ($item->status === 'verified')
                                <span class="text-green-600">Terverifikasi</span>
                            @else
                                <span class="text-red-600">Ditolak</span>
                            @endif
                        </td>
                        <td class="border p-2">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="border p-2">
                            <a href="{{ route('admin.laporan.show', $item->id) }}" class="text-blue-600 text-sm">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border p-2 text-center">Belum ada laporan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $laporan->links() }}
    </div>
</x-app-layout>