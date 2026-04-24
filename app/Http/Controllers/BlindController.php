<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlindUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BlindController extends Controller
{
    public function index()
    {
        // Ambil data tunanetra milik user yang sedang login
        $blindUser = BlindUser::where('user_id', Auth::id())->first();

        // Hitung umur otomatis jika ada tanggal_lahir
        $age = null;
        if ($blindUser && $blindUser->tanggal_lahir) {
            $age = Carbon::parse($blindUser->tanggal_lahir)->age;
        }

        return view('blind', compact('blindUser', 'age'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_tunanetra' => 'required|string|max:255',
            'status_hubungan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        $blindUser = BlindUser::where('user_id', Auth::id())->first();

        if ($blindUser) {
            // --- LOGIC GENERATE KODE PERANGKAT BARU ---
            // Format: AT + Tahun(2 digit) + Bulan + Tanggal + ID(3 digit)
            // Contoh hari ini: AT260420001
            $prefix = "AT";
            $datePart = now()->format('ymd'); // y=26, m=04, d=20
            $suffix = str_pad($blindUser->id, 3, '0', STR_PAD_LEFT); 
            
            $generatedCode = $prefix . $datePart . $suffix;

            $blindUser->update([
                'nama_tunanetra' => $request->nama_tunanetra,
                'status_hubungan' => $request->status_hubungan,
                'tanggal_lahir' => $request->tanggal_lahir,
                'device_code' => $generatedCode, 
            ]);

            return back()->with('toast_success', 'Profil Berhasil Diperbarui! Kode Alat: ' . $generatedCode);
        }

        return back()->with('error', 'Data tidak ditemukan.');
    }
}