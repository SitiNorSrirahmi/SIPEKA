@extends('layouts.publik')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-2">SIPEKA</h1>
        <p class="text-gray-600 mb-6">Sistem Informasi Peta Kebencanaan Kalimantan Selatan</p>

        <form action="{{ route('pencarian.index') }}" method="GET" class="mb-4">
            <input type="text" name="keyword" placeholder="Cari lokasi atau jenis bencana..." class="border p-2 w-64">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Cari</button>
        </form>
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded">
                <p class="text-sm text-gray-600">Total Kejadian</p>
                <p class="text-2xl font-bold">{{ $totalKejadian }}</p>
            </div>
            <div class="bg-red-50 p-4 rounded">
                <p class="text-sm text-gray-600">Korban Meninggal</p>
                <p class="text-2xl font-bold">{{ $totalKorbanMeninggal }}</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded">
                <p class="text-sm text-gray-600">Korban Luka</p>
                <p class="text-2xl font-bold">{{ $totalKorbanLuka }}</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded">
                <p class="text-sm text-gray-600">Kerugian</p>
                <p class="text-2xl font-bold">Rp{{ number_format($totalKerugian, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="flex gap-3 mb-6">
            <a href="{{ route('laporan.create') }}" class="bg-red-600 text-white px-4 py-2 rounded text-sm">
                Laporkan Kejadian
            </a>
            <a href="{{ route('cek-status.index') }}" class="bg-gray-200 px-4 py-2 rounded text-sm">
                Cek Status Laporan
            </a>
        </div>

        <h2 class="font-semibold mb-2">Berita Terbaru</h2>
        <div class="grid gap-3 mb-4">
            @forelse ($beritaTerbaru as $item)
            <a href="{{ route('berita.show', $item->id) }}" class="block border rounded p-3 hover:bg-gray-50">
                <p class="font-semibold">{{ $item->judul }}</p>
                <p class="text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</p>
            </a>
            @empty
            <p class="text-gray-500">Belum ada berita.</p>
            @endforelse
        </div>
        <a href="{{ route('berita.index') }}" class="text-blue-600 text-sm">Lihat Semua Berita &rarr;</a>

        <div class="mt-6">
            <a href="{{ route('wilayahrawan.index') }}" class="text-blue-600 text-sm">Lihat Wilayah Rawan &rarr;</a>
        </div>
    </div>
@endsection