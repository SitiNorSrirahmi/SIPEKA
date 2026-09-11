<x-app-layout>
    <div class="p-6 max-w-3xl mx-auto">
        <a href="{{ route('berita.index') }}" class="text-blue-600 text-sm">&larr; Kembali ke Berita</a>

        <h1 class="text-2xl font-bold mt-3 mb-2">{{ $berita->judul }}</h1>
        <p class="text-sm text-gray-500 mb-4">
            Oleh {{ $berita->penulis->name ?? '-' }} · {{ $berita->created_at->format('d M Y') }}
        </p>

        @if ($berita->gambar)
            <img src="{{ Storage::url($berita->gambar) }}" class="w-full max-h-96 object-cover rounded mb-4">
        @endif

        <div class="prose">
            {!! nl2br(e($berita->konten)) !!}
        </div>
    </div>
</x-app-layout>