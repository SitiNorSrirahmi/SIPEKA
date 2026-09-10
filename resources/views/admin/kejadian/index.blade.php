<x-app-layout>
    <div class="p-6 max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Kelola Data Kejadian Bencana</h1>
            <a href="{{ route('admin.laporan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
            + Tambah Kejadian
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Jenis Bencana</th>
                    <th class="border p-2">Korban</th>
                    <th class="border p-2">Kerugian</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kejadian as $item)
                    <tr>
                        <td class="border p-2">{{ $item->id }}</td>
                        <td class="border p-2">{{ $item->jenisBencana->nama_bencana ?? '-' }}</td>
                        <td class="border p-2">{{ $item->jumlah_korban }}</td>
                        <td class="border p-2">Rp{{ number_format($item->estimasi_kerugian ?? 0, 0, ',', '.') }}</td>
                        <td class="border p-2">{{ $item->tanggal_kejadian?->format('d M Y') }}</td>
                        <td class="border p-2">
                            <a href="{{ route('admin.kejadian.edit', $item->id) }}" class="text-blue-600 text-sm">Edit</a>
                            |
                            <form action="{{ route('admin.kejadian.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border p-2 text-center">Belum ada data kejadian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $kejadian->links() }}
    </div>
</x-app-layout>