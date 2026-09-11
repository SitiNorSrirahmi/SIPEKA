<x-app-layout>
    <div class="p-6 max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Kelola Berita</h1>
            <a href="{{ route('admin.berita.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                + Tambah Berita
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
                    <th class="border p-2">Gambar</th>
                    <th class="border p-2">Judul</th>
                    <th class="border p-2">Penulis</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($berita as $item)
                    <tr>
                        <td class="border p-2">
                            @if ($item->gambar)
                                <img src="{{ Storage::url($item->gambar) }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-400 text-sm">Tidak ada</span>
                            @endif
                        </td>
                        <td class="border p-2">{{ $item->judul }}</td>
                        <td class="border p-2">{{ $item->penulis->name ?? '-' }}</td>
                        <td class="border p-2">
                            <span class="{{ $item->status === 'published' ? 'text-green-600' : 'text-gray-500' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="border p-2">
                            <a href="{{ route('admin.berita.edit', $item->id) }}" class="text-blue-600 text-sm">Edit</a>
                            |
                            <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border p-2 text-center">Belum ada berita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $berita->links() }}
    </div>
</x-app-layout>