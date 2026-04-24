<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
    'tunanetra_id', 
    'bpm', 
    'latitude', 
    'longitude', 
    'battery', 
    'status'
];
}
