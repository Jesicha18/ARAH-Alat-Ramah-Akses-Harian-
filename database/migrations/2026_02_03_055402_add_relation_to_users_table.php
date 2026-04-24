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
    Schema::table('users', function (Blueprint $table) {
        // Kita tambahkan kolom relation (Keluarga/Kerabat)
        // Kita buat nullable karena di awal login (step 1) data ini belum ada
        $table->string('relation')->nullable()->after('email');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Untuk membatalkan perubahan jika diperlukan
        $table->dropColumn('relation');
    });
}
};
