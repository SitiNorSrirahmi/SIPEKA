<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Edit Wilayah Rawan Bencana</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.wilayah.update', $wilayahRawan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Jenis Bencana</label>
            <select name="id_bencana" class="border w-full mb-3 p-2">
                @foreach ($jenisBencana as $jb)
                    <option value="{{ $jb->id }}" @selected($jb->id === $wilayahRawan->id_bencana)>
                        {{ $jb->nama_bencana }}
                    </option>
                @endforeach
            </select>

            <label>Kabupaten/Kota</label>
            <input type="text" name="kabupaten" class="border w-full mb-3 p-2" value="{{ $wilayahRawan->kabupaten }}">

            <label>Level Kerawanan</label>
            <select name="level_rawan" class="border w-full mb-3 p-2">
                <option value="rendah" @selected($wilayahRawan->level_rawan === 'rendah')>Rendah</option>
                <option value="sedang" @selected($wilayahRawan->level_rawan === 'sedang')>Sedang</option>
                <option value="tinggi" @selected($wilayahRawan->level_rawan === 'tinggi')>Tinggi</option>
            </select>

            <label>Data Polygon (GeoJSON)</label>
            <textarea name="geom" rows="6" class="border w-full mb-3 p-2 font-mono text-sm">{{ json_encode($wilayahRawan->geom) }}</textarea>

            <label>Sumber Data</label>
            <input type="text" name="sumber_data" class="border w-full mb-3 p-2" value="{{ $wilayahRawan->sumber_data }}">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>