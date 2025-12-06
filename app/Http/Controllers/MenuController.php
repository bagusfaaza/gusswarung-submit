<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function penjualan()
    {
        // 1. Ambil data dari database dan kelompokkan berdasarkan kategori
        $makanan = Menu::where('kategori', 'makanan')->get();
        $minuman = Menu::where('kategori', 'minuman')->get();
        $addons = Menu::where('kategori', 'addon')->get();

        // 2. Kirim data ke view penjualan.blade.php
        return view('penjualan', [
            'makanan' => $makanan,
            'minuman' => $minuman,
            'addons' => $addons,
            'cartCount' => 3
        ]);
    }
}