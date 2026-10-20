<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek status admin (baik boolean true maupun integer 1)
            if ($user->is_admin == 1 || $user->is_admin === true) {
                $request->session()->regenerate();
                return redirect()->route('berita.index')->with('success', 'Selamat datang kembali, Admin!');
            }

            // Jika bukan admin, logout & beri pesan error
            Auth::logout();
            return back()->withErrors(['email' => 'Akses ditolak! Akun Anda bukan Admin.']);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }
}