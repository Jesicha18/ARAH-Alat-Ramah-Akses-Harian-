<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class SecurityController extends Controller
{
    /**
     * Menampilkan halaman keamanan & riwayat sesi
     */
    public function index()
    {
        // Mengambil riwayat login dari tabel sessions
        $sessions = DB::table('sessions')
            ->where('user_id', auth()->id())
            ->orderBy('last_activity', 'desc')
            ->get();

        return view('security', compact('sessions'));
    }

    /**
     * Proses update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)],
        ], [
            'current_password.current_password' => 'Kata sandi lama salah.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        // UPDATE DATABASE
        $request->user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->new_password),
        ]);

        // Kirim notifikasi sukses
        return back()->with('toast_success', 'Kata sandi kamu berhasil diperbarui!');
    }
}