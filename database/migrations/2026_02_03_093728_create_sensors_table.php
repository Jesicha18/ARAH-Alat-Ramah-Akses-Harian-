<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up() {
    Schema::create('sensors', function (Blueprint $table) {
        $table->id();
        
        // Menghubungkan ke ID tunanetra yang sedang dipantau (Misal: Ellie)
        $table->foreignId('tunanetra_id')->constrained('tunanetras')->onDelete('cascade'); 
        
        $table->integer('bpm');         // Detak Jantung
        
        // GPS harus dipisah jadi dua kolom Decimal agar Peta bisa ngetrack
        $table->decimal('latitude', 10, 8)->nullable(); 
        $table->decimal('longitude', 11, 8)->nullable();
        
        $table->integer('battery');     // Sisa Baterai
        $table->string('status')->default('Normal');       // Status (Normal, Fall, dll)
        $table->timestamps();           
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
