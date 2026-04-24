<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel.
     */
    public function up(): void
    {
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->id();
            $table->string('device_id');    // Untuk nama alat (misal: ARAH-01)
            $table->integer('distance');   // Untuk simpan jarak rintangan (cm)
            $table->integer('battery');    // Untuk simpan level baterai (%)
            $table->timestamps();          // Otomatis buat created_at (waktu data masuk)
        });
    }

    /**
     * Batalkan migrasi (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};