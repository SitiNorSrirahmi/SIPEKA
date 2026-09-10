<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\KejadianBencana;
use App\Models\JenisBencana;
use Illuminate\Http\Request;


class KejadianBencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kejadian = KejadianBencana::with('jenisBencana')
            ->latest()
            ->paginate(15);
        
            return view('admin.kejadian.index', compact('kejadian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisBencana  = JenisBencana::all();
        return view('admin.kejadian.create', compact('jenisBencana'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_bencana' => 'required|exists:jenis_bencana,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'jumlah_korban' => 'nullable|integer|min:0',
            'estimasi_kerugian' => 'nullable|numeric|min:0',
            'tanggal_kejadian' => 'required|date',
        ]);

        KejadianBencana::create([
            'id_bencana' => $validated['id_bencana'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'jumlah_korban' => $validated['jumlah_korban'] ?? 0,
            'estimasi_kerugian' => $validated['estimasi_kerugian'] ?? null,
            'status_data' => 'published',
            'tanggal_kejadian' => $validated['tanggal_kejadian'],
        ]);

        return redirect()
            ->route('admin.kejadian.index')
            ->with('success', 'Data kejadian bencana berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KejadianBencana $kejadianBencana)
    {
        $kejadianBencana->load('jenisBencana');
        return view('admin.kejadian.show', compact('kejadianBencana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KejadianBencana $kejadianBencana)
    {
        $jenisBencana = JenisBencana::all();
        return view('admin.kejadian.edit', compact('kejadianBencana', 'jenisBencana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KejadianBencana $kejadianBencana)
    {
        $validated = $request->validate([
            'id_bencana' => 'required|exists:jenis_bencana,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'jumlah_korban' => 'nullable|integer|min:0',
            'estimasi_kerugian' => 'nullable|numeric|min:0',
            'tanggal_kejadian' => 'required|date',
        ]);

        $kejadianBencana->update($validated);

        return redirect()
            ->route('admin.kejadian.index')
            ->with('success', 'Data kejadian bencana berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KejadianBencana $kejadianBencana)
    {
         $kejadianBencana->delete();

        return redirect()
            ->route('admin.kejadian.index')
            ->with('success', 'Data kejadian bencana berhasil dihapus.');
    }
}
