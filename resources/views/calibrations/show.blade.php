@extends('layouts.app')

@section('title', 'Detail Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION')

@section('content')
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
        
        @if($mode == 'view')
            <a href="{{ route('calibrations.show', $calibration->id) }}?mode=edit" 
               class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
        @endif
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
                    <form id="calibrationForm" action="{{ route('calibrations.update', $calibration->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="{{ $formType }}">
                        
                        <!-- Include Form HTML berdasarkan jenis alat -->
                        @if($formType == 'inside_micrometer')
                            @include('formhtml.inside_micrometer_edit', ['calibration' => $calibration])
                        @elseif($formType == 'outside_micrometer')
                            @include('formhtml.outside_micrometer_edit', ['calibration' => $calibration])
                        @elseif($formType == 'depth_micrometer')
                            @include('formhtml.depth_micrometer_edit', ['calibration' => $calibration])
                        @elseif($formType == 'ir_thermometer')
                            @include('formhtml.ir_thermometer_edit', ['calibration' => $calibration])
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
                        @elseif($formType == 'conductivity meter')
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
                        @elseif($formType == 'temp_transmitter')
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
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                Form edit untuk alat jenis "{{ $calibration->namaAlat }}" belum tersedia.
                            </div>
                        @endif
                       
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
                        @include('formhtml.gauge_block_view', ['calibration' => $calibration])
                    @elseif($formType == 'holetest')
                        @include('formhtml.holetest_view', ['calibration' => $calibration])    
                    @elseif($formType == 'conductivity meter')
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
                    @elseif($formType == 'temp_transmitter')
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
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            Form untuk alat jenis "{{ $calibration->namaAlat }}" belum tersedia.
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@if($mode == 'edit')
    @section('scripts')
    <script>
        $(document).ready(function() {
            // Validasi form
            $('#calibrationForm').on('submit', function(e) {
                // Anda bisa menambahkan validasi client-side di sini
                // Misalnya, memastikan semua required field terisi
                
                var isValid = true;
                $('input[required], select[required], textarea[required]').each(function() {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Harap lengkapi semua field yang wajib diisi.');
                }
            });
            
            // Auto-hapus error class saat user mulai mengetik
            $('input, select, textarea').on('input change', function() {
                if ($(this).val() !== '') {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
    @endsection
@endif