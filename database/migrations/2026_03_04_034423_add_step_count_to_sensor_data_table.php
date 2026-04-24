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
            // Cek dan tambah kolom bpm jika ternyata belum ada
            if (!Schema::hasColumn('sensor_data', 'bpm')) {
                $table->integer('bpm')->nullable()->after('device_code');
            }

            // Cek dan tambah kolom step_count
            if (!Schema::hasColumn('sensor_data', 'step_count')) {
                $table->integer('step_count')->default(0);
            }

            // Cek dan tambah kolom battery
            if (!Schema::hasColumn('sensor_data', 'battery')) {
                $table->integer('battery')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sensor_data', function (Blueprint $table) {
            $table->dropColumn(['bpm', 'step_count', 'battery']);
        });
    }
};