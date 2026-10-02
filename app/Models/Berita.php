<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Berita extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'konten',
        'status',
        'penulis_id',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gambar')->singleFile();
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}
