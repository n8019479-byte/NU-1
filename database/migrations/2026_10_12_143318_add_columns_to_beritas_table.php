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
    Schema::table('beritas', function (Blueprint $table) {
        if (!Schema::hasColumn('beritas', 'kategori')) {
            $table->string('kategori')->default('BERITA');
        }
        if (!Schema::hasColumn('beritas', 'konten')) {
            $table->text('konten')->nullable();
        }
        if (!Schema::hasColumn('beritas', 'penulis')) {
            $table->string('penulis')->default('Admin Ranting');
        }
        if (!Schema::hasColumn('beritas', 'gambar')) {
            $table->string('gambar')->nullable();
        }
    });
}

public function down(): void
{
    Schema::table('beritas', function (Blueprint $table) {
        $table->dropColumn(['kategori', 'konten', 'penulis', 'gambar']);
    });
}
};
