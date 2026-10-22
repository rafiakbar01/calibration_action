<div class="calibration-view-modal">
    <!-- Navigation Tabs - Bootstrap 4 -->
    <ul class="nav nav-tabs mb-4" id="calibrationTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info-tab-pane" role="tab">
                <i class="fas fa-info-circle me-2"></i>Informasi Umum
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="form-tab" data-toggle="tab" href="#form-tab-pane" role="tab"
               data-form-type="{{ $formType }}" data-calibration-id="{{ $calibration->id }}">
                <i class="fas fa-file-alt me-2"></i>Form Kalibrasi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="data-tab" data-toggle="tab" href="#data-tab-pane" role="tab">
                <i class="fas fa-table me-2"></i>Data Measurements
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="calibrationTabContent">
        
        <!-- Tab 1: Informasi Umum -->
        <div class="tab-pane fade show active" id="info-tab-pane" role="tabpanel">
            <!-- Your existing info tab content -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-tools me-2"></i>Informasi Alat</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td width="40%"><strong>Certificate ID:</strong></td>
                                    <td><span class="badge badge-primary">{{ $calibration->headInsideMicrometer->certificate_id ?? 'N/A' }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Alat:</strong></td>
                                    <td>{{ $calibration->namaAlat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Merek:</strong></td>
                                    <td>{{ $calibration->brandAlat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kode Alat:</strong></td>
                                    <td>{{ $calibration->kodeAlat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Type/No. Seri:</strong></td>
                                    <td>{{ $calibration->typeAlat }} / {{ $calibration->noSeri }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kapasitas:</strong></td>
                                    <td>{{ $calibration->kapasitas }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Resolusi:</strong></td>
                                    <td>{{ $calibration->resolusi }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-user me-2"></i>Informasi Pemilik & Tanggal</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td width="40%"><strong>Pemilik:</strong></td>
                                    <td>{{ $calibration->pemilikAlat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. PO:</strong></td>
                                    <td>{{ $calibration->no_po ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Masuk:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($calibration->tanggalMasuk)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Kalibrasi:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($calibration->tanggalKalibrasi)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat Kalibrasi:</strong></td>
                                    <td>{{ $calibration->tempatKalibrasi }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Lokasi PT:</strong></td>
                                    <td>{{ $calibration->lokasiPT }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Pembacaan:</strong></td>
                                    <td>{{ $calibration->jenisPembacaan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kondisi Alat:</strong></td>
                                    <td>
                                        <span class="badge {{ $calibration->kondisiAlat == 'ok' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $calibration->kondisiAlat }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Continue with the rest of your content... -->
            
        </div>

        <!-- Tab 2: Form Kalibrasi -->
        <div class="tab-pane fade" id="form-tab-pane" role="tabpanel">
            <div id="formContent" class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Klik tab "Form Kalibrasi" untuk memuat form</p>
            </div>
        </div>

        <!-- Tab 3: Data Measurements -->
        <div class="tab-pane fade" id="data-tab-pane" role="tabpanel">
            @if($calibration->detailInsideMicrometers->count() > 0)
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-table me-2"></i>Data Measurements</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">Titik Ukur</th>
                                        <th class="text-center">Ulangan 1</th>
                                        <th class="text-center">Ulangan 2</th>
                                        <th class="text-center">Ulangan 3</th>
                                        <th class="text-center">Ulangan 4</th>
                                        <th class="text-center">Ulangan 5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($calibration->detailInsideMicrometers as $detail)
                                        <tr>
                                            <td class="text-center">{{ $detail->titikUkur }}</td>
                                            <td class="text-center">{{ $detail->ulangan01 }}</td>
                                            <td class="text-center">{{ $detail->ulangan02 }}</td>
                                            <td class="text-center">{{ $detail->ulangan03 }}</td>
                                            <td class="text-center">{{ $detail->ulangan04 }}</td>
                                            <td class="text-center">{{ $detail->ulangan05 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-2x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada data measurements</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Load form content ketika tab form diklik - jQuery version
    $(document).ready(function() {
        $('#form-tab').on('click', function() {
            const formType = $(this).data('form-type');
            const calibrationId = $(this).data('calibration-id');
            console.log('Loading form:', formType, calibrationId);
            loadFormContent(formType, calibrationId);
        });
    });

    function loadFormContent(formType, calibrationId) {
        const formContent = $('#formContent');
        formContent.html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Memuat form ${formType}...</p>
            </div>
        `);

        $.ajax({
            url: '/calibrations/' + calibrationId + '/form-view/' + formType,
            type: 'GET',
            success: function(html) {
                formContent.html(html);
            },
            error: function(xhr, status, error) {
                console.error('Error loading form:', error);
                formContent.html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Gagal memuat form. Silakan coba lagi.
                    </div>
                `);
            }
        });
    }
</script>