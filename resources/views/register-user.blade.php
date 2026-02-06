@extends('layouts.app')
@section('title', 'Registrasi User')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <button onclick="openModal()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah User</button>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Manajemen User</h6>
     
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="users-table" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>NIK</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\User::all() as $user)
                        @php
                            $badge = match($user->role) {
                                'super admin' => 'danger',
                                'teknisi'     => 'info',
                                'checker'     => 'warning',
                                'approver'    => 'success',
                                default       => 'secondary'
                            };
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ $user->nama }}&background=007bff&color=fff" 
                                         class="rounded-circle mr-3" width="40" alt="{{ $user->nama }}">
                                    <div>
                                        <div class="font-weight-bold">{{ $user->nama }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->nik }}</td>
                            <td>
                                <span class="badge badge-{{ $badge }}">
                                    {{ ucwords($user->role) }}
                                </span>
                            </td>
                            <td>
                                <button 
                                    onclick="editUser(this)" 
                                    data-id="{{ $user->id }}"
                                    data-nik="{{ $user->nik }}"
                                    data-nama="{{ $user->nama }}"
                                    data-role="{{ $user->role }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button onclick="deleteUser('{{ $user->id }}')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL: SEMUA DI DALAM FILE INI -->
<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="user-form" action="{{ route('users.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="user-id">

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" id="nik" class="form-control" required>
                        <small class="text-danger" id="nik-error"></small>
                    </div>

                    <div class="form-group">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                        <small class="text-danger" id="nama-error"></small>
                    </div>

                    <div class="form-group">
                        <label>Role <span class="text-danger">*</span></label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="super admin">Super Admin</option>
                            <option value="teknisi">Teknisi</option>
                            <option value="checker">Checker</option>
                            <option value="approver">Approver</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label id="password-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <small class="text-danger" id="password-error"></small>
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL -->

<script>
    function openModal() {
        $('#modal-title').text('Tambah User');
        $('#user-form')[0].reset();
        $('#user-id').val('');
        $('#password').prop('required', true);
        $('#password-label').html('Password <span class="text-danger">*</span>');
        $('.text-danger').text('').hide();
        $('#modal-user').modal('show');
    }

    function editUser(button) {
        const id = button.getAttribute('data-id');
        const nik = button.getAttribute('data-nik');
        const nama = button.getAttribute('data-nama');
        const role = button.getAttribute('data-role');

        $('#modal-title').text('Edit User');
        $('#user-id').val(id);
        $('#nik').val(nik);
        $('#nama').val(nama);
        $('#role').val(role);
        $('#password').val('').prop('required', false);
        $('#password-label').text('Password (kosongkan jika tidak ubah)');
        $('.text-danger').text('').hide();
        $('#modal-user').modal('show');
    }

    function deleteUser(id) {
        if (confirm('Yakin ingin menghapus user ini?')) {
            // Ganti dengan route hapus yang benar
            window.location.href = `/users/delete/${id}`;
        }
    }

    $(document).ready(function() {
        $('#users-table').DataTable({
            responsive: true,
            language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' }
        });
    });
</script>
@endsection