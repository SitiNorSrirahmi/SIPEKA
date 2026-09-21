<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LaporanMasuk;
use App\Models\KejadianBencana;
use App\Models\Berita;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Cek rolenya
        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role === 'petugas') {

            // ===== STATISTIK LAPORAN PETUGAS =====
            $totalLaporan = LaporanMasuk::where('dibuat_oleh', $user->id)->count();

            $totalVerified = LaporanMasuk::where('dibuat_oleh', $user->id)
                ->where('status', 'verified')
                ->count();

            $totalPending = LaporanMasuk::where('dibuat_oleh', $user->id)
                ->where('status', 'pending')
                ->count();

            $totalRejected = LaporanMasuk::where('dibuat_oleh', $user->id)
                ->where('status', 'rejected')
                ->count();

            // ===== STATISTIK GLOBAL =====
            $totalKejadian = KejadianBencana::where('status_data', 'published')->count();
            $totalBerita = Berita::where('status', 'published')->count();

            // ===== LAPORAN TERBARU PETUGAS =====
            $laporanTerbaru = LaporanMasuk::where('dibuat_oleh', $user->id)
                ->with('jenisBencana')
                ->latest()
                ->take(5)
                ->get();

            return view('petugas.dashboard', compact(
                'totalLaporan',
                'totalVerified',
                'totalPending',
                'totalRejected',
                'totalKejadian',
                'totalBerita',
                'laporanTerbaru'
            ));
        }

        // Jaga-jaga jika role tidak ada
        Auth::logout();
        return redirect('/login');
    }
}