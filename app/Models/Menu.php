<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 💡 BARIS PERBAIKAN: Impor Trait HasFactory dari namespace Eloquent Factories
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory; // ✅ Sekarang trait ini dikenali

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'kategori',
        'gambar',
        'is_popular',
        'diskon_persen'
    ];
}