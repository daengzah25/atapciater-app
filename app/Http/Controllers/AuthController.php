<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari pegawai berdasarkan username dan password (plain text sesuai permintaan)
        $pegawai = Pegawai::where('username', $credentials['username'])
                          ->where('password', $credentials['password'])
                          ->first();

        if ($pegawai) {
            // Login berhasil, simpan data di session
            session(['pegawai' => $pegawai]);

            // Redirect berdasarkan role
            if ($pegawai->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('pic.dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
