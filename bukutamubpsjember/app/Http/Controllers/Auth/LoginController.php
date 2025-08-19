<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        // Hanya menampilkan view, pastikan path-nya benar
        return view('auth.login2');
    }

    /**
     * Menangani percobaan login dari pengguna.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string'], // Ganti 'string' dengan 'email' jika Anda menggunakan email
            'password' => ['required'],
        ]);

        // 2. Coba lakukan autentikasi
        //    'username' di sini harus sesuai dengan nama kolom di database Anda (misal: 'email' atau 'username')
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            // 3. Jika berhasil, regenerate session & redirect ke halaman admin
            $request->session()->regenerate();

            // Arahkan ke halaman admin kepuasan pelanggan setelah login berhasil
            return redirect()->route('admin.tampilan.survei')->with('success', 'Anda berhasil login!');
        }

        // 4. Jika gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau Password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login setelah logout
        return redirect('/auth');
    }
}
