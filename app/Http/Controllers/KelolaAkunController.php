<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelolaAkunController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $admins = User::where('role', 'admin')->get();

        return view('admin.kelolaadmin', compact('admins', 'user'));
    }

    public function store(Request $request)
    {
        // Tambahkan validasi agar tidak error jika email duplikat
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Admin berhasil ditambahkan');
    }
    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        // Proteksi berdasarkan Email
        if ($admin->email === 'admin@admin.com') {
            return redirect()->back()->with('error', 'Akun Super Admin (admin@admin.com) dilindungi dan tidak dapat dihapus!');
        }

        // Tetap cegah admin menghapus dirinya sendiri
        if ($id == Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $admin->delete();
        return redirect()->back()->with('success', 'Admin berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        // Proteksi Update: Hanya pemilik email tersebut yang bisa edit datanya sendiri
        if ($admin->email === 'admin@admin.com' && Auth::user()->email !== 'admin@admin.com') {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengubah data Super Admin!');
        }

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Admin berhasil diperbarui');
    }
}
