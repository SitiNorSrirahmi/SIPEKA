<?php

namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\LaporanMasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    /**
     * Halaman statistik yang bisa diakses semua orang
     */

    public function index(Request $request)
    {
        $totalKejadian = KejadianBencana::where('status_data', 'published')->count();

        $perJenis = KejadianBencana::where('status_data', 'published' )
            ->join('jenis_bencana', 'kejadian_bencana.id_bencana', '=', 'jenis_bencana.id')
            ->selectRaw('jenis_bencana.nama_bencana, COUNT(*) as total')
            ->groupBy('jenis_bencana.nama_bencana')
            ->orderByDesc('total')
            ->get();
        
        $perPeriode = KejadianBencana::where('status_data', 'published')
            ->selectRaw('DATE_FORMAT(tanggal_kejadian, "%Y-%m") as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        
        $totalKorbanMeninggal = LaporanMasuk::where('status', 'verified')
            ->sum('jumlah_korban_meninggal');
        
        $totalKorbanLuka = LaporanMasuk::where('status', 'verified')
            ->sum('jumlah_korban_luka');
        
        $totalKerugian = LaporanMasuk::where('status', 'verified')
            ->sum('estimasi_kerugian');

        $isAdmin = Auth::check() && Auth::user()->role== 'admin';

        if ($isAdmin) {
            $daftarKejadian = LaporanMasuk::with('jenisBencana', 'kejadianBencana')
                ->latest()
                ->paginate(10);
        } else {
            $daftarKejadian = KejadianBencana::with('jenisBencana')
                ->where('status_data', 'published')
                ->latest()
                ->paginate(10);
        }

        return view('statistik.index', compact(
            'totalKejadian',
            'perJenis',
            'perPeriode',
            'totalKorbanMeninggal',
            'totalKorbanLuka',
            'totalKerugian',
            'daftarKejadian',
            'isAdmin'
        ));
    }
}
