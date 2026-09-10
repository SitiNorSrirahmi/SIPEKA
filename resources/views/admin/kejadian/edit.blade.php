<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Edit Data Kejadian Bencana</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kejadian.update', $kejadianBencana->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Jenis Bencana</label>
            <select name="id_bencana" class="border w-full mb-3 p-2">
                @foreach ($jenisBencana as $jb)
                    <option value="{{ $jb->id }}" @selected($jb->id === $kejadianBencana->id_bencana)>
                        {{ $jb->nama_bencana }}
                    </option>
                @endforeach
            </select>

            <label>Latitude</label>
            <input type="text" name="latitude" class="border w-full mb-3 p-2" value="{{ $kejadianBencana->latitude }}">

            <label>Longitude</label>
            <input type="text" name="longitude" class="border w-full mb-3 p-2" value="{{ $kejadianBencana->longitude }}">

            <label>Jumlah Korban</label>
            <input type="number" name="jumlah_korban" class="border w-full mb-3 p-2" value="{{ $kejadianBencana->jumlah_korban }}">

            <label>Estimasi Kerugian (Rp)</label>
            <input type="number" name="estimasi_kerugian" class="border w-full mb-3 p-2" value="{{ $kejadianBencana->estimasi_kerugian }}">

            <label>Tanggal Kejadian</label>
            <input type="date" name="tanggal_kejadian" class="border w-full mb-3 p-2" value="{{ $kejadianBencana->tanggal_kejadian?->format('Y-m-d') }}">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>