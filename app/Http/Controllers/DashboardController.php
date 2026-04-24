<?php

namespace App\Http\Controllers;

use App\Models\BlindUser; 
use App\Models\SensorData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function selectDevice()
    {
        $daftar_tunanetra = BlindUser::where('user_id', Auth::id())->get(); 
        return view('select-device', ['daftar_tunanetra' => $daftar_tunanetra]);
    }

    public function addDevice(Request $request)
    {
        $request->validate([
            'nama_tunanetra' => 'required|string|max:255',
            'status_hubungan' => 'required|string',
            'jenis_kebutaan' => 'required|string',
            'device_code' => 'required|string',
            'tanggal_lahir' => 'required|date', 
        ]);

        $usia = Carbon::parse($request->tanggal_lahir)->age;

        BlindUser::create([
            'user_id' => Auth::id(), 
            'nama_tunanetra' => $request->nama_tunanetra,
            'status_hubungan' => $request->status_hubungan,
            'jenis_kebutaan' => $request->jenis_kebutaan,
            'usia_tunanetra' => $usia,
            'device_code' => $request->device_code,
            'tanggal_lahir' => $request->tanggal_lahir
        ]);

        return redirect()->route('select.device')->with('success', 'Data berhasil disimpan!');
    }

    public function destroy($id)
    {
        $tuna = BlindUser::findOrFail($id);
        
        if($tuna->user_id == Auth::id()){
            $tuna->delete();
            return redirect()->route('select.device')->with('success', 'Profil berhasil dihapus!');
        }

        return redirect()->route('select.device')->with('error', 'Akses ditolak!');
    }

    public function profile()
    {
        $user = Auth::user();
        $tunanetra = BlindUser::where('user_id', $user->id)->first();
        return view('profile', ['user' => $user, 'tunanetra' => $tunanetra]);
    }

    public function index($id)
    {
        $tunanetra = BlindUser::findOrFail($id);

        $last_data = SensorData::where('device_code', $tunanetra->device_code)->latest()->first();

        $sensorData = SensorData::where('device_code', $tunanetra->device_code)
                        ->latest()->take(10)->get()->reverse();

        $labels = $sensorData->map(function($item){
            return $item->created_at->format('H:i:s');
        });

        $values = $sensorData->pluck('bpm');

        // Hitung Total Rintangan (Depan + Bawah) Hari Ini
        $totalObstacles = SensorData::where('device_code', $tunanetra->device_code)
                            ->whereDate('created_at', today())
                            ->where(function($query) {
                                $query->where('obstacle_depan', 1)
                                      ->orWhere('obstacle_bawah', 1);
                            })->count();

        $obstacleValues = [$totalObstacles]; 

        return view('dashboard', compact(
            'tunanetra', 'last_data', 'labels', 'values', 'obstacleValues'
        ));
    }

    /**
     * FUNGSI BARU: Mengambil data sensor terbaru secara real-time via API
     */
    public function getLatestSensor($id)
    {
        $tunanetra = BlindUser::findOrFail($id);
        
        // Ambil 1 data sensor paling baru
        $latest = SensorData::where('device_code', $tunanetra->device_code)
                    ->latest()
                    ->first();

        // Hitung ulang total rintangan hari ini untuk diupdate ke UI
        $totalObstacleToday = SensorData::where('device_code', $tunanetra->device_code)
                            ->whereDate('created_at', today())
                            ->where(function($query) {
                                $query->where('obstacle_depan', 1)
                                      ->orWhere('obstacle_bawah', 1);
                            })->count();

        return response()->json([
            'latest' => $latest,
            'total_obstacle_today' => $totalObstacleToday,
            'status' => 'success'
        ]);
    }
}