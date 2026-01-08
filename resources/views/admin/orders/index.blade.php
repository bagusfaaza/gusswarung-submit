<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Admin GusWarung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        /* Perbaikan tambahan jika pagination masih nakal */
        .pagination svg {
            width: 1.25rem;
            height: 1.25rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-warning mb-1">Daftar Pesanan Baru</h1>
                <p class="text-muted">Kelola dan konfirmasi pesanan pelanggan di sini.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Dashboard
            </a>
        </div>

        {{-- Pesan Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-warning text-dark">
                            <tr>
                                <th class="ps-4 py-3">ID</th>
                                <th>Waktu</th>
                                <th>Pelanggan</th>
                                <th>Total Bayar</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                    <td>
                                        <small class="text-muted d-block">{{ $order->created_at->format('d M Y') }}</small>
                                        {{ $order->created_at->format('H:i') }} WIB
                                    </td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td class="fw-bold text-dark">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-light text-dark border">
                                            {{ ucfirst($order->payment_method) }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = match ($order->status) {
                                                'Lunas' => 'bg-success',
                                                'Menunggu Pembayaran', 'Baru (Menunggu Konfirmasi)' => 'bg-info text-dark',
                                                'Menunggu Konfirmasi Admin' => 'bg-warning text-dark',
                                                'Diproses' => 'bg-primary',
                                                'Dibatalkan' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}" style="font-size: 0.85rem;">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                            class="btn btn-sm btn-warning shadow-sm">
                                            <i class="fas fa-search me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                        Belum ada pesanan yang masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>