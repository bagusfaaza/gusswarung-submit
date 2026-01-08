<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Menu;

class StatController extends Controller
{
    public function index()
    {
        // Total pesanan
        $totalPesanan = Order::count();

        // Pelanggan aktif
        $pelangganAktif = User::where('role', 'user')->count();

        // Menu paling sering dijual
        $menuTerlaris = OrderDetail::select('menu_id')
            ->selectRaw('SUM(quantity) as total_terjual')
            ->groupBy('menu_id')
            ->orderByDesc('total_terjual')
            ->first();

        $namaMenuTerlaris = null;

        if ($menuTerlaris) {
            $namaMenuTerlaris = Menu::find($menuTerlaris->menu_id)->nama_menu;
        }

        return view('userhome', compact(
            'totalPesanan',
            'pelangganAktif',
            'namaMenuTerlaris'
        ));
    }
}
