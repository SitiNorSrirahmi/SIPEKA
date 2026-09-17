<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Wilayah Rawan Bencana</h1>

        <form method="GET" class="flex gap-3 mb-4">
            <select name="id_bencana" class="border p-2">
                <option value="">Semua Jenis Bencana</option>
                @foreach ($jenisBencana as $jb)
                    <option value="{{ $jb->id }}" @selected(request('id_bencana') == $jb->id)>
                        {{ $jb->nama_bencana }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="kabupaten" placeholder="Cari kabupaten..." class="border p-2" value="{{ request('kabupaten') }}">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Filter</button>
            <a href="{{ route('wilayahrawan.index') }}" class="bg-gray-200 px-4 py-2 rounded text-sm">Reset</a>
        </form>

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Jenis Bencana</th>
                    <th class="border p-2">Kabupaten</th>
                    <th class="border p-2">Level Rawan</th>
                    <th class="border p-2">Sumber Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wilayah as $item)
                    <tr>
                        <td class="border p-2">{{ $item->jenisBencana->nama_bencana ?? '-' }}</td>
                        <td class="border p-2">{{ $item->kabupaten }}</td>
                        <td class="border p-2">{{ ucfirst($item->level_rawan) }}</td>
                        <td class="border p-2">{{ $item->sumber_data ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border p-2 text-center">Belum ada data wilayah rawan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $wilayah->links() }}
    </div>
</x-app-layout>