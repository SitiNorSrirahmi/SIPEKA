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
        Schema::create('kejadian_bencana', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->nullable()->constrained('laporan_masuk')->nullOnDelete();
            $table->foreignId('id_bencana')->constrained('jenis_bencana')->onDelete('cascade');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->integer('jumlah_korban')->default(0);
            $table->decimal('estimasi_kerugian', 15, 2)->nullable();
            $table->string('status_data')->default('published');
            $table->dateTime('tanggal_kejadian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadian_bencana');
    }
};
