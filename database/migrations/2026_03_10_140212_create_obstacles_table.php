<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('obstacles', function (Blueprint $table) {
            $table->id();
            $table->float('distance'); // Simpan jarak dalam cm
            $table->timestamps(); // Ini otomatis buat created_at (untuk grafik)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obstacles');
    }
};
