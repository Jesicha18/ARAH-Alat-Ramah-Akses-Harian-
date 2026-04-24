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
        Schema::table('sensor_data', function (Blueprint $table) {
            // Pastikan ada dua kolom ini Jes
            $table->integer('obstacle_depan')->default(0)->after('device_code');
            $table->integer('obstacle_bawah')->default(0)->after('obstacle_depan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sensor_data', function (Blueprint $table) {
            //
        });
    }
};
