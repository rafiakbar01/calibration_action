@extends('layouts.app')

@section('title', 'Tambah Berita Acara')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                <div class="card-header bg-white border-bottom d-flex align-items-center py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="create-icon-box">
                            <i class="fas fa-file-alt text-primary"></i>
                        </div>
                        <div>
                            <h4 class="card-title mb-0 fw-bold text-dark fs-5">
                                Tambah Berita Acara
                                @if(isset($groupInfo) && !empty($groupInfo) && $groupInfo['jumlah'] > 0)
                                <span class="ms-2 badge bg-primary-subtle text-primary fs-7 fw-semibold rounded-pill py-2 px-3">
                                    <i class="fas fa-layer-group me-1"></i>
                                    {{ $groupInfo['perusahaan'] }} &nbsp;|&nbsp;
                                    <i class="far fa-calendar-alt me-1"></i>{{ \Carbon\Carbon::parse($groupInfo['tanggal'])->format('d/m/Y') }}
                                    &nbsp;|&nbsp;
                                    <i class="fas fa-cubes me-1"></i>{{ $groupInfo['jumlah'] }} Alat
                                </span>
                                @endif
                            </h4>
                            <small class="text-muted">Isi formulir untuk membuat dokumen berita acara kalibrasi baru</small>
                        </div>
                    </div>
                </div>

                <form action="{{ route('berita-acara.store') }}" method="POST" id="formBeritaAcara">
                    @csrf

                    <!-- Hidden Fields -->
                    <input type="hidden" name="no_ba" value="{{ $newNoBa }}">

                    @if(isset($groupInfo) && !empty($groupInfo))
                    <input type="hidden" name="from_group" value="1">
                    <input type="hidden" name="group_tanggal" value="{{ $groupInfo['tanggal'] }}">
                    <input type="hidden" name="group_perusahaan" value="{{ $groupInfo['perusahaan'] }}">
                    @endif

                    <!-- Informasi Group -->
                    @if(isset($groupInfo) && !empty($groupInfo) && $groupInfo['jumlah'] > 0)
                    <div class="create-info-box mx-3 mt-3 mb-0 rounded-3 p-3 d-flex align-items-start gap-2">
                        <span class="create-info-icon mt-1"><i class="fas fa-info-circle text-primary"></i></span>
                        <div>
                            <strong class="text-primary d-block mb-1">Informasi Group</strong>
                            <p class="mb-0 small text-secondary">
                                Membuat Berita Acara untuk <strong>{{ $groupInfo['jumlah'] }} alat</strong> dari
                                <strong>{{ $groupInfo['perusahaan'] }}</strong>
                                @if(!empty($groupInfo['lokasi']))({{ $groupInfo['lokasi'] }})@endif
                                dengan tanggal masuk <strong>{{ \Carbon\Carbon::parse($groupInfo['tanggal'])->format('d/m/Y') }}</strong>.
                                <br>Semua alat akan dimasukkan dalam satu Berita Acara nomor <strong>{{ $newNoBa }}</strong>.
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Error Messages (akan ditampilkan jika ada session error) -->
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible mx-3 mt-3">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                    @endif

                    <!-- Success Messages (akan ditampilkan jika ada session success) -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible mx-3 mt-3">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h5><i class="icon fas fa-check-circle"></i> Berhasil!</h5>
                        <p class="mb-0">{!! session('success') !!}</p>
                    </div>
                    @endif

                    <!-- Validation Errors -->
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible mx-3 mt-3">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error Validasi!</h5>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card-body px-4 py-4">

                        <!-- Baris 1: Tanggal, No Order, Kontak, Telp/Fax -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="tanggal"
                                               class="form-control @error('tanggal') is-invalid @enderror"
                                               value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                    </div>
                                    @error('tanggal')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No. Order</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="no_order" class="form-control"
                                               value="{{ old('no_order', $groupInfo['no_po'] ?? request('no_po', '')) }}" placeholder="Masukkan No Order / No PO">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                 <div class="form-group">
                                    <label>Kontak Person <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror"
                                               value="{{ old('kontak') }}" placeholder="Nama kontak" required>
                                    </div>
                                    @error('kontak')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Telp / Fax</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="telp_fax" class="form-control"
                                               value="{{ old('telp_fax') }}" placeholder="Telepon / Fax">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Baris 2: Perusahaan dan Alamat -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Perusahaan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <input type="text" name="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror"
                                               value="{{ old('perusahaan', $perusahaan ?? '') }}"
                                               placeholder="Nama perusahaan" required>
                                    </div>
                                    @error('perusahaan')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Alamat <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                               value="{{ old('alamat', $alamat ?? '') }}"
                                               placeholder="Alamat lengkap" required>
                                    </div>
                                    @error('alamat')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="bg-primary">

                        <!-- Tabel Daftar Alat -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="create-section-header d-flex align-items-center gap-2 mb-3">
                                    <div class="create-section-icon">
                                        <i class="fas fa-tools text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">Daftar Alat</h6>
                                        <small class="text-muted">Alat yang akan dimasukkan dalam berita acara</small>
                                    </div>
                                    @if(isset($calibrations) && $calibrations->count() > 0)
                                    <span class="badge bg-primary rounded-pill ms-auto px-3 py-2">
                                        <i class="fas fa-cubes me-1"></i>{{ $calibrations->count() }} Alat
                                    </span>
                                    @endif
                                </div>

                                @if(isset($calibrations) && $calibrations->count() > 0)
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover" id="table-alat">
                                        <thead class="create-table-header">
                                            <tr>
                                                <th width="5%" class="text-center">No</th>
                                                <th width="8%" class="text-center">ID</th>
                                                <th width="12%" class="text-center">No Label</th>
                                                <th width="18%" class="text-center">Nama Alat</th>
                                                <th width="12%" class="text-center">Merek</th>
                                                <th width="10%" class="text-center">Type</th>
                                                <th width="15%" class="text-center">Rentang Ukur</th>
                                                <th width="15%" class="text-center">No. Seri</th>
                                                <th width="15%" class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="alat-container">
                                            @foreach($calibrations as $cal)
                                            @php
                                                $rentangUkur = '';
                                                if (!empty($cal->kapasitas)) {
                                                    $rentangUkur = $cal->kapasitas;
                                                    if (!empty($cal->satuan)) {
                                                        $rentangUkur .= ' ' . $cal->satuan;
                                                    }
                                                } else {
                                                    $rentangUkur = '-';
                                                }
                                            @endphp
                                            <tr class="alat-row">
                                                <td class="text-center align-middle font-weight-bold">{{ $loop->iteration }}</td>
                                                <td class="text-center align-middle">
                                                    <span class="badge badge-info">{{ $cal->id }}</span>
                                                    <input type="hidden" name="alat[{{ $loop->index }}][calibration_id]" value="{{ $cal->id }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="alat[{{ $loop->index }}][no_label]" class="form-control form-control-sm" value="{{ $cal->no_label ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="alat[{{ $loop->index }}][nama_alat]" class="form-control form-control-sm" value="{{ $cal->namaAlat ?? '' }}" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="alat[{{ $loop->index }}][merek]" class="form-control form-control-sm" value="{{ $cal->brandAlat ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="alat[{{ $loop->index }}][type_alat]" class="form-control form-control-sm" value="{{ $cal->typeAlat ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="alat[{{ $loop->index }}][kapasitas]" class="form-control form-control-sm" value="{{ $cal->kapasitas ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="alat[{{ $loop->index }}][no_seri]" class="form-control form-control-sm" value="{{ $cal->NoSeri ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="alat[{{ $loop->index }}][keterangan]" class="form-control form-control-sm" value="{{ $cal->keterangan ?? '' }}">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <strong>Tidak ada data alat!</strong>
                                    <p class="mb-0 mt-2">Tidak ada data calibration yang ditemukan untuk grup ini.</p>
                                    <a href="{{ route('berita-acara.index') }}" class="btn btn-warning btn-sm mt-3">
                                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Grouping
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        @if(isset($calibrations) && $calibrations->count() > 0)
                        <div class="create-divider my-4"></div>

                        <!-- Catatan -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="fw-semibold small text-secondary mb-1">Catatan</label>
                                    <textarea name="catatan" class="form-control create-input" rows="3"
                                              placeholder="Catatan tambahan...">{{ old('catatan') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Request By & Approve By -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Request By</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-edit"></i></span>
                                        </div>
                                        <input type="text" name="request_by" class="form-control"
                                               value="{{ old('request_by', $calibrations->first()->calibratedBy ?? (Auth::check() ? Auth::user()->name : 'System')) }}"
                                               placeholder="Nama pemohon">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Approve By <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                        </div>
                                        <input type="text" name="approve_by" class="form-control @error('approve_by') is-invalid @enderror"
                                               value="{{ old('approve_by') }}" placeholder="Nama yang menyetujui" required>
                                    </div>
                                    @error('approve_by')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Hidden status default -->
                        <input type="hidden" name="status" value="waiting_approve">
                        @endif

                    </div>

                    @if(isset($calibrations) && $calibrations->count() > 0)
                    <div class="card-footer bg-white border-top px-4 py-3">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm" id="btnSubmit">
                            <i class="fas fa-save me-1"></i> Simpan Berita Acara
                        </button>
                        <a href="{{ route('berita-acara.index') }}" class="btn btn-light rounded-pill px-4 ms-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan SweetAlert2 CSS dan JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@push('styles')
<style>
    /* === Card & Header === */
    .card { border-radius: 14px !important; }
    .create-icon-box {
        width: 46px; height: 46px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem; flex-shrink: 0;
        color: white;
    }
    .create-icon-box i { color: white !important; }

    /* === Info Box (replace alert-info) === */
    .create-info-box {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
    }
    .create-info-icon {
        font-size: 1.1rem; flex-shrink: 0;
    }

    /* === Section Header (Daftar Alat) === */
    .create-section-header {
        background: #f8faff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 16px;
    }
    .create-section-icon {
        width: 36px; height: 36px;
        background: #eff6ff;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* === Table header solid blue === */
    .table thead.create-table-header th {
        background-color: #e8f0fe !important; /* Biru muda premium yang bersih, terang, dan mewah */
        background-image: none !important;
        color: #1e3a8a !important; /* Teks biru tua yang sangat kontras, tegas, dan elegan */
        font-weight: 800 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.8px !important;
        border: none !important; /* Hilangkan seluruh garis hitam dan garis pembatas vertikal antar kolom */
        border-bottom: 2px solid #93c5fd !important; /* Garis bawah biru muda lembut sebagai pemisah yang manis */
        padding: 12px 14px !important;
        text-align: center;
        vertical-align: middle;
        text-shadow: none !important;
    }
    .table tbody td { vertical-align: middle; font-size: 0.875rem; }

    /* === Divider === */
    .create-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, #bfdbfe, transparent);
        border: none;
    }

    /* === Form labels === */
    .form-group label, label.fw-semibold {
        font-weight: 600 !important;
        color: #374151 !important;
        font-size: 0.85rem !important;
    }

    /* === Input group text (icon prefix) === */
    .input-group-text {
        background-color: #eff6ff !important;
        border-color: #e2e8f0 !important;
        color: #2563eb !important;
    }

    /* === Form controls === */
    .form-control, .create-input, input, textarea, select {
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        background-color: #fff !important;
        color: #1e293b !important;
        transition: border-color 0.2s, box-shadow 0.2s !important;
    }
    .form-control:focus, .create-input:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37,99,235,.1) !important;
    }
    input[readonly], .form-control[readonly] {
        background-color: #f8faff !important;
        cursor: not-allowed;
        color: #6b7280 !important;
    }
    .input-group-text + .form-control { border-left: none !important; }

    /* === Buttons === */
    .btn { transition: all 0.2s ease; }
    .btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.12); }
    .btn-primary { background: linear-gradient(135deg, #2563eb, #1d4ed8) !important; border: none !important; }

    /* === Card footer === */
    .card-footer { background: #fff !important; border-top: 1px solid #f1f5f9 !important; }

    /* === Outline top === */
    .card-primary.card-outline { border-top: 3px solid #2563eb !important; }

    /* === Spinner animation === */
    .swal2-loader-custom {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #2563eb;
        border-radius: 50%;
        width: 40px; height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto hide alert biasa
        setTimeout(function() {
            $(".alert").fadeOut('slow');
        }, 5000);

        // Cek apakah ada session success dari server
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: true,
                confirmButtonColor: '#2563eb',
                confirmButtonText: 'OK',
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                },
                background: '#f8f9fa',
                iconColor: '#28a745',
                customClass: {
                    title: 'text-success fw-bold',
                    popup: 'rounded-3 shadow-lg'
                }
            });
        @endif

        // Cek apakah ada session error dari server
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: '{{ session('error') }}',
                timer: 5000,
                showConfirmButton: true,
                confirmButtonColor: '#2563eb',
                confirmButtonText: 'OK',
                timerProgressBar: true,
                background: '#f8f9fa',
                iconColor: '#dc3545',
                customClass: {
                    title: 'text-danger fw-bold',
                    popup: 'rounded-3 shadow-lg'
                }
            });
        @endif

        // Cek apakah ada validation errors
        @if($errors->any())
            let errorList = '<ul class="text-left mb-0" style="list-style-type: disc; padding-left: 20px;">';
            @foreach($errors->all() as $error)
                errorList += '<li>{{ $error }}</li>';
            @endforeach
            errorList += '</ul>';
            
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: errorList,
                timer: 5000,
                showConfirmButton: true,
                confirmButtonColor: '#2563eb',
                confirmButtonText: 'OK',
                timerProgressBar: true,
                background: '#f8f9fa',
                iconColor: '#dc3545',
                customClass: {
                    title: 'text-danger fw-bold',
                    popup: 'rounded-3 shadow-lg'
                }
            });
        @endif

        // Loading saat submit dengan animasi yang lebih baik
        $('#formBeritaAcara').on('submit', function(e) {
            let kontak = $('input[name="kontak"]').val().trim();
            let approveBy = $('input[name="approve_by"]').val().trim();
            
            if (!kontak) {
                e.preventDefault();
                showWarningAnimation('Kontak Person harus diisi!');
                return false;
            }
            
            if (!approveBy) {
                e.preventDefault();
                showWarningAnimation('Approve By harus diisi!');
                return false;
            }
            
            let btn = $(this).find('button[type="submit"]');
            let originalText = btn.html();
            
            // Tampilkan SweetAlert loading
            Swal.fire({
                title: 'Menyimpan Data...',
                html: `
                    <div class="swal2-loader-custom"></div>
                    <p class="mt-3">Mohon tunggu sebentar, data sedang diproses.</p>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" 
                             style="width: 100%; background-color: #2563eb;"></div>
                    </div>
                `,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                background: '#f8f9fa',
                customClass: {
                    title: 'text-primary fw-bold',
                    popup: 'rounded-3 shadow-lg'
                }
            });
            
            // Ubah tombol submit menjadi loading
            btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...').prop('disabled', true);
            
            // Biarkan form submit secara normal
            return true;
        });

        // Jika ada error di server (misalnya 500, 419, dll)
        $(document).ajaxError(function(event, xhr, settings, error) {
            if (xhr.status === 419) {
                Swal.fire({
                    icon: 'error',
                    title: 'Sesi Habis!',
                    text: 'Sesi Anda telah habis. Silakan refresh halaman dan login kembali.',
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: 'Refresh Halaman',
                    background: '#f8f9fa',
                    iconColor: '#dc3545',
                    customClass: {
                        title: 'text-danger fw-bold',
                        popup: 'rounded-3 shadow-lg'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            } else if (xhr.status === 500) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error Server!',
                    text: 'Terjadi kesalahan pada server. Silakan coba lagi atau hubungi administrator.',
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: 'OK',
                    background: '#f8f9fa',
                    iconColor: '#dc3545',
                    customClass: {
                        title: 'text-danger fw-bold',
                        popup: 'rounded-3 shadow-lg'
                    }
                });
            }
        });
    });

    // Fungsi untuk menampilkan notifikasi sukses dengan animasi
    function showSuccessAnimation(message) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            timer: 3000,
            showConfirmButton: true,
            confirmButtonColor: '#003366',
            confirmButtonText: 'OK',
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            },
            background: '#f8f9fa',
            iconColor: '#28a745',
            customClass: {
                title: 'text-success fw-bold',
                popup: 'rounded-3 shadow-lg'
            }
        });
    }

    // Fungsi untuk menampilkan notifikasi error dengan detail
    function showErrorAnimation(message, detail = null) {
        let html = message;
        if (detail) {
            html += '<br><small class="text-muted">' + detail + '</small>';
        }
        
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: html,
            timer: 5000,
            showConfirmButton: true,
            confirmButtonColor: '#003366',
            confirmButtonText: 'OK',
            timerProgressBar: true,
            background: '#f8f9fa',
            iconColor: '#dc3545',
            customClass: {
                title: 'text-danger fw-bold',
                popup: 'rounded-3 shadow-lg'
            }
        });
    }

    // Fungsi untuk menampilkan notifikasi peringatan
    function showWarningAnimation(message) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: message,
            timer: 4000,
            showConfirmButton: true,
            confirmButtonColor: '#003366',
            confirmButtonText: 'OK',
            timerProgressBar: true,
            background: '#f8f9fa',
            iconColor: '#ffc107',
            customClass: {
                title: 'text-warning fw-bold',
                popup: 'rounded-3 shadow-lg'
            }
        });
    }
</script>
@endpush