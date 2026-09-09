<?php

namespace App\Http\Controllers;

use App\Models\JenisBencana;
use App\Models\LaporanMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanMasukController extends Controller
{
    /**
     * Form pelaporan — bisa diakses Masyarakat (guest) maupun Petugas (login).
     */
    public function create()
    {
        $jenisBencana = JenisBencana::all();
        return view('laporan.create', compact('jenisBencana'));
    }

    /**
     * Simpan laporan baru.
     */
    public function store(Request $request)
    {
        $rules = [
            'id_bencana' => 'required|exists:jenis_bencana,id',
            'lokasi' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'foto' => 'nullable|image|max:5120',
            'jumlah_korban_meninggal' => 'nullable|integer|min:0',
            'jumlah_korban_luka' => 'nullable|integer|min:0',
            'estimasi_kerugian' => 'nullable|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'tanggal_kejadian' => 'nullable|date',
        ];

        // Masyarakat (guest, belum login) wajib isi data diri
        if (!Auth::check()) {
            $rules['pelapor_nama'] = 'required|string|max:255';
            $rules['pelapor_hp'] = 'required|string|max:20';
        }

        $validated = $request->validate($rules);

        // Proses foto & cek geotag EXIF (Opsi 1: cek ada/tidaknya saja)
        $statusGeotag = 'tanpa_foto';
        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fotoPath = $file->store('laporan_foto', 'public');
            $statusGeotag = $this->cekGeotagExif($file->getRealPath());
        }

        // Tentukan status & pemilik laporan berdasarkan siapa yang lapor
        if (Auth::check() && Auth::user()->role === 'petugas') {
            $status = 'verified'; // Petugas -> auto verified & langsung publish
            $dibuatOleh = Auth::id();
            $pelaporNama = null;
            $pelaporHp = null;
        } else {
            $status = 'pending'; // Masyarakat -> masuk antrean verifikasi Admin
            $dibuatOleh = null;
            $pelaporNama = $validated['pelapor_nama'] ?? null;
            $pelaporHp = $validated['pelapor_hp'] ?? null;
        }

        DB::transaction(function () use (
            $validated, $statusGeotag, $fotoPath, $status, $dibuatOleh, $pelaporNama, $pelaporHp
        ) {
            $laporan = LaporanMasuk::create([
                'id_bencana' => $validated['id_bencana'],
                'lokasi' => $validated['lokasi'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'sumber' => $fotoPath,
                'pelapor_nama' => $pelaporNama,
                'pelapor_hp' => $pelaporHp,
                'status_geotag' => $statusGeotag,
                'status' => $status,
                'dibuat_oleh' => $dibuatOleh,
                'jumlah_korban_meninggal' => $validated['jumlah_korban_meninggal'] ?? 0,
                'jumlah_korban_luka' => $validated['jumlah_korban_luka'] ?? 0,
                'estimasi_kerugian' => $validated['estimasi_kerugian'] ?? null,
                'deskripsi' => $validated['deskripsi'] ?? null,
                'tanggal_kejadian' => $validated['tanggal_kejadian'] ?? now(),
            ]);

            // Petugas -> langsung salin ke kejadian_bencana (auto publish)
            if ($status === 'verified') {
                $this->salinKeKejadianBencana($laporan);
            }
        });

        $pesan = $status === 'verified'
            ? 'Laporan berhasil dikirim dan langsung dipublikasikan.'
            : 'Laporan berhasil dikirim, menunggu verifikasi Admin.';

        return redirect()->back()->with('success', $pesan);
    }

    /**
     * Admin: lihat SEMUA laporan (Kelola Laporan) — apapun statusnya.
     */
    public function index()
    {
        $laporan = LaporanMasuk::latest()->paginate(15);
        return view('admin.laporan.index', compact('laporan'));
    }

    /**
     * Petugas: lihat laporan yang mereka buat sendiri.
     */
    public function laporanSaya()
    {
        $laporan = LaporanMasuk::where('dibuat_oleh', Auth::id())
            ->latest()
            ->paginate(10);

        return view('petugas.laporan-saya', compact('laporan'));
    }

    /**
     * Admin: lihat antrean laporan berstatus pending (Verifikasi Laporan Warga).
     */
    public function antrean()
    {
        $laporan = LaporanMasuk::where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.verifikasi-laporan', compact('laporan'));
    }

    /**
     * Admin: setujui laporan -> salin ke kejadian_bencana & publish.
     */
    public function verifikasi(LaporanMasuk $laporanMasuk)
    {
        DB::transaction(function () use ($laporanMasuk) {
            $laporanMasuk->update([
                'status' => 'verified',
                'diverifikasi_oleh' => Auth::id(),
            ]);

            $this->salinKeKejadianBencana($laporanMasuk);
        });

        return redirect()->back()->with('success', 'Laporan berhasil diverifikasi dan dipublikasikan.');
    }

    /**
     * Admin: tolak laporan.
     */
    public function tolak(LaporanMasuk $laporanMasuk)
    {
        $laporanMasuk->update([
            'status' => 'rejected',
            'diverifikasi_oleh' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Laporan ditolak.');
    }

    /**
     * Salin data dari LaporanMasuk (staging) ke KejadianBencana (published).
     * Dipanggil dari store() saat Petugas auto-verified, dan dari verifikasi() saat Admin approve.
     */
    private function salinKeKejadianBencana(LaporanMasuk $laporan): void
    {
        $laporan->kejadianBencana()->create([
            'id_bencana' => $laporan->id_bencana,
            'latitude' => $laporan->latitude,
            'longitude' => $laporan->longitude,
            'jumlah_korban' => $laporan->jumlah_korban_meninggal + $laporan->jumlah_korban_luka,
            'estimasi_kerugian' => $laporan->estimasi_kerugian,
            'status_data' => 'published',
            'tanggal_kejadian' => $laporan->tanggal_kejadian ?? now(),
        ]);
    }

    /**
     * Cek keberadaan EXIF GPS pada foto (Opsi 1 — flag sederhana, tanpa hitung jarak).
     */
    private function cekGeotagExif(string $path): string
    {
        if (!function_exists('exif_read_data')) {
            return 'tidak_didukung';
        }

        $exif = @exif_read_data($path);

        if ($exif !== false && isset($exif['GPSLatitude']) && isset($exif['GPSLongitude'])) {
            return 'ada_geotag';
        }

        return 'tanpa_geotag';
    }
}