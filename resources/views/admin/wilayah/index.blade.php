<x-app-layout>
    <div class="p-6 max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Kelola Wilayah Rawan Bencana</h1>
            <a href="{{ route('admin.wilayah.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                + Tambah Wilayah Rawan
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
                    <th class="border p-2">Kabupaten</th>
                    <th class="border p-2">Level Rawan</th>
                    <th class="border p-2">Sumber Data</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wilayah as $item)
                    <tr>
                        <td class="border p-2">{{ $item->id }}</td>
                        <td class="border p-2">{{ $item->jenisBencana->nama_bencana ?? '-' }}</td>
                        <td class="border p-2">{{ $item->kabupaten }}</td>
                        <td class="border p-2">{{ ucfirst($item->level_rawan) }}</td>
                        <td class="border p-2">{{ $item->sumber_data ?? '-' }}</td>
                        <td class="border p-2">
                            <a href="{{ route('admin.wilayah.edit', $item->id) }}" class="text-blue-600 text-sm">Edit</a>
                            |
                            <form action="{{ route('admin.wilayah.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border p-2 text-center">Belum ada data wilayah rawan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $wilayah->links() }}
    </div>
</x-app-layout>