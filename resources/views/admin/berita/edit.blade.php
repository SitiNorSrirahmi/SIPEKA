<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Edit Berita</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($berita->gambar)
            <img src="{{ Storage::url($berita->gambar) }}" class="w-32 h-32 object-cover rounded mb-3">
        @endif

        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>Judul</label>
            <input type="text" name="judul" class="border w-full mb-3 p-2" value="{{ $berita->judul }}">

            <label>Konten</label>
            <textarea name="konten" rows="6" class="border w-full mb-3 p-2">{{ $berita->konten }}</textarea>

            <label>Ganti Gambar (kosongkan jika tidak diubah)</label>
            <input type="file" name="gambar" class="border w-full mb-3 p-2">

            <label>Status</label>
            <select name="status" class="border w-full mb-3 p-2">
                <option value="draft" @selected($berita->status === 'draft')>Draft</option>
                <option value="published" @selected($berita->status === 'published')>Published</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>