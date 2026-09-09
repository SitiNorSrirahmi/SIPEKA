<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_masuk', function (Blueprint $table) {
            $table->integer('jumlah_korban_meninggal')->default(0)->after('status_geotag');
            $table->integer('jumlah_korban_luka')->default(0)->after('jumlah_korban_meninggal');
            $table->decimal('estimasi_kerugian', 15, 2)->nullable()->after('jumlah_korban_luka');
            $table->text('deskripsi')->nullable()->after('estimasi_kerugian');
            $table->dateTime('tanggal_kejadian')->nullable()->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('laporan_masuk', function (Blueprint $table) {
            $table->dropColumn([
                'jumlah_korban_meninggal',
                'jumlah_korban_luka',
                'estimasi_kerugian',
                'deskripsi',
                'tanggal_kejadian',
            ]);
        });
    }
};