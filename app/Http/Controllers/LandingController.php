<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KejadianBencana;
use App\Models\LaporanMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Jangan lupa import DB

class LandingController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. DATA YANG UDAH ADA (Card Atas)
        // ==========================================
        $totalKejadian = KejadianBencana::where('status_data', 'published')->count();

        $totalKorbanMeninggal = LaporanMasuk::where('status', 'verified')
            ->sum('jumlah_korban_meninggal');

        $totalKorbanLuka = LaporanMasuk::where('status', 'verified')
            ->sum('jumlah_korban_luka');

        $totalKerugian = LaporanMasuk::where('status', 'verified')
            ->sum('estimasi_kerugian');

        $beritaTerbaru = Berita::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        // ==========================================
        // 2. DATA STATISTIK BARU (Grafik & Tabel)
        // ==========================================
        $statTotalKejadian = $totalKejadian;
        $statTotalKorbanMeninggal = $totalKorbanMeninggal;
        $statTotalKorbanLuka = $totalKorbanLuka;
        $statTotalKerugian = $totalKerugian;

        $perJenis = KejadianBencana::select('id_bencana', DB::raw('count(*) as total'))
            ->with('jenisBencana')
            ->groupBy('id_bencana')
            ->get()
            ->map(function($item) {
                return (object) [
                    'nama_bencana' => $item->jenisBencana->nama_bencana ?? '-',
                    'total' => $item->total
                ];
            });

        $perPeriode = KejadianBencana::select(DB::raw("DATE_FORMAT(tanggal_kejadian, '%Y-%m') as bulan"), DB::raw('count(*) as total'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $isAdmin = false;
        $daftarKejadian = KejadianBencana::with(['jenisBencana', 'laporanMasuk'])
            ->where('status_data', 'published')
            ->latest()
            ->paginate(10);

        // ==========================================
        // 3. KIRIM SEMUA KE VIEW
        // ==========================================
        return view('welcome', compact(
            'totalKejadian',
            'totalKorbanMeninggal',
            'totalKorbanLuka',
            'totalKerugian',
            'beritaTerbaru',
            // Variabel tambahan buat statistik
            'statTotalKejadian',
            'statTotalKorbanMeninggal',
            'statTotalKorbanLuka',
            'statTotalKerugian',
            'perJenis',
            'perPeriode',
            'daftarKejadian',
            'isAdmin'
        ));
    }

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