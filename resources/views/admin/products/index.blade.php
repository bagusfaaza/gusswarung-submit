<div class="container my-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="mb-4 text-warning">Manajemen Produk ({{ $menus->count() }} Item)</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Tambah Produk Baru</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mb-3">Kembali ke Admin Dashboard</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Diskon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{ $menu->id }}</td>
                        <td>
                            @if($menu->gambar)
                                <img src="{{ asset($menu->gambar) }}" alt="Img" width="50">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $menu->nama }}</td>
                        <td>{{ ucfirst($menu->kategori) }}</td>
                        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                        <td>{{ $menu->stok }}</td>
                        <td>{{ $menu->diskon_persen }}%</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $menu) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.products.destroy', $menu) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin hapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>