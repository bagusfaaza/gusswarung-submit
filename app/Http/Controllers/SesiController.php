<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    function index()
    {
        return view('login');
    }

    /**
     * Menampilkan halaman register.
     */
    function formRegister()
    {
        return view('register');
    }

    /**
     * Memproses permintaan login.
     * Logika: Memeriksa Email & Password (Auth::attempt), lalu memverifikasi Nama dan Role secara manual.
     */
    function login(Request $request)
    {
        // 1. Validasi input (Semua field wajib diisi)
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required|in:admin,user,driver',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format Email tidak valid',
                'password.required' => 'Password wajib diisi',
                'role.required' => 'Role wajib dipilih',
            ]
        );
        // 

        // 2. Data untuk otentikasi standar (Hanya email & password yang bisa di-attempt)
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // 3. Coba Otentikasi Email & Password
        if (Auth::attempt($infologin)) {

            // Otentikasi Email & Password Berhasil.
            $user = Auth::user();

            // 4. Periksa Kriteria Tambahan (Nama dan Role)
            // Kredensial hanya dianggap valid jika Nama dan Role yang diinput
            // cocok dengan data pengguna yang berhasil diotentikasi.
            if ($user->name === $request->name && $user->role === $request->role) {

                // Semua Kriteria (Email, Password, Nama, Role) COCOK

                // Tentukan jalur redirect berdasarkan kolom 'role'
                if ($user->role === 'admin') {
                    return redirect('/admin');
                } else if ($user->role === 'user') {
                    return redirect('/user');
                } else {
                    // Redirect default
                    return redirect('/dashboard');
                }
            } else {
                // Nama atau Role TIDAK COCOK
                Auth::logout(); // Logout paksa karena kredensial tidak lengkap/salah
                return redirect()
                    ->back()
                    ->withErrors('Kombinasi Nama, Email, Password, dan Role tidak cocok.')
                    ->withInput();
            }
        } else {

            // Otentikasi Email dan Password Gagal
            return redirect()
                ->back()
                ->withErrors('Email atau Password yang dimasukkan salah.')
                ->withInput();
        }
    }

    /**
     * Memproses logout user.
     */
    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke route login yang bernama 'login'
        return redirect()->route('login');
    }

    /**
     * Memproses registrasi user baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user,driver', // Pastikan role hanya salah satu dari ini
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Simpan password yang sudah di-hash
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silahkan login.');
    }
}