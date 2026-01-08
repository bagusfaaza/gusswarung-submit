<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $menu->exists ? 'Edit' : 'Tambah' }} Produk - Admin GusWarung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 12px; }
        .form-control:focus, .form-select:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.25 cereal rgba(255, 193, 7, 0.25);
        }
        .input-group-text { border-radius: 8px 0 0 8px; }
        .btn-warning { color: #fff; }
        .img-thumbnail { border-radius: 10px; object-fit: cover; }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h2 class="fw-bold text-warning mb-1">
                            <i class="fas {{ $menu->exists ? 'fa-edit' : 'fa-plus-circle' }} me-2"></i>
                            {{ $menu->exists ? 'Edit Produk' : 'Tambah Produk Baru' }}
                        </h2>
                        <p class="text-muted small">Kelola detail menu GusWarung agar menarik bagi pelanggan.</p>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <form method="POST"
                    action="{{ $menu->exists ? route('admin.products.update', $menu) : route('admin.products.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if($menu->exists)
                        @method('PUT')
                    @endif

                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4 p-md-5">

                            <div class="mb-4">
                                <label for="nama" class="form-label fw-bold">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg border-warning-subtle" id="nama"
                                    name="nama" placeholder="Contoh: Nasi Goreng Gila"
                                    value="{{ old('nama', $menu->nama) }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-bold">Deskripsi Singkat</label>
                                <textarea class="form-control border-warning-subtle" id="deskripsi" name="deskripsi"
                                    rows="3" placeholder="Jelaskan rasa, komposisi, atau porsi...">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label for="harga" class="form-label fw-bold">Harga Satuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning-subtle border-warning-subtle fw-bold">Rp</span>
                                        <input type="number" class="form-control border-warning-subtle" id="harga"
                                            name="harga" value="{{ old('harga', $menu->harga) }}" required min="0">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="stok" class="form-label fw-bold">Stok Tersedia</label>
                                    <input type="number" class="form-control border-warning-subtle" id="stok"
                                        name="stok" value="{{ old('stok', $menu->stok) }}" required min="0">
                                </div>
                                <div class="col-md-4">
                                    <label for="diskon_persen" class="form-label fw-bold text-danger">Promo Diskon (%)</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control border-danger-subtle"
                                            id="diskon_persen" name="diskon_persen"
                                            value="{{ old('diskon_persen', $menu->diskon_persen) }}" min="0" max="100">
                                        <span class="input-group-text bg-danger-subtle border-danger-subtle text-danger fw-bold">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4 border-top pt-4">
                                <div class="col-md-6">
                                    <label for="kategori" class="form-label fw-bold">Kategori Menu</label>
                                    <select class="form-select border-warning-subtle" id="kategori" name="kategori" required>
                                        <option value="makanan" {{ old('kategori', $menu->kategori) == 'makanan' ? 'selected' : '' }}>🍛 Makanan</option>
                                        <option value="minuman" {{ old('kategori', $menu->kategori) == 'minuman' ? 'selected' : '' }}>🥤 Minuman</option>
                                        <option value="addon" {{ old('kategori', $menu->kategori) == 'addon' ? 'selected' : '' }}>🍟 Tambahan (Add-ons)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold d-block">Label Khusus</label>
                                    <div class="form-check form-switch mt-2">
                                        <input type="hidden" name="is_popular" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_popular"
                                            name="is_popular" value="1" {{ old('is_popular', $menu->is_popular) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_popular">🔥 Set sebagai Menu Populer</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 border-top pt-4">
                                <label for="gambar" class="form-label fw-bold">Foto Produk</label>
                                <input class="form-control border-warning-subtle mb-3" type="file" id="gambar" name="gambar"
                                    onchange="previewImage()" accept="image/*">

                                <div class="bg-light rounded p-3 text-center border">
                                    <p class="small text-muted mb-2">Pratinjau Foto:</p>
                                    <img id="img-preview" src="{{ $menu->gambar ? asset($menu->gambar) : '' }}"
                                        class="img-thumbnail {{ $menu->gambar ? '' : 'd-none' }}"
                                        style="max-height: 200px; width: auto;">
                                    
                                    @if(!$menu->gambar)
                                        <div id="no-img" class="py-4">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-warning-subtle mb-2"></i>
                                            <p class="text-muted small mb-0">Klik "Pilih File" untuk mengunggah gambar</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning btn-lg fw-bold shadow-sm py-3 text-white">
                                    <i class="fas fa-save me-2"></i>
                                    {{ $menu->exists ? 'Simpan Perubahan' : 'Terbitkan Menu Baru' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('#img-preview');
            const noImg = document.querySelector('#no-img');

            if (image.files && image.files[0]) {
                imgPreview.classList.remove('d-none');
                if (noImg) noImg.classList.add('d-none');

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function (oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>