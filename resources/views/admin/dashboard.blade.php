<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - GusWarung</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff7da, #ffffff);
            min-height: 100vh;
        }

        .dashboard-title {
            font-weight: 700;
            color: #f4b400;
        }

        .dashboard-subtitle {
            max-width: 520px;
            margin: auto;
        }

        .dashboard-card {
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            transition: all 0.35s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 45px rgba(244, 180, 0, 0.25);
        }

        .dashboard-icon {
            font-size: 2.6rem;
            color: #f4b400;
        }

        .dashboard-card h5 {
            margin-top: 10px;
            font-weight: 600;
        }

        .dashboard-card p {
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .logout-btn {
            border-radius: 30px;
            padding: 10px 30px;
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="dashboard-title">Admin Panel GusWarung</h1>
            <p class="text-muted dashboard-subtitle">
                Kelola seluruh sistem GusWarung dengan mudah, cepat, dan terstruktur
            </p>
        </div>

        <!-- Menu Cards -->
        <div class="row g-4 justify-content-center">

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.products.index') }}" class="text-decoration-none text-dark">
                    <div class="card dashboard-card text-center p-4 h-100">
                        <i class="fas fa-utensils dashboard-icon mb-3"></i>
                        <h5>Manajemen Produk</h5>
                        <p class="text-muted">Tambah, edit, dan hapus menu</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.stock.index') }}" class="text-decoration-none text-dark">
                    <div class="card dashboard-card text-center p-4 h-100">
                        <i class="fas fa-boxes dashboard-icon mb-3"></i>
                        <h5>Manajemen Stok</h5>
                        <p class="text-muted">Kontrol persediaan barang</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.orders.index') }}" class="text-decoration-none text-dark">
                    <div class="card dashboard-card text-center p-4 h-100">
                        <i class="fas fa-list-check dashboard-icon mb-3"></i>
                        <h5>Pesanan & Pembayaran</h5>
                        <p class="text-muted">Kelola transaksi pelanggan</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.report') }}" class="text-decoration-none text-dark">
                    <div class="card dashboard-card text-center p-4 h-100">
                        <i class="fas fa-chart-line dashboard-icon mb-3"></i>
                        <h5>Laporan</h5>
                        <p class="text-muted">Cetak laporan penjualan</p>
                    </div>
                </a>
            </div>

            <!-- Kelola Akun (SUDAH RAPI) -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.management') }}" class="text-decoration-none text-dark">
                    <div class="card dashboard-card text-center p-4 h-100">
                        <i class="fas fa-user-shield dashboard-icon mb-3"></i>
                        <h5>Kelola Akun</h5>
                        <p class="text-muted">Mengelola akun admin</p>
                    </div>
                </a>
            </div>

        </div>

        <!-- Footer -->
        <div class="text-center mt-5">
            <a href="/" class="btn btn-outline-secondary logout-btn">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Login
            </a>
        </div>

    </div>



</body>

</html>