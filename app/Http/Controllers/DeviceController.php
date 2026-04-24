<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tunanetra; 
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    // Fungsi untuk Simpan Perangkat Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_tunanetra' => 'required|string|max:255',
            'status_hubungan' => 'required',
            'jenis_kebutaan' => 'required',
            'tanggal_lahir' => 'required|date',
            'device_code' => 'required|string|unique:tunanetras,device_code', 
        ]);

        // --- PERUBAHAN DI SINI ---
        // Kita paksa input device_code jadi HURUF BESAR sebelum disimpan
        $device_code_fix = strtoupper($request->device_code);

        // Simpan ke database
        Tunanetra::create([
            'user_id' => Auth::id(), 
            'nama_tunanetra' => $request->nama_tunanetra,
            'status_hubungan' => $request->status_hubungan,
            'jenis_kebutaan' => $request->jenis_kebutaan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'device_code' => $device_code_fix, // Simpan hasil yang sudah di-uppercase
        ]);

        return back()->with('success', 'Teman tunanetra berhasil ditambahkan dengan kode: ' . $device_code_fix);
    }

    // Fungsi untuk Hapus Perangkat
    public function destroy($id)
    {
        $tuna = Tunanetra::findOrFail($id);
        
        if($tuna->user_id == Auth::id()){
            $tuna->delete();
            return back()->with('success', 'Profil berhasil dihapus.');
        }

        return back()->with('error', 'Kamu tidak punya akses menghapus ini.');
    }
}