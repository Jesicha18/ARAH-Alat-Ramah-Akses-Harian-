<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlindUser extends Model
{
    // Nama tabel di database XAMPP kamu
    protected $table = 'blind_users';

    // Kolom yang diizinkan untuk disimpan (mass assignment)
    // 'color' dan 'icon' sudah dihapus dari daftar ini
protected $fillable = [
    'user_id', 
    'nama_tunanetra', 
    'status_hubungan', // Tambahkan ini
    'tanggal_lahir', 
    'device_code'
];
}