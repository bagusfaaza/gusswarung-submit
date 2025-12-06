<div class="container my-5">
    <h2 class="mb-4 text-warning">{{ $menu->exists ? 'Edit' : 'Tambah' }} Produk Menu</h2>

    <form method="POST"
        action="{{ $menu->exists ? route('admin.products.update', $menu) : route('admin.products.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if($menu->exists)
            @method('PUT')
        @endif

        <div class="card p-4">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $menu->nama) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi"
                    name="deskripsi">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="harga" class="form-label">Harga (Rp)</label>
                    <input type="number" class="form-control" id="harga" name="harga"
                        value="{{ old('harga', $menu->harga) }}" required min="0">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="stok" class="form-label">Stok Awal</label>
                    <input type="number" class="form-control" id="stok" name="stok"
                        value="{{ old('stok', $menu->stok) }}" required min="0">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="diskon_persen" class="form-label">Diskon (%)</label>
                    <input type="number" class="form-control" id="diskon_persen" name="diskon_persen"
                        value="{{ old('diskon_persen', $menu->diskon_persen) }}" min="0" max="100">
                </div>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="makanan" {{ old('kategori', $menu->kategori) == 'makanan' ? 'selected' : '' }}>Makanan
                    </option>
                    <option value="minuman" {{ old('kategori', $menu->kategori) == 'minuman' ? 'selected' : '' }}>Minuman
                    </option>
                    <option value="addon" {{ old('kategori', $menu->kategori) == 'addon' ? 'selected' : '' }}>Tambahan
                        (Add-ons)</option>
                </select>
            </div>

            <div class="mb-3 form-check">
                <input type="hidden" name="is_popular" value="0">
                <input type="checkbox" class="form-check-input" id="is_popular" name="is_popular" value="1" {{ old('is_popular', $menu->is_popular) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_popular">Menu Populer</label>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk</label>
                <input class="form-control" type="file" id="gambar" name="gambar">
                @if($menu->gambar)
                    <p class="mt-2">Gambar saat ini: <img src="{{ asset($menu->gambar) }}" alt="{{ $menu->nama }}"
                            width="100"></p>
                @endif
            </div>

            <button type="submit" class="btn btn-warning mt-3 text-white">{{ $menu->exists ? 'Update' : 'Simpan' }}
                Produk</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary mt-2">Batal</a>
        </div>
    </form>
</div>