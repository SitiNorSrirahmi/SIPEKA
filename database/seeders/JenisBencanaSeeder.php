<?php

namespace Database\Seeders;

use App\Models\JenisBencana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_bencana' => 'Banjir',
                'deskripsi' => 'Genangan air yang meluas akibat luapan sungai atau curah hujan tinggi.',
            ],
            [
                'nama_bencana' => 'Karhutla',
                'deskripsi' => 'Kebakaran hutan dan Lahan',
            ],
        ];

        foreach ($data as $item) {
            JenisBencana::create($item);
        }
    }
}