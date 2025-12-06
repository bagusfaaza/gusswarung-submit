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

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        h1,
        h2,
        h3,
        .navbar-brand {
            font-family: "Playfair Display", serif;
        }

        /* Efek zoom gambar ketika hover */

        .navbar-brand {
            display: flex;
            align-items: center;
            /* sejajarkan logo dan teks di tengah vertikal */
            gap: 10px;
            /* beri jarak kecil antara logo dan teks */
        }

        .navbar-brand img {
            display: inline-block;
            vertical-align: middle;
            /* pastikan logo ikut rata tengah */
            margin-bottom: 0 !important;
            /* hilangkan offset bawah */
        }

        .card-img-top {
            transition: transform 0.4s ease;
            object-fit: cover;
            height: 180px;
            /* Tinggi gambar serasi untuk makanan */
        }

        .card:hover .card-img-top {
            transform: scale(1.08);
        }

        /* Rating bintang */

        .rating {
            color: #ffc107;
            font-size: 1.2rem;
        }

        /* Animasi halus muncul */

        .card {
            overflow: hidden;
            position: relative;
            border-radius: 12px;
        }

        .card-img-top {
            transition: transform 0.4s ease;
            object-fit: cover;
            height: 180px;
            border-radius: 12px 12px 0 0;
        }

        .card:hover .card-img-top {
            transform: scale(1.08);
        }

        .popular-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 193, 7, 0.9);
            /* Warna kuning transparan */
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 10px;
            backdrop-filter: blur(4px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 5;
        }

        /* Styling untuk label Stok */

        .stock-info {
            font-size: 0.9rem;
            font-weight: bold;
            padding: 5px 0;
        }

        .stock-ready {
            color: #198754;
            /* Hijau untuk Stok Cukup */
        }

        .stock-low {
            color: #ffc107;
            /* Kuning untuk Stok Menipis */
        }

        .stock-out {
            color: #dc3545;
            /* Merah untuk Stok Habis */
        }

        /* Style untuk Header Restoran */

        .hero-section {
            background: url("https://img.freepik.com/foto-gratis/pelayan-bahagia-menyajikan-makanan-kepada-sekelompok-teman-yang-ceria-di-pub_637285-12525.jpg") no-repeat center center;
            /* Ganti dengan gambar restoran Anda */
            background-size: cover;
            height: 40vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            text-align: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Overlay gelap */
        }

        .hero-content {
            z-index: 2;
            color: white;
        }

        /* Style tambahan untuk carousel minuman agar tampil horizontal */

        .carousel-item-drinks {
            /* Pastikan card minuman memiliki tinggi yang sama dengan card makanan */
            height: 100%;
        }

        .carousel-inner .col-md-4 {
            /* Untuk menampilkan 3 item per slide, kita perlu mengontrol lebar item di dalam inner*/
            display: inline-block;
            float: left;
        }

        /* Custom styling for carousel height */

        .drink-carousel-container {
            max-width: 900px;
            /* Batasi lebar carousel agar tidak terlalu besar */
            margin: 0 auto;
        }

        .drink-card .card-img-top {
            height: 220px;
            /* Tinggi gambar sedikit lebih besar untuk minuman di carousel */
        }

        .divider {
            width: 120px;
            height: 4px;
            margin: 0 auto;
            border-radius: 2px;
            background: linear-gradient(to right,
                    transparent,
                    #ffc107,
                    transparent);
        }

        #searchResults {
            display: none;
            /* ⛔ awalnya disembunyikan */
            background: #ffd876;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            max-height: 300px;
            overflow-y: auto;
        }

        .search-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-bottom: 1px solid #eee;
            transition: background 0.2s;
        }

        .search-item:hover {
            background: #ffc107;
            border-radius: 10px;
            cursor: pointer;
        }

        .search-item img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .search-item h6 {
            margin: 0;
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.15);
        }

        .search-item p {
            margin: 0;
            font-size: 0.85rem;
            color: #ff0000;
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

        /* Tombol keranjang melayang */
        .floating-cart {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background-color: #ffc107;
            color: #fff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            text-decoration: none;
            transition: all 0.3s ease;
            z-index: 1050;
            /* di atas elemen lain */
        }

        .floating-cart:hover {
            background-color: #e0aa00;
            transform: scale(1.08);
        }

        /* Badge jumlah item */
        .cart-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
            padding: 3px 6px;
            line-height: 1;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

<body>
    <nav class="navbar navbar-expand-lg sticky-top shadow-lg" style="background-color: #ffc107">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="index.html">
                <img src="logo/logo_guswarung tb.png" alt="Logo" width="40" height="40" />
                GusWarung
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black active" href="/sell">Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="/about">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="material-symbols-outlined align-middle">account_circle</span>
                        </a>
                        <ul class="dropdown-menu bg-warning">
                            <li>
                                <a class="dropdown-item text-white bg-warning" href="/setting">Pengaturan</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white bg-warning" href="#">Profil</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger bg-warning" href="logout">Keluar</a>
                            </li>
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

                <!-- 🔽 Hasil pencarian akan muncul di sini -->
                <div id="searchResults" class="mt-3 w-100" style="max-width: 500px"></div>
            </div>
        </div>
    </header>
    <div class="container my-5">
        <h2 class="fw-bold text-center text-warning" data-aos="fade-down">
            <b>Menu Makanan Pilihan</b>
        </h2>
        <p class="mb-5 text-center" data-aos="fade-down">
            Temukan hidangan lezat pilihan kami, siap memanjakan lidahmu!
        </p>

        <div class="divider mx-auto mb-5" data-aos="fade-up"></div>

        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="card shadow-sm border-0">
                    <span class="popular-badge">⭐ Populer</span>
                    <img src="https://nibble-images.b-cdn.net/nibble/original_images/resep_bubur_ayam_04_be2a72a6b8.jpeg?class=large"
                        class="card-img-top" alt="Bubur Ayam" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Bubur Ayam</h5>
                        <div class="rating mb-2">⭐️⭐️⭐️⭐️☆</div>
                        <p class="card-text text-muted flex-grow-1">
                            Bubur ayam gurih dengan kuah kaldu hangat, cocok untuk semua
                            selera!
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 25 Porsi</div>
                        <p class="fw-bold text-warning">Mulai Rp 10.000</p>
                        <button class="btn btn-warning text-white w-100" data-bs-toggle="modal"
                            data-bs-target="#buburModal">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Pilihan -->
            <div class="modal fade" id="buburModal" tabindex="-1" aria-labelledby="buburModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="buburModalLabel">
                                Pilih Varian Bubur Ayam
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="buburForm">
                            <div class="modal-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="buburVariant" id="anak"
                                        value="Bubur Ayam Porsi Anak - Rp 10.000" required />
                                    <label class="form-check-label" for="anak">
                                        Bubur Ayam Porsi Anak — Rp 10.000
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="buburVariant" id="dewasa"
                                        value="Bubur Ayam Dewasa - Rp 14.000" />
                                    <label class="form-check-label" for="dewasa">
                                        Bubur Ayam Dewasa — Rp 14.000
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="buburVariant" id="komplit"
                                        value="Bubur Ayam Komplit - Rp 18.000" />
                                    <label class="form-check-label" for="komplit">
                                        Bubur Polos — Rp 8.000
                                    </label>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-warning text-white">
                                    <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Notifikasi sederhana -->
            <div id="toast" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100; display: none">
                <div class="toast align-items-center text-bg-success border-0 show">
                    <div class="d-flex">
                        <div class="toast-body" id="toastMessage"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="card shadow-sm border-0">
                    <span class="popular-badge">⭐ Populer</span>
                    <img src="img/AyamBakar.jpg" class="card-img-top" alt="Ayam Geprek" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Ayam Bakar</h5>
                        <div class="rating mb-2">⭐️⭐️⭐️⭐️⭐️</div>
                        <p class="card-text text-muted flex-grow-1">
                            Ayam bakar dengan bumbu manis gurih khas tradisional, dibakar
                            hingga matang sempurna dan harum menggoda selera.
                        </p>
                        <div class="stock-info stock-low mb-2">Stok: 5 Porsi</div>
                        <p class="fw-bold text-warning">Rp 15.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="card shadow-sm border-0">
                    <img src="img/AyamKremes.jpeg" class="card-img-top" alt="Mie Goreng" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Ayam Kremes</h5>
                        <div class="rating mb-2">⭐️⭐️⭐️⭐️☆</div>
                        <p class="card-text text-muted flex-grow-1">
                            Ayam goreng renyah dengan taburan kremes gurih khas rumahan,
                            disajikan dengan sambal pedas yang menggoda selera.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 18 Porsi</div>
                        <p class="fw-bold text-warning">Rp 15.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="card shadow-sm border-0">
                    <img src="img/AyamLaos.webp" class="card-img-top" alt="Sate Ayam" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Ayam Laos</h5>
                        <div class="rating mb-2">⭐️⭐️⭐️⭐️⭐️</div>
                        <p class="card-text text-muted flex-grow-1">
                            Ayam goreng berbumbu laos khas Jawa dengan aroma wangi dan rasa
                            gurih yang meresap hingga ke dalam daging.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 30 Porsi</div>
                        <p class="fw-bold text-warning">Rp 15.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="card shadow-sm border-0">
                    <img src="img/AyamKarage.jpg" class="card-img-top" alt="Sate Ayam" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Ayam Karage</h5>
                        <div class="rating mb-2">⭐️⭐️⭐️⭐️⭐️</div>
                        <p class="card-text text-muted flex-grow-1">
                            Potongan ayam empuk berbalut tepung renyah khas Jepang, digoreng
                            keemasan dan cocok disantap dengan nasi hangat.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 30 Porsi</div>
                        <p class="fw-bold text-warning">Rp 15.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="card shadow-sm border-0">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsMjQSgKyAzBRNvo_z1PwbdiXcXxR0gb198w&s"
                        class="card-img-top" alt="Sate Ayam" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Nasi Kuning Ayam Goreng</h5>
                        <div class="rating mb-2">⭐️⭐️⭐️⭐️⭐️</div>
                        <p class="card-text text-muted flex-grow-1">
                            Nasi kuning gurih dengan ayam goreng renyah, sambal pedas manis,
                            dan pelengkap tradisional yang lezat.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 30 Porsi</div>
                        <p class="fw-bold text-warning">Rp 20.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="card shadow-sm border-0">
                    <img src="https://i.pinimg.com/736x/c0/b5/bf/c0b5bf38af06e2197d3a02be5ccfa9b6.jpg"
                        class="card-img-top" alt="Sate Ayam" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Nasi Kuning Ayam Bakar Urap</h5>
                        <div class="rating mb-2">⭐️⭐️⭐️⭐️⭐️</div>
                        <p class="card-text text-muted flex-grow-1">
                            Perpaduan nasi kuning lembut dengan ayam bakar berbumbu manis
                            gurih, disajikan bersama urap segar yang menambah cita rasa.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 30 Porsi</div>
                        <p class="fw-bold text-warning">Rp 20.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="card shadow-sm border-0">
                    <img src="https://i0.wp.com/i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/f4fd79c2-956c-405b-b34f-0b1de443a900_Go-Biz_20200813_061426.jpeg?resize=728%2C500"
                        class="card-img-top" alt="Sate Ayam" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Nasi Kuning Telur Bali</h5>
                        <div class="rating mb-2">⭐️⭐️⭐️⭐️⭐️</div>
                        <p class="card-text text-muted flex-grow-1">
                            Nasi kuning aromatik dengan telur bumbu Bali yang pedas manis,
                            lengkap dengan sambal dan pelengkap tradisional.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 30 Porsi</div>
                        <p class="fw-bold text-warning">Rp 20.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="card shadow-sm border-0">
                    <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/a32b3f8c-c321-453d-9ba8-3e058f92644c_Go-Biz_20221208_083040.jpeg"
                        class="card-img-top" alt="Sate Ayam" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Nasi Ayam Bakar Urap</h5>
                        <div class="rating mb-2">⭐️⭐️⭐️⭐️⭐️</div>
                        <p class="card-text text-muted flex-grow-1">
                            Nasi hangat dengan ayam bakar bumbu kecap dan urap sayur segar
                            yang menggugah selera setiap suapan.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 30 Porsi</div>
                        <p class="fw-bold text-warning">Rp 20.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-light py-5">
            <div class="divider mx-auto mb-5" data-aos="fade-up"></div>

            <h2 class="fw-bold text-center text-warning" data-aos="fade-down">
                Menu Minuman Segar
            </h2>
            <p class="mb-5 text-center" data-aos="fade-down">
                Nikmati pilihan minuman segar kami, siap menemani setiap santapanmu.
            </p>

            <div class="drink-carousel-container" data-aos="fade-up">
                <div id="drinkCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row g-4 justify-content-center">
                                <div class="col-md-4 carousel-item-drinks">
                                    <div class="card shadow-sm border-0 drink-card">
                                        <img src="img/EsTeh.jpg" class="card-img-top" alt="Es Teh Manis" />
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title fw-bold">Es Teh Manis</h5>
                                            <div class="rating mb-2">⭐️⭐️⭐️⭐️☆</div>
                                            <p class="card-text text-muted flex-grow-1">
                                                Teh hitam segar dengan gula pas takaran, minuman
                                                klasik yang selalu menyegarkan di setiap suasana.
                                            </p>
                                            <div class="stock-info stock-ready mb-2">
                                                Stok: 50 Gelas
                                            </div>
                                            <p class="fw-bold text-warning">Rp 3.000</p>
                                            <button class="btn btn-warning text-white w-100">
                                                <i class="bi bi-cart-plus me-2"></i> Tambah ke
                                                Keranjang
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 carousel-item-drinks">
                                    <div class="card shadow-sm border-0 drink-card">
                                        <img src="https://cdn.rri.co.id/berita/Samarinda/o/1714349277901-WhatsApp_Image_2024-04-29_at_08.01.54/y3lif3r5nlmi8lk.jpeg"
                                            class="card-img-top" alt="Kopi Hitam" />
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title fw-bold">Teh Hangat</h5>
                                            <div class="rating mb-2">⭐️⭐️⭐️⭐️☆</div>
                                            <p class="card-text text-muted flex-grow-1">
                                                Teh melati hangat dengan aroma menenangkan, sempurna
                                                untuk menemani waktu santai atau hidangan hangatmu.
                                            </p>
                                            <div class="stock-info stock-out mb-2">Stok: Habis</div>
                                            <p class="fw-bold text-warning">Rp 3.000</p>
                                            <button class="btn btn-secondary w-100" disabled>
                                                Stok Habis
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row g-4 justify-content-center">
                                <!-- Es Jeruk -->
                                <div class="col-md-4 carousel-item-drinks">
                                    <div class="card shadow-sm border-0 drink-card">
                                        <img src="img/EsJeruk.jpg" class="card-img-top" alt="Es Jeruk" />
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title fw-bold">Es Jeruk</h5>
                                            <div class="rating mb-2">⭐️⭐️⭐️⭐️⭐️</div>
                                            <p class="card-text text-muted flex-grow-1">
                                                Perpaduan jeruk segar dan es batu yang menyegarkan,
                                                pilihan tepat untuk menghilangkan dahaga di siang
                                                hari.
                                            </p>
                                            <div class="stock-info stock-ready mb-2">
                                                Stok: 40 Gelas
                                            </div>
                                            <p class="fw-bold text-warning">Rp 5.000</p>
                                            <button class="btn btn-warning text-white w-100">
                                                <i class="bi bi-cart-plus me-2"></i> Tambah ke
                                                Keranjang
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Jeruk Panas -->
                                <div class="col-md-4 carousel-item-drinks">
                                    <div class="card shadow-sm border-0 drink-card">
                                        <img src="https://asset.kompas.com/crops/N9xzNvCzQra65mfChRGBsOGrcVc=/0x0:1000x667/1200x800/data/photo/2022/03/05/622387577a776.jpg"
                                            class="card-img-top" alt="Jeruk Panas" />
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title fw-bold">Jeruk Panas</h5>
                                            <div class="rating mb-2">⭐️⭐️⭐️⭐️☆</div>
                                            <p class="card-text text-muted flex-grow-1">
                                                Perasan jeruk asli disajikan hangat dengan rasa manis
                                                alami, cocok untuk menghangatkan tubuh di segala
                                                suasana.
                                            </p>
                                            <div class="stock-info stock-ready mb-2">
                                                Stok: 35 Gelas
                                            </div>
                                            <p class="fw-bold text-warning">Rp 5.000</p>
                                            <button class="btn btn-warning text-white w-100">
                                                <i class="bi bi-cart-plus me-2"></i> Tambah ke
                                                Keranjang
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#drinkCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#drinkCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Section Tambahan Menu -->
    <div class="divider mx-auto mb-5" data-aos="fade-up"></div>

    <h2 class="fw-bold text-center text-warning" data-aos="fade-down">
        Tambahan Menu (Add-ons)
    </h2>
    <p class="mb-5 text-center" data-aos="fade-down">
        Lengkapi hidanganmu dengan pilihan tambahan lezat dari dapur kami!
    </p>

    <div class="container" data-aos="fade-up">
        <div class="row g-4 justify-content-center">
            <!-- Telur Asin -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 drink-card h-100">
                    <img src="https://static.promediateknologi.id/crop/141x658:923x1276/0x0/webp/photo/p2/74/2025/04/21/Screenshot_20250421_160718-257565206.jpg"
                        class="card-img-top" alt="Telur Asin" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Telur Asin</h5>
                        <p class="card-text text-muted flex-grow-1">
                            Telur asin gurih dengan cita rasa khas, cocok jadi lauk
                            pendamping nasi kuning atau sarapan spesialmu.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 20 Porsi</div>
                        <p class="fw-bold text-warning">Rp 5.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Telur Ceplok -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 drink-card h-100">
                    <img src="https://s3.ap-southeast-3.amazonaws.com/assets.primaku.com/article_image/e90279bca9cd229aed393d398ea37929_1672748448456..jpg?tr=w-200"
                        class="card-img-top" alt="Telur Ceplok" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Sate Puyuh</h5>
                        <p class="card-text text-muted flex-grow-1">
                            Sate telur puyuh empuk dengan bumbu manis gurih yang meresap
                            sempurna, menambah kenikmatan setiap suapan.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 25 Porsi</div>
                        <p class="fw-bold text-warning">Rp 4.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tahu & Tempe -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 drink-card h-100">
                    <img src="https://palpos.bacakoran.co/upload/51871ab92a36298af91cb85539eb1edc.jpg"
                        class="card-img-top" alt="Tahu & Tempe" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Sate Usus</h5>
                        <p class="card-text text-muted flex-grow-1">
                            Sate usus ayam yang lembut dengan balutan bumbu kecap pedas
                            manis, cocok untuk camilan atau lauk tambahan.
                        </p>
                        <div class="stock-info stock-ready mb-2">Stok: 30 Porsi</div>
                        <p class="fw-bold text-warning">Rp 3.000</p>
                        <button class="btn btn-warning text-white w-100"
                            onclick="window.location.href='keranjang.html'">
                            <i class="bi bi-cart-plus me-2"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add-ons -->

    <!-- Quote Section -->
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

    <a href="keranjang.html" class="floating-cart">
        <span class="material-symbols-outlined">shopping_cart</span>
        <span class="cart-badge">3</span>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Inisialisasi carousel tambahan
        var addonCarousel = document.getElementById("addonCarousel");
        new bootstrap.Carousel(addonCarousel, {
            interval: 6000,
        });
    </script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });

        // Tambahan script untuk memastikan carousel berfungsi
        var myCarousel = document.getElementById("drinkCarousel");
        new bootstrap.Carousel(myCarousel, {
            interval: 5000, // Otomatis berpindah slide setiap 5 detik
        });

        document
            .getElementById("searchButton")
            .addEventListener("click", searchProduct);
        document
            .getElementById("searchInput")
            .addEventListener("input", searchProduct);

        function searchProduct() {
            const query = document
                .getElementById("searchInput")
                .value.toLowerCase()
                .trim();

            const resultContainer = document.getElementById("searchResults");
            resultContainer.innerHTML = ""; // Hapus hasil lama

            if (!query) {
                // kalau kosong, sembunyikan box hasil
                resultContainer.style.display = "none";
                return;
            }

            const cards = document.querySelectorAll(".card");
            const results = [];

            cards.forEach((card) => {
                const title = card
                    .querySelector(".card-title")
                    .textContent.toLowerCase();
                const desc = card
                    .querySelector(".card-text")
                    .textContent.toLowerCase();
                const imgSrc = card.querySelector(".card-img-top").src;
                const price = card.querySelector(".fw-bold.text-warning").textContent;

                if (title.includes(query) || desc.includes(query)) {
                    results.push({
                        title: card.querySelector(".card-title").textContent,
                        desc: card.querySelector(".card-text").textContent,
                        img: imgSrc,
                        price: price,
                    });
                }
            });

            // 🔹 kalau ada hasil, tampilkan box-nya
            resultContainer.style.display = "block";

            if (results.length === 0) {
                resultContainer.innerHTML = `<p class="text-center text-muted m-2">Produk tidak ditemukan 😞</p>`;
                return;
            }

            results.forEach((item) => {
                const resultItem = document.createElement("div");
                resultItem.classList.add("search-item");
                resultItem.innerHTML = `
      <img src="${item.img}" alt="${item.title}">
      <div>
        <h6>${item.title}</h6>
        <p>${item.price}</p>
      </div>
    `;

                resultItem.addEventListener("click", () => {
                    const targetCard = [...document.querySelectorAll(".card")].find(
                        (c) => c.querySelector(".card-title").textContent === item.title
                    );
                    if (targetCard)
                        targetCard.scrollIntoView({
                            behavior: "smooth",
                            block: "center",
                        });
                });

                resultContainer.appendChild(resultItem);
            });
        }

        document.addEventListener("click", (e) => {
            const searchBox = document.getElementById("searchResults");
            const input = document.getElementById("searchInput");
            if (!searchBox.contains(e.target) && !input.contains(e.target)) {
                searchBox.style.display = "none";
            }
        });

        const buburForm = document.getElementById("buburForm");
        const toast = document.getElementById("toast");
        const toastMessage = document.getElementById("toastMessage");
        const modal = new bootstrap.Modal(document.getElementById("buburModal"));

        buburForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const selected = document.querySelector(
                'input[name="buburVariant"]:checked'
            ).value;

            // Tutup modal
            modal.hide();

            // Tampilkan notifikasi
            toastMessage.textContent = `✅ ${selected} berhasil ditambahkan ke keranjang!`;
            toast.style.display = "block";

            // Hilangkan toast otomatis setelah 3 detik
            setTimeout(() => {
                toast.style.display = "none";
            }, 3000);
        });
    </script>
</body>

</html>