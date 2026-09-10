<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Form Laporan (Testing)</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $actionRoute }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Jenis Bencana</label>
            <select name="id_bencana" class="border w-full mb-3 p-2">
                @foreach ($jenisBencana as $jb)
                    <option value="{{ $jb->id }}">{{ $jb->nama_bencana }}</option>
                @endforeach
            </select>

            <label>Lokasi</label>
            <input type="text" name="lokasi" class="border w-full mb-3 p-2" value="Testing Lokasi">

            <label>Latitude</label>
            <input type="text" name="latitude" class="border w-full mb-3 p-2" value="-3.3194">

            <label>Longitude</label>
            <input type="text" name="longitude" class="border w-full mb-3 p-2" value="114.5908">

            <label>Foto (opsional)</label>
            <input type="file" name="foto" class="border w-full mb-3 p-2">

            <label>Korban Meninggal</label>
            <input type="number" name="jumlah_korban_meninggal" class="border w-full mb-3 p-2" value="0">

            <label>Korban Luka</label>
            <input type="number" name="jumlah_korban_luka" class="border w-full mb-3 p-2" value="0">

            <label>Estimasi Kerugian</label>
            <input type="number" name="estimasi_kerugian" class="border w-full mb-3 p-2">

            <label>Deskripsi</label>
            <textarea name="deskripsi" class="border w-full mb-3 p-2"></textarea>

            @guest
                <label>Nama Pelapor</label>
                <input type="text" name="pelapor_nama" class="border w-full mb-3 p-2" value="Warga Testing">

                <label>No HP Pelapor</label>
                <input type="text" name="pelapor_hp" class="border w-full mb-3 p-2" value="08123456789">
            @endguest

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kirim Laporan</button>
        </form>
    </div>
</x-app-layout>