<?php

namespace App\Http\Controllers;

use App\Models\WilayahRawan;
use App\Models\JenisBencana;
use Illuminate\Http\Request;

class WilayahRawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wilayah = WilayahRawan::with('jenisBencana')
            ->latest()
            ->paginate(15);

        return view('admin.wilayah.index', compact('wilayah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisBencana = JenisBencana::all();
        return view('admin.wilayah.create', compact('jenisBencana'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_bencana' => 'required|exists:jenis_bencana,id',
            'kabupaten' => 'required|string|max:255',
            'level_rawan' => 'required|in:rendah,sedang,tinggi',
            'geom' => 'required|json',
            'sumber_data' => 'nullable|string|max:255',
        ]);

        WilayahRawan::create([
            'id_bencana' => $validated['id_bencana'],
            'kabupaten' => $validated['kabupaten'],
            'level_rawan' => $validated['level_rawan'],
            'geom' => json_decode($validated['geom'], true),
            'sumber_data' => $validated['sumber_data'] ?? null,
        ]);

        return redirect()
            ->route('admin.wilayah.index')
            ->with('success', 'Data wilayah rawan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WilayahRawan $wilayahRawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WilayahRawan $wilayahRawan)
    {
        $jenisBencana = JenisBencana::all();
        return view('admin.wilayah.edit', compact('wilayahRawan', 'jenisBencana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WilayahRawan $wilayahRawan)
    {
        $validated = $request->validate([
            'id_bencana' => 'required|exists:jenis_bencana,id',
            'kabupaten' => 'required|string|max:255',
            'level_rawan' => 'required|in:rendah,sedang,tinggi',
            'geom' => 'required|json',
            'sumber_data' => 'nullable|string|max:255',
        ]);

        $wilayahRawan->update([
            'id_bencana' => $validated['id_bencana'],
            'kabupaten' => $validated['kabupaten'],
            'level_rawan' => $validated['level_rawan'],
            'geom' => json_decode($validated['geom'], true),
            'sumber_data' => $validated['sumber_data'] ?? null,
        ]);

        return redirect()
            ->route('admin.wilayah.index')
            ->with('success', 'Data wilayah rawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WilayahRawan $wilayahRawan)
    {
        $wilayahRawan->delete();

        return redirect()
            ->route('admin.wilayah.index')
            ->with('success', 'Data wilayah rawan berhasil dihapus.');
            
    }
}
