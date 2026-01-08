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
    <meta name="viewport" content="width=
    , initial-scale=1.0" />
    <title>Gus Warung</title>
    <link rel="icon" href="logo_guswarung tb.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style-userhome.css') }}">

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

<body>
    <!-- Navbar -->
    <!-- Navbar -->
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
    <a class="nav-link text-black {{ request()->routeIs('user.dashboard') ? 'active fw-bold' : '' }}"
       href="{{ route('user.dashboard') }}">
        Home
    </a>
</li>


                    <li class="nav-item">
                        <a class="nav-link text-black" href="/sell">Penjualan</a>
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


    <!-- Akhir Navbar -->

    <!-- Hero section -->
    <section class="hero-scroll">
        {{-- Ambil data user yang login (jika ada) --}}
        @php
            $userName = Auth::check() ? Auth::user()->name : null;
        @endphp

        {{-- SLIDE 1 --}}
        <div class="hero-slide">
            <div class="hero-overlay"></div>
            <div class="hero-text">
                {{-- Tambahkan ucapan sambutan di sini --}}
                @if ($userName)
                    <h2 class="text-white mb-2" style="font-weight: 400;">
                        Hello, <span class="fw-bold text-warning">{{ $userName }}</span>!
                    </h2>
                @endif

                <h1>
                    Nikmati Cita Rasa <br /><span>Nusantara</span> dari Warung Favoritmu
                </h1>
                <div class="card p-4 shadow-sm mx-auto" style="
            max-width: 850px;
            border-radius: 18px;
            background-color: #ffe240;
            border: 1px solid #eee;
          ">
                    <p class="mb-0" style="
                text-align: justify;
                color: #444;
                font-size: 1.05rem;
                line-height: 1.7;
              ">
                        Gus Warung adalah pengembangan digital dari sebuah UMKM kuliner
                        lokal yang kini hadir dalam bentuk platform online. Kami
                        berkomitmen menghadirkan pengalaman menikmati hidangan warung
                        tradisional dengan cara yang lebih mudah dan modern. Melalui
                        digitalisasi, Gus Warung tetap menjaga cita rasa khas warung,
                        pelayanan hangat, dan harga terjangkau bagi semua kalangan.
                    </p>
                </div>
            </div>
            <div class="hero-img">
                <img src="img/kursi.jpg" alt="Makanan Warung" />
            </div>
        </div>

        {{-- SLIDE 2 --}}
        <div class="hero-slide">
            <div class="hero-overlay"></div>
            <div class="hero-text">
                {{-- Tambahkan ucapan sambutan di sini --}}
                @if ($userName)
                    <h2 class="text-white mb-2" style="font-weight: 400;">
                        Hello, <span class="fw-bold text-warning">{{ $userName }}</span>!
                    </h2>
                @endif

                <h1>
                    Nikmati Cita Rasa <br /><span>Nusantara</span> dari Warung Favoritmu
                </h1>
                <div class="card p-4 shadow-sm mx-auto" style="
            max-width: 850px;
            border-radius: 18px;
            background-color: #ffe240;
            border: 1px solid #eee;
          ">
                    <p class="mb-0" style="
                text-align: justify;
                color: #444;
                font-size: 1.05rem;
                line-height: 1.7;
              ">
                        Gus Warung berkomitmen menjadi jembatan antara warung lokal dan
                        pelanggan di era digital. Kami ingin setiap orang, di mana pun
                        berada, bisa menikmati cita rasa khas Nusantara tanpa kehilangan
                        sentuhan kehangatan warung tradisional. Inilah langkah kecil kami
                        untuk menjaga budaya kuliner Indonesia tetap hidup di dunia
                        digital.
                    </p>
                </div>
            </div>
            <div class="hero-img">
                <img src="img/AyamBakar.jpg" alt="Makanan Warung" />
            </div>
        </div>

        {{-- SLIDE 3 --}}
        <div class="hero-slide">
            <div class="hero-overlay"></div>
            <div class="hero-text">
                {{-- Tambahkan ucapan sambutan di sini --}}
                @if ($userName)
                    <h2 class="text-white mb-2" style="font-weight: 400;">
                        Hello, <span class="fw-bold text-warning">{{ $userName }}</span>!
                    </h2>
                @endif

                <h1>
                    Nikmati Cita Rasa <br /><span>Nusantara</span> dari Warung Favoritmu
                </h1>
                <div class="card p-4 shadow-sm mx-auto" style="
            max-width: 850px;
            border-radius: 18px;
            background-color: #ffe240;
            border: 1px solid #ffffff;
          ">
                    <p class="mb-0" style="
                text-align: justify;
                color: #444;
                font-size: 1.05rem;
                line-height: 1.7;
              ">
                        Chef Baguz adalah sosok di balik setiap hidangan lezat yang
                        menjadi ciri khas Gus Warung. Berawal dari dapur sederhana warung
                        keluarga, ia menghadirkan cita rasa Nusantara yang tetap autentik
                        di era digital. Dengan dedikasi dan kecintaannya terhadap masakan
                        rumahan, Chef Gus terus berinovasi menghadirkan hidangan yang
                        menggugah selera tanpa meninggalkan cita rasa khas warung.
                    </p>
                </div>
            </div>
            <div class="hero-img">
                <img src="img/chef baguz.jpg" alt="Makanan Warung" />
            </div>
        </div>
    </section>

    <!-- ======= KATEGORI PILIHAN ======= -->
    <section class="categories py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4 text-dark">Kategori Pilihan</h2>

            <div class="row justify-content-center g-4">
                <!-- Card 1 -->
                <div class="col-6 col-md-3">
                    <div class="card category-card shadow-sm border-0">
                        <img src="img/nasi ayam.jpg" class="card-img-top" alt="Aneka Nasi" />
                        <div class="card-body">
                            <p class="card-text fw-semibold text-dark">Aneka Nasi</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-6 col-md-3">
                    <div class="card category-card shadow-sm border-0">
                        <img src="img/BuburKomplit.jpg" class="card-img-top" alt="Bubur ayam" />
                        <div class="card-body">
                            <p class="card-text fw-semibold text-dark">Bubur Ayam</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-6 col-md-3">
                    <div class="card category-card shadow-sm border-0">
                        <img src="img/aneka minuman.jpg" class="card-img-top" alt="Sate" />
                        <div class="card-body">
                            <p class="card-text fw-semibold text-dark">Aneka Minuman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= POPULAR MENU ======= -->
    <section class="popular">
        <h2>Menu Populer Minggu Ini</h2>
        <div class="menu-list">
            <div class="menu-card">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsMjQSgKyAzBRNvo_z1PwbdiXcXxR0gb198w&s"
                    alt="Nasi kuning" />
                <h3>Nasi Kuning Ayam Goreng</h3>
                <p>
                    Nasi kuning gurih dengan ayam goreng renyah, sambal pedas manis, dan
                    pelengkap tradisional yang lezat.
                </p>
                <div class="text-center my-3">
                    <a href="/sell" class="btn btn-success fw-semibold shadow-sm w-100 py-3 rounded-pill"
                        style="max-width: 300px">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
            <div class="menu-card">
                <img src="https://nibble-images.b-cdn.net/nibble/original_images/resep_bubur_ayam_04_be2a72a6b8.jpeg?class=large"
                    alt="Soto Ayam" />
                <h3>Bubur Ayam Komplit Dewasa</h3>
                <p>
                    Bubur ayam gurih dengan topping lengkap — suwiran ayam, cakwe,
                    bawang goreng, dan kuah kaldu hangat yang menggoda selera. Cocok
                    disantap kapan saja!
                </p>
                <div class="text-center my-3">
                    <a href="/sell" class="btn btn-success fw-semibold shadow-sm w-100 py-3 rounded-pill"
                        style="max-width: 300px">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
            <div class="menu-card">
                <img src="img/AyamBakar.jpg" alt="Ayam Bakar" />
                <h3>Ayam Bakar</h3>
                <p>
                    Ayam bakar dengan bumbu manis gurih khas tradisional, dibakar hingga
                    matang sempurna dan harum menggoda selera.
                </p>
                <div class="text-center my-3">
                    <a href="/sell" class="btn btn-success fw-semibold shadow-sm w-100 py-3 rounded-pill"
                        style="max-width: 300px">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= PROMO UTAMA GUS WARUNG ======= -->
    <section class="promo-bestdeal py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center g-4">
                <!-- Gambar Promo -->
                <div class="col-md-6 text-center">
                    <div class="promo-img position-relative d-inline-block">
                        <img src="img/AyamLaos.webp" class="rounded-circle shadow-lg" alt="Promo Best Deal" style="
                  width: 280px;
                  height: 280px;
                  object-fit: cover;
                  border: 8px solid #f1f8e9;
                " />
                        <div class="discount-badge position-absolute top-0 end-0 bg-success text-white fw-bold rounded-circle d-flex align-items-center justify-content-center"
                            style="
                  width: 80px;
                  height: 80px;
                  font-size: 1.3rem;
                  transform: translate(25%, -25%);
                ">
                            50%
                            <span style="font-size: 0.9rem; display: block">OFF</span>
                        </div>
                    </div>
                </div>

                <!-- Teks Promo -->
                <div class="col-md-6 text-center text-md-start">
                    <h2 class="fw-bold text-dark" style="font-size: 2.5rem">
                        TODAY’S <span style="color: #4caf50">BEST DEAL!</span>
                    </h2>
                    <p class="text-muted my-3" style="font-size: 1.1rem">
                        Nikmati promo hemat spesial dari <strong>Gus Warung</strong> untuk
                        menu pilihan hari ini! Cita rasa khas warung dengan potongan harga
                        hingga 50%. Pesan sekarang sebelum kehabisan!
                    </p>
                    <a href="/sell" class="btn btn-success fw-semibold shadow-sm w-100 py-3 rounded-pill"
                        style="max-width: 300px">
                        Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= STATISTIK GUS WARUNG ======= -->
    <section class="stats-section py-5" style="background: linear-gradient(90deg, #fff8e1, #f1f8e9)">
        <section class="container text-center">
            <h2 class="fw-bold mb-4 text-dark">Gus Warung dalam Angka</h2>
            <p class="text-muted mb-5">
                Terima kasih telah menjadi bagian dari komunitas kuliner Nusantara 🍽️
            </p>

            <div class="row g-4 justify-content-center">

                <!-- Total Pesanan -->
                <div class="col-6 col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm">
                        <div class="fs-1 fw-bold text-warning counter" data-target="{{ $totalPesanan }}">
                            0
                        </div>
                        <p class="fw-semibold mt-2">Total Pesanan</p>
                    </div>
                </div>

                <!-- Pelanggan Aktif -->
                <div class="col-6 col-md-3">
                    <div class="p-4 bg-white rounded-4 shadow-sm">
                        <div class="fs-1 fw-bold text-success counter" data-target="{{ $pelangganAktif }}">
                            0
                        </div>
                        <p class="fw-semibold mt-2">Pelanggan Aktif</p>
                    </div>
                </div>

                <!-- Menu Terlaris -->
                <div class="col-6 col-md-3">
                <div class="p-4 bg-white rounded-4 shadow-sm text-center">
                    <div class="fs-4 fw-bold text-info">
                        {{ $namaMenuTerlaris }}
                    </div>
                    <p class="fw-semibold mt-2">Menu Terlaris 🍜</p>
                </div>
            </div>
            </div>
        </section>
    </section>

    <!-- ======= FOOTER ======= -->
    <footer style="background: #222; color: #eee; padding: 60px 20px">
        <div class="footer-content" style="
          display: flex;
          flex-wrap: wrap;
          justify-content: space-around;
          gap: 40px;
          text-align: left;
        ">
            <!-- Kolom 1 -->
            <div style="max-width: 300px">
                <h3 style="color: #ffb703">GUSWarung</h3>
                <p style="color: #ccc">
                    Platform kuliner untuk menjelajahi cita rasa Nusantara dari warung
                    lokal. Cepat, mudah, dan terpercaya.
                </p>
            </div>

            <!-- Kolom 2 -->
            <div>
                <h3 style="color: #ffb703">Menu</h3>
                <a href="#" style="color: #ccc; text-decoration: none">Beranda</a><br />
                <a href="#" style="color: #ccc; text-decoration: none">Tentang</a><br />
                <a href="#" style="color: #ccc; text-decoration: none">Kontak</a><br />
            </div>

            <!-- Kolom 3 -->
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
    <!-- Akhir hero sectiom -->

    <!-- ======= SCRIPT ANIMASI COUNTER ======= -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const counters = document.querySelectorAll(".counter");
            const speed = 150; // kecepatan animasi
            let started = false;

            if (!counters.length) return;

            const animateCounters = () => {
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute("data-target"));
                    let count = 0;
                    const increment = Math.ceil(target / speed);

                    const updateCount = () => {
                        if (count < target) {
                            count += increment;
                            counter.innerText = count.toLocaleString();
                            setTimeout(updateCount, 15);
                        } else {
                            counter.innerText = target.toLocaleString();
                        }
                    };

                    updateCount();
                });
            };

            const statsSection = document.querySelector(".stats-section");
            if (!statsSection) {
                animateCounters(); // fallback jika section tidak ada
                return;
            }

            const checkScroll = () => {
                const sectionTop = statsSection.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (!started && sectionTop < windowHeight - 100) {
                    animateCounters();
                    started = true;
                    window.removeEventListener("scroll", checkScroll);
                }
            };

            window.addEventListener("scroll", checkScroll);
            checkScroll(); // cek saat pertama load (tanpa scroll)

        });
    </script>

    <script>
        document.querySelectorAll('.dropdown-submenu > a').forEach((el) => {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                let parent = this.parentElement;

                // Tutup submenu lainnya
                document.querySelectorAll('.dropdown-submenu').forEach((item) => {
                    if (item !== parent) item.classList.remove('show');
                });

                // Toggle submenu
                parent.classList.toggle('show');
            });
        });

        // Tutup submenu saat dropdown utama ditutup
        document.querySelectorAll('.dropdown').forEach((el) => {
            el.addEventListener('hidden.bs.dropdown', function () {
                document.querySelectorAll('.dropdown-submenu').forEach((item) => {
                    item.classList.remove('show');
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const toggles = document.querySelectorAll(".toggle-submenu");

            toggles.forEach(toggle => {
                toggle.addEventListener("click", function (e) {
                    e.preventDefault();

                    let submenu = this.nextElementSibling;

                    // Toggle show/hide
                    if (submenu.style.display === "block") {
                        submenu.style.display = "none";
                    } else {
                        submenu.style.display = "block";
                    }
                });
            });
        });
    </script>
</body>

</html>