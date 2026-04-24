<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'sensor_data';

    // Kolom yang boleh diisi (WAJIB masukkan kolom baru di sini)
    protected $fillable = [
    'device_id', 
    'device_code', 
    'bpm', 
    'heart_status', 
    'heart_color', 
    'step_count', 
    'battery', 
    'latitude', 
    'longitude', 
    'distance_obstacle',
    'distance',
    'status',
    'obstacle_depan',
    'obstacle_bawah'
];

    // Opsional: Jika kamu ingin created_at otomatis jadi objek Carbon
    protected $dates = ['created_at', 'updated_at'];
}