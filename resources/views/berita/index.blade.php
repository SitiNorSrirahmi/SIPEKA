<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Berita & Informasi Kebencanaan</h1>

        <div class="grid gap-4">
            @forelse ($berita as $item)
                <a href="{{ route('berita.show', $item->id) }}" class="block border rounded p-4 hover:bg-gray-50">
                    <div class="flex gap-4">
                        @if ($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" class="w-24 h-24 object-cover rounded">
                        @endif
                        <div>
                            <h2 class="font-semibold text-lg">{{ $item->judul }}</h2>
                            <p class="text-sm text-gray-500">
                                Oleh {{ $item->penulis->name ?? '-' }} · {{ $item->created_at->format('d M Y') }}
                            </p>
                            <p class="text-gray-700 mt-1">
                                {{ Str::limit(strip_tags($item->konten), 120) }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-500">Belum ada berita.</p>
            @endforelse
        </div>

        {{ $berita->links() }}
    </div>
</x-app-layout>