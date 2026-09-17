<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KejadianBencana;
use App\Models\LaporanMasuk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $totalKejadian = KejadianBencana::where('status_data', 'published')->count();

        $totalKorbanMeninggal = LaporanMasuk::where('status', 'verified')
            ->sum('jumlah_korban_meninggal');

        $totalKorbanLuka = LaporanMasuk::where('status', 'verified')
            ->sum('jumlah_korban_luka');

        $totalKerugian = KejadianBencana::where('status_data', 'published')
            ->sum('estimasi_kerugian');

        $beritaTerbaru = Berita::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact(
            'totalKejadian',
            'totalKorbanMeninggal',
            'totalKorbanLuka',
            'totalKerugian',
            'beritaTerbaru'
        ));
    }

    /**
     * Pencarian dari landing page — cari berdasarkan lokasi atau nama jenis bencana
     */
    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
        ]);

        $keyword = $request->keyword;

        $hasil = KejadianBencana::with('jenisBencana')
            ->where('status_data', 'published')
            ->where(function ($query) use ($keyword) {
                $query->whereHas('jenisBencana', function ($q) use ($keyword) {
                    $q->where('nama_bencana', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('laporanMasuk', function ($q) use ($keyword) {
                    $q->where('lokasi', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(15);

        return view('pencarian', compact('hasil', 'keyword'));
    }
}