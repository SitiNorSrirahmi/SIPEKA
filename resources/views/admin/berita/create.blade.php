<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Tambah Berita</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Judul</label>
            <input type="text" name="judul" class="border w-full mb-3 p-2">

            <label>Konten</label>
            <textarea name="konten" rows="6" class="border w-full mb-3 p-2"></textarea>

            <label>Gambar (opsional)</label>
            <input type="file" name="gambar" class="border w-full mb-3 p-2">

            <label>Status</label>
            <select name="status" class="border w-full mb-3 p-2">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>