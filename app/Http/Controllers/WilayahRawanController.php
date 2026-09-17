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
    public function index(Request $request)
    {
        $query = WilayahRawan::with('jenisBencana');

        if ($request->filled('kabupaten')) {
            $query->where('kabupaten', 'like', '%' . $request->kabupaten . '%');
        }

        if ($request->filled('id_bencana')) {
            $query->where('id_bencana', $request->id_bencana);
        }

        $wilayah = $query->latest()->paginate(15)->withQueryString();

        $jenisBencana = JenisBencana::all();

        return view('admin.wilayah.index', compact('wilayah', 'jenisBencana'));
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

        /**
     * Halaman publik — bisa diakses Admin, Petugas, dan Masyarakat (guest)
     */
    public function publikIndex(Request $request)
    {
        $query = WilayahRawan::with('jenisBencana');

        if ($request->filled('kabupaten')) {
            $query->where('kabupaten', 'like', '%' . $request->kabupaten . '%');
        }

        if ($request->filled('id_bencana')) {
            $query->where('id_bencana', $request->id_bencana);
        }

        $wilayah = $query->latest()->paginate(15)->withQueryString();

        $jenisBencana = JenisBencana::all();

        return view('wilayahrawan.index', compact('wilayah', 'jenisBencana'));
    }
        /**
     * Endpoint publik — return data wilayah rawan dalam format JSON untuk peta (Leaflet.js)
     */
    public function apiIndex(Request $request)
    {
        $query = WilayahRawan::with('jenisBencana');

        if ($request->filled('id_bencana')) {
            $query->where('id_bencana', $request->id_bencana);
        }

        $wilayah = $query->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'jenis_bencana' => $item->jenisBencana->nama_bencana ?? '-',
                'kabupaten' => $item->kabupaten,
                'level_rawan' => $item->level_rawan,
                'geom' => $item->geom,
            ];
        });

        return response()->json($wilayah);
    }
}
