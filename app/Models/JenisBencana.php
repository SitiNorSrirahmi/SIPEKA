<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBencana extends Model
{
    use HasFactory;

    protected $table = 'jenis_bencana';

    protected $fillable = [
        'nama_bencana',
        'deskripsi',
    ];

    public function wilayahRawan()
    {
        return $this->hasMany(WilayahRawan::class, 'id_bencana');
    }

    public function laporanMasuk()
    {
        return $this->hasMany(LaporanMasuk::class, 'id_bencana');
    }

    public function kejadianBencana()
    {
        return $this->hasMany(KejadianBencana::class, 'id_bencana');
    }
}
