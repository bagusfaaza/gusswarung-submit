<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Menu; // Gunakan Model Menu

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('menus')->truncate();

        // ... di dalam function run(): void
        $menuData = [
            // ===================================
            // MENU MAKANAN
            // ===================================

            // Bubur Existing (DISCONTINUED: Dihapus dan diganti dengan versi Komplit Dewasa)
            // ['nama' => 'Bubur Ayam', 'deskripsi' => 'Bubur ayam gurih dengan kuah kaldu hangat...', 'harga' => 14000, 'stok' => 25, 'kategori' => 'makanan', 'gambar' => 'path/to/bubur.jpg', 'is_popular' => true, 'diskon_persen' => 10], 
            // ['nama' => 'Bubur Ayam', 'deskripsi' => 'Bubur Ayam', 'harga' => 15000, 'stok' => 5, 'kategori' => 'makanan', 'gambar' => 'img/bubur.webp', 'is_popular' => false, 'diskon_persen' => 0],

            // 🆕 BARU: Bubur Varian
            ['nama' => 'Bubur Ayam Dewasa', 'deskripsi' => 'Bubur komplit dengan suwiran ayam & topping melimpah.', 'harga' => 14000, 'stok' => 25, 'kategori' => 'makanan', 'gambar' => 'img/makanan/BuburKomplit.jpg', 'is_popular' => true, 'diskon_persen' => 10], // DISKON 10%
            ['nama' => 'Bubur Ayam Anak', 'deskripsi' => 'Bubur porsi kecil, cocok untuk anak tanpa topping pedas.', 'harga' => 11000, 'stok' => 20, 'kategori' => 'makanan', 'gambar' => 'img/makanan/BuburAnak.jpg', 'is_popular' => false, 'diskon_persen' => 0],
            ['nama' => 'Bubur Polos', 'deskripsi' => 'Bubur original gurih tanpa suwiran ayam atau topping.', 'harga' => 8000, 'stok' => 15, 'kategori' => 'makanan', 'gambar' => 'img/makanan/BuburPolos.jpg', 'is_popular' => false, 'diskon_persen' => 0],

            // 🆕 BARU: Nasi Kuning Varian
            ['nama' => 'Nasi Kuning Ayam Goreng', 'deskripsi' => 'Nasi kuning wangi disajikan dengan ayam goreng renyah.', 'harga' => 13000, 'stok' => 35, 'kategori' => 'makanan', 'gambar' => 'img/makanan/NasiKunGor.jpg', 'is_popular' => true, 'diskon_persen' => 0],
            ['nama' => 'Nasi Kuning Ayam Urap', 'deskripsi' => 'Nasi kuning, ayam bakar, dan sambal urap kelapa pedas.', 'harga' => 15000, 'stok' => 10, 'kategori' => 'makanan', 'gambar' => 'img/makanan/NasiKunUrap.jpg', 'is_popular' => false, 'diskon_persen' => 0],
            ['nama' => 'Nasi Kuning Telur Bali', 'deskripsi' => 'Nasi kuning wangi dengan telur bumbu Bali pedas manis.', 'harga' => 13000, 'stok' => 8, 'kategori' => 'makanan', 'gambar' => 'img/makanan/NasiKunTelur.jpg', 'is_popular' => false, 'diskon_persen' => 0],

            // Nasi Ayam Existing
            ['nama' => 'Nasi Ayam Bakar Urap', 'deskripsi' => 'Ayam bakar dengan bumbu manis gurih khas tradisional.', 'harga' => 15000, 'stok' => 5, 'kategori' => 'makanan', 'gambar' => 'img/makanan/AyamBakarUrap.jpg', 'is_popular' => true, 'diskon_persen' => 0],
            ['nama' => 'Nasi Ayam Laos', 'deskripsi' => 'Ayam goreng berbumbu laos khas Jawa dengan aroma wangi.', 'harga' => 15000, 'stok' => 30, 'kategori' => 'makanan', 'gambar' => 'img/makanan/AyamLaos.jpg', 'is_popular' => false, 'diskon_persen' => 0],
            ['nama' => 'Nasi Ayam Kremes', 'deskripsi' => 'Ayam goreng renyah dengan taburan kremes gurih khas rumahan.', 'harga' => 15000, 'stok' => 18, 'kategori' => 'makanan', 'gambar' => 'img/makanan/AyamKremes.jpg', 'is_popular' => false, 'diskon_persen' => 20], // DISKON 20%

            // 🆕 BARU: Nasi Ayam Karage
            ['nama' => 'Nasi Ayam Karage', 'deskripsi' => 'Nasi dengan potongan ayam karage renyah ala Jepang.', 'harga' => 15000, 'stok' => 12, 'kategori' => 'makanan', 'gambar' => 'img/makanan/NasiKarage.jpg', 'is_popular' => false, 'diskon_persen' => 0],

            // ===================================
            // MENU MINUMAN
            // ===================================
            ['nama' => 'Es Teh Manis', 'deskripsi' => 'Teh hitam segar dingin dengan gula pas takaran yang mantap.', 'harga' => 3000, 'stok' => 50, 'kategori' => 'minuman', 'gambar' => 'img/minuman/EsTeh.jpg', 'is_popular' => false, 'diskon_persen' => 0],
            ['nama' => 'Teh Hangat', 'deskripsi' => 'Teh melati hangat dengan aroma menenangkan dan sedikit gula.', 'harga' => 3000, 'stok' => 45, 'kategori' => 'minuman', 'gambar' => 'img/minuman/TehHangat.jpg', 'is_popular' => false, 'diskon_persen' => 50], // DISKON 50%
            ['nama' => 'Es Jeruk', 'deskripsi' => 'Perpaduan jeruk peras segar dan es batu yang menyegarkan dahaga.', 'harga' => 5000, 'stok' => 40, 'kategori' => 'minuman', 'gambar' => 'img/minuman/EsJeruk.jpg', 'is_popular' => true, 'diskon_persen' => 0],

            // 🆕 BARU: Jeruk Hangat
            ['nama' => 'Jeruk Hangat', 'deskripsi' => 'Sari jeruk peras hangat dengan sedikit tambahan madu alami.', 'harga' => 5000, 'stok' => 35, 'kategori' => 'minuman', 'gambar' => 'img/minuman/JerukHangat.jpg', 'is_popular' => false, 'diskon_persen' => 0],

            // ===================================
            // MENU ADD-ONS (TAMBAHAN)
            // ===================================
            ['nama' => 'Telur Asin', 'deskripsi' => 'Telur asin gurih kualitas terbaik dengan cita rasa khas.', 'harga' => 5000, 'stok' => 20, 'kategori' => 'addon', 'gambar' => 'img/tambahan/TelurAsin.jpg', 'is_popular' => true, 'diskon_persen' => 0],
            ['nama' => 'Sate Puyuh', 'deskripsi' => 'Sate telur puyuh empuk dengan bumbu manis gurih kecap.', 'harga' => 4000, 'stok' => 25, 'kategori' => 'addon', 'gambar' => 'img/tambahan/SatePuyuh.jpg', 'is_popular' => false, 'diskon_persen' => 0],
            ['nama' => 'Sate Usus', 'deskripsi' => 'Sate usus ayam yang lembut dengan balutan bumbu kecap manis.', 'harga' => 3000, 'stok' => 30, 'kategori' => 'addon', 'gambar' => 'img/tambahan/SateUsus.jpg', 'is_popular' => false, 'diskon_persen' => 0],
        ];
        Menu::insert($menuData);
    }
}