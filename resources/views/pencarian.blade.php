@extends('layouts.publik')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Hasil Pencarian: "{{ $keyword }}"</h1>

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Jenis Bencana</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Korban</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hasil as $item)
                    <tr>
                        <td class="border p-2">{{ $item->jenisBencana->nama_bencana ?? '-' }}</td>
                        <td class="border p-2">{{ $item->tanggal_kejadian?->format('d M Y') }}</td>
                        <td class="border p-2">{{ $item->jumlah_korban }}</td>
                        <td class="border p-2">
                            <a href="{{ route('kejadian.show', $item->id) }}" class="text-blue-600 text-sm">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border p-2 text-center">Tidak ditemukan hasil untuk "{{ $keyword }}".</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $hasil->links() }}
    </div>
@endsection