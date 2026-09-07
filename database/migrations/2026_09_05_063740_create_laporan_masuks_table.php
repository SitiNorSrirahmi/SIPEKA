<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_masuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bencana')->constrained('jenis_bencana')->onDelete('cascade');
            $table->string('lokasi');
            $table->decimal('latitude', 10,7);
            $table->decimal('longitude', 10,7);
            $table->string('sumber')->nullable();
            $table->string('pelapor_nama')->nullable();
            $table->string('pelapor_hp')->nullable();
            $table->string('status_geotag')->nullable(); // hasil validasi geotag foto
            $table->string('status')->default('pending'); // pending, verified, rejected
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_masuk');
    }
};
