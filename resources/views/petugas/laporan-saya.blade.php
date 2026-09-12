<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Laporan Saya</h1>
            <a href="{{ route('petugas.laporan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                + Buat Laporan
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
                    <th class="border p-2">Jenis Bencana</th>
                    <th class="border p-2">Lokasi</th>
                    <th class="border p-2">Korban</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $item)
                    <tr>
                        <td class="border p-2">{{ $item->jenisBencana->nama_bencana ?? '-' }}</td>
                        <td class="border p-2">{{ $item->lokasi }}</td>
                        <td class="border p-2">
                            Meninggal: {{ $item->jumlah_korban_meninggal }},
                            Luka: {{ $item->jumlah_korban_luka }}
                        </td>
                        <td class="border p-2">
                            <span class="{{ $item->status === 'verified' ? 'text-green-600' : 'text-gray-500' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="border p-2">{{ $item->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border p-2 text-center">Kamu belum membuat laporan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $laporan->links() }}
    </div>
</x-app-layout>