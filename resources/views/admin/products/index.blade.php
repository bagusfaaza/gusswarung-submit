@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
<div class="container-fluid">

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-warning mb-1">Manajemen Produk</h3>
            <p class="text-muted mb-0">
                Total <strong>{{ $menus->count() }}</strong> item terdaftar
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.create') }}"
               class="btn btn-success rounded-pill px-4 shadow-sm">
                <i class="fas fa-plus me-2"></i>Tambah Produk
            </a>

            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-outline-secondary rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i>Dashboard
            </a>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-uppercase small text-muted">
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Diskon</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $menu)
                        <tr>
                            <td class="fw-semibold">{{ $menu->id }}</td>

                            {{-- Gambar --}}
                            <td>
                                @if($menu->gambar)
                                    <img src="{{ asset($menu->gambar) }}"
                                         class="rounded-3 border"
                                         width="55" height="55"
                                         style="object-fit: cover;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- Nama --}}
                            <td class="fw-semibold">{{ $menu->nama }}</td>

                            {{-- Kategori --}}
                            <td>
                                <span class="badge bg-secondary-subtle text-dark rounded-pill px-3 py-2">
                                    {{ ucfirst($menu->kategori) }}
                                </span>
                            </td>

                            {{-- Harga --}}
                            <td class="fw-semibold">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </td>

                            {{-- Stok --}}
                            <td>
                                @if($menu->stok > 0)
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                        {{ $menu->stok }} tersedia
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">
                                        Habis
                                    </span>
                                @endif
                            </td>

                            {{-- Diskon --}}
                            <td>
                                @if($menu->diskon_persen > 0)
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                        {{ $menu->diskon_persen }}%
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <a href="{{ route('admin.products.edit', $menu) }}"
                                   class="btn btn-sm btn-outline-primary rounded-circle me-1"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.products.destroy', $menu) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger rounded-circle"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fas fa-box-open me-2"></i>Belum ada produk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
