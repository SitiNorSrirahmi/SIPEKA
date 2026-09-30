<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::with('penulis')
            ->latest()
            ->paginate(15);

            return view('admin.berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $berita = Berita::create([
            'judul'  => $validated['judul'],
            'konten' => $validated['konten'],
            'status' => $validated['status'],
            'penulis_id' => Auth::id(),
        ]);

        if ($request->hasFile('gambar')) {
            $berita->addMediaFromRequest('gambar')->toMediaCollection('gambar');
        }

        return redirect()
            ->route('admin.berita.index')
            ->with('success','Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $berita->update([
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
            'status' => $validated['status'],
        ]);

        if ($request->hasFile('gambar')) {
            $berita->clearMediaCollection('gambar'); // hapus gambar lama otomatis
            $berita->addMediaFromRequest('gambar')->toMediaCollection('gambar');
    }

        return redirect()
            ->route('admin.berita.index')
            ->with('success','Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
{
    $berita->delete(); // Media Library otomatis hapus file terkait

    return redirect()
        ->route('admin.berita.index')
        ->with('success', 'Berita berhasil dihapus.');
}

    /**
     * Publik: lihat daftar berita yang sudah published
     */
    public function publikIndex(Request $request)
    {
        $query = Berita::where('status', 'published')->with('penulis');

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', '%' . $keyword . '%')
                  ->orWhere('konten', 'like', '%' . $keyword . '%');
            });
        }

        $berita = $query->latest()->paginate(10)->withQueryString();

        return view('berita.index', compact('berita'));
    }

    /**
     * Publik: lihat detail 1 berita
     */
    public function publikShow(Berita $berita)
    {
        abort_if($berita->status !== 'published', 404);

        return view('berita.show', compact('berita'));
    }
}