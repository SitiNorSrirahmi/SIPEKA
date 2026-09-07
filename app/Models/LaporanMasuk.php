<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMasuk extends Model
{
    use HasFactory;

    protected $table = 'laporan_masuk';

    protected $fillable = [
        'id_bencana',
        'lokasi',
        'latitude',
        'longitude',
        'sumber',
        'pelapor_nama',
        'pelapor_hp',
        'status_geotag',
        'status',
        'dibuat_oleh',
        'diverifikasi_oleh',
    ];

    public function jenisBencana()
    {
        return $this->belongsTo(JenisBencana::class, 'dibuat_oleh');
    }

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function diverifikasiOleh()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    public function kejadianBencana()
    {
        return $this->hasOne(KejadianBencana::class, 'laporan_id');
    }

}
