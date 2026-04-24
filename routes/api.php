<?php

use App\Http\Controllers\Api\SensorController;
use Illuminate\Support\Facades\Route;

// 1. Ini jalur utama yang dipakai ESP temen kamu
//Route::post('/sensor', [SensorController::class, 'receiveData']);

// 2. Jalur cadangan
Route::post('/send-data', [SensorController::class, 'receiveData']);

// 4. Sinkronisasi Blynk
Route::get('/fetch-blynk', [SensorController::class, 'fetchFromBlynk']);

Route::post('/send-data', [SensorController::class, 'receiveData']);

Route::get('/latest-sensor/{id}', [SensorController::class, 'getLatestData']);