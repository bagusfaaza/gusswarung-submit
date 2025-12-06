<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan - GusWarung</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font & Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #fdf9f4;
            color: #3c2f2f;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            display: inline-block;
            vertical-align: middle;
        }

        .laporan-container {
            padding: 50px 80px;
        }

        .laporan-container h2 {
            font-weight: 700;
            color: #3b2b20;
        }

        .laporan-container p {
            color: #7b7b7b;
        }

        .stat-card {
            background-color: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 1.7rem;
            font-weight: 700;
            color: #3b2b20;
        }

        /* Grafik Penjualan Bulanan */
        .sales-bars {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .bar-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bar-item .day {
            width: 95px;
            font-weight: 600;
            color: #3b2b20;
        }

        .bar-container {
            flex-grow: 1;
            background-color: #f6f6f6;
            border-radius: 20px;
            height: 18px;
            overflow: hidden;
        }

        .bar {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(90deg, #ffc107, #cddc39);
            width: 0;
            transition: width 1.2s ease-in-out;
        }

        .bar-item .value {
            width: 70px;
            text-align: right;
            font-weight: 600;
            color: #ff9800;
        }

        footer {
            background: #fff;
            color: #777;
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
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="fixed-top navbar navbar-expand-lg shadow-lg" style="background-color: #ffc107">
        <div class="container">
            <!-- Logo di kiri -->
            <a class="navbar-brand text-white fw-bold" href="#">
                <img src="logo/logo_guswarung tb.png" alt="Logo" width="40" height="40" />
                GusWarung
            </a>

            <!-- Toggler untuk mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu di kanan -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-black" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="/sell">Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="/stock">Inventaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black active" href="/report">Laporan</a>
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
                                <a class="dropdown-item text-white bg-warning" href="/setting">
                                    Pengaturan
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item text-white bg-warning" href="#">Profil</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger bg-warning" href="#">Keluar</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Laporan -->
    <div style="margin-top: 50px;" class="laporan-container">
        <h2 data-aos="fade-right">Laporan</h2>
        <p data-aos="fade-left">Ringkasan penjualan dan performa warung</p>

        <!-- Statistik -->
        <div class="container my-5">
            <div class="row g-4">
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat-card position-relative h-100">
                        <p class="mb-1 text-muted">Total Penjualan Hari Ini</p>
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-value">Rp 865.000</div>
                                <div class="text-success fw-semibold" style="font-size: 0.9rem">
                                    +12.5% dari kemarin
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-4" style="
                    width: 45px;
                    height: 45px;
                    background: linear-gradient(135deg, #ffca28, #cddc39);
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
                  ">
                                <span class="material-symbols-outlined fs-4 text-dark">
                                    attach_money
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-card position-relative h-100">
                        <p class="mb-1 text-muted">Jumlah Transaksi</p>
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-value">60</div>
                                <div class="text-success fw-semibold" style="font-size: 0.9rem">
                                    +8.2%
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-4" style="
                    width: 45px;
                    height: 45px;
                    background: linear-gradient(135deg, #03a9f4, #00bcd4);
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
                  ">
                                <span class="material-symbols-outlined fs-4 text-dark">
                                    receipt_long
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat-card position-relative h-100">
                        <p class="mb-1 text-muted">Rata-rata / Hari</p>
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-value">Rp 2.7</div>
                                <div class="fs-5 fw-bold text-dark">Jt</div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-4" style="
                    width: 45px;
                    height: 45px;
                    background: linear-gradient(135deg, #ffeb3b, #8bc34a);
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
                  ">
                                <span class="material-symbols-outlined fs-4 text-dark">
                                    trending_up
                                </span>
                            </div>
                        </div>
                        <div class="text-danger mt-2" style="font-size: 0.9rem">
                            ↓ 5% dari minggu lalu
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="stat-card position-relative h-100">
                        <p class="mb-1 text-muted">Item Inventaris</p>
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-value">8</div>
                                <div class="text-danger fw-semibold" style="font-size: 0.9rem">
                                    3 stok rendah
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-4" style="
                    width: 45px;
                    height: 45px;
                    background: linear-gradient(135deg, #ff7043, #ff9800);
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
                  ">
                                <span class="material-symbols-outlined fs-4 text-dark">
                                    inventory_2
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Penjualan Bulanan -->
        <section class="my-5" data-aos="fade-up">
            <div class="card shadow-sm border-0 p-4 rounded-4">
                <h5 class="fw-bold mb-4">Grafik Penjualan Selama 1 Bulan</h5>
                <div class="sales-bars">
                    <div class="bar-item">
                        <span class="day">Januari</span>
                        <div class="bar-container">
                            <div class="bar" data-width="60%"></div>
                        </div>
                        <span class="value">Rp 355.000</span>
                    </div>

                    <div class="bar-item">
                        <span class="day">Februari</span>
                        <div class="bar-container">
                            <div class="bar" data-width="67%"></div>
                        </div>
                        <span class="value">Rp 287.000</span>
                    </div>

                    <div class="bar-item">
                        <span class="day">Maret</span>
                        <div class="bar-container">
                            <div class="bar" data-width="80%"></div>
                        </div>
                        <span class="value">Rp 375.000</span>
                    </div>

                    <div class="bar-item">
                        <span class="day">April</span>
                        <div class="bar-container">
                            <div class="bar" data-width="70%"></div>
                        </div>
                        <span class="value">Rp 250.000</span>
                    </div>

                    <div class="bar-item">
                        <span class="day">Mei</span>
                        <div class="bar-container">
                            <div class="bar" data-width="90%"></div>
                        </div>
                        <span class="value">Rp 300.000</span>
                    </div>

                    <div class="bar-item">
                        <span class="day">Juni</span>
                        <div class="bar-container">
                            <div class="bar" data-width="100%"></div>
                        </div>
                        <span class="value">Rp 535.000</span>
                    </div>

                    <div class="bar-item">
                        <span class="day">Juli</span>
                        <div class="bar-container">
                            <div class="bar" data-width="83%"></div>
                        </div>
                        <span class="value">Rp 750.000</span>
                    </div>

                    <div class="bar-item">
                        <span class="day">Agustus</span>
                        <div class="bar-container">
                            <div class="bar" data-width="80%"></div>
                        </div>
                        <span class="value">Rp 375.000</span>
                    </div>

                    <div class="bar-item">
                        <span class="day">September</span>
                        <div class="bar-container">
                            <div class="bar" data-width="90%"></div>
                        </div>
                        <span class="value">Rp 300.000</span>
                    </div>

                    <div class="bar-item">
                        <span class="day">Oktober</span>
                        <div class="bar-container">
                            <div class="bar" data-width="70%"></div>
                        </div>
                        <span class="value">Rp 250.000</span>
                    </div>

                    <div class="sales-bars">
                        <div class="bar-item">
                            <span class="day">November</span>
                            <div class="bar-container">
                                <div class="bar" data-width="60%"></div>
                            </div>
                            <span class="value">Rp 355.000</span>
                        </div>

                        <div class="bar-item">
                            <span class="day">Desember</span>
                            <div class="bar-container">
                                <div class="bar" data-width="100%"></div>
                            </div>
                            <span class="value">Rp 535.000</span>
                        </div>

                    </div>
                </div>
        </section>

        <!-- Transaksi Terakhir -->
        <section class="my-5" data-aos="fade-up" data-aos-delay="200">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-4">Transaksi Terakhir (7 Hari)</h5>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="border-bottom">
                            <tr>
                                <th class="text-muted fw-semibold">Tanggal</th>
                                <th class="text-muted fw-semibold">Menu</th>
                                <th class="text-muted fw-semibold text-center">Jumlah</th>
                                <th class="text-muted fw-semibold text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-secondary">27 Okt 2025</td>
                                <td class="fw-semibold">
                                    Bubur Ayam <br />
                                    Nasi Kuning <br />
                                    Nasi Ayam Bakar <br />
                                    Nasi Ayam Karage
                                </td>
                                <td class="text-center">60</td>
                                <td class="text-end fw-semibold text-warning">Rp 865.000</td>
                            </tr>

                            <tr>
                                <td class="text-secondary">28 Okt 2025</td>
                                <td class="fw-semibold">
                                    Bubur Ayam <br />
                                    Nasi Kuning <br />
                                    Nasi Ayam Bakar <br />
                                    Nasi Ayam Karage
                                </td>
                                <td class="text-center">60</td>
                                <td class="text-end fw-semibold text-warning">Rp 865.000</td>
                            </tr>

                            <tr>
                                <td class="text-secondary">29 Okt 2025</td>
                                <td class="fw-semibold">
                                    Bubur Ayam <br />
                                    Nasi Kuning <br />
                                    Nasi Ayam Bakar <br />
                                    Nasi Ayam Karage
                                </td>
                                <td class="text-center">60</td>
                                <td class="text-end fw-semibold text-warning">Rp 865.000</td>
                            </tr>

                            <tr>
                                <td class="text-secondary">30 Okt 2025</td>
                                <td class="fw-semibold">
                                    Bubur Ayam <br />
                                    Nasi Kuning <br />
                                    Nasi Ayam Bakar <br />
                                    Nasi Ayam Karage
                                </td>
                                <td class="text-center">60</td>
                                <td class="text-end fw-semibold text-warning">Rp 865.000</td>
                            </tr>

                            <tr>
                                <td class="text-secondary">01 Okt 2025</td>
                                <td class="fw-semibold">
                                    Bubur Ayam <br />
                                    Nasi Kuning <br />
                                    Nasi Ayam Bakar <br />
                                    Nasi Ayam Karage
                                </td>
                                <td class="text-center">60</td>
                                <td class="text-end fw-semibold text-warning">Rp 865.000</td>
                            </tr>

                            <tr>
                                <td class="text-secondary">02 Okt 2025</td>
                                <td class="fw-semibold">
                                    Bubur Ayam <br />
                                    Nasi Kuning <br />
                                    Nasi Ayam Bakar <br />
                                    Nasi Ayam Karage
                                </td>
                                <td class="text-center">60</td>
                                <td class="text-end fw-semibold text-warning">Rp 865.000</td>
                            </tr>

                            <tr>
                                <td class="text-secondary">03 Okt 2025</td>
                                <td class="fw-semibold">
                                    Bubur Ayam <br />
                                    Nasi Kuning <br />
                                    Nasi Ayam Bakar <br />
                                    Nasi Ayam Karage
                                </td>
                                <td class="text-center">60</td>
                                <td class="text-end fw-semibold text-warning">Rp 865.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

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

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 120,
        });
    </script>

    <!-- Animasi Bar -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".bar").forEach((bar, index) => {
                const width = bar.getAttribute("data-width");
                setTimeout(() => {
                    bar.style.width = width;
                }, 200 + index * 150);
            });
        });
    </script>
</body>

</html>