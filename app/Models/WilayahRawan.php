<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahRawan extends Model
{
    use HasFactory;

    protected $table = 'wilayah_rawan';

    protected $fillable = [
        'id_bencana',
        'kabupaten',
        'level_rawan',
        'geom',
        'sumber_data',
    ];

    protected $casts =[
        'geom' => 'array',
    ];

    public function jenisBencana()
    {
        return $this->belongsTo(JenisBencana::class, 'id_bencana');
    }
}
