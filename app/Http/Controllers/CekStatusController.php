<?php

namespace App\Http\Controllers;

use App\Models\LaporanMasuk;
use Illuminate\Http\Request;

class CekStatusController extends Controller
{
    /**
     * Tampilkan form cek status (kosong, belum ada hasil pencarian)
     */
    public function index()
    {
        return view('cek-status.index');
    }

    /**
     * Cari laporan berdasarkan token yang diinput guest
     */
    public function cari(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $laporan = LaporanMasuk::with('jenisBencana')
            ->where('token', strtoupper(trim($request->token)))
            ->first();

        if (!$laporan) {
            return back()
                ->withInput()
                ->withErrors(['token' => 'Token tidak ditemukan. Periksa kembali kode yang Anda masukkan.']);
        }

        return view('cek-status.index', compact('laporan'));
    }
}