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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff8e1, #ffffff);
        }

        .dashboard-title {
            font-weight: 700;
            color: #f4b400;
        }

        .dashboard-card {
            border: none;
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .dashboard-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.15);
        }

        .dashboard-icon {
            font-size: 2.5rem;
            color: #f4b400;
        }

        .logout-btn {
            border-radius: 30px;
            padding: 10px 28px;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="dashboard-title">Admin Panel GusWarung</h1>
            <p class="text-muted">Kelola seluruh sistem GusWarung dengan mudah & cepat</p>
        </div>

        <!-- Menu Cards -->
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.products.index') }}" class="text-decoration-none text-dark">
                    <div class="card dashboard-card text-center p-4 h-100">
                        <i class="fas fa-utensils dashboard-icon mb-3"></i>
                        <h5 class="fw-semibold">Manajemen Produk</h5>
                        <p class="text-muted small">Tambah, edit, dan hapus menu</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.stock.index') }}" class="text-decoration-none text-dark">
                    <div class="card dashboard-card text-center p-4 h-100">
                        <i class="fas fa-boxes dashboard-icon mb-3"></i>
                        <h5 class="fw-semibold">Manajemen Stok</h5>
                        <p class="text-muted small">Kontrol persediaan barang</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.orders.index') }}" class="text-decoration-none text-dark">
                    <div class="card dashboard-card text-center p-4 h-100">
                        <i class="fas fa-list-check dashboard-icon mb-3"></i>
                        <h5 class="fw-semibold">
                            Pesanan & Pembayaran
                            <span class="badge bg-warning text-dark ms-1">BARU</span>
                        </h5>
                        <p class="text-muted small">Kelola transaksi pelanggan</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="{{ route('admin.report') }}" class="text-decoration-none text-dark">
                    <div class="card dashboard-card text-center p-4 h-100">
                        <i class="fas fa-chart-line dashboard-icon mb-3"></i>
                        <h5 class="fw-semibold">Laporan</h5>
                        <p class="text-muted small">Cetak laporan penjualan</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Footer Action -->
        <div class="text-center mt-5">
            <a href="/" class="btn btn-outline-secondary logout-btn">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Login
            </a>
        </div>
    </div>

</body>

</html>
