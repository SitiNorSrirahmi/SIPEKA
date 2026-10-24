<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LaporanMasuk;
use App\Models\KejadianBencana;
use App\Models\Berita;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // ==========================================
        // QUERY STATISTIK GLOBAL (Dipakai Admin & Petugas)
        // ==========================================
        $statTotalKejadian = KejadianBencana::count();
        $statTotalKorbanMeninggal = LaporanMasuk::where('status', 'verified')->sum('jumlah_korban_meninggal');
        $statTotalKorbanLuka = LaporanMasuk::where('status', 'verified')->sum('jumlah_korban_luka');
        $statTotalKerugian = LaporanMasuk::where('status', 'verified')->sum('estimasi_kerugian');

        // Query Grafik Donut (Jenis Bencana) - SUDAH DIPERBAIKI JADI id_bencana
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

        // Query Grafik Batang (Per Bulan)
        $perPeriode = KejadianBencana::select(DB::raw("DATE_FORMAT(tanggal_kejadian, '%Y-%m') as bulan"), DB::raw('count(*) as total'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();


        // ==========================================
        // LOGIKA ROLE
        // ==========================================
        if ($user->hasRole('admin')) {
            
            // ===== DATA DASHBOARD ADMIN =====
            $totalLaporan = LaporanMasuk::count();
            $laporanPending = LaporanMasuk::where('status', 'pending')->count();

            $totalKejadian = KejadianBencana::count();
            $kejadianBulanIni = KejadianBencana::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();

            $totalPengguna = User::count();
            $penggunaAktif = User::where('aktif', true)->count();

            $totalBerita = Berita::count();
            $beritaDraft = Berita::where('status', 'draft')->count();

            $laporanPerluVerifikasi = LaporanMasuk::with('jenisBencana')
                ->where('status', 'pending')
                ->latest()
                ->take(5)
                ->get();

            // ===== AKTIVITAS SISTEM =====
            $aktivitas = collect();
            LaporanMasuk::with(['jenisBencana', 'diverifikasiOleh'])
                ->whereNotNull('diverifikasi_oleh')
                ->latest('updated_at')
                ->take(5)
                ->get()
                ->each(function ($item) use ($aktivitas) {
                    $aktivitas->push([
                        'tipe' => 'verifikasi',
                        'waktu' => $item->updated_at,
                        'nama' => $item->diverifikasiOleh->name ?? 'Admin',
                        'jenis' => $item->jenisBencana->nama_bencana ?? '-',
                        'warna' => 'green',
                    ]);
                });

            LaporanMasuk::with(['jenisBencana', 'dibuatOleh'])
                ->latest()
                ->take(5)
                ->get()
                ->each(function ($item) use ($aktivitas) {
                    $aktivitas->push([
                        'tipe' => 'laporan',
                        'waktu' => $item->created_at,
                        'nama' => $item->dibuatOleh->name ?? 'Petugas',
                        'jenis' => $item->jenisBencana->nama_bencana ?? '-',
                        'warna' => 'blue',
                    ]);
                });

            User::latest()
                ->take(5)
                ->get()
                ->each(function ($item) use ($aktivitas) {
                    $aktivitas->push([
                        'tipe' => 'pengguna',
                        'waktu' => $item->created_at,
                        'nama' => $item->name,
                        'jenis' => null,
                        'warna' => 'purple',
                    ]);
                });
            $aktivitas = $aktivitas->sortByDesc('waktu')->take(10);

            // Ambil daftar kejadian untuk Admin
            $isAdmin = true;
            $daftarKejadian = LaporanMasuk::with(['jenisBencana', 'kejadianBencana'])->latest()->paginate(10);

            return view('admin.dashboard', compact(
                'totalLaporan', 'laporanPending', 'totalKejadian', 'kejadianBulanIni', 'totalPengguna', 'penggunaAktif', 'totalBerita', 'beritaDraft', 'laporanPerluVerifikasi', 'aktivitas',
                'statTotalKejadian', 'statTotalKorbanMeninggal', 'statTotalKorbanLuka', 'statTotalKerugian',
                'perJenis', 'perPeriode', 'daftarKejadian', 'isAdmin'
            ));

        } elseif ($user->hasRole('petugas')) {

            // ===== STATISTIK LAPORAN PETUGAS =====
            $totalLaporan = LaporanMasuk::where('dibuat_oleh', $user->id)->count();
            $totalVerified = LaporanMasuk::where('dibuat_oleh', $user->id)->where('status', 'verified')->count();
            $totalPending = LaporanMasuk::where('dibuat_oleh', $user->id)->where('status', 'pending')->count();
            $totalRejected = LaporanMasuk::where('dibuat_oleh', $user->id)->where('status', 'rejected')->count();

            // ===== STATISTIK GLOBAL =====
            $totalKejadian = KejadianBencana::where('status_data', 'published')->count();
            $totalBerita = Berita::where('status', 'published')->count();

            // ===== LAPORAN TERBARU PETUGAS =====
            $laporanTerbaru = LaporanMasuk::where('dibuat_oleh', $user->id)
                ->with('jenisBencana')
                ->latest()
                ->take(5)
                ->get();

            // Khusus Petugas: Ambil daftar kejadian (yang published)
            $isAdmin = false;
            $daftarKejadian = KejadianBencana::with(['jenisBencana', 'laporanMasuk'])
                ->where('status_data', 'published')
                ->latest()
                ->paginate(10);

            return view('petugas.dashboard', compact(
                'totalLaporan', 'totalVerified', 'totalPending', 'totalRejected',
                'totalKejadian', 'totalBerita', 'laporanTerbaru',
                'statTotalKejadian', 'statTotalKorbanMeninggal', 'statTotalKorbanLuka', 'statTotalKerugian',
                'perJenis', 'perPeriode', 'daftarKejadian', 'isAdmin'
            ));
        }

        // Jaga-jaga jika role tidak ada
        Auth::logout();
        return redirect('/login');
    }
}

// Helper: time ago
if (!function_exists('timeAgo')) {
    function timeAgo($date) {
        if (!$date) return 'Baru saja';
        $diff = now()->diffInMinutes($date);
        if ($diff < 1) return 'Baru saja';
        if ($diff < 60) return $diff . ' menit lalu';
        if ($diff < 1440) return floor($diff / 60) . ' jam lalu';
        if ($diff < 43200) return floor($diff / 1440) . ' hari lalu';
        return $date->format('d M Y');
    }
}