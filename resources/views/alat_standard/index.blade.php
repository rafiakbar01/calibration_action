@extends('layouts.app')
@section('title', 'Master Alat Standard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-tools me-2"></i>
                    </h5>
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#createAlatStandardModal">
                        <i class="fas fa-plus me-1"></i> Tambah Alat Standard
                    </button>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>Terjadi kesalahan pada input data.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="alatStandardTable" class="table table-hover table-striped" style="width:100%">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Nama Tabel</th>
                                    <th>Nama Standar</th>
                                    <th>Tanggal Dibuat</th>
                                    <th width="120" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($alatStandards as $index => $alat)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="fw-semibold text-primary">{{ $alat->namaTabel }}</span>
                                    </td>
                                    <td>{{ $alat->namaStandar }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-calendar me-1"></i>{{ $alat->created_at->format('d/m/Y') }}
                                        </span>
                                        <small class="text-muted d-block">{{ $alat->created_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <button type="button" class="btn btn-info btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#viewAlatStandardModal"
                                                    data-id="{{ $alat->id }}"
                                                    data-namatabel="{{ $alat->namaTabel }}"
                                                    data-namastandar="{{ $alat->namaStandar }}"
                                                    data-created="{{ $alat->created_at->format('d/m/Y H:i') }}"
                                                    data-updated="{{ $alat->updated_at->format('d/m/Y H:i') }}"
                                                    title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editAlatStandardModal"
                                                    data-id="{{ $alat->id }}"
                                                    data-namatabel="{{ $alat->namaTabel }}"
                                                    data-namastandar="{{ $alat->namaStandar }}"
                                                    title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('alat-standards.destroy', $alat->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        title="Hapus Data" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus alat standard ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p class="mb-0">Tidak ada data alat standard.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createAlatStandardModal" tabindex="-1" aria-labelledby="createAlatStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createAlatStandardModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Alat Standard
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('alat-standards.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_namaTabel" class="form-label fw-semibold">Nama Tabel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('namaTabel') is-invalid @enderror" 
                               id="create_namaTabel" name="namaTabel" value="{{ old('namaTabel') }}" 
                               placeholder="Masukkan nama tabel" required>
                        @error('namaTabel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="create_namaStandar" class="form-label fw-semibold">Nama Standar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('namaStandar') is-invalid @enderror" 
                               id="create_namaStandar" name="namaStandar" value="{{ old('namaStandar') }}" 
                               placeholder="Masukkan nama standar" required>
                        @error('namaStandar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editAlatStandardModal" tabindex="-1" aria-labelledby="editAlatStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editAlatStandardModalLabel">
                    <i class="fas fa-edit me-2"></i>Edit Alat Standard
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_namaTabel" class="form-label fw-semibold">Nama Tabel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" 
                               id="edit_namaTabel" name="namaTabel" 
                               placeholder="Masukkan nama tabel" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_namaStandar" class="form-label fw-semibold">Nama Standar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" 
                               id="edit_namaStandar" name="namaStandar" 
                               placeholder="Masukkan nama standar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="fas fa-save me-1"></i>Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="viewAlatStandardModal" tabindex="-1" aria-labelledby="viewAlatStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewAlatStandardModalLabel">
                    <i class="fas fa-eye me-2"></i>Detail Alat Standard
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th width="40%" class="bg-light">ID</th>
                                        <td id="view_id">-</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Nama Tabel</th>
                                        <td id="view_namaTabel">-</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Nama Standar</th>
                                        <td id="view_namaStandar">-</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Dibuat Pada</th>
                                        <td id="view_created">-</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Diperbarui Pada</th>
                                        <td id="view_updated">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<style>
    .card {
        border: none;
        border-radius: 12px;
    }
    
    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table td {
        vertical-align: middle;
        font-size: 0.9rem;
    }
    
    .btn-group-sm > .btn, .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    #alatStandardTable_wrapper .dataTables_filter input {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 0.375rem 0.75rem;
    }
    
    #alatStandardTable_wrapper .dataTables_length select {
        border-radius: 6px;
        border: 1px solid #dee2e6;
    }
    
    .dataTables_info {
        font-size: 0.875rem;
        color: #6c757d;
    }
    
    .modal-header {
        border-bottom: 1px solid #dee2e6;
    }
    
    .modal-footer {
        border-top: 1px solid #dee2e6;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#alatStandardTable').DataTable({
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Tidak ada data yang ditemukan",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Berikutnya",
                previous: "Sebelumnya"
            }
        },
        dom: '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
        pageLength: 10,
        responsive: true,
        order: [[3, 'desc']] // Urutkan berdasarkan tanggal dibuat descending
    });

    // Handle Edit Modal
    const editModal = document.getElementById('editAlatStandardModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const namaTabel = button.getAttribute('data-namatabel');
            const namaStandar = button.getAttribute('data-namastandar');
            
            const modal = this;
            modal.querySelector('#edit_namaTabel').value = namaTabel;
            modal.querySelector('#edit_namaStandar').value = namaStandar;
            
            // Update form action
            const form = modal.querySelector('#editForm');
            form.action = `/alat-standards/${id}`;
        });
    }

    // Handle View Modal
    const viewModal = document.getElementById('viewAlatStandardModal');
    if (viewModal) {
        viewModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const namaTabel = button.getAttribute('data-namatabel');
            const namaStandar = button.getAttribute('data-namastandar');
            const created = button.getAttribute('data-created');
            const updated = button.getAttribute('data-updated');
            
            const modal = this;
            modal.querySelector('#view_id').textContent = id;
            modal.querySelector('#view_namaTabel').textContent = namaTabel;
            modal.querySelector('#view_namaStandar').textContent = namaStandar;
            modal.querySelector('#view_created').textContent = created;
            modal.querySelector('#view_updated').textContent = updated;
        });
    }

    // Handle form validation untuk create modal
    const createModal = document.getElementById('createAlatStandardModal');
    if (createModal) {
        createModal.addEventListener('show.bs.modal', function () {
            // Reset form ketika modal dibuka
            const form = this.querySelector('form');
            form.reset();
            
            // Hapus class invalid
            const invalidInputs = form.querySelectorAll('.is-invalid');
            invalidInputs.forEach(input => {
                input.classList.remove('is-invalid');
            });
            
            const invalidFeedbacks = form.querySelectorAll('.invalid-feedback');
            invalidFeedbacks.forEach(feedback => {
                feedback.remove();
            });
        });
    }

    // Auto close alerts setelah 5 detik
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endpush