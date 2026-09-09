<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Verifikasi Laporan (Testing)</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Lokasi</th>
                    <th class="border p-2">Pelapor</th>
                    <th class="border p-2">Korban</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                    <tr>
                        <td class="border p-2">{{ $item->id }}</td>
                        <td class="border p-2">{{ $item->lokasi }}</td>
                        <td class="border p-2">{{ $item->pelapor_nama ?? '-' }}</td>
                        <td class="border p-2">
                            Meninggal: {{ $item->jumlah_korban_meninggal }},
                            Luka: {{ $item->jumlah_korban_luka }}
                        </td>
                        <td class="border p-2">{{ $item->status }}</td>
                        <td class="border p-2">
                            <form action="{{ route('admin.laporan.verifikasi', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button class="bg-green-600 text-white px-2 py-1 rounded text-sm">Verifikasi</button>
                            </form>
                            <form action="{{ route('admin.laporan.tolak', $item->id) }}" method="POST" class="inline">
                                @csrf
                                <button class="bg-red-600 text-white px-2 py-1 rounded text-sm">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border p-2 text-center">Tidak ada laporan pending.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $laporan->links() }}
    </div>
</x-app-layout>