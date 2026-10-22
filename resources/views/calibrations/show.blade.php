@extends('layouts.app')

@section('title', 'Detail Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION')

@section('content')
<script>
    // Global function for parameter checkbox toggles
    if (typeof window.toggleParamSection !== 'function') {
        window.toggleParamSection = function(checkbox) {
            const targetId = checkbox.getAttribute('data-target');
            const container = checkbox.closest('.subform-wrapper') || checkbox.closest('.lk-form-container') || document;
            const targetSection = container.querySelector('#' + targetId) || document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = checkbox.checked ? 'block' : 'none';
                console.log(`Parameter toggled: ${targetId} -> ${targetSection.style.display}`);
            }
        };
    }
</script>
<style>
    /* Hide boilerplate elements in subforms */
    .subform-wrapper .footer-table,
    .subform-wrapper #btnSimpanSemua,
    .subform-wrapper .text-center.mt-4,
    .subform-wrapper .btn-primary {
        display: none !important;
    }

    .subform-wrapper {
        border: 2px dashed #3498db !important;
        border-radius: 8px;
        padding: 20px;
        background-color: #fdfdfd;
        position: relative;
        margin-bottom: 25px;
    }

    /* Hide default action buttons inside form templates when rendered inside the main card-body */
    .card-body .row.mt-5:not(.central-action-row),
    .card-body button[type="submit"]:not(.central-submit-btn),
    .card-body a.btn-secondary:not(.central-cancel-btn):not(.shadow-sm),
    .form-kalibrasi-container .row.mt-5,
    .form-kalibrasi-container button:not(.add-row-btn):not(.remove-row-btn),
    .form-kalibrasi-container a.btn-secondary {
        display: none !important;
    }
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-file-alt text-primary"></i>
        @if($mode == 'edit')
        Edit Kalibrasi
        @else
        Detail Kalibrasi
        @endif
    </h1>
    <div>
        <a href="{{ route('calibrations.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
</div>

<!-- Alert Messages -->
@if(session('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <i class="fas fa-info-circle"></i> {{ session('info') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    @if($mode == 'edit')
                    Form Edit Kalibrasi - {{ $calibration->namaAlat }}
                    @else
                    Form Kalibrasi - {{ $calibration->namaAlat }}
                    @endif
                </h6>
                @if($mode == 'view')
                <span class="badge badge-success">Mode View Only</span>
                @else
                <span class="badge badge-warning">Mode Edit</span>
                @endif
            </div>
            <div class="card-body">
                @if($mode == 'edit')
                <!-- FORM EDIT -->
                   <form id="calibrationForm" action="{{ route('calibrations.update', $calibration->id) }}" method="POST" enctype="multipart/form-data">
                  
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="form_type" value="{{ $formType }}">
                    <input type="hidden" name="no_po" id="hidden_no_po_input" value="{{ old('no_po', $calibration->no_po) }}">

                    <!-- Include Form HTML berdasarkan jenis alat -->
                    @if($formType == 'inside_micrometer')
                    @include('formhtml.inside_micrometer_edit', ['calibration' => $calibration])
                    @elseif($formType == 'outside_micrometer')
                    @include('formhtml.outside_micrometer_edit', ['calibration' => $calibration])
                    @elseif($formType == 'depth_micrometer')
                    @include('formhtml.depth_micrometer_edit', ['calibration' => $calibration])
                    @elseif($formType == 'ir_thermometer')
                    @include('formhtml.thermometer_infrared_edit', ['calibration' => $calibration])
                    @elseif($formType == 'thermometer')
                    @include('formhtml.thermometer_edit', ['calibration' => $calibration])
                    @elseif($formType == 'dial_indicator')
                    @include('formhtml.dial_indicator_edit', ['calibration' => $calibration])
                    @elseif($formType == 'dial_test_indicator')
                    @include('formhtml.dial_test_indicator_edit', ['calibration' => $calibration])
                    @elseif($formType == 'depth_caliper')
                    @include('formhtml.depth_caliper_edit', ['calibration' => $calibration])
                    @elseif($formType == 'caliper')
                    @include('formhtml.caliper_edit', ['calibration' => $calibration])
                    @elseif($formType == 'torque_wrench')
                    @include('formhtml.torque_wrench_edit', ['calibration' => $calibration])
                    @elseif($formType == 'torque_meter')
                    @include('formhtml.torque_meter_edit', ['calibration' => $calibration])
                    @elseif($formType == 'ultrasonic_thickness_gauge')
                    @include('formhtml.ultrasonic_thickness_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'thickness_gauge')
                    @include('formhtml.thickness_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'penggaris')
                    @include('formhtml.penggaris_edit', ['calibration' => $calibration])
                    @elseif($formType == 'enclosure')
                    @include('formhtml.enclosure_edit', ['calibration' => $calibration])
                    @elseif($formType == 'chamber')
                    @include('formhtml.chamber_edit', ['calibration' => $calibration])
                    @elseif($formType == 'pressure_gauge')
                    @include('formhtml.pressure_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'differential_pressure_gauge')
                    @include('formhtml.differential_pressure_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'volumetrik')
                    @include('formhtml.volumetrik_edit', ['calibration' => $calibration])
                    @elseif($formType == 'push_pull')
                    @include('formhtml.push_pull_edit', ['calibration' => $calibration])
                    @elseif($formType == 'anak_timbangan')
                    @include('formhtml.anak_timbangan_edit', ['calibration' => $calibration])
                    @elseif($formType == 'timbangan')
                    @include('formhtml.timbangan_edit', ['calibration' => $calibration])
                    @elseif($formType == 'timbangan_moisture')
                    @include('formhtml.timbangan_moisture_edit', ['calibration' => $calibration])
                    @elseif($formType == 'timbangan_bias')
                    @include('formhtml.timbangan_bias_edit', ['calibration' => $calibration])
                    @elseif($formType == 'gauge_block')
                    @include('formhtml.gauge_block_edit', ['calibration' => $calibration])
                    @elseif($formType == 'holetest')
                    @include('formhtml.holetest_edit', ['calibration' => $calibration])
                    @elseif($formType == 'conductivity_meter')
                    @include('formhtml.conductivity_meter_edit', ['calibration' => $calibration])
                    @elseif($formType == 'coating_thickness')
                    @include('formhtml.coating_thickness_edit', ['calibration' => $calibration])
                    @elseif($formType == 'durometer')
                    @include('formhtml.durometer_edit', ['calibration' => $calibration])
                    @elseif($formType == 'mikropipet_dispenset')
                    @include('formhtml.mikropipet_dispenset_edit', ['calibration' => $calibration])
                    @elseif($formType == 'taper_gauge')
                    @include('formhtml.taper_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'feeler_gauge')
                    @include('formhtml.feeler_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'ph_meter')
                    @include('formhtml.ph_meter_edit', ['calibration' => $calibration])
                    @elseif($formType == 'tachometer')
                    @include('formhtml.tachometer_edit', ['calibration' => $calibration])
                    @elseif($formType == 'pin_gauge')
                    @include('formhtml.pin_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'viscometer')
                    @include('formhtml.viscometer_edit', ['calibration' => $calibration])
                    @elseif($formType == 'visco_cup')
                    @include('formhtml.visco_cup_edit', ['calibration' => $calibration])
                    @elseif($formType == 'plain_limit_gauge')
                    @include('formhtml.plain_limit_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'temp_humid_transmitter')
                    @include('formhtml.temp_humid_transmitter_edit', ['calibration' => $calibration])
                    @elseif($formType == 'temperature_transmitter')
                    @include('formhtml.temp_transmitter_edit', ['calibration' => $calibration])
                    @elseif($formType == 'thermoindicator')
                    @include('formhtml.thermoindicator_edit', ['calibration' => $calibration])
                    @elseif($formType == 'plastic_shim')
                    @include('formhtml.plastic_shim_edit', ['calibration' => $calibration])
                    @elseif($formType == 'profil_projector')
                    @include('formhtml.profil_projector_edit', ['calibration' => $calibration])
                    @elseif($formType == 'surface_roughness_tester')
                    @include('formhtml.surface_roughness_tester_edit', ['calibration' => $calibration])
                    @elseif($formType == 'thread_gauge')
                    @include('formhtml.thread_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'stopwatch')
                    @include('formhtml.stopwatch_edit', ['calibration' => $calibration])
                    @elseif($formType == 'centrifuge')
                    @include('formhtml.centrifuge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'utm')
                    @include('formhtml.utm_edit', ['calibration' => $calibration])
                    @elseif($formType == 'pressure_transmitter')
                    @include('formhtml.pressure_transmitter_edit', ['calibration' => $calibration])
                    @elseif($formType == 'surface_plate')
                    @include('formhtml.surface_plate_edit', ['calibration' => $calibration])
                    @elseif($formType == 'thermohygrometer')
                    @include('formhtml.thermohygrometer_edit', ['calibration' => $calibration])
                    @elseif($formType == 'bore_gauge')
                    @include('formhtml.bore_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'abration_tester')
                    @include('formhtml.abration_tester_edit', ['calibration' => $calibration])
                    @elseif($formType == 'height_gauge')
                    @include('formhtml.height_gauge_edit', ['calibration' => $calibration])
                    @elseif($formType == 'insulation')
                        @if(str_contains(strtolower($calibration->namaAlat), 'clamp'))
                        @include('formhtml.clampmeter_edit', ['calibration' => $calibration])
                        @else
                        @include('formhtml.multimeter_edit', ['calibration' => $calibration])
                        @endif
                    @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        Form edit untuk alat jenis "{{ $calibration->namaAlat }}" belum tersedia.
                    </div>
                    @endif

                    <!-- Container for subforms -->
                    <div id="subform-container">
                        @php
                        $savedSubforms = \App\Http\Controllers\CalibrationController::getSavedSubforms($calibration->id, $formType);
                        @endphp
                        @foreach($savedSubforms as $subType)
                        @php
                            $identities = json_decode($calibration->subform_identities, true) ?? [];
                            $hasCustomId = isset($identities[$subType]) ? '1' : '0';
                        @endphp
                        <div class="subform-wrapper mb-4 border p-3 rounded bg-light" data-form-type="{{ $subType }}" data-has-custom-identity="{{ $hasCustomId }}">
                            <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                                <h5 class="m-0 text-secondary"><i class="fas fa-file-alt"></i> Form Tambahan: {{ ucwords(str_replace('_', ' ', $subType)) }}</h5>
                                <button type="button" class="btn btn-sm btn-danger remove-subform-btn" data-form-type="{{ $subType }}">Hapus Form</button>
                            </div>
                            <input type="hidden" name="additional_forms[]" value="{{ $subType }}">
                            {!! \App\Http\Controllers\CalibrationController::renderSubform('formhtml.' . $subType . '_edit', $calibration) !!}
                        </div>
                        @endforeach
                    </div>

                    <!-- Panel for adding additional subforms in Edit Mode -->
                    <div class="card card-outline card-primary mt-4">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold"><i class="fas fa-plus-circle mr-1"></i> Form Tambahan (Optional Worksheets)</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small">Pilih form tambahan yang ingin digabungkan ke transaksi kalibrasi ini:</p>
                            <div class="row">
                                @foreach(\App\Http\Controllers\CalibrationController::$formRegistry as $type => $config)
                                @if($type !== $formType)
                                <div class="col-md-3 col-sm-6 mb-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input subform-checkbox" type="checkbox" id="chk_subform_{{ $type }}" value="{{ $type }}"
                                            {{ in_array($type, $savedSubforms) ? 'checked' : '' }}>
                                        <label for="chk_subform_{{ $type }}" class="form-check-label font-weight-normal">
                                            {{ ucwords(str_replace('_', ' ', $type)) }}
                                        </label>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Centralized Action Buttons at the very bottom -->
                    <div class="row mt-5 central-action-row">
                        <div class="col-12 text-center mb-4">
                            <a href="{{ route('calibrations.index') }}" class="btn btn-secondary btn-lg central-cancel-btn" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-success btn-lg ms-3 central-submit-btn" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </div>

                </form>
                @else
                <!-- VIEW ONLY -->
                @if($formType == 'inside_micrometer')
                @include('formhtml.inside_micrometer_view', ['calibration' => $calibration])
                @elseif($formType == 'outside_micrometer')
                @include('formhtml.outside_micrometer_view', ['calibration' => $calibration])
                @elseif($formType == 'depth_micrometer')
                @include('formhtml.depth_micrometer_view', ['calibration' => $calibration])
                @elseif($formType == 'ir_thermometer')
                @include('formhtml.thermometer_infrared_view', ['calibration' => $calibration])
                @elseif($formType == 'thermometer')
                @include('formhtml.thermometer_view', ['calibration' => $calibration])
                @elseif($formType == 'dial_indicator')
                @include('formhtml.dial_indicator_view', ['calibration' => $calibration])
                @elseif($formType == 'dial_test_indicator')
                @include('formhtml.dial_test_indicator_view', ['calibration' => $calibration])
                @elseif($formType == 'depth_caliper')
                @include('formhtml.depth_caliper_view', ['calibration' => $calibration])
                @elseif($formType == 'caliper')
                @include('formhtml.caliper_view', ['calibration' => $calibration])
                @elseif($formType == 'torque_wrench')
                @include('formhtml.torque_wrench_view', ['calibration' => $calibration])
                @elseif($formType == 'torque_meter')
                @include('formhtml.torque_meter_view', ['calibration' => $calibration])
                @elseif($formType == 'ultrasonic_thickness_gauge')
                @include('formhtml.ultrasonic_thickness_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'thickness_gauge')
                @include('formhtml.thickness_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'penggaris')
                @include('formhtml.penggaris_view', ['calibration' => $calibration])
                @elseif($formType == 'enclosure')
                @include('formhtml.enclosure_view', ['calibration' => $calibration])
                @elseif($formType == 'chamber')
                @include('formhtml.chamber_view', ['calibration' => $calibration])
                @elseif($formType == 'pressure_gauge')
                @include('formhtml.pressure_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'differential_pressure_gauge')
                @include('formhtml.differential_pressure_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'volumetrik')
                @include('formhtml.volumetrik_view', ['calibration' => $calibration])
                @elseif($formType == 'push_pull')
                @include('formhtml.push_pull_view', ['calibration' => $calibration])
                @elseif($formType == 'anak_timbangan')
                @include('formhtml.anak_timbangan_view', ['calibration' => $calibration])
                @elseif($formType == 'timbangan')
                @include('formhtml.timbangan_view', ['calibration' => $calibration])
                @elseif($formType == 'timbangan_moisture')
                @include('formhtml.timbangan_moisture_view', ['calibration' => $calibration])
                @elseif($formType == 'timbangan_bias')
                @include('formhtml.timbangan_bias_view', ['calibration' => $calibration])
                @elseif($formType == 'gauge_block')
                @include('formhtml.gauge_block_edit', ['calibration' => $calibration])
                @elseif($formType == 'holetest')
                @include('formhtml.holetest_view', ['calibration' => $calibration])
                @elseif($formType == 'conductivity_meter')
                @include('formhtml.conductivity_meter_view', ['calibration' => $calibration])
                @elseif($formType == 'coating_thickness')
                @include('formhtml.coating_thickness_view', ['calibration' => $calibration])
                @elseif($formType == 'durometer')
                @include('formhtml.durometer_view', ['calibration' => $calibration])
                @elseif($formType == 'mikropipet_dispenset')
                @include('formhtml.mikropipet_dispenset_view', ['calibration' => $calibration])
                @elseif($formType == 'taper_gauge')
                @include('formhtml.taper_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'feeler_gauge')
                @include('formhtml.feeler_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'ph_meter')
                @include('formhtml.ph_meter_view', ['calibration' => $calibration])
                @elseif($formType == 'tachometer')
                @include('formhtml.tachometer_view', ['calibration' => $calibration])
                @elseif($formType == 'pin_gauge')
                @include('formhtml.pin_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'visco_cup')
                @include('formhtml.visco_cup_view', ['calibration' => $calibration])
                @elseif($formType == 'plain_limit_gauge')
                @include('formhtml.plain_limit_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'temp_humid_transmitter')
                @include('formhtml.temp_humid_transmitter_view', ['calibration' => $calibration])
                @elseif($formType == 'temperature_transmitter')
                @include('formhtml.temp_transmitter_view', ['calibration' => $calibration])
                @elseif($formType == 'thermohygrometer')
                @include('formhtml.thermohygrometer_view', ['calibration' => $calibration])
                @elseif($formType == 'thermoindicator')
                @include('formhtml.thermoindicator_view', ['calibration' => $calibration])
                @elseif($formType == 'plastic_shim')
                @include('formhtml.plastic_shim_view', ['calibration' => $calibration])
                @elseif($formType == 'profil_projector')
                @include('formhtml.profil_projector_view', ['calibration' => $calibration])
                @elseif($formType == 'surface_roughness_tester')
                @include('formhtml.surface_roughness_tester_view', ['calibration' => $calibration])
                @elseif($formType == 'thread_gauge')
                @include('formhtml.thread_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'stopwatch')
                @include('formhtml.stopwatch_view', ['calibration' => $calibration])
                @elseif($formType == 'centrifuge')
                @include('formhtml.centrifuge_view', ['calibration' => $calibration])
                @elseif($formType == 'utm')
                @include('formhtml.utm_view', ['calibration' => $calibration])
                @elseif($formType == 'pressure_transmitter')
                @include('formhtml.pressure_transmitter_view', ['calibration' => $calibration])
                @elseif($formType == 'surface_plate')
                @include('formhtml.surface_plate_view', ['calibration' => $calibration])
                @elseif($formType == 'viscometer')
                @include('formhtml.viscometer_view', ['calibration' => $calibration])
                @elseif($formType == 'bore_gauge')
                @include('formhtml.bore_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'abration_tester')
                @include('formhtml.abration_tester_view', ['calibration' => $calibration])
                @elseif($formType == 'height_gauge')
                @include('formhtml.height_gauge_view', ['calibration' => $calibration])
                @elseif($formType == 'insulation')
                    @if(str_contains(strtolower($calibration->namaAlat), 'clamp'))
                    @include('formhtml.clampmeter_view', ['calibration' => $calibration])
                    @else
                    @include('formhtml.multimeter_view', ['calibration' => $calibration])
                    @endif
                @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    Form untuk alat jenis "{{ $calibration->namaAlat }}" belum tersedia.
                </div>
                @endif

                <!-- View subforms under main form in View Mode -->
                @if($mode == 'view')
                @php
                $savedSubforms = \App\Http\Controllers\CalibrationController::getSavedSubforms($calibration->id, $formType);
                @endphp
                @if(count($savedSubforms) > 0)
                <div class="mt-5 border-top pt-4">
                    <h4 class="mb-4 text-primary font-weight-bold"><i class="fas fa-copy mr-1"></i> Lampiran Lembar Kerja Tambahan</h4>
                    @foreach($savedSubforms as $subType)
                    <div class="subform-wrapper mb-5 p-3 border rounded bg-white shadow-sm" data-form-type="{{ $subType }}">
                        <div class="bg-light p-2 mb-3 border-bottom d-flex justify-content-between align-items-center">
                            <h5 class="m-0 text-secondary font-weight-bold"><i class="fas fa-file-alt mr-1"></i> {{ ucwords(str_replace('_', ' ', $subType)) }}</h5>
                            <span class="badge badge-info">Lampiran</span>
                        </div>
                        {!! \App\Http\Controllers\CalibrationController::renderSubform('formhtml.' . $subType . '_view', $calibration) !!}
                    </div>
                    @endforeach
                </div>
                @endif
                @endif

                <!-- Centralized Action Buttons at the very bottom for View Mode -->
                <div class="row mt-5 central-action-row">
                    <div class="col-12 text-center mb-4">
                        <a href="{{ route('calibrations.index') }}" class="btn btn-secondary btn-lg central-cancel-btn" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // INJECT FIELD NO PO SEBELUM BARIS NAMA ALAT (UNTUK MODE EDIT & VIEW)
        const isEditMode = {{ $mode == 'edit' ? 'true' : 'false' }};
        const noPoValue = {!! json_encode(old('no_po', $calibration->no_po ?? '')) !!};

        function escapeHtml(text) {
            if (!text) return '';
            return String(text)
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

        function injectNoPORow() {
            if (document.querySelector('tr[data-no-po-row="true"]')) return;

            let namaAlatRow = null;
            document.querySelectorAll('table.kalibrasi-main-table td, .form-kalibrasi-container td').forEach(td => {
                const txt = (td.querySelector('p') || td).textContent.trim();
                if (txt === 'Nama Alat' && !namaAlatRow) {
                    namaAlatRow = td.closest('tr');
                }
            });

            if (namaAlatRow) {
                const noPORow = document.createElement('tr');
                noPORow.setAttribute('data-no-po-row', 'true');
                if (isEditMode) {
                    noPORow.innerHTML = `
                        <td style="width: 20%;"><p style="margin: 0; color: #000000; font-weight: 500;">No. PO
                            <span style="color: #6c757d; font-size: 11px;"> (Purchase Order)</span>
                        </p></td>
                        <td colspan="3">
                            <input type="text"
                                   name="no_po"
                                   id="no_po_edit"
                                   class="kalibrasi-input"
                                   value="${escapeHtml(noPoValue)}"
                                   placeholder="Masukkan No PO / Nomor Order (opsional)"
                                   style="width: 100%;">
                        </td>
                    `;
                } else {
                    noPORow.innerHTML = `
                        <td style="width: 20%;"><p style="margin: 0; color: #000000; font-weight: 500;">No. PO
                            <span style="color: #6c757d; font-size: 11px;"> (Purchase Order)</span>
                        </p></td>
                        <td colspan="3">
                            <input type="text"
                                   class="kalibrasi-input"
                                   value="${escapeHtml(noPoValue || '-')}"
                                   readonly
                                   style="width: 100%; background-color: #e9ecef; cursor: not-allowed;">
                        </td>
                    `;
                }
                namaAlatRow.insertAdjacentElement('beforebegin', noPORow);

                if (isEditMode) {
                    const visibleNoPo = noPORow.querySelector('input[name="no_po"]');
                    const hiddenNoPo = document.getElementById('hidden_no_po_input');
                    if (visibleNoPo && hiddenNoPo) {
                        visibleNoPo.addEventListener('input', function() {
                            hiddenNoPo.value = this.value;
                        });
                    }
                }
            }
        }

        injectNoPORow();
        setTimeout(injectNoPORow, 150);
        setTimeout(injectNoPORow, 500);

        if (isEditMode) {
            // Move subform container, checkboxes card, and central buttons back inside the main form
            var $mainForm = $('#calibrationForm');
            if ($mainForm.length > 0) {
                $mainForm.append($('#subform-container'));
                $mainForm.append($('.card-outline.card-primary').first());
                $mainForm.append($('.central-action-row'));
            }

            // Process all existing subforms on page load
            $('.subform-wrapper').each(function() {
                processSubform($(this));
            });

            // Toggle subform checkbox - gunakan event delegation agar bekerja setelah DOM move
            $(document).on('change', '.subform-checkbox', function() {
                var formType = $(this).val();
                var isChecked = $(this).is(':checked');

                console.log('🔲 Checkbox changed:', formType, '→', isChecked);

                if (isChecked) {
                    loadSubform(formType);
                } else {
                    removeSubform(formType);
                }
            });

            // Click remove button inside subform
            $(document).on('click', '.remove-subform-btn', function() {
                var formType = $(this).data('form-type');
                removeSubform(formType);
            });

            function loadSubform(formType) {
                // Cari subform-container di mana saja di DOM (bukan hanya di #subform-container)
                var $container = $('#subform-container');
                console.log('📦 #subform-container found:', $container.length, '| in form:', $container.closest('#calibrationForm').length);

                if ($container.find('.subform-wrapper[data-form-type="' + formType + '"]').length > 0) {
                    console.log('⚠️ Subform sudah ada di DOM:', formType);
                    return;
                }

                Swal.fire({
                    title: 'Loading form...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                var url = '/get-form-html/' + formType + '?is_subform=true';
                console.log('🌐 AJAX GET:', url);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(html) {
                        Swal.close();
                        console.log('✅ HTML diterima, panjang:', html.length, 'chars');

                        html = html.replace(/\bsubmitSemuaForm\b/g, "subform_submitSemuaForm");
                        var label = formType.replace(/_/g, ' ').toUpperCase();

                        var wrapper = $('<div class="subform-wrapper mb-4 border p-3 rounded bg-light" data-form-type="' + formType + '"></div>');
                        var header = $('<div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">' +
                            '<h5 class="m-0 text-secondary"><i class="fas fa-file-alt"></i> Form Tambahan: ' + label + '</h5>' +
                            '<button type="button" class="btn btn-sm btn-danger remove-subform-btn" data-form-type="' + formType + '">Hapus Form</button>' +
                            '</div>');
                        var hiddenInput = $('<input type="hidden" name="additional_forms[]" value="' + formType + '">');

                        wrapper.append(header);
                        wrapper.append(hiddenInput);

                        // Parse HTML dengan jQuery dan append agar script tidak diblok
                        var $parsed = $($.parseHTML(html, document, true));
                        wrapper.append($parsed);

                        $container.append(wrapper);
                        console.log('✅ Wrapper di-append ke #subform-container. Total subforms:', $container.find('.subform-wrapper').length);

                        processSubform(wrapper);
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        console.error('❌ Gagal load subform:', status, error, xhr.responseText);
                        $('#chk_subform_' + formType).prop('checked', false);
                        Swal.fire('Error', 'Gagal memuat form tambahan: ' + (xhr.status || '') + ' ' + (error || ''), 'error');
                    }
                });
            }

            function removeSubform(formType) {
                $('.subform-wrapper[data-form-type="' + formType + '"]').remove();
                $('#chk_subform_' + formType).prop('checked', false);
            }

            function processSubform($wrapper) {
                var $headerTable = $wrapper.find('.kalibrasi-header-table');
                $headerTable.find('input, select, textarea').removeAttr('required');
                $wrapper.find('input[name="form_type"]').prop('disabled', true);

                var $mainTable = $wrapper.find('.kalibrasi-main-table');
                if ($mainTable.length === 0) {
                    var $tables = $wrapper.find('table');
                    if ($tables.length >= 2) {
                        $mainTable = $($tables[1]);
                    }
                }
                if ($mainTable.length > 0) {
                    $mainTable.find('input, select, textarea').removeAttr('required');
                }

                // HAPUS REQUIRED KONDISI KALIBRASI
                var $kondisiHeader = $wrapper.find('.kalibrasi-section-header').filter(function() {
                    var text = $(this).text().trim().toLowerCase();
                    return text === 'kondisi kalibrasi' || text === 'kondisi';
                });
                if ($kondisiHeader.length > 0) {
                    var $row = $kondisiHeader.closest('.row');
                    if ($row.length > 0) {
                        $row.find('input, select, textarea').removeAttr('required');
                    }
                }
                $wrapper.find('.kondisi-input').removeAttr('required');

                // FUNGSI KOMPONEN RADIO BUTTONS HAPUS REQUIRED
                var $radioInputs = $wrapper.find('input[type="radio"][name^="fungsi_komponen"]');
                if ($radioInputs.length > 0) {
                    $radioInputs.removeAttr('required');
                }

                var $tablesAll = $wrapper.find('table');
                if ($tablesAll.length >= 3) {
                    var $lastTable = $tablesAll.last();
                    if ($lastTable.text().includes('Calibrated') || $lastTable.text().includes('Verified') || $lastTable.text().includes('Tanda Tangan')) {
                        $lastTable.hide();
                        $lastTable.find('input, select, textarea').prop('disabled', true).removeAttr('required');
                    }
                }

                if ($wrapper.find('input[name="use_custom_identity"]').length === 0) {
                    $wrapper.append(`<input type="hidden" name="use_custom_identity" value="1">`);
                } else {
                    $wrapper.find('input[name="use_custom_identity"]').val('1');
                }

                $wrapper.find('#btnSimpanSemua').closest('div').hide();
                $wrapper.find('#btnSimpanSemua').hide();
                $wrapper.find('.btn-primary').hide();

                $wrapper.find('button[type="submit"]').closest('.row').hide();
                $wrapper.find('button[type="submit"]').hide();
                $wrapper.find('a[href*="calibrations"]').hide();
            }

            // Validasi dan Simpan Form Utama + Subform via AJAX
            $('#calibrationForm').on('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Menyimpan perubahan...',
                    text: 'Harap tunggu hingga semua data tersimpan.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const $subformWrappers = $('#subform-container').find('.subform-wrapper');
                const formElement = document.getElementById('calibrationForm');
                const formData = new FormData();
                formElement.querySelectorAll('input, select, textarea').forEach(function(el) {
                    if (el.closest('.subform-wrapper')) return;
                    if (!el.name) return;
                    if (el.type === 'file') {
                        // ✅ Kirim binary file, BUKAN string fakepath
                        if (el.files && el.files.length > 0) {
                            for (let i = 0; i < el.files.length; i++) {
                                formData.append(el.name, el.files[i]);
                            }
                        }
                    } else if (el.type === 'radio' || el.type === 'checkbox') {
                        if (el.checked) {
                            formData.append(el.name, el.value);
                        }
                    } else if (el.tagName === 'SELECT' && el.multiple) {
                        Array.from(el.options).forEach(function(opt) {
                            if (opt.selected) formData.append(el.name, opt.value);
                        });
                    } else {
                        formData.append(el.name, el.value);
                    }
                });

                const url = $(formElement).attr('action');
                
                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw new Error(err.message || err.error || 'Gagal menyimpan data utama.'); });
                    }
                    return response.json();
                })
                .then(async result => {
                    const calibrationId = '{{ $calibration->id }}';
                    const subforms = [];
                    $subformWrappers.each(function() {
                        subforms.push({
                            type: $(this).data('form-type'),
                            wrapper: this
                        });
                    });

                    for (const sub of subforms) {
                        const subFormData = new FormData();
                        $(sub.wrapper).find('input, select, textarea').each(function() {
                            if (this.name) {
                                // 🔥 SKIP hidden _method dan _token dari template subform
                                if (this.name === '_method' || this.name === '_token') {
                                    console.log('⏭️ Skipping field:', this.name, '=', this.value, 'dari', sub.type);
                                    return;
                                }
                                
                                if (this.type === 'checkbox' || this.type === 'radio') {
                                    if (this.checked) {
                                        subFormData.append(this.name, this.value);
                                    }
                                } else if (this.type === 'file') {
                                    if (this.files && this.files.length > 0) {
                                        for (let i = 0; i < this.files.length; i++) {
                                            subFormData.append(this.name, this.files[i]);
                                        }
                                    }
                                } else {
                                    subFormData.append(this.name, this.value);
                                }
                            }
                        });


                        subFormData.append('calibration_id', calibrationId);
                        subFormData.append('form_type', sub.type);
                        
                        const subResponse = await fetch('/calibrations/' + calibrationId + '/save-subform', {
                            method: 'POST',
                            body: subFormData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        if (!subResponse.ok) {
                            const subError = await subResponse.json();
                            throw new Error(`Gagal menyimpan form tambahan ${sub.type}: ` + (subError.error || subError.message || 'Unknown error'));
                        }
                    }

                    // Hapus draf edit karena data sudah tersimpan permanen ke database
                    if (typeof EDIT_DRAFT_KEY !== 'undefined') {
                        localStorage.removeItem(EDIT_DRAFT_KEY);
                    }
                    isFormDirty = false;
                    isSubmitting = true;

                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Perubahan berhasil disimpan.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '{{ route("calibrations.show", $calibration->id) }}';
                    });
                })
                .catch(error => {
                    Swal.close();
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan',
                        text: error.message
                    });
                });
            });

            // Auto-hapus error class saat user mulai mengetik
            $('input, select, textarea').on('input change', function() {
                if ($(this).val() !== '') {
                    $(this).removeClass('is-invalid');
                }
            });

            // ================================================================
            // 💾 DRAFT AUTO-SAVE, RESTORE & UNSAVED WARNING UNTUK MODE EDIT
            // ================================================================
            const EDIT_DRAFT_USER_ID = parseInt("{{ auth()->user()->id ?? 0 }}", 10);
            const EDIT_DRAFT_CALIBRATION_ID = parseInt("{{ $calibration->id }}", 10);
            const EDIT_DRAFT_KEY = 'calibration_edit_draft_' + EDIT_DRAFT_USER_ID + '_' + EDIT_DRAFT_CALIBRATION_ID;

            let isFormDirty = false;
            let isSubmitting = false;
            let editSaveTimeout = null;
            window.isRestoringEditDraft = false;

            // Indikator kecil saat tersimpan otomatis
            function showEditDraftIndicator() {
                let indicator = document.getElementById('edit-draft-indicator');
                if (!indicator) {
                    indicator = document.createElement('div');
                    indicator.id = 'edit-draft-indicator';
                    indicator.style.cssText = 'position:fixed;bottom:15px;right:15px;background:rgba(13,110,253,0.92);color:#fff;padding:6px 14px;border-radius:20px;font-size:12px;font-weight:500;z-index:99999;box-shadow:0 4px 12px rgba(0,0,0,0.15);transition:opacity 0.4s ease;pointer-events:none;display:flex;align-items:center;gap:6px;';
                    document.body.appendChild(indicator);
                }
                const now = new Date();
                const timeStr = String(now.getHours()).padStart(2, '0') + ':' +
                                String(now.getMinutes()).padStart(2, '0') + ':' +
                                String(now.getSeconds()).padStart(2, '0');
                indicator.innerHTML = '<i class="fas fa-save"></i> Draf edit tersimpan otomatis (' + timeStr + ')';
                indicator.style.opacity = '1';
                setTimeout(() => { if (indicator) indicator.style.opacity = '0'; }, 2500);
            }

            // Fungsi simpan draft ke localStorage
            function saveEditDraft() {
                if (isSubmitting || window.isRestoringEditDraft) return;

                const $form = $('#calibrationForm');
                if ($form.length === 0) return;

                const draft = {
                    calibrationId: EDIT_DRAFT_CALIBRATION_ID,
                    userId: EDIT_DRAFT_USER_ID,
                    savedAt: Date.now(),
                    subforms: [],
                    inputs: {}
                };

                // Catat subform yang aktif
                $('.subform-checkbox:checked').each(function() {
                    draft.subforms.push($(this).val());
                });

                // Catat semua nilai input
                $form.find('input, select, textarea').each(function() {
                    const el = this;
                    if (!el.name || el.name === '_token' || el.name === '_method' || el.type === 'file' || el.type === 'password' || el.type === 'submit' || el.type === 'button') return;

                    const $subWrapper = $(el).closest('.subform-wrapper');
                    const subType = $subWrapper.length ? $subWrapper.data('form-type') : null;
                    const key = subType ? `subform_${subType}_${el.name}` : `main_${el.name}`;

                    if (el.type === 'checkbox' || el.type === 'radio') {
                        if (el.checked) {
                            if (!draft.inputs[key]) draft.inputs[key] = [];
                            if (!draft.inputs[key].includes(el.value)) draft.inputs[key].push(el.value);
                        }
                    } else if (el.tagName === 'SELECT' && el.multiple) {
                        draft.inputs[key] = Array.from(el.selectedOptions).map(o => o.value);
                    } else {
                        draft.inputs[key] = el.value;
                    }
                });

                try {
                    localStorage.setItem(EDIT_DRAFT_KEY, JSON.stringify(draft));
                    showEditDraftIndicator();
                } catch (e) {
                    console.warn('Gagal menyimpan draf edit ke localStorage:', e);
                }
            }

            function triggerDebouncedEditSave() {
                if (isSubmitting || window.isRestoringEditDraft) return;
                isFormDirty = true;
                clearTimeout(editSaveTimeout);
                editSaveTimeout = setTimeout(saveEditDraft, 600);
            }

            // Event listener saat user mengetik atau mengubah field
            $('#calibrationForm').on('input', 'input, textarea', triggerDebouncedEditSave);
            $('#calibrationForm').on('change', 'input, select, textarea', triggerDebouncedEditSave);
            $(document).on('change', '.subform-checkbox', triggerDebouncedEditSave);

            // ────────────────────────────────────────────────────────────────
            // FUNGSI RESTORE DRAFT
            // ────────────────────────────────────────────────────────────────
            async function restoreEditDraft(draft) {
                window.isRestoringEditDraft = true;

                Swal.fire({
                    title: 'Memulihkan Perubahan...',
                    html: '<small class="text-muted">Mengisi kembali perubahan data yang belum tersimpan...</small>',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                try {
                    // 1. Restore subforms jika ada yang ditambah di draft
                    if (draft.subforms && draft.subforms.length > 0) {
                        for (const subType of draft.subforms) {
                            const $chk = $(`#chk_subform_${subType}`);
                            if ($chk.length && !$chk.is(':checked')) {
                                $chk.prop('checked', true);
                                if (typeof loadSubform === 'function') {
                                    loadSubform(subType);
                                }
                            }
                        }
                        await new Promise(r => setTimeout(r, 800));
                    }

                    // 2. Terapkan nilai input (Pass 1)
                    applyDraftInputs(draft.inputs);

                    // Pass 2 setelah 400ms untuk field kalkulasi / cascade
                    await new Promise(r => setTimeout(r, 400));
                    applyDraftInputs(draft.inputs);

                    isFormDirty = true;
                    Swal.close();

                    Swal.fire({
                        icon: 'success',
                        title: 'Draf Berhasil Dipulihkan!',
                        text: 'Semua perubahan data sebelum keluar telah dimuat kembali.',
                        timer: 2000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } catch (err) {
                    console.error('Error saat memulihkan draf edit:', err);
                    Swal.close();
                } finally {
                    window.isRestoringEditDraft = false;
                }
            }

            function applyDraftInputs(savedInputs) {
                if (!savedInputs) return;
                const $form = $('#calibrationForm');

                $form.find('input, select, textarea').each(function() {
                    const el = this;
                    if (!el.name || el.name === '_token' || el.name === '_method' || el.type === 'file' || el.type === 'password' || el.type === 'submit' || el.type === 'button') return;

                    const $subWrapper = $(el).closest('.subform-wrapper');
                    const subType = $subWrapper.length ? $subWrapper.data('form-type') : null;
                    const key = subType ? `subform_${subType}_${el.name}` : `main_${el.name}`;

                    if (savedInputs[key] !== undefined) {
                        const savedVal = savedInputs[key];

                        if (el.type === 'checkbox' || el.type === 'radio') {
                            const wasChecked = el.checked;
                            if (Array.isArray(savedVal)) {
                                el.checked = savedVal.includes(el.value);
                            } else {
                                el.checked = (savedVal === el.value || savedVal === true);
                            }
                            if (el.checked !== wasChecked) {
                                $(el).trigger('change');
                            }
                        } else if (el.tagName === 'SELECT' && el.multiple && Array.isArray(savedVal)) {
                            $(el).val(savedVal).trigger('change');
                        } else {
                            if (el.value !== savedVal) {
                                el.value = savedVal;
                                $(el).trigger('input').trigger('change');
                            }
                        }
                    }
                });
            }

            // ────────────────────────────────────────────────────────────────
            // CEK DRAFT SAAT HALAMAN SELESAI DIMUAT (STARTUP)
            // ────────────────────────────────────────────────────────────────
            setTimeout(() => {
                const draftStr = localStorage.getItem(EDIT_DRAFT_KEY);
                if (!draftStr) return;

                let draft = null;
                try {
                    draft = JSON.parse(draftStr);
                } catch (e) {
                    localStorage.removeItem(EDIT_DRAFT_KEY);
                    return;
                }

                if (!draft || !draft.inputs || Object.keys(draft.inputs).length === 0) return;

                const savedDate = draft.savedAt ? new Date(draft.savedAt).toLocaleString('id-ID') : 'Sesi sebelumnya';

                Swal.fire({
                    icon: 'question',
                    title: 'Pulihkan Perubahan Edit?',
                    html: `Ditemukan draf perubahan yang belum sempat disimpan pada kalibrasi ini.<br>
                           <small class="text-muted"><i class="fas fa-clock mr-1"></i> Terakhir disimpan: <b>${savedDate}</b></small><br><br>
                           Apakah Anda ingin memulihkan perubahan data tersebut?`,
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-history mr-1"></i> Ya, Pulihkan',
                    cancelButtonText: '<i class="fas fa-trash mr-1"></i> Tidak, Gunakan Data Asli',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        await restoreEditDraft(draft);
                    } else {
                        localStorage.removeItem(EDIT_DRAFT_KEY);
                        isFormDirty = false;
                        Swal.fire({
                            icon: 'info',
                            title: 'Draf Dihapus',
                            text: 'Form kembali menggunakan data asli dari database.',
                            timer: 1500,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end',
                        });
                    }
                });
            }, 400);

            // ────────────────────────────────────────────────────────────────
            // PROTEKSI: WARNING JIKA MENINGGALKAN HALAMAN KETIKA ADA PERUBAHAN
            // ────────────────────────────────────────────────────────────────
            // 1. Browser Native Warning (reload / close tab / back browser)
            window.addEventListener('beforeunload', function(e) {
                if (isFormDirty && !isSubmitting) {
                    e.preventDefault();
                    e.returnValue = 'Perubahan data belum disimpan. Yakin ingin meninggalkan halaman?';
                    return e.returnValue;
                }
            });

            // 2. SweetAlert Warning jika user klik link / menu / sidebar / tombol Batal
            $(document).on('click', 'a:not([target="_blank"]):not([href^="#"]):not([href^="javascript:"])', function(e) {
                if (isFormDirty && !isSubmitting && localStorage.getItem(EDIT_DRAFT_KEY)) {
                    e.preventDefault();
                    const targetUrl = $(this).attr('href');
                    if (!targetUrl) return;

                    Swal.fire({
                        icon: 'warning',
                        title: 'Tinggalkan Halaman Edit?',
                        html: 'Ada perubahan data kalibrasi yang belum Anda simpan.<br><small class="text-muted">Draf Anda tetap tersimpan otomatis dan bisa dipulihkan kembali saat membuka halaman ini.</small>',
                        showCancelButton: true,
                        showDenyButton: true,
                        confirmButtonColor: '#0d6efd',
                        denyButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="fas fa-save mr-1"></i> Simpan Draf & Keluar',
                        denyButtonText: '<i class="fas fa-trash mr-1"></i> Buang Draf & Keluar',
                        cancelButtonText: 'Tetap di Halaman Ini'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Biarkan draf di localStorage, user bisa restore nanti
                            isSubmitting = true;
                            window.location.href = targetUrl;
                        } else if (result.isDenied) {
                            // Hapus draf dan keluar
                            localStorage.removeItem(EDIT_DRAFT_KEY);
                            isFormDirty = false;
                            isSubmitting = true;
                            window.location.href = targetUrl;
                        }
                    });
                }
            });
        } // end if (isEditMode)
    }); // end $(document).ready

    // =====================================================
    // NAVIGASI SEPERTI EXCEL: TAB = ke Bawah (bukan kanan)
    // ENTER   = ke Bawah (kolom yang sama)
    // SHIFT+TAB = ke Atas
    // =====================================================
    document.addEventListener('keydown', function(e) {
        if (e.key !== 'Tab' && e.key !== 'Enter') return;

        var activeEl = document.activeElement;
        if (!activeEl) return;

        var currentTd = activeEl.closest('td');
        var currentTr = activeEl.closest('tr');
        if (!currentTd || !currentTr) return;

        if (activeEl.tagName !== 'INPUT' && activeEl.tagName !== 'SELECT') return;
        if (activeEl.type === 'hidden' || activeEl.type === 'button' ||
            activeEl.type === 'submit' || activeEl.type === 'checkbox') return;

        var goUp = (e.key === 'Tab' && e.shiftKey);
        var targetTr = goUp ? currentTr.previousElementSibling : currentTr.nextElementSibling;

        if (!targetTr) return;
        if (targetTr.closest('thead')) return;

        var currentRect = currentTd.getBoundingClientRect();
        var currentCenterX = currentRect.left + currentRect.width / 2;

        var bestInput = null;
        var bestDistance = Infinity;

        Array.from(targetTr.cells).forEach(function(cell) {
            var inputs = cell.querySelectorAll('input:not([type="hidden"]):not([disabled]), select:not([disabled])');
            inputs.forEach(function(inp) {
                if (inp.readOnly) return;
                var cellRect = cell.getBoundingClientRect();
                var cellCenterX = cellRect.left + cellRect.width / 2;
                var dist = Math.abs(cellCenterX - currentCenterX);
                if (dist < bestDistance) {
                    bestDistance = dist;
                    bestInput = inp;
                }
            });
        });

        if (bestInput && bestDistance < 200) {
            e.preventDefault();
            bestInput.focus();
            if (bestInput.tagName === 'INPUT') {
                bestInput.select();
            }
        }
    });
</script>
@endpush