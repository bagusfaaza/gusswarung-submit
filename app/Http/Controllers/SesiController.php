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
     */
    function login(Request $request)
    {
        // 1. Validasi input
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );

        // 2. Data untuk otentikasi
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // 3. Coba otentikasi
        if (Auth::attempt($infologin)) {

            // Otentikasi Berhasil

            // Ambil data user yang baru login
            $user = Auth::user();

            // Tentukan jalur redirect berdasarkan kolom 'role'
            if ($user->role === 'admin') {
                return redirect('/admin');

            } else if ($user->role === 'user') {
                return redirect('/user');

            } else if ($user->role === 'driver') {
                return redirect('/driver');

            } else {
                // Default redirect jika role tidak dikenali
                return redirect('/dashboard');
            }

        } else {

            // Otentikasi Gagal

            // PERBAIKAN: Menggunakan helper redirect() tanpa parameter
            return redirect()
                ->back()
                ->withErrors('Email dan Password yang dimasukkan salah')
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