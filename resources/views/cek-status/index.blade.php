@extends('layouts.publik')

@section('content')
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Cek Status Laporan</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cek-status.cari') }}" method="POST" class="mb-6">
            @csrf
            <label>Masukkan Token Laporan</label>
            <input type="text" name="token" class="border w-full mb-3 p-2 uppercase" placeholder="Contoh: LRP-A3F9K2" value="{{ old('token') }}">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cek Status</button>
        </form>

        @isset($laporan)
            <div class="border rounded p-4 bg-gray-50">
                <p class="text-sm text-gray-500">Token</p>
                <p class="font-mono font-semibold mb-2">{{ $laporan->token }}</p>

                <p class="text-sm text-gray-500">Jenis Bencana</p>
                <p class="font-semibold mb-2">{{ $laporan->jenisBencana->nama_bencana ?? '-' }}</p>

                <p class="text-sm text-gray-500">Lokasi</p>
                <p class="font-semibold mb-2">{{ $laporan->lokasi }}</p>

                <p class="text-sm text-gray-500">Status</p>
                <p class="font-semibold">
                    @if ($laporan->status === 'pending')
                        <span class="text-yellow-600">Menunggu Verifikasi</span>
                    @elseif ($laporan->status === 'verified')
                        <span class="text-green-600">Terverifikasi & Dipublikasikan</span>
                    @else
                        <span class="text-red-600">Ditolak</span>
                    @endif
                </p>
            </div>
        @endisset
    </div>
@endsection