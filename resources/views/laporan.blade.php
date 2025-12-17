<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan - GusWarung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    <!-- <nav class="fixed-top navbar navbar-expand-lg shadow-lg" style="background-color: #ffc107">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="#">
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
                        <a class="nav-link text-black active" href="/report">Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->

    <div style="margin-top: 50px;" class="laporan-container">
        <form action="{{ route('admin.dashboard') }}" method="GET">
            <button data-aos="fade-right" type="submit" class="btn btn-warning">
                Kembali ke Dashboard
            </button>
        </form>
        <h2 data-aos="fade-right">Laporan</h2>
        <p data-aos="fade-left">Ringkasan penjualan dan performa warung</p>

        <div class="container my-5">

            <!-- ================= BARIS 1 : 4 CARD UTAMA ================= -->
            <div class="row g-4">

                <!-- Total Penjualan Hari Ini -->
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat-card position-relative h-100">
                        <p class="mb-1 text-muted">Total Penjualan Hari Ini</p>
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-value">
                                    Rp {{ number_format($todaySales, 0, ',', '.') }}
                                </div>
                                <div class="text-success fw-semibold" style="font-size: 0.9rem">
                                    +12.5% dari kemarin
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-center rounded-4"
                                style="width:45px;height:45px;background:linear-gradient(135deg,#ffca28,#cddc39);box-shadow:0 2px 6px rgba(0,0,0,.15);">
                                <span class="material-symbols-outlined fs-4 text-dark">
                                    attach_money
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Transaksi -->
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-card position-relative h-100">
                        <p class="mb-1 text-muted">Jumlah Transaksi</p>
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-value">{{ $todayTransactions }}</div>
                                <div class="text-success fw-semibold" style="font-size: 0.9rem">
                                    +8.2%
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-center rounded-4"
                                style="width:45px;height:45px;background:linear-gradient(135deg,#03a9f4,#00bcd4);box-shadow:0 2px 6px rgba(0,0,0,.15);">
                                <span class="material-symbols-outlined fs-4 text-dark">
                                    receipt_long
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rata-rata / Hari -->
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat-card position-relative h-100">
                        <p class="mb-1 text-muted">Rata-rata / Hari</p>
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-value">
                                    Rp {{ number_format($averageDailySales / 1000000, 1) }}
                                </div>
                                <div class="fs-5 fw-bold">Jt</div>
                            </div>

                            <div class="d-flex align-items-center justify-content-center rounded-4"
                                style="width:45px;height:45px;background:linear-gradient(135deg,#ffeb3b,#8bc34a);box-shadow:0 2px 6px rgba(0,0,0,.15);">
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

                <!-- Item Inventaris -->
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="stat-card position-relative h-100">
                        <p class="mb-1 text-muted">Item Inventaris</p>
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-value">{{ $totalInventaris }}</div>
                                <div class="text-danger fw-semibold" style="font-size: 0.9rem">
                                    {{ $lowStockCount }} stok rendah
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-center rounded-4"
                                style="width:45px;height:45px;background:linear-gradient(135deg,#ff7043,#ff9800);box-shadow:0 2px 6px rgba(0,0,0,.15);">
                                <span class="material-symbols-outlined fs-4 text-dark">
                                    inventory_2
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ================= END BARIS 1 ================= -->


            <!-- ================= BARIS 2 : PENDAPATAN & PENGELUARAN ================= -->
            <div class="row g-4 mt-4">

                <!-- Pendapatan Bulan Ini -->
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="500">
                    <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Pendapatan Bulan Ini</h6>
                                <h4 class="fw-bold mb-1">
                                    Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
                                </h4>
                                <small class="text-muted">
                                    Total transaksi selama 1 bulan
                                </small>
                            </div>

                            <div class="rounded-circle d-flex justify-content-center align-items-center"
                                style="width:50px;height:50px;background:#E6F4EA;">
                                <span style="font-size:22px;">💰</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🔥 Pengeluaran Bulan Ini -->
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="600">
                    <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Pengeluaran Bulan Ini</h6>
                                <h4 class="fw-bold mb-1 text-danger">
                                    Rp {{ number_format($monthlyExpense, 0, ',', '.') }}
                                </h4>
                                <small class="text-muted">
                                    Biaya operasional & belanja
                                </small>
                            </div>

                            <div class="rounded-circle d-flex justify-content-center align-items-center"
                                style="width:50px;height:50px;background:#FDECEA;">
                                <span style="font-size:22px;">💸</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="600">
                    <div class="card shadow-sm border-0 rounded-4 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-2">Laba Bersih Bulan Ini</h6>
                                <h4 class="fw-bold mb-1 
                    {{ $netProfit >= 0 ? 'text-success' : 'text-danger' }}">
                                    Rp {{ number_format($netProfit, 0, ',', '.') }}
                                </h4>
                                <small class="text-muted">
                                    Pendapatan - Pengeluaran
                                </small>
                            </div>

                            <div class="rounded-circle d-flex justify-content-center align-items-center"
                                style="width:50px;height:50px;background:#E8F5E9;">
                                <span style="font-size:22px;">📊</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ================= END BARIS 2 ================= -->

        </div>
    </div>


    <!-- Menampilkan Menu Terlaris dalam Minggu Ini -->
    <!-- ================= MENU TERLARIS MINGGU INI ================= -->
    <section class="my-5" data-aos="fade-up">
        <div class="card shadow-sm border-0 rounded-4 p-4">
            <h5 class="fw-bold mb-4 text-center">Menu Terlaris Minggu Ini</h5>

            <div class="d-flex justify-content-center">
                <canvas id="menuChart" style="max-width:380px; max-height:380px;"></canvas>
            </div>
        </div>
    </section>

    <!-- CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const canvas = document.getElementById('menuChart');
            if (!canvas) {
                console.warn('Canvas menuChart tidak ditemukan');
                return;
            }

            const ctx = canvas.getContext('2d');

            // 🔥 HAPUS CHART LAMA JIKA ADA
            if (window.menuChartInstance instanceof Chart) {
                window.menuChartInstance.destroy();
            }

            // DATA DARI CONTROLLER
            const labels = @json($bestSellingMenus->pluck('product_name'));
            const data = @json($bestSellingMenus->pluck('total_sold'));

            // CEK DATA KOSONG
            if (labels.length === 0 || data.length === 0) {
                console.warn('Data menu terlaris kosong');
                return;
            }

            // BUAT CHART
            window.menuChartInstance = new Chart(ctx, {
                type: 'doughnut', // bisa diganti: bar / pie
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Terjual',
                        data: data,
                        backgroundColor: [
                            '#ff5252',
                            '#ff9800',
                            '#03a9f4',
                            '#ffeb3b',
                            '#3f51b5'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

        });
    </script>


    <section class="my-5" data-aos="fade-up">
        <div class="card shadow-sm border-0 rounded-4 p-4">

            <!-- JUDUL -->
            <h5 class="fw-bold mb-4 text-center">10 Transaksi Terbaru</h5>

            <!-- SEARCH NAMA PELANGGAN -->
            <div class="d-flex justify-content-center mb-3">
                <input type="text" id="filterCustomer" class="form-control" placeholder="Cari nama pelanggan..."
                    autocomplete="off" style="max-width:320px;border-radius:12px;text-align:center;">
            </div>

            <!-- TOOLBAR: ICON MATA + SEARCH MENU + FILTER TANGGAL -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                <!-- KIRI: ICON MATA + SEARCH MENU -->
                <div class="d-flex align-items-center gap-2">

                    <!-- ICON MATA -->
                    <button id="toggleTransactionTable" class="btn btn-sm btn-light d-flex align-items-center gap-1"
                        style="border-radius:8px;">
                        <span id="eyeIcon" class="material-symbols-outlined" style="font-size:20px;">
                            visibility
                        </span>
                        <span class="small text-muted">Transaksi</span>
                    </button>

                    <!-- SEARCH MENU -->
                    <input type="text" id="filterMenu" class="form-control form-control-sm" placeholder="Cari menu..."
                        autocomplete="off" style="max-width:220px;border-radius:8px;">
                </div>

                <!-- KANAN: FILTER TANGGAL -->
                <form method="GET" action="{{ url('/report') }}" class="d-flex gap-2">
                    <input type="date" name="tanggal" value="{{ $tanggal ?? request('tanggal') ?? '' }}"
                        class="form-control form-control-sm" style="border-radius:8px;">

                    <button class="btn btn-sm btn-outline-secondary" style="border-radius:8px;">
                        Cari
                    </button>

                    @if(!empty($tanggal ?? request('tanggal')))
                        <a href="{{ url('/report') }}" class="btn btn-sm btn-outline-danger" style="border-radius:8px;">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- TABLE -->
            <div class="table-responsive" id="transactionTableWrapper">
                <table class="table table-bordered align-middle mb-0" id="latestOrdersTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">Waktu</th>
                            <th class="text-center">Pelanggan</th>
                            <th class="text-center">Menu</th>
                            <th class="text-center">Qty / Menu</th>
                            <th class="text-center">Total Qty</th>
                            <th class="text-center">Total Bayar</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($latestOrders as $order)
                            @php
                                $transaction = $transactionSummary->firstWhere('order_id', $order->id);
                            @endphp
                            <tr>
                                <td class="text-center">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>

                                <td class="text-center">
                                    {{ $order->customer_name }}
                                </td>

                                <!-- MENU -->
                                <td class="text-center">
                                    @if($transaction)
                                        @foreach($transaction['items'] as $item)
                                            {{ $item['product_name'] }}<br>
                                        @endforeach
                                    @else
                                        <span class="text-muted">–</span>
                                    @endif
                                </td>

                                <!-- QTY PER MENU -->
                                <td class="text-center">
                                    @if($transaction)
                                        @foreach($transaction['items'] as $item)
                                            {{ $item['quantity'] }}<br>
                                        @endforeach
                                    @else
                                        <span class="text-muted">–</span>
                                    @endif
                                </td>

                                <!-- TOTAL QTY -->
                                <td class="text-center">
                                    {{ $transaction['total_qty'] ?? '–' }}
                                </td>

                                <!-- TOTAL BAYAR -->
                                <td class="text-center">
                                    @if($transaction)
                                        Rp {{ number_format(collect($transaction['items'])->sum('total_price'), 0, ',', '.') }}
                                    @else
                                        –
                                    @endif
                                </td>

                                <!-- STATUS -->
                                <td class="text-center">
                                    {{ $order->status }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Tidak ada data transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            /* ============================
               TOGGLE HIDE / SHOW TABLE
            ============================ */
            const toggleBtn = document.getElementById("toggleTransactionTable");
            const tableWrapper = document.getElementById("transactionTableWrapper");
            const eyeIcon = document.getElementById("eyeIcon");

            if (toggleBtn) {
                toggleBtn.addEventListener("click", function () {
                    if (tableWrapper.style.display === "none") {
                        tableWrapper.style.display = "block";
                        eyeIcon.textContent = "visibility";
                    } else {
                        tableWrapper.style.display = "none";
                        eyeIcon.textContent = "visibility_off";
                    }
                });
            }

            /* ============================
               FILTER NAMA PELANGGAN
            ============================ */
            const customerInput = document.getElementById("filterCustomer");
            const rows = document.querySelectorAll("#latestOrdersTable tbody tr");

            if (customerInput) {
                customerInput.addEventListener("keyup", function () {
                    const keyword = this.value.toLowerCase().trim();

                    rows.forEach(row => {
                        const customerCell = row.cells[1]; // kolom pelanggan
                        if (!customerCell) return;

                        const customerName = customerCell.textContent.toLowerCase();
                        row.style.display = customerName.includes(keyword) ? "" : "none";
                    });
                });
            }

            /* ============================
               FILTER MENU (PER MENU)
            ============================ */
            const menuInput = document.getElementById("filterMenu");

            if (menuInput) {
                menuInput.addEventListener("keyup", function () {
                    const keyword = this.value.toLowerCase().trim();

                    rows.forEach(row => {
                        const menuCell = row.cells[2]; // kolom menu
                        const qtyCell = row.cells[3]; // kolom qty

                        if (!menuCell || !qtyCell) return;

                        const menus = menuCell.innerHTML.split("<br>");
                        const qtys = qtyCell.innerHTML.split("<br>");

                        let filteredMenus = [];
                        let filteredQtys = [];

                        menus.forEach((menu, index) => {
                            if (menu.toLowerCase().includes(keyword)) {
                                filteredMenus.push(menu);
                                filteredQtys.push(qtys[index] ?? "");
                            }
                        });

                        if (keyword === "") {
                            // reset ke tampilan awal
                            row.style.display = "";
                        } else if (filteredMenus.length > 0) {
                            menuCell.innerHTML = filteredMenus.join("<br>");
                            qtyCell.innerHTML = filteredQtys.join("<br>");
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    });
                });
            }

        });
    </script>


    <section class="my-5" data-aos="fade-up">
        <div class="card shadow-sm border-0 rounded-4 p-4">
            <h5 class="fw-bold mb-4">
                Grafik Penjualan Selama 1 Tahun ({{ date('Y') }})
            </h5>

            <div style="height:400px;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </section>


    <script>
        const paymentMethodData = @json($paymentMethodReport);

        const labels = paymentMethodData.map(item =>
            item.payment_method.toUpperCase()
        );

        const dataValues = paymentMethodData.map(item =>
            item.total_transactions
        );

        new Chart(document.getElementById('paymentMethodChart'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.label + ': ' + context.raw + ' transaksi';
                            }
                        }
                    }
                }
            }
        });

        const yearlySales = @json($yearlySales);

        // Nama bulan
        const monthLabels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        // Siapkan array 12 bulan (default 0)
        const salesData = Array(12).fill(0);

        yearlySales.forEach(item => {
            salesData[item.month - 1] = item.total;
        });

        const ctx = document.getElementById('salesChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar', // Bisa diganti 'line'
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: salesData,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function (value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>


    <script>

        // ===================================
        // 1. DATA HARGA MENU (harga tetap)
        // ===================================
        const hargaPerMenu = {
            "Bubur Ayam": 14000,
            "Nasi Kuning": 13000,
            "Nasi Ayam Bakar": 15000,
            "Nasi Ayam Karage": 15000,
            "Telur Asin": 5000,
            "Sate Puyuh": 4000,
            "Sate Usus": 3000,
            "Es Teh": 3000,
            "Teh Hangat": 3000,
            "Es Jeruk": 5000,
            "Jeruk Hangat": 5000
        };

        // ==============================
        // 3. FUNGSI BANTU
        // ==============================

        function formatRupiah(angka) {
            return "Rp " + angka.toLocaleString("id-ID");
        }

        function getStatusBadge(status) {
            let colorClass = "";
            if (status === "Selesai") {
                colorClass = "bg-success";
            } else if (status === "Menunggu Pembayaran") {
                colorClass = "bg-warning";
            } else if (status === "Pembayaran Diterima") {
                colorClass = "bg-primary";
            } else {
                colorClass = "bg-secondary";
            }

            return `<span class="badge ${colorClass} rounded-pill">${status}</span>`;
        }


        // ==============================
        // 4. FUNGSI RENDER TABEL TRANSAKSI LAMA (1 BULAN)
        // ==============================

        function buatBarisTransaksi(tanggalDisplay, items, totalQty, totalHarga) {
            const tr = document.createElement("tr");

            const tdTanggal = document.createElement("td");
            tdTanggal.className = "text-secondary";
            tdTanggal.textContent = tanggalDisplay;

            const tdMenu = document.createElement("td");
            tdMenu.className = "fw-semibold";
            // Menampilkan setiap item menu dalam satu baris, dipisahkan <br />
            tdMenu.innerHTML = items.map((i) => i.nama).join("<br />");

            const tdQtyPerMenu = document.createElement("td");
            tdQtyPerMenu.className = "text-center";
            // Menampilkan Qty per Menu dalam satu baris, dipisahkan <br />
            tdQtyPerMenu.innerHTML = items.map((i) => i.qty).join("<br />");

            const tdTotalQty = document.createElement("td");
            tdTotalQty.className = "text-center";
            tdTotalQty.textContent = totalQty;

            const tdTotalHarga = document.createElement("td");
            tdTotalHarga.className = "text-end fw-semibold text-warning";
            tdTotalHarga.textContent = formatRupiah(totalHarga);

            tr.appendChild(tdTanggal);
            tr.appendChild(tdMenu);
            tr.appendChild(tdQtyPerMenu);
            tr.appendChild(tdTotalQty);
            tr.appendChild(tdTotalHarga);

            return tr;
        }

        function renderTable(data, menuFilter = null) {
            const tbody = document.querySelector("#tabelTransaksi tbody");
            tbody.innerHTML = "";

            const filterLower = menuFilter ? menuFilter.toLowerCase() : null;
            let hasData = false;

            data.forEach((trx) => {
                let items = trx.items;

                // Mode filter menu
                if (filterLower) {
                    const filteredItems = items.filter((item) =>
                        item.nama.toLowerCase().includes(filterLower)
                    );

                    if (filteredItems.length === 0) {
                        return; // baris ini tidak punya menu yang dicari
                    }

                    // Hitung total qty & total harga hanya dari menu yang dicari
                    const totalQty = filteredItems.reduce((sum, item) => sum + item.qty, 0);

                    let totalHarga = 0;
                    filteredItems.forEach((item) => {
                        const harga = hargaPerMenu[item.nama] || 0;
                        totalHarga += harga * item.qty;
                    });

                    const row = buatBarisTransaksi(
                        trx.tanggalDisplay,
                        filteredItems,
                        totalQty,
                        totalHarga
                    );
                    tbody.appendChild(row);
                    hasData = true;
                } else {
                    // Mode normal (tanpa filter menu): pakai total asli
                    const row = buatBarisTransaksi(
                        trx.tanggalDisplay,
                        items,
                        trx.totalQty,
                        trx.totalHarga
                    );
                    tbody.appendChild(row);
                    hasData = true;
                }
            });

            if (!hasData) {
                const tr = document.createElement("tr");
                tr.innerHTML = '<td colspan="5" class="text-center text-muted py-4">Tidak ada data transaksi yang ditemukan.</td>';
                tbody.appendChild(tr);
            }
        }


        // ==============================
        // 5. FUNGSI RENDER TRANSAKSI TERBARU (DARI ORDERS)
        // ==============================

        function renderLatestOrders(data) {
            const tbody = document.getElementById("latestOrdersBody");
            if (!tbody) return; // Pastikan elemen ada

            tbody.innerHTML = "";

            data.forEach((order) => {
                const tr = document.createElement("tr");

                // Format waktu
                const date = new Date(order.timestamp);
                const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) + ", " + date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                tr.innerHTML = `
            <td class="text-secondary" style="font-size:0.9rem;">${formattedDate}</td>
            <td class="fw-semibold text-dark">${order.customer_name}</td>
            <td class="text-end fw-bold text-success">${formatRupiah(order.total_amount)}</td>
            <td class="text-center">${getStatusBadge(order.status)}</td>
        `;
                tbody.appendChild(tr);
            });
        }


        // ==============================
        // 6. LOGIKA GRAFIK (CHART JS)
        // ==============================

        // Data Dummy untuk Grafik
        const labelsBulanan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        const dataBulanan = [
            1000000, 1500000, 1800000, 2000000, 2200000, 3000000,
            3500000, 3800000, 4500000, 5000000, 5500000, 6000000
        ];

        const labelsMingguan = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];

        const dataMingguanCache = {};

        function generateWeeklyData(total) {
            const weekly = [];
            let sisa = total;

            for (let i = 0; i < 3; i++) {
                const rata = total / 4;
                const variasi = rata * 0.3;
                const nilai = rata + (Math.random() * variasi - variasi / 2);

                weekly.push(Math.max(0, Math.round(nilai)));
                sisa -= nilai;
            }

            weekly.push(Math.round(sisa));
            return weekly;
        }

        function baseOptions() {
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { color: '#ddd' } },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#ddd' },
                        // Menambahkan callback untuk memformat label sumbu Y ke format Rupiah
                        ticks: { callback: v => 'Rp ' + v.toLocaleString("id-ID") }
                    }
                }
            };
        }

        // Inisialisasi Chart
        const ctxSales = document.getElementById('salesChart').getContext('2d');
        let chart = new Chart(ctxSales, {
            type: 'line',
            data: {
                labels: labelsBulanan,
                datasets: [{
                    label: 'Penjualan',
                    data: dataBulanan,
                    borderColor: '#4BC0C0',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 5,
                    borderWidth: 2
                }]
            },
            options: baseOptions()
        });


        // ==============================
        // 7. EVENT FILTER TANGGAL
        // ==============================

        document.getElementById("filterButton").addEventListener("click", function () {
            const inputTanggal = document
                .getElementById("filterTanggal")
                .value.trim();
            const errorBox = document.getElementById("errorNotification");

            // Kalau kosong → tampilkan semua
            if (!inputTanggal) {
                errorBox.classList.add("d-none");
                renderTable(transaksiData);
                return;
            }

            // Cek pola dasar: "dd NamaBulan yyyy"
            const regexTanggal = /^\d{1,2}\s+\w+\s+\d{4}$/i; // Menambahkan 'i' untuk case-insensitive
            if (!regexTanggal.test(inputTanggal)) {
                errorBox.classList.remove("d-none");
                return;
            }

            errorBox.classList.add("d-none");

            const normalized = inputTanggal.toLowerCase();
            const filtered = transaksiData.filter(
                (trx) => trx.tanggalDisplay.toLowerCase() === normalized
            );

            renderTable(filtered);
        });

        // ==========================
        // 8. FILTER MENU
        // ==========================
        document.getElementById("filterMenuButton").addEventListener("click", () => {
            const val = document.getElementById("filterMenu").value.trim();
            if (!val) {
                renderTable(transaksiData);
                return;
            }
            renderTable(transaksiData, val);
        });

        document.getElementById("filterMenu").addEventListener("keyup", e => {
            if (e.key === "Enter") {
                document.getElementById("filterMenuButton").click();
            }
        });


        // ==============================
        // 9. EVENT SELECTOR BULAN (GRAFIK)
        // ==============================
        document.getElementById("bulanSelector").addEventListener("change", function () {
            const value = this.value;

            if (value === "tahun") {
                chart.data.labels = labelsBulanan;
                chart.data.datasets[0].data = dataBulanan;
                chart.options.plugins.title = { display: true, text: 'Penjualan Per Bulan (1 Tahun Terakhir)' };
                chart.update();
                return;
            }

            const bulanIndex = parseInt(value);
            const bulanText = this.options[this.selectedIndex].text;

            if (!dataMingguanCache[bulanIndex]) {
                // Gunakan dataBulanan[bulanIndex] sebagai total untuk bulan tersebut
                dataMingguanCache[bulanIndex] = generateWeeklyData(dataBulanan[bulanIndex]);
            }

            chart.data.labels = labelsMingguan;
            chart.data.datasets[0].data = dataMingguanCache[bulanIndex];
            chart.options.plugins.title = { display: true, text: 'Penjualan Mingguan Bulan ' + bulanText };
            chart.update();
        });


        // ==============================
        // 10. TAMPILKAN SEMUA TRANSAKSI SAAT PERTAMA KALI & TOGGLE
        // ==============================
        document.addEventListener("DOMContentLoaded", function () {
            // Render data transaksi lama
            renderTable(transaksiData);

            // Render data transaksi terbaru (BARU DITAMBAHKAN)
            renderLatestOrders(latestOrdersData);
        });

        // FITUR SHOW / HIDE DATA TRANSAKSI
        const toggleBtn = document.getElementById("toggleData");
        const transaksiTable = document.getElementById("tabelTransaksi");

        let isShown = true; // data awalnya tampil

        toggleBtn.addEventListener("click", function () {
            if (isShown) {
                transaksiTable.style.display = "none";
                toggleBtn.textContent = "👁️‍🗨";
                isShown = false;
            } else {
                transaksiTable.style.display = "";
                toggleBtn.textContent = "👁";
                isShown = true;
            }
        });
    </script>


    <!-- <footer style="background: #222; color: #eee; padding: 60px 20px">
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
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 120,
        });
    </script>

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