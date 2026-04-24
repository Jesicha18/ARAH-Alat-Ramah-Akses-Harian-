<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SensorData;
use App\Models\BlindUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SensorController extends Controller
{
    /**
     * MENERIMA DATA DARI HARDWARE (ESP32)
     */
    public function receiveData(Request $request)
    {
        // 🔥 DEBUG - Cek data masuk di storage/logs/laravel.log
        Log::info("Data Masuk: ", $request->all());

        // ✅ VALIDASI
        $request->validate([
            'device_code'       => 'required|string',
            'bpm'               => 'required|numeric',
            'battery'           => 'nullable|integer',
            'lat'               => 'nullable|numeric',   
            'lng'               => 'nullable|numeric',   
            'dist_bawah'        => 'nullable|numeric',
            'dist_atas'         => 'nullable|numeric',
            'vibration_count'   => 'nullable|numeric',
            'steps'             => 'nullable|numeric', 
        ]);

        $device_code = strtoupper($request->device_code);
        $user = BlindUser::where('device_code', $device_code)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Device tidak terdaftar'
            ], 403);
        }

        $bpm = (int)$request->bpm;
        
        // Logika Status Jantung
if ($bpm >= 60 && $bpm <= 100) {
            $heart_status = "Normal";
            $heart_color = "hijau";
        } elseif ($bpm > 100) {
            // Menggantikan Tachycardia
            $heart_status = "Detak Jantung Cepat"; 
            $heart_color = "merah";
        } else {
            // Menggantikan Bradycardia
            $heart_status = "Detak Jantung Lambat";
            $heart_color = "kuning";
        }

        // ✅ SIMPAN KE DATABASE
        SensorData::create([
            'device_id'         => $user->id,
            'device_code'       => $device_code,
            'bpm'               => $bpm,
            'heart_status'      => $heart_status,
            'heart_color'       => $heart_color,
            'battery'           => $request->battery ?? 0,
            'latitude'          => $request->lat ?? 0,
            'longitude'         => $request->lng ?? 0,
            'distance_obstacle' => $request->vibration_count ?? 0,
            'distance'          => $request->dist_bawah ?? 0,
            'step_count'        => $request->steps ?? 0, 
            'status'            => 'Active',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ], 200);
    }

    /**
     * MENGIRIM DATA TERBARU KE DASHBOARD (AJAX FETCH)
     * Dipanggil oleh: fetch('/api/latest-sensor/{id}')
     */
    public function getLatestData($id)
    {
        // Ambil data terbaru berdasarkan ID BlindUser (device_id)
        $latest = SensorData::where('device_id', $id)
                    ->latest()
                    ->first();

        if (!$latest) {
            return response()->json([
                'status' => 'error',
                'message' => 'Belum ada data sensor untuk user ini',
                'latest' => null
            ], 200); // Tetap 200 supaya JS tidak crash, tapi kasih null
        }

        return response()->json([
            'status' => 'success',
            'latest' => $latest
        ], 200);
    }
}