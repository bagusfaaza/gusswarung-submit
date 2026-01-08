@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Order;
    use Illuminate\Support\Str; // Tambahkan ini untuk menggunakan Str::contains

    // 1. Logika Pengambilan Data Pesanan di View
    $latestOrders = collect();
    $userName = Auth::check() ? Auth::user()->name : null;

    if (Auth::check()) {
        // Ambil 5 pesanan terbaru milik user yang sedang login
        $latestOrders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu Penjualan - GusWarung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('css/style-penjualan.css') }}" />
    <style>
    </style>
</head>

<body>
    <div id="toast" style="
        position: fixed;
        bottom: 25px;
        left: 25px;
        z-index: 1060;
        padding: 15px 20px;
        border-radius: 10px;
        color: white;
        font-weight: 500;
        display: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    " class="bg-success">
        <span id="toastMessage">Item berhasil ditambahkan!</span>
    </div>

    <nav class="fixed-top navbar navbar-expand-lg shadow-lg" style="background-color: #ffc107">
        <div class="container">

            <a class="navbar-brand text-white fw-bold" href="/">
                <img src="logo/logo_guswarung tb.png" width="40" height="40">
                GusWarung
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">

                    <li class="nav-item">
                        <a class="nav-link text-black" href="/user">Home</a>
                    </li>

                    <li class="nav-item">
    <a class="nav-link text-black {{ request()->routeIs('user.sell') ? 'active fw-bold' : '' }}"
       href="{{ route('user.sell') }}">
        Penjualan
    </a>
</li>


                    <li class="nav-item">
                        <a class="nav-link text-black" href="/about">About</a>
                    </li>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-black d-flex align-items-center position-relative"
                            href="#" role="button" data-bs-toggle="dropdown">

                            <span class="material-symbols-outlined me-1">
                                account_circle
                            </span>

                            @auth
                                {{-- BADGE NOTIFIKASI (Jika ada pesanan baru/perubahan status) --}}
                                @if(isset($newOrdersCount) && $newOrdersCount > 0)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $newOrdersCount }}
                                        <span class="visually-hidden">New orders</span>
                                    </span>
                                @endif
                                <span class="fw-bold">{{ Auth::user()->name }}</span>
                            @endauth
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end bg-warning">

                            @auth
                                <li>
                                    <span class="dropdown-item fw-bold text-black bg-warning border-bottom">
                                        Masuk sebagai {{ Auth::user()->name }}
                                    </span>
                                </li>

                                {{-- 🔔 NOTIFIKASI STATUS PESANAN (TIDAK KE PAGE LAIN) --}}
                                <li>
                                    <h6 class="dropdown-header">🔔 Status Pesanan Terbaru</h6>
                                </li>

                                {{-- Asumsi variabel $latestOrders tersedia dari Controller --}}
                                @forelse($latestOrders as $order)
                                    <li>
                                        <a class="dropdown-item small" href="{{ route('orders.show', $order->id) ?? '#' }}"
                                            style="line-height: 1.2;">
                                            Pesanan #{{ $order->id }} ({{ $order->created_at->format('d/m') }})
                                            <br>
                                            {{-- LOGIKA WARNA STATUS --}}
                                            <span
                                                class="fw-bold
                                                                                                                                            @if ($order->status == 'Lunas' || $order->status == 'Selesai') text-success
                                                                                                                                            @elseif ($order->status == 'Dibatalkan') text-danger
                                                                                                                                            @elseif (Str::contains($order->status, 'Menunggu') || $order->status == 'Diproses') text-info
                                                                                                                                            @else text-primary
                                                                                                                                            @endif">
                                                Status: {{ $order->status }}
                                            </span>
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <span class="dropdown-item text-muted small">Belum ada pesanan terbaru.</span>
                                    </li>
                                @endforelse

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item" href="/ganti-profil">
                                        <span
                                            class="material-symbols-outlined align-middle small me-1">manage_accounts</span>
                                        Akun
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item text-danger bg-warning" href="{{ route('logout') }}">
                                        <span class="material-symbols-outlined align-middle small me-1">logout</span> Keluar
                                    </a>
                                </li>

                            @else
                                {{-- Jika belum login --}}
                                <li><a class="dropdown-item text-black bg-warning" href="{{ route('login') }}">Login</a>
                                </li>
                                <li><a class="dropdown-item text-black bg-warning"
                                        href="{{ route('register') }}">Register</a></li>
                            @endauth
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content" data-aos="fade-up">
            <h1 class="display-4 fw-bold mb-3">Selamat Datang di GusWarung!</h1>
            <p class="lead">
                Kelola pesanan dengan mudah dan cepat. Selalu siap melayani pelanggan.
            </p>

            <div class="mt-4 d-flex flex-column align-items-center">
                <div class="input-group" style="max-width: 400px">
                    <input type="text" id="searchInput" class="form-control"
                        placeholder="Cari menu (contoh: Ayam, Nasi, Kopi)..." aria-label="Cari Menu" />
                    <button class="btn btn-warning text-white" id="searchButton">
                        <span class="material-symbols-outlined align-middle">search</span>
                    </button>
                </div>
                <div id="searchResults" class="mt-3 w-100" style="max-width: 500px"></div>
            </div>
        </div>
    </header>

    <div class="container mt-4 mb-5" data-aos="fade-up">
        <div class="d-flex justify-content-center flex-wrap gap-2" id="menu-filters">
            <button class="btn btn-warning active" data-filter="all">
                <i class="fas fa-list-ul me-1"></i> Semua Menu
            </button>
            <button class="btn btn-outline-warning" data-filter="makanan">
                <i class="fas fa-drumstick-bite me-1"></i> Makanan
            </button>
            <button class="btn btn-outline-warning" data-filter="minuman">
                <i class="fas fa-coffee me-1"></i> Minuman
            </button>
            <button class="btn btn-outline-warning" data-filter="addon">
                <i class="fas fa-plus-circle me-1"></i> Tambahan (Add-ons)
            </button>
            <button class="btn btn-outline-warning" data-filter="populer">
                <i class="fas fa-fire me-1"></i> Populer
            </button>
            <button class="btn btn-outline-warning" data-filter="diskon">
                <i class="fas fa-tag me-1"></i> Diskon
            </button>
        </div>
    </div>

    <div class="container my-5 pt-0">

        <div class="row g-4 justify-content-center" id="menu-list-container">

            @foreach($makanan as $menu)
                <div class="col-md-4 menu-item" data-aos="zoom-in" data-kategori="makanan"
                    data-populer="{{ $menu->is_popular ? 'yes' : 'no' }}">
                    <div class="card shadow-sm border-0">
                        @if($menu->is_popular)
                            <span class="popular-badge">⭐ Populer</span>
                        @endif

                        <img src="{{ asset($menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}" />

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $menu->nama }}</h5>
                            <p class="card-text text-muted flex-grow-1">
                                {{ $menu->deskripsi }}
                            </p>

                            {{-- Logic Status Stok --}}
                            <!-- @php
                                $stokStatus = 'stock-ready';
                                $stokText = 'Stok: ' . $menu->stok . ' Porsi';
                                if ($menu->stok < 10 && $menu->stok > 0) {
                                    $stokStatus = 'stock-low';
                                    $stokText = 'Stok: ' . $menu->stok . ' Porsi (Menipis!)';
                                } elseif ($menu->stok == 0) {
                                    $stokStatus = 'stock-out';
                                    $stokText = 'Stok: Habis';
                                }
                            @endphp

                            <div class="stock-info {{ $stokStatus }} mb-2">{{ $stokText }}</div> -->

                            {{-- Logic Harga Diskon --}}
                            @php
                                $diskon = $menu->diskon_persen ?? 0;
                                $harga_asli = $menu->harga;
                                $harga_diskon = $harga_asli * (1 - ($diskon / 100));
                            @endphp

                            <div class="price-group">
                                @if ($diskon > 0)
                                    <span class="original-price">Rp {{ number_format($harga_asli, 0, ',', '.') }}</span>
                                    <span class="discount-price">Rp {{ number_format($harga_diskon, 0, ',', '.') }}</span>
                                    <span class="discount-badge">{{ $diskon }}%</span>
                                @else
                                    <span class="fw-bold text-warning">Rp {{ number_format($harga_asli, 0, ',', '.') }}</span>
                                @endif
                            </div>

                            <button class="btn btn-warning text-white w-100" @if($menu->stok == 0) disabled @endif
                                onclick="addToCart({
                                                                                                                                                                                                                                            id: {{ $menu->id }},
                                                                                                                                                                                                                                                name: '{{ $menu->nama }}',
                                                                                                                                                                                                                                                price: {{ round($harga_diskon) }}, 
                                                                                                                                                                                                                                                image: '{{ asset($menu->gambar) }}',
                                                                                                                                                                                                                                                unit: 'Porsi', 
                                                                                                                                                                                                                                                stok: {{ $menu->stok }},
                                                                                                                                                                                                                                                diskon: {{ $diskon }}
                                                                                                                                                                                                                                                                            })">
                                <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($minuman as $menu)
                @php
                    // Hitung harga & diskon per produk
                    $harga_asli = $menu->harga;
                    $diskon = $menu->diskon_persen ?? 0;
                    $harga_diskon = $diskon > 0
                        ? $harga_asli - ($harga_asli * $diskon / 100)
                        : $harga_asli;

                    // Logic Status Stok Minuman
                    // $stokStatus = 'stock-ready';
                    // $stokText = 'Stok: ' . $menu->stok . ' Unit'; // Unit untuk minuman

                    // if ($menu->stok < 10 && $menu->stok > 0) {
                    //     $stokStatus = 'stock-low';
                    //     $stokText = 'Stok: ' . $menu->stok . ' Unit (Menipis!)';
                    // } elseif ($menu->stok == 0) {
                    //     $stokStatus = 'stock-out';
                    //     $stokText = 'Stok: Habis';
                    // }
                @endphp

                <div class="col-md-4 menu-item" data-aos="zoom-in" data-kategori="minuman"
                    data-populer="{{ $menu->is_popular ? 'yes' : 'no' }}">
                    <div class="card shadow-sm border-0 drink-card h-100">

                        @if($menu->is_popular)
                            <span class="popular-badge">⭐ Populer</span>
                        @endif

                        <img src="{{ asset($menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}" />

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $menu->nama }}</h5>

                            <p class="card-text text-muted flex-grow-1">
                                {{ $menu->deskripsi }}
                            </p>

                            <!-- <div class="stock-info {{ $stokStatus }} mb-2">
                                {{ $stokText }}
                            </div> -->s

                            <div class="price-group">
                                @if ($diskon > 0)
                                    <span class="original-price">
                                        Rp {{ number_format($harga_asli, 0, ',', '.') }}
                                    </span>
                                    <span class="discount-price">
                                        Rp {{ number_format($harga_diskon, 0, ',', '.') }}
                                    </span>
                                    <span class="discount-badge">
                                        {{ $diskon }}%
                                    </span>
                                @else
                                    <span class="fw-bold text-warning">
                                        Rp {{ number_format($harga_asli, 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-warning text-white w-100" @if($menu->stok == 0) disabled @endif
                                onclick="addToCart({
                                                                                                                            id: {{ $menu->id }},
                                                                                                                            name: '{{ $menu->nama }}',
                                                                                                                            price: {{ round($harga_diskon) }},
                                                                                                                            image: '{{ asset($menu->gambar) }}',
                                                                                                                            unit: 'Unit',
                                                                                                                            stok: {{ $menu->stok }},
                                                                                                                            diskon: {{ $diskon }}
                                                                                                                        })">
                                <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                            </button>
                        </div>

                    </div>
                </div>
            @endforeach

            @foreach($addons as $menu)
                @php
                    // Hitung harga & diskon per produk (Add-ons)
                    $harga_asli = $menu->harga;
                    $diskon = $menu->diskon_persen ?? 0;
                    $harga_diskon = $diskon > 0
                        ? $harga_asli - ($harga_asli * $diskon / 100)
                        : $harga_asli;

                    // Logic Status Stok Add-ons (disamakan stylenya dengan minuman)
                    // $stokStatus = 'stock-ready';
                    // $stokText = 'Stok: ' . $menu->stok . ' Porsi';

                    // if ($menu->stok < 10 && $menu->stok > 0) {
                    //     $stokStatus = 'stock-low';
                    //     $stokText = 'Stok: ' . $menu->stok . ' Porsi (Menipis!)';
                    // } elseif ($menu->stok == 0) {
                    //     $stokStatus = 'stock-out';
                    //     $stokText = 'Stok: Habis';
                    // }
                @endphp

                <div class="col-md-4 menu-item" data-aos="zoom-in" data-kategori="addon"
                    data-populer="{{ $menu->is_popular ? 'yes' : 'no' }}">
                    <div class="card shadow-sm border-0 drink-card h-100">
                        @if($menu->is_popular)
                            <span class="popular-badge">⭐ Populer</span>
                        @endif

                        <img src="{{ asset($menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}" />

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $menu->nama }}</h5>

                            <p class="card-text text-muted flex-grow-1">
                                {{ $menu->deskripsi }}
                            </p>

                            {{-- Stock info (style sama dengan minuman) --}}
                            <!-- <div class="stock-info {{ $stokStatus }} mb-2">
                                {{ $stokText }}
                            </div> -->

                            <div class="price-group">
                                @if ($diskon > 0)
                                    <span class="original-price">
                                        Rp {{ number_format($harga_asli, 0, ',', '.') }}
                                    </span>
                                    <span class="discount-price">
                                        Rp {{ number_format($harga_diskon, 0, ',', '.') }}
                                    </span>
                                    <span class="discount-badge">
                                        {{ $diskon }}%
                                    </span>
                                @else
                                    <span class="fw-bold text-warning">
                                        Rp {{ number_format($harga_asli, 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-warning text-white w-100" @if($menu->stok == 0) disabled @endif onclick="addToCart({
                                                                                                id: {{ $menu->id }},
                                                                                                name: '{{ $menu->nama }}',
                                                                                                price: {{ round($harga_diskon) }},
                                                                                                image: '{{ asset($menu->gambar) }}',
                                                                                                unit: 'Porsi',
                                                                                                stok: {{ $menu->stok }},
                                                                                                diskon: {{ $diskon }}
                                                                                            })">
                                <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
    <section class="text-center my-5 py-5 position-relative bg-light" data-aos="fade-up" style="
        border-top: 3px solid #ffc107;
        border-bottom: 3px solid #ffc107;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
      ">
        <div class="container">
            <i class="material-symbols-outlined text-warning fs-1 mb-3">
                format_quote
            </i>
            <h2 class="fw-bold text-warning mb-3 fst-italic">
                "Rasa yang Mengikat Kenangan"
            </h2>
            <div class="divider mx-auto mb-3" style="
            width: 80px;
            height: 4px;
            border-radius: 2px;
            background: linear-gradient(
              to right,
              transparent,
              #ffc107,
              transparent
            );
          "></div>
            <p class="text-muted fs-5">
                Di setiap hidangan, kami menyajikan lebih dari sekadar makanan — kami
                menghadirkan kehangatan dan cerita di setiap rasa.
            </p>
            <p class="text-secondary mt-3 mb-0 fst-italic">
                — Tim Dapur <b>GusWarung</b>
            </p>
        </div>
    </section>

    <div class="modal fade" id="quickCartModal" tabindex="-1" aria-labelledby="quickCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title fw-bold" id="quickCartModalLabel">
                        <span class="material-symbols-outlined align-middle me-1">shopping_cart</span>
                        Keranjang Saya
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="quick-cart-items-list">
                        <p class="text-center text-muted m-4">Keranjang kosong.</p>
                    </div>
                </div>
                <div class="modal-footer d-block">
                    <div class="summary-details mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Subtotal</span>
                            <span id="quick-cart-subtotal">Rp 0</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                        <span>Total</span>
                        <span class="text-warning" id="quick-cart-total">Rp 0</span>
                    </div>
                    <a href="{{ url('/checkout') }}" class="btn btn-danger w-100 fw-bold">
                        Lanjut Checkout (Bayar)
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer style="background: #222; color: #eee; padding: 60px 20px">
        <div class="footer-content" style="
          display: flex;
          flex-wrap: wrap;
          justify-content: space-around;
          gap: 40px;
          text-align: left;
        ">
            <div style="max-width: 300px">
                <h3 style="color: #ffb703">GUSWarung</h3>
                <p style="color: #ccc">
                    Platform kuliner untuk menjelajahi cita rasa Nusantara dari warung
                    lokal. Cepat, mudah, dan terpercaya.
                </p>
            </div>

            <div>
                <h3 style="color: #ffb703">Menu</h3>
                <a href="#" style="color: #ccc; text-decoration: none">Beranda</a><br />
                <a href="#" style="color: #ccc; text-decoration: none">Tentang</a><br />
                <a href="#" style="color: #ccc; text-decoration: none">Kontak</a><br />
            </div>

            <div>
                <h3 style="color: #ffb703">Ikuti Kami</h3>
                <div class="social-icons" style="margin-top: 10px">
                    <a href="#" class="me-3 text-white fs-4"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-3 text-white fs-4"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white fs-4"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="floating-cart" data-bs-toggle="modal" data-bs-target="#quickCartModal" id="floatingCartButton">
        <span class="material-symbols-outlined">shopping_cart</span>
        <span class="cart-badge">0</span>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });
    </script>
    <script src="{{ asset('js/script-penjualan.js') }}"></script>

</body>

</html>