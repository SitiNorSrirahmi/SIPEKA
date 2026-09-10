<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Tambah Wilayah Rawan Bencana</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.wilayah.store') }}" method="POST">
            @csrf

            <label>Jenis Bencana</label>
            <select name="id_bencana" class="border w-full mb-3 p-2">
                @foreach ($jenisBencana as $jb)
                    <option value="{{ $jb->id }}">{{ $jb->nama_bencana }}</option>
                @endforeach
            </select>

            <label>Kabupaten/Kota</label>
            <input type="text" name="kabupaten" class="border w-full mb-3 p-2" placeholder="Contoh: Kabupaten Banjar">

            <label>Level Kerawanan</label>
            <select name="level_rawan" class="border w-full mb-3 p-2">
                <option value="rendah">Rendah</option>
                <option value="sedang">Sedang</option>
                <option value="tinggi">Tinggi</option>
            </select>

            <label>Data Polygon (GeoJSON) — testing manual dulu</label>
            <textarea name="geom" rows="6" class="border w-full mb-3 p-2 font-mono text-sm" placeholder='{"type":"Polygon","coordinates":[[[114.59,-3.31],[114.60,-3.32],[114.58,-3.33],[114.59,-3.31]]]}'></textarea>

            <label>Sumber Data</label>
            <input type="text" name="sumber_data" class="border w-full mb-3 p-2" placeholder="Contoh: BPBD Kalsel 2024">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>