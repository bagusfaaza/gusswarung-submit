<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keranjang - GusWarung</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet" />

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #fffbea;
        }

        .navbar {
            background-color: #ffc107 !important;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff !important;
            font-weight: bold;
            font-family: "Playfair Display", serif;
        }

        .cart-container {
            max-width: 1200px;
            margin: 50px auto;
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .cart-item img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
        }

        .cart-item h5 {
            font-weight: 600;
        }

        .cart-item .price {
            color: #ffc107;
            font-weight: 600;
        }

        .cart-summary {
            background-color: #fff8e1;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 100px;
        }

        .btn-checkout {
            background-color: #ffc107;
            color: white;
            font-weight: 600;
            width: 100%;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-checkout:hover {
            background-color: #e0aa00;
        }

        footer {
            text-align: center;
            padding: 20px 0;
            color: #555;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .cart-summary {
                margin-top: 20px;
            }
        }

        .payment-select {
            font-size: 0.95rem;
            padding: 8px 12px;
            border-radius: 8px;
            border: 2px solid #ffc107;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .payment-select:focus {
            border-color: #e9b300;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
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
                        <a class="nav-link text-black" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black active" href="/sell">Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="/stock">Inventaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="/report">Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="/#333about">About</a>
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
                                <a class="dropdown-item text-danger bg-warning" href="#">Keluar</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="cart-container">
        <h2 class="fw-bold mb-4 text-warning text-center">
            <span class="material-symbols-outlined align-middle">shopping_cart</span>
            Keranjang Pesanan
        </h2>

        <div class="row">
            <!-- KIRI: Formulir dan pembayaran -->
            <div class="col-md-6">
                <!-- Informasi Pemesan -->
                <h5 class="fw-bold mb-3 text-warning">
                    <span class="material-symbols-outlined align-middle me-1">info</span>
                    Informasi Pemesanan
                </h5>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Pemesan</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama lengkap" />
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor Telepon</label>
                    <input type="tel" class="form-control" placeholder="Contoh: 081234567890" />
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat Pengiriman</label>
                    <textarea class="form-control" rows="3"
                        placeholder="Masukkan alamat lengkap, RT/RW, kecamatan, dan patokan..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Catatan Tambahan</label>
                    <textarea class="form-control" rows="2"
                        placeholder="Contoh: tanpa sambal, nasi setengah, bungkus terpisah..."></textarea>
                </div>

                <hr class="my-4" />

                <!-- Metode Pembayaran -->
                <h5 class="fw-bold mb-3 text-warning">
                    <span class="material-symbols-outlined align-middle me-1">credit_card</span>
                    Metode Pembayaran
                </h5>

                <div class="d-flex align-items-center mb-4">
                    <select class="form-select payment-select">
                        <option selected disabled>Pilih metode pembayaran...</option>
                        <option value="cash">Tunai</option>
                        <option value="qris">QRIS</option>
                        <option value="transfer">Transfer Bank</option>
                    </select>
                    <img id="paymentLogo" src="" alt="" class="ms-3" width="42" height="42" style="display: none" />
                </div>

                <button class="btn btn-checkout">
                    <span class="material-symbols-outlined align-middle me-1">shopping_bag</span>
                    Lanjut ke Pembayaran
                </button>
            </div>

            <!-- KANAN: Item dan Ringkasan -->
            <div class="col-md-6">
                <div class="cart-summary">
                    <h5 class="fw-bold mb-3 text-center text-warning">Pesanan Anda</h5>

                    <!-- Item -->
                    <div class="cart-item">
                        <img src="https://nibble-images.b-cdn.net/nibble/original_images/resep_bubur_ayam_04_be2a72a6b8.jpeg"
                            alt="Bubur Ayam" />
                        <div class="flex-grow-1">
                            <h5>Bubur Ayam Komplit</h5>
                            <p class="mb-1 text-muted">Porsi Dewasa</p>
                            <p class="price mb-0">Rp 14.000</p>
                        </div>
                        <div>
                            <input type="number" class="form-control" value="1" min="1" style="width: 70px" />
                        </div>
                    </div>

                    <div class="cart-item">
                        <img src="img/AyamBakar.jpg" alt="Ayam Bakar" />
                        <div class="flex-grow-1">
                            <h5>Ayam Bakar</h5>
                            <p class="mb-1 text-muted">Porsi Lengkap</p>
                            <p class="price mb-0">Rp 15.000</p>
                        </div>
                        <div>
                            <input type="number" class="form-control" value="2" min="1" style="width: 70px" />
                        </div>
                    </div>

                    <hr />

                    <!-- Ringkasan -->
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>Rp 44.000</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Ongkir</span>
                        <span>Rp 5.000</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>PPN (10%)</span>
                        <span>Rp 4.400</span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span class="text-warning">Rp 53.400</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 GusWarung. Semua hak dilindungi.</p>
    </footer>
    <script>
        const select = document.querySelector(".payment-select");
        const logo = document.getElementById("paymentLogo");

        select.addEventListener("change", () => {
            const value = select.value;
            logo.style.display = "inline-block";

            if (value === "cash") {
                // 💵 Logo uang tunai
                logo.src = "https://cdn-icons-png.flaticon.com/512/2331/2331942.png";
            } else if (value === "qris") {
                // 📱 Logo QRIS (resmi, resolusi tinggi)
                logo.src =
                    "https://images.seeklogo.com/logo-png/39/1/quick-response-code-indonesia-standard-qris-logo-png_seeklogo-391791.png";
            } else if (value === "transfer") {
                // 🏦 Logo transfer bank
                logo.src =
                    "https://i0.wp.com/www.halkidikisuites.com/wp-content/uploads/2023/02/38978-bank-transfer-logo-icon-vector-icon-vector-eps.png?fit=256%2C256&ssl=1";
            } else {
                logo.style.display = "none";
            }
        });
    </script>
</body>

</html>