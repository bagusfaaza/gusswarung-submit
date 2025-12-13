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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - Warung Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #ffffff;
        }

        /* ===== Navbar ===== */
        .navbar {
            background-color: #ffc107 !important;
            /* Diubah agar konsisten dengan navbar lain */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-link,
        .navbar .dropdown-toggle {
            color: #000 !important;
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link.active {
            color: #fff !important;
            background-color: #e9de08;
            border-radius: 10px;
            padding: 8px 16px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .nav-link.active:hover {
            background-color: #d1c607;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* ===== Section Hero ===== */
        .about-hero {
            /* gradient overlay + background image dalam satu deklarasi */
            background:
                linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                url('https://img.freepik.com/foto-gratis/pelayan-bahagia-menyajikan-makanan-kepada-sekelompok-teman-yang-ceria-di-pub_637285-12525.jpg') center/cover no-repeat;

            color: #fff;
            text-align: center;
            border-radius: 20px;
            padding: 80px 20px;
            margin: 40px auto;
            width: 90%;
        }

        .about-hero h1 {
            font-weight: 700;
        }

        .stats {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-item span.material-symbols-outlined {
            font-size: 48px;
            color: #fff8dc;
        }

        .stat-item p {
            margin: 5px 0 0;
            font-size: 15px;
        }

        /* ===== Section Cerita ===== */
        .section-title {
            font-weight: 700;
            color: #5a2e00;
            text-align: center;
            margin-bottom: 10px;
        }

        .underline {
            width: 70px;
            height: 4px;
            background-color: #d26b17;
            margin: 0 auto 20px;
            border-radius: 2px;
        }

        /* ===== Section Kontak ===== */
        .contact-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 25px;
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-card span.material-symbols-outlined {
            font-size: 40px;
            color: #d26b17;
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #444;
            margin-top: 40px;
        }
    </style>
</head>

<body>
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
                        <a class="nav-link text-black" href="/">Home</a>
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

    <section style="margin-top: 120px;" class="about-hero">
        <h1 data-aos="fade-up">Tentang Warung Saya</h1>
        <p data-aos="fade-up" data-aos-delay="100">Warung makan tradisional dengan cita rasa istimewa</p>
        <div class="stats" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-item">
                <span class="material-symbols-outlined">groups</span>
                <h4>100+</h4>
                <p>Pelanggan</p>
            </div>
            <div class="stat-item">
                <span class="material-symbols-outlined">grade</span>
                <h4>5.0</h4>
                <p>Rating</p>
            </div>
            <div class="stat-item">
                <span class="material-symbols-outlined">restaurant</span>
                <h4>8+</h4>
                <p>Menu</p>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 class="section-title" data-aos="fade-right">Cerita Kami</h2>
        <div class="underline" data-aos="zoom-in"></div>
        <p class="text-center mx-auto" style="max-width: 750px;" data-aos="fade-up">
            Warung Saya didirikan dengan semangat untuk menyajikan hidangan rumahan berkualitas tinggi dengan harga
            terjangkau.
            Setiap menu kami dibuat dari bahan-bahan segar pilihan dan resep turun-temurun.
        </p>
        <p class="text-center mx-auto" style="max-width: 750px;" data-aos="fade-up" data-aos-delay="100">
            Kami bangga melayani komunitas lokal dengan hidangan lezat yang mengingatkan pelanggan akan masakan rumah.
            Dari Nasi Goreng Spesial yang terkenal hingga Soto Ayam yang menghangatkan, setiap hidangan dibuat dengan
            cinta dan dedikasi.
        </p>
    </section>

    <section class="py-5 text-center">
        <h2 class="fw-bold mb-3" style="color:#a14f00;" data-aos="fade-down">Apa Kata Pelanggan</h2>
        <div class="underline mx-auto mb-4" style="width:70px;height:4px;background:#a14f00;border-radius:2px;"
            data-aos="zoom-in"></div>

        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="fade-right">
                    <div class="p-4 border rounded-4 shadow-sm bg-white">
                        <p>"Makanannya enak banget, bener-bener kayak di rumah sendiri. Pelayanannya cepat dan ramah!"
                        </p>
                        <h6 class="fw-semibold mt-3">— Dwi Anjani</h6>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-left">
                    <div class="p-4 border rounded-4 shadow-sm bg-white">
                        <p>"GusWarung beneran beda, suasananya hangat dan modern. Favoritku: Nasi Goreng Spesial!"</p>
                        <h6 class="fw-semibold mt-3">— Fajar Rahman</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="video-section text-center my-5">
        <h2 class="fw-bold mb-3" style="color:#a14f00;" data-aos="fade-down">Profil Usaha GusWarung</h2>
        <div class="underline mx-auto mb-4" style="width:70px;height:4px;background:#a14f00;border-radius:2px;"
            data-aos="zoom-in"></div>

        <div class="container">
            <div class="d-flex justify-content-center" data-aos="zoom-in">
                <video controls autoplay muted loop playsinline
                    style="width:70%; max-width:700px; border-radius:20px; box-shadow:0 6px 18px rgba(0,0,0,0.2);">
                    <source src="video/video gaus warung.mp4" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video>
            </div>
            <p class="mt-3 text-muted" data-aos="fade-up" data-aos-delay="200">
                Nikmati cerita di balik dapur digital kami – <strong>GusWarung</strong>, cita rasa lokal dengan sentuhan
                modern.
            </p>
        </div>
    </section>

    <section class="container my-5">
        <h2 class="section-title" data-aos="fade-right">Hubungi Kami</h2>
        <div class="underline" data-aos="zoom-in"></div>

        <div class="row justify-content-center">
            <div class="col-md-3 col-sm-6 contact-card" data-aos="fade-up" data-aos-delay="100">
                <span class="material-symbols-outlined mb-2">location_on</span>
                <h5>Lokasi</h5>
                <p>Jl. Raya Kendung No 70, Benowo<br>Surabaya</p>
            </div>

            <div class="col-md-3 col-sm-6 contact-card" data-aos="fade-up" data-aos-delay="200">
                <span class="material-symbols-outlined mb-2">call</span>
                <h5>Kontak</h5>
                <p>+62 812 3456 7890<br><span class="text-success fw-semibold">WhatsApp tersedia</span></p>
            </div>

            <div class="col-md-3 col-sm-6 contact-card" data-aos="fade-up" data-aos-delay="300">
                <span class="material-symbols-outlined mb-2">schedule</span>
                <h5>Jam Buka</h5>
                <p>Setiap Hari<br><strong>05:30 - 15:00</strong></p>
            </div>

            <div class="col-md-3 col-sm-6 contact-card" data-aos="fade-up" data-aos-delay="400">
                <span class="material-symbols-outlined mb-2">mail</span>
                <h5>Email</h5>
                <p>GusWarung@warungsaya.com<br>GusWarung@warungsaya.com</p>
            </div>
        </div>
    </section>

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

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        /* durasi animasi 1 detik */
        once: true,
        /* animasi hanya muncul sekali */
        easing: 'ease-in-out'
    });
</script>

</html>