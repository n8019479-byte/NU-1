<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jamaahs', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('nik')->unique();
    $table->string('email')->unique();
    $table->string('whatsapp');
    $table->string('banom');
    $table->string('tempat_lahir')->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('jenis_kelamin')->nullable();
    $table->string('rt_rw');
    $table->string('nomor_kartanu')->unique()->nullable();
    $table->string('foto')->nullable();
    $table->string('verification_code')->nullable();
    $table->boolean('is_approved')->default(false); // Status persetujuan Admin (0 = Pending, 1 = Approved)
    $table->timestamp('verified_at')->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('jamaahs');
    }
};