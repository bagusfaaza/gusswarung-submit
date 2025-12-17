<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua order
        $orderIds = DB::table('orders')->pluck('id')->toArray();

        // Ambil semua menu (REAL, VALID)
        $menus = DB::table('menus')->get();

        $now = Carbon::now();

        foreach ($orderIds as $orderId) {

            // ✅ 100% order punya menu (sesuai permintaan kamu)
            $menuCount = rand(1, 3);

            $selectedMenus = $menus->random($menuCount);

            foreach ($selectedMenus as $menu) {

                $quantity = rand(1, 3);
                $totalPrice = $quantity * $menu->harga;

                DB::table('order_details')->insert([
                    'order_id' => $orderId,
                    'menu_id' => $menu->id,           // ✅ AMAN
                    'product_name' => $menu->nama,    // sesuai migration
                    'quantity' => $quantity,
                    'price_per_unit' => $menu->harga,
                    'total_price' => $totalPrice,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
