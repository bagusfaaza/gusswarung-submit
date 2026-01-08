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

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Admin berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Admin berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Admin berhasil dihapus');
    }
}
