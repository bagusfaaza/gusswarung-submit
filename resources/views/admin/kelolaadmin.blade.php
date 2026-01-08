@extends('layouts.admin')

@section('title', 'Kelola akun admin')

@section('content')
<div class="container mt-5">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mb-3"><i
                class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard</a>
    <h3 class="fw-bold">Manajemen Admin</h3>

    <button class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        + Tambah Admin
    </button>

    <table class="table table-hover">
        <thead>
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
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary"
                            onclick="openEdit('{{ $admin->id }}','{{ $admin->name }}','{{ $admin->email }}')">
                            Edit
                        </button>

                        <form action="{{ route('admin.delete', $admin->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus admin ini?')">
                                Hapus
                            </button>
                        </form>
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

</div>
@endsection
