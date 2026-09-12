<x-app-layout>
    <div class="p-6 max-w-2xl mx-auto">
        <a href="{{ url()->previous() }}" class="text-blue-600 text-sm">&larr; Kembali</a>

        <h1 class="text-xl font-bold mt-3 mb-4">Detail Kejadian Bencana</h1>

        <div class="bg-white border rounded p-4 space-y-3">
            <div>
                <p class="text-sm text-gray-500">Jenis Bencana</p>
                <p class="font-semibold">{{ $kejadianBencana->jenisBencana->nama_bencana ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Lokasi (Koordinat)</p>
                <p class="font-semibold">{{ $kejadianBencana->latitude }}, {{ $kejadianBencana->longitude }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Jumlah Korban</p>
                <p class="font-semibold">{{ $kejadianBencana->jumlah_korban }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Estimasi Kerugian</p>
                <p class="font-semibold">
                    Rp{{ number_format($kejadianBencana->estimasi_kerugian ?? 0, 0, ',', '.') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tanggal Kejadian</p>
                <p class="font-semibold">{{ $kejadianBencana->tanggal_kejadian?->format('d M Y') }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p class="font-semibold">{{ ucfirst($kejadianBencana->status_data) }}</p>
            </div>
        </div>
    </div>
</x-app-layout>