<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KejadianBencana extends Model
{
    use HasFactory;

    protected $table = 'kejadian_bencana';

    protected $fillable = [
        'laporan_id',
        'id_bencana',
        'latitude',
        'longitude',
        'jumlah_korban',
        'estimasi_kerugian',
        'status_data',
        'tanggal_kejadian',
    ];

     protected $casts = [
        'tanggal_kejadian' => 'datetime',
    ];

    public function jenisBencana()
    {
        return $this->belongsTo(JenisBencana::class, 'id_bencana');
    }

    public function laporanMasuk()
    {
        return $this->belongsTo(LaporanMasuk::class, 'laporan_id');
    }
}
