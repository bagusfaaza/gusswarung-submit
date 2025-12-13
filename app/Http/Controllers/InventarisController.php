<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris; // <--- PENTING: Panggil Model Anda

class InventarisController extends Controller
{
    // MENAMPILKAN DATA KE BLADE
    public function index()
    {
        // Ambil semua data dari tabel 'inventaris'
        $stok = Inventaris::all();

        // Kirim variabel $stok ke view 'inventaris.blade.php'
        return view('inventaris', compact('stok'));
    }

    // MENYIMPAN DATA BARU
    public function store(Request $request)
    {
        // Validasi input (opsional tapi disarankan)
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);

        // Simpan ke database
        Inventaris::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'minimal_stock' => $request->minimal_stock,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return redirect()->back(); // Kembali ke halaman sebelumnya
    }
    // UPDATE DATA
    public function update(Request $request)
    {
        // Cari barang berdasarkan nama
        $barang = Inventaris::where('name', $request->name)->first();

        if ($barang) {
            // 1. Update data dasar
            $barang->quantity = $request->quantity; // Update Jumlah
            $barang->price = $request->price;       // Update Harga (BARU)
            $barang->unit = $request->unit;         // Update Satuan (BARU)

            // 2. Cek ulang status (Aman/Rendah)
            if ($barang->quantity <= $barang->minimal_stock) {
                $barang->status = 'rendah';
            } else {
                $barang->status = 'aman';
            }

            // 3. Simpan perubahan
            $barang->save();
        }

        return redirect()->back();
    }

    // HAPUS DATA
    public function destroy($id)
    {
        // Cari barang berdasarkan ID unik
        $barang = Inventaris::find($id);

        if ($barang) {
            $barang->delete(); // Hapus dari database
            // return redirect()->back()->with('success', 'Barang berhasil dihapus');
        }

        return redirect()->back();
    }
}