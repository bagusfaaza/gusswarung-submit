<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // --- READ (Index) ---
    public function index()
    {
        $menus = Menu::orderBy('kategori')->get();
        return view('admin.products.index', compact('menus'));
    }

    // --- CREATE (Form) ---
    public function create()
    {
        $menu = new Menu(); // Kirim objek kosong untuk form
        return view('admin.products.form', compact('menu'));
    }

    // --- STORE (Simpan ke DB) ---
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|in:makanan,minuman,addon',
            'is_popular' => 'boolean',
            'diskon_persen' => 'required|integer|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Aturan untuk upload gambar
        ]);

        // HANDLE UPLOAD GAMBAR
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('', 'public_uploads'); // simpan langsung ke root disk
            $validatedData['gambar'] = '/uploads/' . $path; // hasil: /uploads/namafile.jpg
        }


        Menu::create($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // --- EDIT (Form) ---
    public function edit(Menu $menu)
    {
        return view('admin.products.form', compact('menu'));
    }

    // --- UPDATE (Simpan Perubahan) ---
    public function update(Request $request, Menu $menu)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|in:makanan,minuman,addon',
            'is_popular' => 'boolean',
            'diskon_persen' => 'required|integer|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // handle checkbox is_popular (kalau checkbox nggak dicentang, request-nya nggak ikut)
        $validatedData['is_popular'] = $request->has('is_popular');

        // HANDLE UPDATE GAMBAR
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($menu->gambar) {
                $fileName = str_replace('/uploads/', '', $menu->gambar);
                Storage::disk('public_uploads')->delete($fileName);
            }


            // Simpan file
            $path = $request->file('gambar')->store('', 'public_uploads'); // simpan langsung ke root disk
            $validatedData['gambar'] = '/uploads/' . $path;
        }

        $menu->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }


    // --- DELETE ---
    public function destroy(Menu $menu)
    {
        // Hapus gambar dari folder sebelum menghapus data
        if ($menu->gambar) {
            Storage::disk('public_uploads')->delete(str_replace('/uploads/', '', $menu->gambar));
        }

        $menu->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}