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
        Schema::create('wilayah_rawan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bencana')->constrained('jenis_bencana')->onDelete('cascade');
            $table->string('kabupaten');
            $table->string('level_rawan');
            $table->json('geom')->nullable();
            $table->string('sumber_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah_rawan');
    }
};
