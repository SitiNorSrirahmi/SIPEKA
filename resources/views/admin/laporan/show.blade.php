<x-app-layout>
    <div class="p-6 max-w-2xl mx-auto">
        <a href="{{ url()->previous() }}" class="text-blue-600 text-sm">&larr; Kembali</a>

        <h1 class="text-xl font-bold mt-3 mb-4">Detail Laporan</h1>

        <div class="bg-white border rounded p-4 space-y-3">
            <div>
                <p class="text-sm text-gray-500">Token</p>
                <p class="font-mono font-semibold">{{ $laporanMasuk->token ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Jenis Bencana</p>
                <p class="font-semibold">{{ $laporanMasuk->jenisBencana->nama_bencana ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Lokasi</p>
                <p class="font-semibold">{{ $laporanMasuk->lokasi }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Koordinat</p>
                <p class="font-semibold">{{ $laporanMasuk->latitude }}, {{ $laporanMasuk->longitude }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Deskripsi</p>
                <p class="font-semibold">{{ $laporanMasuk->deskripsi ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Korban</p>
                <p class="font-semibold">
                    Meninggal: {{ $laporanMasuk->jumlah_korban_meninggal }},
                    Luka: {{ $laporanMasuk->jumlah_korban_luka }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Estimasi Kerugian</p>
                <p class="font-semibold">
                    Rp{{ number_format($laporanMasuk->estimasi_kerugian ?? 0, 0, ',', '.') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tanggal Kejadian</p>
                <p class="font-semibold">{{ $laporanMasuk->tanggal_kejadian?->format('d M Y') }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Foto</p>
                @if ($laporanMasuk->sumber)
                    <img src="{{ Storage::url($laporanMasuk->sumber) }}" class="max-w-sm rounded mt-1">
                    <p class="text-xs text-gray-400 mt-1">Status Geotag: {{ $laporanMasuk->status_geotag }}</p>
                @else
                    <p class="text-gray-400">Tidak ada foto.</p>
                @endif
            </div>

            <div>
                <p class="text-sm text-gray-500">Pelapor</p>
                <p class="font-semibold">
                    {{ $laporanMasuk->pelapor_nama ?? $laporanMasuk->dibuatOleh->name ?? '-' }}
                    @if ($laporanMasuk->pelapor_hp)
                        ({{ $laporanMasuk->pelapor_hp }})
                    @endif
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p class="font-semibold">{{ ucfirst($laporanMasuk->status) }}</p>
            </div>

            @if ($laporanMasuk->status === 'pending')
                <div class="pt-3 flex gap-2">
                    <form action="{{ route('admin.laporan.verifikasi', $laporanMasuk->id) }}" method="POST">
                        @csrf
                        <button class="bg-green-600 text-white px-4 py-2 rounded text-sm">Verifikasi</button>
                    </form>
                    <form action="{{ route('admin.laporan.tolak', $laporanMasuk->id) }}" method="POST">
                        @csrf
                        <button class="bg-red-600 text-white px-4 py-2 rounded text-sm">Tolak</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>