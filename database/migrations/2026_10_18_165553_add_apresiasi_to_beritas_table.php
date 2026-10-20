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
        $table->integer('apresiasi')->default(0)->after('isi');
    });
}

public function down(): void
{
    Schema::table('beritas', function (Blueprint $table) {
        $table->dropColumn('apresiasi');
    });
}
};
