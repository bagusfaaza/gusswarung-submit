<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventaris - GusWarung</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- ====== CSS LANGSUNG ====== -->
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #fafafa;
        }

        .navbar-custom-shadow {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .card {
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .alert {
            border-radius: 10px;
        }

        .badge {
            font-size: 0.85rem;
            padding: 6px 10px;
        }

        input.form-control {
            border-radius: 10px;
            padding: 10px 14px;
        }

        .btn-group .btn.active {
            background-color: #ffc107 !important;
            color: white !important;
        }

        .btn-warning {
            background-color: #ffc107 !important;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800 !important;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            display: inline-block;
            vertical-align: middle;
            margin-bottom: 0 !important;
        }

        .alert {
            margin-top: 50px;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(25px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
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
    <nav class="navbar navbar-expand-lg navbar-custom-shadow fixed-top" style="background-color: #ffc107">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="index.html">
                <img src="logo/logo_guswarung tb.png" alt="Logo" width="40" height="40" />GusWarung
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-black" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-black" href="/sell">Penjualan</a></li>
                    <li class="nav-item"><a class="nav-link text-black active" href="/stock">Inventaris</a>
                    </li>
                    <li class="nav-item"><a class="nav-link text-black" href="/report">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link text-black" href="/about">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="material-symbols-outlined align-middle">account_circle</span>
                        </a>
                        <ul class="dropdown-menu bg-warning">
                            <li><a class="dropdown-item text-white bg-warning" href="/setting">Pengaturan</a>
                            </li>
                            <li><a class="dropdown-item text-white bg-warning" href="profil.html">Profil</a></li>
                            <li><a class="dropdown-item text-danger bg-warning" href="keluar.html">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Konten utama -->
    <div style="margin-top: 80px;" class="container py-5 fade-in">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h2 class="fw-bold">Inventaris</h2>
                <p class="text-muted">Kelola stok bahan baku warung</p>
            </div>

            <!-- Tombol disusun vertikal -->
            <div class="d-flex flex-column gap-2">
                <button class="btn btn-warning text-white fw-semibold shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#addItemModal">
                    + Tambah Item
                </button>

                <button class="btn btn-primary text-white fw-semibold shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#updateItemModal">
                    🔄 Update Item
                </button>
            </div>
        </div>

        <!-- Peringatan Stok Rendah -->
        <div class="alert alert-danger border-danger border-2 fade-in" role="alert">
            <strong>⚠️ Peringatan Stok Rendah</strong>
            <div class="mt-2">
                <span class="badge bg-danger">Cabai: 3 kg</span>
                <span class="badge bg-danger">Bawang Merah: 2 kg</span>
                <span class="badge bg-danger">Penyedap Rasa: 8 bungkus</span>
                <span class="badge bg-danger">Tomat: 4 kg</span>
                <span class="badge bg-danger">Usus: 2 kg</span>
                <span class="badge bg-danger">Kacang Kedelai: 6 kg</span>
            </div>
        </div>

        <!-- Kategori Bahan Stok -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2 fade-in">
            <div class="btn-group" role="group" aria-label="Filter Stok">
                <button class="btn btn-outline-warning active" data-filter="all">Semua</button>
                <button class="btn btn-outline-success" data-filter="aman">Aman</button>
                <button class="btn btn-outline-danger" data-filter="rendah">Rendah</button>
            </div>

            <input type="text" class="form-control w-50" placeholder="🔍 Cari item inventaris" id="searchInput" />
        </div>

        <div class="row g-4" id="inventoryContainer">
            <!-- BAHAN BAKU -->
            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Air Galon</h5>
                    <h3 class="fw-bold text-warning">10 <small>galon</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Ayam</h5>
                    <h3 class="fw-bold text-warning">10 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Baking Powder</h5>
                    <h3 class="fw-bold text-warning">12 <small>pak</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>

                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="rendah">
                <div class="card p-3 border-danger border-2 shadow-sm">
                    <h5>Bawang Merah</h5>
                    <h3 class="fw-bold text-danger">2 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-danger">Rendah</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Bawang Putih</h5>
                    <h3 class="fw-bold text-warning">7 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Beras</h5>
                    <h3 class="fw-bold text-warning">50 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Bumbu Racik</h5>
                    <h3 class="fw-bold text-warning">20 <small>bungkus</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="rendah">
                <div class="card p-3 border-danger border-2 shadow-sm">
                    <h5>Cabai</h5>
                    <h3 class="fw-bold text-danger">3 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-danger">Rendah</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Garam</h5>
                    <h3 class="fw-bold text-warning">10 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Gula</h5>
                    <h3 class="fw-bold text-warning">25 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 10</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Jeruk</h5>
                    <h3 class="fw-bold text-warning">25 <small>buah</small></h3>
                    <p class="text-muted mb-1">Min. stok: 10</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="rendah">
                <div class="card p-3 border-danger border-2 shadow-sm">
                    <h5>Kacang Kedelai</h5>
                    <h3 class="fw-bold text-danger">6 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 7</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-danger">Rendah</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Kelapa</h5>
                    <h3 class="fw-bold text-warning">15 <small>butir</small></h3>
                    <p class="text-muted mb-1">Min. stok: 10</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Kentang</h5>
                    <h3 class="fw-bold text-warning">15 <small>butir</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Kecap Manis</h5>
                    <h3 class="fw-bold text-warning">12 <small>botol</small></h3>
                    <p class="text-muted mb-1">Min. stok: 6</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Kerupuk</h5>
                    <h3 class="fw-bold text-warning">40 <small>bungkus</small></h3>
                    <p class="text-muted mb-1">Min. stok: 20</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Laos</h5>
                    <h3 class="fw-bold text-warning">15 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Minyak Goreng</h5>
                    <h3 class="fw-bold text-warning">15 <small>liter</small></h3>
                    <p class="text-muted mb-1">Min. stok: 10</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="rendah">
                <div class="card p-3 border-danger border-2 shadow-sm">
                    <h5>Penyedap Rasa</h5>
                    <h3 class="fw-bold text-danger">8 <small>bungkus</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-danger">Rendah</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Saos Tomat</h5>
                    <h3 class="fw-bold text-warning">18 <small>botol</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Santan Jadi</h5>
                    <h3 class="fw-bold text-warning">10 <small>paket</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Selada</h5>
                    <h3 class="fw-bold text-warning">8 <small>ikat</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Tepung Terigu</h5>
                    <h3 class="fw-bold text-warning">25 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Teh</h5>
                    <h3 class="fw-bold text-warning">15 <small>pak</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="rendah">
                <div class="card p-3 border-danger border-2 shadow-sm">
                    <h5>Tomat</h5>
                    <h3 class="fw-bold text-danger">4 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-danger">Rendah</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Telur Ayam</h5>
                    <h3 class="fw-bold text-warning">100 <small>butir</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Telur Bebek</h5>
                    <h3 class="fw-bold text-warning">30 <small>butir</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Telur Puyuh</h5>
                    <h3 class="fw-bold text-warning">50 <small>butir</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="aman">
                <div class="card p-3 shadow-sm">
                    <h5>Timun</h5>
                    <h3 class="fw-bold text-warning">10 <small>buah</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-success">Aman</span>
                </div>
            </div>

            <div class="col-md-3 inventory-item fade-in" data-status="rendah">
                <div class="card p-3 border-danger border-2 shadow-sm">
                    <h5>Usus</h5>
                    <h3 class="fw-bold text-danger">2 <small>kg</small></h3>
                    <p class="text-muted mb-1">Min. stok: 5</p>
                    <p class="text-muted mb-1 update-date"></p>
                    <span class="badge bg-danger">Rendah</span>
                </div>
            </div>
        </div>
    </div> <!-- penutup container -->

    <!-- ===== Modal Tambah Item ===== -->
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="addItemModalLabel">Tambah Bahan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addItemForm">
                        <div class="mb-3">
                            <label class="form-label">Nama Bahan</label>
                            <input type="text" class="form-control" id="itemName" placeholder="Contoh: Cabai" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="itemQty" placeholder="Masukkan jumlah stok"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Satuan</label>
                            <input type="text" class="form-control" id="itemUnit" placeholder="kg / liter / bungkus"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="itemStatus">
                                <option value="aman">Aman</option>
                                <option value="rendah">Rendah</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning text-white w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Modal Update Item ===== -->
    <div class="modal fade" id="updateItemModal" tabindex="-1" aria-labelledby="updateItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="updateItemModalLabel">Update Stok Bahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateItemForm">
                        <div class="mb-3">
                            <label class="form-label">Nama Bahan</label>
                            <input type="text" class="form-control" id="updateName" placeholder="Contoh: Cabai"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Baru</label>
                            <input type="number" class="form-control" id="updateQty" placeholder="Masukkan jumlah baru"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary text-white w-100">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== JAVASCRIPT ====== -->
    <script>
        // Animasi fade-in saat muncul di layar
        document.addEventListener("DOMContentLoaded", () => {
            const fadeItems = document.querySelectorAll(".fade-in");
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            fadeItems.forEach((item) => observer.observe(item));
        });

        // Fungsi untuk format tanggal (DD/MM/YYYY)
        function formatTanggal(date) {
            const d = new Date(date);
            const day = String(d.getDate()).padStart(2, '0');
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const year = d.getFullYear();
            return `${day}/${month}/${year}`;
        }

        // Set tanggal update otomatis untuk semua item yang sudah ada
        document.addEventListener("DOMContentLoaded", () => {
            const updateElements = document.querySelectorAll(".update-date");
            const today = formatTanggal(new Date());
            updateElements.forEach(el => {
                el.textContent = `Update: ${today}`;
            });
        });

        // Tambah Item ke Inventaris 
        const form = document.getElementById("addItemForm");
        const container = document.getElementById("inventoryContainer");

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const name = document.getElementById("itemName").value.trim();
            const qty = document.getElementById("itemQty").value.trim();
            const unit = document.getElementById("itemUnit").value.trim();
            const status = document.getElementById("itemStatus").value;

            if (!name || !qty || !unit) return;

            const badgeClass = status === "aman" ? "bg-success" : "bg-danger";
            const textClass = status === "aman" ? "text-warning" : "text-danger";
            const borderClass = status === "rendah" ? "border-danger border-2" : "border-0";

            const newCard = document.createElement("div");
            newCard.classList.add("col-md-3", "inventory-item", "fade-in");
            newCard.setAttribute("data-status", status);

            newCard.innerHTML = `
                <div class="card p-3 shadow-sm ${borderClass}">
                    <h5>${name}</h5>
                    <h3 class="fw-bold ${textClass}">${qty} <small>${unit}</small></h3>
                    <p class="text-muted mb-1">Update: ${formatTanggal(new Date())}</p>
                    <span class="badge ${badgeClass}">${status === "aman" ? "Aman" : "Rendah"}</span>
                </div>
            `;

            container.prepend(newCard);

            setTimeout(() => newCard.classList.add("show"), 50);

            form.reset();
            const modal = bootstrap.Modal.getInstance(document.getElementById("addItemModal"));
            modal.hide();
        });

        // Update Item
        const updateForm = document.getElementById("updateItemForm");
        updateForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const updateName = document.getElementById("updateName").value.trim().toLowerCase();
            const updateQty = document.getElementById("updateQty").value.trim();

            if (!updateName || !updateQty) return;

            const items = document.querySelectorAll(".inventory-item");
            let found = false;

            items.forEach(item => {
                const nameEl = item.querySelector("h5");
                if (nameEl.textContent.trim().toLowerCase() === updateName) {
                    const qtyEl = item.querySelector("h3");
                    qtyEl.innerHTML = `${updateQty} <small>${qtyEl.querySelector("small").textContent}</small>`;
                    const updateEl = item.querySelector(".update-date");
                    if (updateEl) updateEl.textContent = `Update: ${formatTanggal(new Date())}`;
                    found = true;
                }
            });

            if (!found) {
                alert(`Bahan "${updateName}" tidak ditemukan di inventaris.`);
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById("updateItemModal"));
            modal.hide();
            updateForm.reset();
        });

        // Filter stok
        const filterButtons = document.querySelectorAll("[data-filter]");
        const items = document.querySelectorAll(".inventory-item");
        filterButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                filterButtons.forEach((b) => b.classList.remove("active"));
                btn.classList.add("active");
                const filter = btn.dataset.filter;
                items.forEach((item) => {
                    item.style.display =
                        filter === "all" || item.dataset.status === filter ? "block" : "none";
                });
            });
        });

        // Pencarian
        const searchInput = document.getElementById("searchInput");
        searchInput.addEventListener("input", (e) => {
            const query = e.target.value.toLowerCase();
            items.forEach((item) => {
                const name = item.querySelector("h5").textContent.toLowerCase();
                item.style.display = name.includes(query) ? "block" : "none";
            });
        });
    </script>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
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
</body>

</html>