<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (empty(Auth::user()->relation)) {
                return redirect()->intended('/setup-profile');
            }
            return redirect()->intended('/select-device');
        }

        return back()->withErrors(['email' => 'Email atau sandi salah'])->withInput();
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        session([
            'reg_email' => $request->email,
            'reg_password' => Hash::make($request->password)
        ]);

        return redirect()->route('setup.profile');
    }

public function updateProfile(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'age' => 'required|integer|min:1|max:120', 
        'relation' => 'required|string',
    ]);

    if (!session()->has('reg_email')) {
        return redirect()->route('register')->withErrors(['email' => 'Sesi habis, silakan isi ulang.']);
    }

    // TRIK: Ubah angka (misal 15) jadi format tanggal (misal 0015-01-01) 
    // supaya kolom DATE di DB kamu mau nerima datanya.
    $fakeDateAge = str_pad($request->age, 4, '0', STR_PAD_LEFT) . '-01-01';

    $user = User::create([
        'email'    => session('reg_email'),
        'password' => session('reg_password'),
        'name'     => $request->name,
        'age'      => $fakeDateAge, // Kirim format tanggal palsu ke DB
        'relation' => $request->relation,
    ]);

    Auth::login($user);
    session()->forget(['reg_email', 'reg_password']);

    return redirect()->route('select.device');
}

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}