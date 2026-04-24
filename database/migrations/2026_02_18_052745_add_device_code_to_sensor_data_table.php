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
        // Nambahin kolom device_code buat relasi ke tongkat
        $table->string('device_code')->after('id'); 
    });
}

public function down()
{
    Schema::table('sensor_data', function (Blueprint $table) {
        $table->dropColumn('device_code');
    });
}
};
