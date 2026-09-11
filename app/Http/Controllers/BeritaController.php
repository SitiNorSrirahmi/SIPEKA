<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create([
            'judul'  => $validated['judul'],
            'konten' => $validated['konten'],
            'gambar' => $gambarPath,
            'status' => $validated['status'],
            'penulis_id' => Auth::id(),
        ]);

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

        $gambarPath = $berita->gambar;

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update([
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
            'gambar' => $gambarPath,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.berita.index')
            ->with('success','Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        if ($berita->gambar){
            Storage::disk('public')->delete($berita->gambar);
        }
        
        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Publik: lihat daftar berita yang sudah published
     */
    public function publikIndex()
    {
        $berita = Berita::where('status', 'published')
            ->with('penulis')
            ->latest()
            ->paginate(10);

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
