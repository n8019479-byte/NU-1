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
    Schema::create('kegiatans', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('kategori')->default('Umum'); // Pengajian, Hadroh, Musyawarah, dll.
        $table->date('tanggal');
        $table->string('waktu')->default('09:00 WIB - Selesai');
        $table->string('lokasi')->default('Kantor Ranting NU Kedungurang');
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
