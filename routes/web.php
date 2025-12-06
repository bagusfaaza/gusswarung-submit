<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\MenuController; // Untuk /sell
use App\Http\Controllers\Admin\ProductController; // Untuk CRUD Produk Admin

/*
|--------------------------------------------------------------------------
| Route Otentikasi & Public
|--------------------------------------------------------------------------
*/

// Halaman utama / Login (Routes Teman)
Route::get('/', [SesiController::class, 'index'])->name('login');
Route::post('/', [SesiController::class, 'login']);

// Registrasi (Routes Teman)
Route::get('/register', [SesiController::class, 'formRegister'])->name('register');
Route::post('/register', [SesiController::class, 'register'])->name('register.action');

// Logout (Routes Teman)
Route::get('/logout', [SesiController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Route Admin (Memerlukan Middleware 'admin')
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->group(function () {

    // 1. Dashboard Admin (Rute /admin, diubah dari view('home') menjadi view('admin.dashboard'))
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // 2. Manajemen Produk (CRUD Products - Rute Anda)
    Route::prefix('admin/products')->name('admin.products.')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');                // GET /admin/products (Tabel Produk)
        Route::get('/create', 'create')->name('create');        // GET /admin/products/create (Form Tambah)
        Route::post('/', 'store')->name('store');               // POST /admin/products
        Route::get('/{menu}/edit', 'edit')->name('edit');       // GET /admin/products/{menu}/edit (Form Edit)
        Route::put('/{menu}', 'update')->name('update');        // PUT/PATCH /admin/products/{menu}
        Route::delete('/{menu}', 'destroy')->name('destroy');   // DELETE /admin/products/{menu}
    });

    // 3. Routes Admin Tambahan dari Teman
    Route::get('/stock', function () {
        return view('inventaris'); // Rute Inventaris (Stock)
    })->name('admin.stock.index'); // <-- INI YANG HARUS DITAMBAHKA
    Route::get('/report', function () {
        return view('laporan'); // Rute Laporan
    });
    Route::get('/setting', function () {
        return view('pengaturan'); // Rute Pengaturan
    });
});


/*
|--------------------------------------------------------------------------
| Route User (Memerlukan Middleware 'user')
|--------------------------------------------------------------------------
*/
Route::middleware(['user'])->group(function () {

    // 1. Dashboard User (Routes Teman)
    Route::get('/user', function () {
        return view('userhome');
    })->name('user.dashboard');

    // 2. Routes User Tambahan (Menggabungkan Rute Teman dan Rute Baru)
    Route::get('/sell', [MenuController::class, 'penjualan'])->name('user.sell'); // Penjualan

    Route::get('/about', function () {
        return view('userabout'); // User About
    });

    // Note: Saya tidak menyertakan '/sell' dan '/about' versi admin/non-user karena biasanya 
    // routes ini spesifik untuk tampilan user atau harus berada di bawah middleware admin.

    Route::get('/checkout', function () {
        return view('keranjang'); // Keranjang (Checkout)
    });
});

/*
|--------------------------------------------------------------------------
| Route Public / General (Akses tanpa Login/Role)
|--------------------------------------------------------------------------
*/

// Rute 'about' yang paling terakhir dan kemungkinan dimaksudkan untuk tampilan umum
Route::get('/about', function () {
    return view('about');
});

// Jika ada rute lain yang umum (misalnya homepage publik), letakkan di sini.