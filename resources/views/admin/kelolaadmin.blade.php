@extends('layouts.admin')

@section('title', 'Kelola akun admin')

@section('content')
<div class="container mt-5">
    {{-- 1. Tambahkan Alert untuk notifikasi (Penting!) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mb-3">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
    </a>
    
    <h3 class="fw-bold">Manajemen Admin</h3>

    <button class="btn btn-warning mb-3 text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-plus me-1"></i> Tambah Admin
    </button>

    <table class="table table-hover shadow-sm bg-white rounded">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
<tr>
    <td>#{{ $admin->id }}</td>
    <td>
        {{ $admin->name }}
        {{-- Badge identifikasi Super Admin --}}
        @if($admin->email === 'admin@admin.com')
            <span class="badge bg-dark ms-2"><i class="fas fa-crown text-warning"></i> Owner</span>
        @endif
    </td>
    <td>{{ $admin->email }}</td>
    <td class="text-center">
        
        {{-- Logika Tombol Edit --}}
        @if($admin->email !== 'admin@admin.com' || Auth::user()->email === 'admin@admin.com')
            <button class="btn btn-sm btn-primary"
                onclick="openEdit('{{ $admin->id }}','{{ $admin->name }}','{{ $admin->email }}')">
                Edit
            </button>
        @else
            <button class="btn btn-sm btn-secondary" disabled><i class="fas fa-lock"></i></button>
        @endif

        {{-- Logika Tombol Hapus (Sembunyikan jika email adalah admin@admin.com) --}}
        @if($admin->email !== 'admin@admin.com')
            <form action="{{ route('admin.delete', $admin->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus admin ini?')">
                    Hapus
                </button>
            </form>
        @endif
    </td>
</tr>
@endforeach
        </tbody>
    </table>

<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('admin.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" class="form-control mb-2" placeholder="Nama" required>
          <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog">
    <form id="formEdit" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" id="editName" name="name" class="form-control mb-2" required>
          <input type="email" id="editEmail" name="email" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

    {{-- Modal Tambah & Edit tetap sama, tapi pastikan JS untuk openEdit sudah benar --}}
</div>

{{-- 3. Script JS untuk menangani Action URL Modal Edit --}}
<script>
    function openEdit(id, name, email) {
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;

        // Update action form secara dinamis agar mengarah ke ID yang benar
        let form = document.getElementById('formEdit');
        form.action = "/admin/kelola-akun/update/" + id; // Sesuaikan dengan route update kamu

        var modal = new bootstrap.Modal(document.getElementById('modalEdit'));
        modal.show();
    }
</script>
@endsection