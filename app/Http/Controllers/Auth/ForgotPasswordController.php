<?php

namespace App\Http\Controllers\Auth; // Pastikan ada "\Auth" di ujungnya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function tampilkanFormReset() {
        return view('auth.reset-password'); // Nama file yang kamu mau
    }

    public function prosesReset(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.exists' => 'Email ini nggak terdaftar di ARAH.',
            'password.confirmed' => 'Password baru dan konfirmasinya beda nih.',
        ]);

        // Langsung hajar update ke tabel users
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('status', 'Sip! Password kamu sudah diganti. Silakan login.');
    }
}