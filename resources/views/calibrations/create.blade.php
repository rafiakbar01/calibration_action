@extends('layouts.app')

@section('title', 'Pilih Form Kalibrasi')

{{-- LOG UNTUK SCAN QR Code DAN FILL FORM --}}
@php
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

// Log ketika halaman diakses
Log::info('==========================================');
Log::info('📄 HALAMAN: Pilih Form Kalibrasi');
Log::info('👤 User: ' . (auth()->user()->name ?? 'Guest'));
Log::info('📧 Email: ' . (auth()->user()->email ?? '-'));
Log::info('🌐 IP: ' . request()->ip());
Log::info('🕐 Waktu: ' . now());
Log::info('==========================================');

// Log jika ada data scan dari session
if(session()->has('scan_data')) {
Log::info('✅ SCAN BARCODE BERHASIL');
Log::info('📦 ID Alat: ' . ($scanData['id_alat'] ?? '-'));
Log::info('📦 Nama Alat: ' . ($scanData['namaAlat'] ?? '-'));
Log::info('🔢 No Seri: ' . ($scanData['NoSeri'] ?? '-'));
Log::info('🏷️ Merek: ' . ($scanData['brandAlat'] ?? '-'));
Log::info('📝 Tipe: ' . ($scanData['typeAlat'] ?? '-'));
Log::info('📏 Rentang Ukur: ' . ($scanData['rangeMin'] ?? '0') . ' - ' . ($scanData['rangeMax'] ?? '0'));
Log::info('📊 Kapasitas: ' . ($scanData['capacity'] ?? '-'));
Log::info('🔍 Resolusi: ' . ($scanData['resolusi'] ?? '-'));
Log::info('👤 Pemilik: ' . ($scanData['pemilikAlat'] ?? '-'));
Log::info('📍 Lokasi PT: ' . ($scanData['lokasiPT'] ?? '-'));
Log::info('🏢 Tempat Kalibrasi: ' . ($scanData['tempatKalibrasi'] ?? '-'));
Log::info('📋 Jenis Pembacaan: ' . ($scanData['jenisPembacaan'] ?? '-'));
Log::info('⚙️ Kondisi Alat: ' . ($scanData['kondisiAlat'] ?? '-'));
Log::info('📄 LK: ' . (is_array($scanData['LK']) ? implode(', ', $scanData['LK']) : ($scanData['LK'] ?? '-')));
Log::info('📅 Tanggal Masuk: ' . ($scanData['tanggalMasuk'] ?? '-'));
Log::info('📅 Tanggal Kalibrasi: ' . ($scanData['tanggalKalibrasi'] ?? '-'));
Log::info('🌡️ Suhu Awal: ' . ($scanData['RT_condition1'] ?? '-'));
Log::info('🌡️ Suhu Tengah: ' . ($scanData['RT_condition2'] ?? '-'));
Log::info('🌡️ Suhu Akhir: ' . ($scanData['RT_condition3'] ?? '-'));
Log::info('💧 RH Awal: ' . ($scanData['RH_condition1'] ?? '-'));
Log::info('💧 RH Tengah: ' . ($scanData['RH_condition2'] ?? '-'));
Log::info('💧 RH Akhir: ' . ($scanData['RH_condition3'] ?? '-'));
Log::info('📝 Keterangan: ' . ($scanData['keterangan'] ?? '-'));
Log::info('📊 Capacity (dropdown): ' . ($scanData['capacity'] ?? '-'));
Log::info('==========================================');
}

// Log jika scan gagal
if(session()->has('scan_error')) {
Log::warning('❌ SCAN BARCODE GAGAL');
Log::warning('🔍 ID: ' . session('scan_id', '-'));
Log::warning('⚠️ Pesan: ' . session('scan_error'));
Log::warning('==========================================');
}

// Log ketika form diisi otomatis
if(session()->has('form_filled')) {
$formData = session('form_filled');
Log::info('🔄 AUTOFILL FORM KALIBRASI');
Log::info('📋 Tipe Form: ' . ($formData['form_type'] ?? '-'));
Log::info('📦 Nama Alat: ' . ($formData['namaAlat'] ?? '-'));
Log::info('🔢 No Seri: ' . ($formData['NoSeri'] ?? '-'));
Log::info('✅ Status: Berhasil diisi otomatis');
Log::info('📊 Jumlah Field: ' . ($formData['filled_count'] ?? '0'));
Log::info('📄 LK: ' . (is_array($formData['LK']) ? implode(', ', $formData['LK']) : ($formData['LK'] ?? '-')));
Log::info('==========================================');
}

// Log ketika user memilih form manual
if(request()->has('form_selected')) {
Log::info('📋 FORM DIPILIH MANUAL');
Log::info('🎯 Tipe: ' . request()->form_type);
Log::info('📝 Nama: ' . request()->form_name);
Log::info('👤 User: ' . (auth()->user()->name ?? 'Guest'));
Log::info('==========================================');
}

// Log ketika search alat
if(request()->has('search')) {
Log::info('🔍 PENCARIAN ALAT');
Log::info('📌 Keyword: ' . request()->keyword);
Log::info('📊 Hasil: ' . request()->result_count . ' ditemukan');
Log::info('👤 User: ' . (auth()->user()->name ?? 'Guest'));
Log::info('==========================================');
}

// Log detail mapping field (untuk debug)
if(session()->has('field_mapping')) {
$mapping = session('field_mapping');
Log::info('🔍 DETAIL MAPPING FIELD');
foreach($mapping as $field => $value) {
if($value) {
Log::info('✅ ' . $field . ': ' . (is_array($value) ? implode(', ', $value) : $value));
} else {
Log::warning('⚠️ ' . $field . ': KOSONG');
}
}
Log::info('==========================================');
}
@endphp

@php
use App\Helpers\LogHelper;

// Log akses halaman
LogHelper::logPageAccess('Pilih Form Kalibrasi', [
'session_has_scan' => session()->has('scan_data'),
'session_has_error' => session()->has('scan_error'),
]);

// Log jika ada data scan dari session
if (session()->has('scan_data')) {
$scanData = session('scan_data');
LogHelper::logScanResult($scanData, 'session');
LogHelper::logAutoFillForm(
'session',
$scanData['form_type'] ?? '-',
$scanData['namaAlat'] ?? '-',
['filled_count' => 1, 'LK' => $scanData['LK'] ?? []],
'success'
);
}

// Log jika scan gagal
if (session()->has('scan_error')) {
LogHelper::logScanQR(
session('scan_id', '-'),
'session',
'failed',
session('scan_error')
);
}

// Log jika user memilih form manual
if (request()->has('form_selected')) {
LogHelper::logSelectForm(
request()->form_type,
request()->form_name,
request()->tab_id ?? null
);
}

// Log jika search alat
if (request()->has('search')) {
LogHelper::logSearchAlat(
request()->keyword,
request()->result_count ?? 0
);
}
@endphp

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">

                <div class="card-body p-3 p-md-4">

                    <!-- Include CSS Select2 -->
                    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
                    <!-- Include FontAwesome for icons -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                    <!-- Include HTML5-QRCode Library -->
                    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
                    <!-- Include SweetAlert2 -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <!-- Search Box dan Select -->
                    <div class="row mb-3 mb-md-4">
                        <div class="col-md-5 mb-3 mb-md-0">
                            <label class="form-label fw-bold">Lingkup Kalibrasi</label>
                            <select id="lingkupSelect" class="form-select select2">
                                <option value="all">-- Semua Lingkup --</option>
                                <option value="ulm">ULM</option>
                                <option value="dimensi">Dimensi</option>
                                <option value="suhu">Suhu & Kelembaban</option>
                                <option value="massa">Massa</option>
                                <option value="gaya">Gaya & Torsi</option>
                                <option value="volumetrik">Volumetrik</option>
                                <option value="listrik">Listrik</option>
                                <option value="waktu">Waktu & Frekuensi</option>
                                <option value="uji">Uji Material</option>
                            </select>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Jenis Alat Ukur</label>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary py-0" id="searchBtn">
                                        <i class="fas fa-search mr-1"></i> Cari Alat
                                    </button>
                                </div>
                            </div>
                            <select id="formSelect" class="form-select select2">
                                <option value="">-- Pilih Form --</option>

                                <option value="inside_micrometer" data-lingkup="dimensi">Inside Micrometer</option>
                                <option value="outside_micrometer" data-lingkup="dimensi">Outside Micrometer</option>
                                <option value="depth_micrometer" data-lingkup="dimensi">Depth Micrometer</option>
                                <option value="dial_indicator" data-lingkup="dimensi">Dial Indicator</option>
                                <option value="dial_test_indicator" data-lingkup="dimensi">Dial Test Indicator</option>
                                <option value="depth_caliper" data-lingkup="dimensi">Depth Caliper</option>
                                <option value="caliper" data-lingkup="dimensi">Caliper</option>
                                <option value="thickness_gauge" data-lingkup="dimensi">Thickness Gauge</option>
                                <option value="penggaris" data-lingkup="dimensi">Penggaris</option>
                                <option value="gauge_block" data-lingkup="ulm">Gauge Block</option>
                                <option value="holetest" data-lingkup="dimensi">Holetest</option>
                                <option value="coating_thickness" data-lingkup="dimensi">Coating Thickness</option>
                                <option value="plastic_shim" data-lingkup="ulm">Plastic Shim</option>
                                <option value="plain_limit_gauge" data-lingkup="ulm">Plain Limit Gauge</option>
                                <option value="surface_roughness_tester" data-lingkup="dimensi">Surface Roughness Tester</option>
                                <option value="feeler_gauge" data-lingkup="dimensi">Feeler Gauge</option>
                                <option value="surface_plate" data-lingkup="dimensi">Surface Plate</option>
                                <option value="taper_gauge" data-lingkup="dimensi">Taper Gauge</option>
                                <option value="bore_gauge" data-lingkup="dimensi">Bore Gauge</option>
                                <option value="pin_gauge" data-lingkup="dimensi">Pin Gauge</option>
                                <option value="profil_projector" data-lingkup="dimensi">Profil Projector / Microscope</option>
                                <option value="thread_gauge" data-lingkup="ulm">Thread Gauge</option>
                                <option value="ultrasonic_thickness_gauge" data-lingkup="dimensi">Ultrasonic Thickness Gauge</option>
                                <option value="height_gauge" data-lingkup="dimensi">Height Gauge</option>

                                <option value="thermometer" data-lingkup="suhu">Thermometer</option>
                                <option value="enclosure" data-lingkup="suhu">Enclosure</option>
                                <option value="chamber" data-lingkup="suhu">Chamber</option>
                                <option value="thermohygrometer" data-lingkup="suhu">Thermohygrometer</option>
                                <option value="temp_humid_transmitter" data-lingkup="suhu">Temperature Humidity Transmitter</option>
                                <option value="thermometer_infrared" data-lingkup="suhu">Thermometer Infrared</option>
                                <option value="thermoindicator" data-lingkup="suhu">Thermoindicator</option>
                                <option value="temperature_transmitter" data-lingkup="suhu">Temperature Transmitter</option>

                                <option value="timbangan" data-lingkup="massa">Timbangan</option>
                                <option value="timbangan_bias" data-lingkup="massa">Timbangan Bias</option>
                                <option value="anak_timbangan" data-lingkup="massa">Anak Timbangan</option>

                                <option value="torque_wrench" data-lingkup="gaya">Torque Wrench-Driver</option>
                                <option value="torque_meter" data-lingkup="gaya">Torque Tester-Meter</option>
                                <option value="push_pull" data-lingkup="massa">Push Pull</option>
                                <option value="utm" data-lingkup="gaya">Mesin Uji Tarik & Tekan</option>

                                <option value="pressure_gauge" data-lingkup="gaya">Pressure Gauge</option>
                                <option value="differential_pressure_gauge" data-lingkup="gaya">Differential Pressure Gauge</option>
                                <option value="pressure_transmitter" data-lingkup="gaya">Pressure Transmitter / Diff Pressure Transmitter</option>

                                <option value="volumetrik" data-lingkup="volumetrik">Volumetrik</option>
                                <option value="mikropipet_dispenset" data-lingkup="volumetrik">Mikropipet Dispenset</option>
                                <option value="visco_cup" data-lingkup="gaya">Visco Cup</option>

                                <option value="viscometer" data-lingkup="gaya">Viscometer</option>
                                <option value="conductivity_meter" data-lingkup="gaya">Conductivity Meter</option>
                                <option value="ph_meter" data-lingkup="gaya">PH Meter</option>

                                <option value="durometer" data-lingkup="massa">Durometer</option>

                                <option value="insulation" data-lingkup="listrik">Kelistrikan</option>

                                <option value="stopwatch" data-lingkup="waktu">Stopwatch</option>
                                <option value="tachometer" data-lingkup="waktu">Tachometer</option>
                                <option value="centrifuge" data-lingkup="waktu">Centrifuge</option>

                                <option value="abration_tester" data-lingkup="uji">Abration Tester</option>
                            </select>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            setTimeout(() => {
                                const lingkupSelect = $('#lingkupSelect');
                                const formSelect = $('#formSelect');

                                // Simpan semua options asli
                                const allOptions = formSelect.find('option').clone();

                                lingkupSelect.on('change', function() {
                                    const selectedLingkup = $(this).val();
                                    const currentValue = formSelect.val();

                                    // Bersihkan formSelect
                                    formSelect.empty();

                                    // Kembalikan option default
                                    formSelect.append(allOptions.filter('[value=""]').clone());

                                    if (selectedLingkup === 'all') {
                                        formSelect.append(allOptions.filter(':not([value=""])').clone());
                                    } else {
                                        formSelect.append(allOptions.filter(`[data-lingkup="${selectedLingkup}"]`).clone());
                                    }

                                    // Update select2
                                    formSelect.trigger('change.select2');

                                    // Set value back if exists in filtered options
                                    if (currentValue && formSelect.find(`option[value="${currentValue}"]`).length) {
                                        formSelect.val(currentValue).trigger('change.select2');
                                    }
                                });
                            }, 500); // Tunggu sampai DOM dan JS jQuery siap
                        });
                    </script>

                    <!-- Modal untuk Search -->
                    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="searchModalLabel">
                                        <i class="fas fa-search mr-2"></i>Cari Alat Ukur
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Search Input -->
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="Ketik nama alat ukur...">
                                    </div>

                                    <!-- Search Results -->
                                    <div id="searchResults" class="row g-3" style="max-height: 400px; overflow-y: auto;">
                                        <!-- Hasil pencarian akan muncul di sini -->
                                        <div class="col-12">
                                            <div class="alert alert-info mb-0">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                Ketik kata kunci untuk mencari alat ukur
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sub Options Container -->
                    <div id="subOptionsContainer">
                        <!-- Sub Option: Hanya muncul jika Inside Micrometer dipilih -->
                        <div id="insideMicrometerCapacityWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="insideMicrometerCapacitySelect" class="form-label fw-bold">Kapasitas Inside Micrometer (mm)</label>
                            <select id="insideMicrometerCapacitySelect" class="form-select select2">
                                <option value="">-- Pilih Kapasitas --</option>
                                <option value="0">0 mm</option>
                                <option value="25">25 mm</option>
                                <option value="50">50 mm</option>
                                <option value="75">75 mm</option>
                                <option value="100">100 mm</option>
                                <option value="125">125 mm</option>
                                <option value="150">150 mm</option>
                                <option value="175">175 mm</option>
                                <option value="200">200 mm</option>
                                <option value="225">225 mm</option>
                                <option value="250">250 mm</option>
                                <option value="275">275 mm</option>
                                <option value="300">300 mm</option>
                                <option value="325">325 mm</option>
                                <option value="350">350 mm</option>
                                <option value="375">375 mm</option>
                                <option value="400">400 mm</option>
                                <option value="425">425 mm</option>
                                <option value="450">450 mm</option>
                                <option value="475">475 mm</option>
                                <option value="500">500 mm</option>
                            </select>
                        </div>

                        <!-- Sub Option: Jumlah Form Inside Micrometer -->
                        <div id="insideMicrometerCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="insideMicrometerCountSelect" class="form-label fw-bold">Jumlah Form Inside Micrometer</label>
                            <input type="number" id="insideMicrometerCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Jumlah Form Thermometer -->
                        <div id="thermometerCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="thermometerCountSelect" class="form-label fw-bold">Jumlah Form Thermometer</label>
                            <input type="number" id="thermometerCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Jumlah Form UTM -->
                        <div id="utmCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="utmCountSelect" class="form-label fw-bold">Jumlah Form UTM</label>
                            <input type="number" id="utmCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>


                        <!-- Sub Option: Jumlah Form Anak Timbangan -->
                        <div id="anakTimbanganCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="anakTimbanganCountSelect" class="form-label fw-bold">Jumlah Form Anak Timbangan</label>
                            <input type="number" id="anakTimbanganCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>


                        <!-- Sub Option: Jumlah Form Feeler Gauge -->
                        <div id="feelerGaugeCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="feelerGaugeCountSelect" class="form-label fw-bold">Jumlah Form Feeler Gauge</label>
                            <input type="number" id="feelerGaugeCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>


                        <!-- Sub Option: Jumlah Form Gauge Block -->
                        <!--<div id="gaugeBlockCountWrapper" class="mb-3 mb-md-4" style="display: none;">-->
                        <!--    <label for="gaugeBlockCountSelect" class="form-label fw-bold">Jumlah Form Gauge Block</label>-->
                        <!--    <input type="number" id="gaugeBlockCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">-->
                        <!--</div>-->

                        <!-- Sub Option: Jumlah Form Centrifuge -->
                        <div id="centrifugeCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="centrifugeCountSelect" class="form-label fw-bold">Jumlah Form Centrifuge</label>
                            <input type="number" id="centrifugeCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Jumlah Form Mikropipet Dispenset -->
                        <div id="mikropipetDispensetCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="mikropipetDispensetCountSelect" class="form-label fw-bold">Jumlah Form Mikropipet Dispenset</label>
                            <input type="number" id="mikropipetDispensetCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Jumlah Form Conductivity Meter -->
                        <div id="conductivityMeterCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="conductivityMeterCountSelect" class="form-label fw-bold">Jumlah Form Conductivity Meter</label>
                            <input type="number" id="conductivityMeterCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Jumlah Form Thermoindicator -->
                        <div id="thermoIndicatorCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="thermoIndicatorCountSelect" class="form-label fw-bold">Jumlah Form Thermo Indicator</label>
                            <input type="number" id="thermoIndicatorCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Hanya muncul jika Outside Micrometer dipilih -->
                        <div id="outsideMicrometerCapacityWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="outsideMicrometerCapacitySelect" class="form-label fw-bold">Kapasitas Outside Micrometer (mm)</label>
                            <select id="outsideMicrometerCapacitySelect" class="form-select select2">
                                <option value="">-- Pilih Kapasitas --</option>
                                <option value="0">0 mm</option>
                                <option value="25">25 mm</option>
                                <option value="50">50 mm</option>
                                <option value="75">75 mm</option>
                                <option value="100">100 mm</option>
                                <option value="125">125 mm</option>
                                <option value="150">150 mm</option>
                                <option value="175">175 mm</option>
                                <option value="200">200 mm</option>
                                <option value="225">225 mm</option>
                                <option value="250">250 mm</option>
                                <option value="275">275 mm</option>
                                <option value="300">300 mm</option>
                                <option value="325">325 mm</option>
                                <option value="350">350 mm</option>
                                <option value="375">375 mm</option>
                                <option value="400">400 mm</option>
                                <option value="425">425 mm</option>
                                <option value="450">450 mm</option>
                                <option value="475">475 mm</option>
                                <option value="500">500 mm</option>
                            </select>
                        </div>

                        <!-- Sub Option: Jumlah Form Outside Micrometer -->
                        <div id="outsideMicrometerCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="outsideMicrometerCountSelect" class="form-label fw-bold">Jumlah Form Outside Micrometer</label>
                            <input type="number" id="outsideMicrometerCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Jumlah Form Pin Gauge -->
                        <div id="pinGaugeCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="pinGaugeCountSelect" class="form-label fw-bold">Jumlah Form Pin Gauge</label>
                            <input type="number" id="pinGaugeCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Jumlah Form Ultrasonic Thickness Gauge -->
                        <div id="ultrasonicThicknessGaugeCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="ultrasonicThicknessGaugeCountSelect" class="form-label fw-bold">Jumlah Form Ultrasonic Thickness Gauge</label>
                            <input type="number" id="ultrasonicThicknessGaugeCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>


                        <!-- Sub Option: Hanya muncul jika depth Micrometer dipilih -->
                        <div id="depthMicrometerCapacityWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="depthMicrometerCapacitySelect" class="form-label fw-bold">Kapasitas Depth Micrometer (mm)</label>
                            <select id="depthMicrometerCapacitySelect" class="form-select select2">
                                <option value="">-- Pilih Kapasitas --</option>
                                <option value="0">0 mm</option>
                                <option value="25">25 mm</option>
                                <option value="50">50 mm</option>
                                <option value="75">75 mm</option>
                                <option value="100">100 mm</option>
                                <option value="125">125 mm</option>
                                <option value="150">150 mm</option>
                                <option value="175">175 mm</option>
                                <option value="200">200 mm</option>
                                <option value="225">225 mm</option>
                                <option value="250">250 mm</option>
                                <option value="275">275 mm</option>
                                <option value="300">300 mm</option>
                                <option value="325">325 mm</option>
                                <option value="350">350 mm</option>
                                <option value="375">375 mm</option>
                                <option value="400">400 mm</option>
                                <option value="425">425 mm</option>
                                <option value="450">450 mm</option>
                                <option value="475">475 mm</option>
                                <option value="500">500 mm</option>
                            </select>
                        </div>

                        <!-- Sub Option: Jumlah Form Depth Micrometer -->
                        <div id="depthMicrometerCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="depthMicrometerCountSelect" class="form-label fw-bold">Jumlah Form Depth Micrometer</label>
                            <input type="number" id="depthMicrometerCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Hanya muncul jika Dial Indicator atau Dial Test Indicator dipilih -->
                        <div id="dialResolutionWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="dialresolutionSelect" class="form-label fw-bold">Resolusi Dial Indicator</label>
                            <select id="dialresolutionSelect" class="form-select select2">
                                <option value="">-- Pilih Resolusi --</option>
                                <option value="0.01">0,01 mm</option>
                                <option value="0.001">0,001 mm</option>
                            </select>
                        </div>

                        <!-- Sub Option: Jumlah Form Dial Test Indicator -->
                        <!--<div id="dialtestIndicatorCountWrapper" class="mb-3 mb-md-4" style="display: none;">-->
                        <!--    <label for="dialtestIndicatorCountSelect" class="form-label fw-bold">Jumlah Form Dial Test Indicator</label>-->
                        <!--    <input type="number" id="dialtestIndicatorCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">-->
                        <!--</div>-->

                        <!-- Sub Option: Hanya muncul jika Caliper dipilih -->
                        <div id="caliperResolutionWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="caliperresolutionSelect" class="form-label fw-bold">Kapasitas Caliper</label>
                            <select id="caliperresolutionSelect" class="form-select select2">
                                <option value="">-- Pilih Kapasitas --</option>
                                <option value="100">100 mm</option>
                                <option value="150">150 mm</option>
                                <option value="200">200 mm</option>
                                <option value="300">300 mm</option>
                                <option value="450">450 mm</option>
                                <option value="600">600 mm</option>
                                <option value="1000">1000 mm</option>
                            </select>
                        </div>

                        <!-- Sub Option: Jumlah Form Caliper -->
                        <div id="caliperCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="caliperCountSelect" class="form-label fw-bold">Jumlah Form Caliper</label>
                            <input type="number" id="caliperCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Hanya muncul jika Enclosure dipilih -->
                        <div id="enclosureRepetitionWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="enclosureRepetitionSelect" class="form-label fw-bold">Jumlah Pengulangan Pengukuran</label>
                            <select id="enclosureRepetitionSelect" class="form-select select2">
                                <option value="1">1 Kali Pengukuran</option>
                                <option value="2">2 Kali Pengukuran</option>
                                <option value="3">3 Kali Pengukuran</option>
                                <option value="4">4 Kali Pengukuran</option>
                            </select>
                        </div>

                        <!-- Sub Option: Hanya muncul jika Chamber dipilih -->
                        <div id="chamberRepetitionWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="chamberRepetitionSelect" class="form-label fw-bold">Jumlah Pengulangan Pengukuran</label>
                            <select id="chamberRepetitionSelect" class="form-select select2">
                                <option value="1">1 Kali Pengukuran</option>
                                <option value="2">2 Kali Pengukuran</option>
                                <option value="3">3 Kali Pengukuran</option>
                            </select>
                        </div>

                        <!-- Sub Option: Jumlah Form Chamber -->
                        <div id="chamberCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="chamberCountSelect" class="form-label fw-bold">Jumlah Form Chamber</label>
                            <input type="number" id="chamberCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>

                        <!-- Sub Option: Hanya muncul jika Thermohygrometer dipilih -->
                        <div id="thermohygrometerTypeWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="thermohygrometerTypeSelect" class="form-label fw-bold">Pilih Tipe</label>
                            <select id="thermohygrometerTypeSelect" class="form-select select2">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="in_out">IN Out</option>
                            </select>
                        </div>

                        <!-- Sub Option: Hanya muncul jika Timbangan dipilih -->
                        <div id="timbanganTypeWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="timbanganTypeSelect" class="form-label fw-bold">Jenis Timbangan</label>
                            <select id="timbanganTypeSelect" class="form-select select2">
                                <option value="">-- Pilih Jenis Timbangan --</option>
                                <option value="moisture">Timbangan Moisture</option>
                            </select>
                        </div>

                        <!-- Sub Option: Jumlah Form Timbangan -->
                        <div id="timbanganCountWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="timbanganCountSelect" class="form-label fw-bold">Jumlah Form Timbangan</label>
                            <input type="number" id="timbanganCountSelect" class="form-control" value="1" min="1" max="50" placeholder="Masukkan jumlah form...">
                        </div>


                        <!-- Sub Option: Hanya muncul jika Insulation dipilih -->
                        <div id="insulationTypeWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="insulationTypeSelect" class="form-label fw-bold">Pilih Tipe</label>
                            <select id="insulationTypeSelect" class="form-select select2">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="multimeter">Multimeter</option>
                                <option value="clampmeter">Clamp Meter</option>
                            </select>
                        </div>
                    </div>


                    <!-- Excel-like Sheet Tabs untuk Multiple LK dengan Nama Form -->
                    <div class="mt-4 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-bold">Lembar Kerja (LK) <span class="text-muted">(Klik + untuk tab baru, lalu pilih form)</span></label>
                            <button type="button" class="btn btn-sm btn-success" id="addLKTabBtn">
                                <i class="fas fa-plus mr-1"></i>Tambah Tab Baru
                            </button>
                        </div>

                        <!-- Tab Navigation seperti Excel -->
                        <div class="lk-tabs-container border-bottom" style="overflow-x: auto; white-space: nowrap;">
                            <ul class="nav nav-tabs flex-nowrap" id="lkTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="lk-tab-1" data-toggle="tab" data-target="#lk-pane-1" type="button" role="tab" aria-controls="lk-pane-1" aria-selected="true">
                                        <i class="fas fa-file-alt mr-1"></i><span class="tab-name">Tab 1</span>
                                        <span class="badge badge-secondary ml-1">Kosong</span>
                                        <i class="fas fa-times ml-2 text-danger" style="cursor: pointer; display: none;" onclick="event.stopPropagation(); removeTab(1)" title="Hapus Tab"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content (Form untuk setiap LK) -->
                        <div class="tab-content p-3 border border-top-0 rounded-bottom bg-light" id="lkTabContent">
                            <div class="tab-pane fade show active" id="lk-pane-1" role="tabpanel" aria-labelledby="lk-tab-1">
                                <div class="lk-form-container" data-lk-id="1" data-form-type="" data-form-name="Kosong">
                                    <div class="row fade-in">
                                        <!-- Area Pesan & Dropdown -->
                                        <div class="col-md-6 mb-3">
                                            <div class="border rounded p-4 bg-light text-center h-100 d-flex flex-column justify-content-center">
                                                <i class="fas fa-hand-pointer text-primary fa-3x mb-3"></i>
                                                <h5 class="text-primary">Pilih Manual</h5>
                                                <p class="text-muted">Pilih jenis alat ukur dari dropdown di atas untuk menampilkan form kalibrasi di tab ini.</p>
                                            </div>
                                        </div>

                                        <!-- Area Scanner & Manual Input -->
                                        <div class="col-md-6 mb-3">
                                            <div class="border rounded p-4 text-center h-100 d-flex flex-column justify-content-center align-items-center bg-white shadow-sm hover-shadow transition-all">
                                                <h5 class="text-success mb-3"><i class="fas fa-qrcode mr-2"></i>Scan / Input ID Kalibrasi</h5>
                                                <p class="text-muted small mb-3">Scan QR Code dengan kamera atau ketik ID alat langsung di bawah.</p>

                                                <div id="scanner-wrapper-1" class="w-100 mb-3" style="display:none; max-width: 280px; margin: 0 auto;">
                                                    <div style="position: relative; width: 280px; height: 280px;">
                                                        <div id="reader-1" class="qr-reader-container" style="width: 100%; height: 100%;"></div>
                                                        <canvas id="overlay-1" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;"></canvas>
                                                    </div>
                                                    <div id="scanResult-1" class="mt-3 text-center d-none alert alert-success p-2">
                                                        <div class="spinner-border spinner-border-sm text-success mr-2" role="status"></div>
                                                        <span>Mengambil data...</span>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-center gap-2 mb-3 w-100" style="max-width: 320px;">
                                                    <button type="button" class="btn btn-success btn-start-scan flex-grow-1" data-target-tab="1">
                                                        <i class="fas fa-camera mr-1"></i> Buka Kamera
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-stop-scan" data-target-tab="1" style="display:none;">
                                                        <i class="fas fa-stop-circle"></i>
                                                    </button>
                                                </div>

                                                <!-- Divider atau -->
                                                <div class="d-flex align-items-center w-100 my-2" style="max-width: 320px;">
                                                    <hr class="flex-grow-1 my-0">
                                                    <span class="px-2 text-muted small font-weight-bold">ATAU KETIK ID</span>
                                                    <hr class="flex-grow-1 my-0">
                                                </div>

                                                <!-- Form Input Manual ID / Barcode -->
                                                <div class="w-100 mt-2" style="max-width: 320px;">
                                                    <div class="input-group">
                                                        <input type="text" id="manualInput-1" class="form-control manual-id-input" placeholder="Contoh: 125 atau URL QR" autocomplete="off" data-target-tab="1">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-success btn-submit-manual" data-target-tab="1" type="button">
                                                                <i class="fas fa-search mr-1"></i> Cari
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <small class="form-text text-muted text-left mt-2" style="font-size: 0.75rem; line-height: 1.4;">
                                                        📌 <strong>Contoh input yang bisa dimasukkan:</strong><br>
                                                        • <strong>ID Kalibrasi / LK:</strong> <code>125</code> atau <code>140</code><br>
                                                        • <strong>Certificate ID:</strong> <code>PAS-2024-001</code><br>
                                                        • <strong>Link URL QR:</strong> <code>https://pascalibration.com/125</code>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Navigasi Akhir -->
                    <div id="finish-action-container" class="mt-4 text-center d-none">
                        <hr>
                        <div class="alert alert-success d-inline-block px-4 py-3 shadow-sm border-success">
                            <h5 class="mb-2"><i class="fas fa-check-circle mr-2"></i>Semua Kalibrasi Selesai?</h5>
                            <p class="mb-3">Pastikan semua tab yang Anda perlukan sudah tersimpan sebelum meninggalkan halaman ini.</p>
                            <a href="{{ route('calibrations.index') }}" class="btn btn-success px-4">
                                <i class="fas fa-home mr-1"></i> Selesai & Kembali ke Daftar
                            </a>
                        </div>
                    </div>

                    <!-- Tempat Form Kalibrasi akan dimuat (digantikan oleh tab system) -->
                    <div id="formContainer" style="display: none;"></div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Scripts disediakan oleh layout (Bootstrap 4 + jQuery + SweetAlert2) -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Global function for parameter checkbox toggles
    if (typeof window.toggleParamSection !== 'function') {
        window.toggleParamSection = function(checkbox) {
            const targetId = checkbox.getAttribute('data-target');
            const container = checkbox.closest('.subform-wrapper') || checkbox.closest('.lk-form-container') || document;
            const targetSection = container.querySelector('#' + targetId) || document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = checkbox.checked ? 'block' : 'none';
                console.log(`📢 Parameter toggled: ${targetId} -> ${targetSection.style.display}`);
            }
        };
    }

    document.addEventListener('DOMContentLoaded', function() {

        // Global state untuk tracking tab aktif
        let activeLkId = 1;
        let isSyncing = false; // Flag untuk mencegah loop rekursif saat sync

        // ==========================================
        // 📋 HELPER: Kirim log ke ActivityLog (endpoint yang sudah ada)
        // ==========================================
        function logFormActivity(event, data) {
            fetch('/api/log-activity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                        '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    event: event,
                    data: data
                })
            }).catch(err => console.warn('Log gagal:', err));
        }

        // ==========================================
        // FUNGSI UNTUK MENDAPATKAN TAB AKTIF YANG BENAR
        // ==========================================
        function getActiveTabId() {
            // PRIORITAS 1: Cari tab button dengan class active
            const activeTabButton = document.querySelector('.nav-link.active');
            if (activeTabButton && activeTabButton.id) {
                const id = activeTabButton.id;
                if (id && id.startsWith('lk-tab-')) {
                    const tabId = id.replace('lk-tab-', '');
                    console.log(`📍 Active tab ID from button: ${tabId}`);
                    // Update global variable
                    activeLkId = parseInt(tabId);
                    return tabId;
                }
            }

            // PRIORITAS 2: Gunakan global variable
            console.log(`📍 Active tab ID from global variable: ${activeLkId}`);
            return activeLkId.toString();
        }

        // Update global variable saat tab berubah
        function updateActiveTab(tabId) {
            activeLkId = parseInt(tabId);
            console.log(`🔄 Global active tab updated to: ${activeLkId}`);
        }
        // Inisialisasi Select2
        function initSelect2() {
            try {
                $('.select2').select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    placeholder: function() {
                        return $(this).data('placeholder') || '-- Pilih --';
                    },
                    allowClear: true,
                    dropdownParent: $('body') // Render ke body agar tidak block elemen lain
                });
            } catch (error) {
                console.error('Error initializing Select2:', error);
            }
        }

        initSelect2();

        // Mapping form value ke nama display
        const formNameMap = {
            'inside_micrometer': 'Inside Micrometer',
            'outside_micrometer': 'Outside Micrometer',
            'depth_micrometer': 'Depth Micrometer',
            'thermometer': 'Thermometer',
            'dial_indicator': 'Dial Indicator',
            'dial_test_indicator': 'Dial Test Indicator',
            'depth_caliper': 'Depth Caliper',
            'caliper': 'Caliper',
            'torque_wrench': 'Torque Wrench-Driver',
            'torque_meter': 'Torque Tester-Meter',
            'thickness_gauge': 'Thickness Gauge',
            'penggaris': 'Penggaris',
            'enclosure': 'Enclosure',
            'chamber': 'Chamber',
            'pressure_gauge': 'Pressure Gauge',
            'heigth_gauge': 'Heigh Gauge',
            'differential_pressure_gauge': 'Differential Pressure Gauge',
            'volumetrik': 'Volumetrik',
            'thermohygrometer': 'Thermohygrometer',
            'viscometer': 'Viscometer',
            'push_pull': 'Push Pull',
            'timbangan': 'Timbangan',
            'timbangan_bias': 'Timbangan Bias',
            'gauge_block': 'Gauge Block',
            'holetest': 'Holetest',
            'conductivity_meter': 'Conductivity Meter',
            'coating_thickness': 'Coating Thickness',
            'mikropipet_dispenset': 'Mikropipet Dispenset',
            'temp_humid_transmitter': 'Temperature Humidity Transmitter',
            'insulation': 'Insulation',
            'centrifuge': 'Centrifuge',
            'plastic_shim': 'Plastic Shim',
            'durometer': 'Durometer',
            'plain_limit_gauge': 'Plain Limit Gauge',
            'surface_roughness_tester': 'Surface Roughness Tester',
            'feeler_gauge': 'Feeler Gauge',
            'stopwatch': 'Stopwatch',
            'thermometer_infrared': 'Thermometer Infrared',
            'tachometer': 'Tachometer',
            'surface_plate': 'Surface Plate',
            'visco_cup': 'Visco Cup',
            'taper_gauge': 'Taper Gauge',
            'bore_gauge': 'Bore Gauge',
            'ph_meter': 'PH Meter',
            'pin_gauge': 'Pin Gauge',
            'profil_projector': 'Profil Projector / Microscope',
            'thread_gauge': 'Thread Gauge',
            'pressure_transmitter': 'Pressure Transmitter / Diff Pressure Transmitter',
            'ultrasonic_thickness_gauge': 'Ultrasonic Thickness Gauge',
            'temperature_transmitter': 'Temperature Transmitter',
            'thermoindicator': 'Thermoindicator',
            'anak_timbangan': 'Anak Timbangan',
            'utm': 'Mesin Uji Tarik & Tekan'
        };

        // Data alat ukur untuk search
        const alatList = Object.entries(formNameMap).map(([value, text]) => ({
            value,
            text
        }));

        // Fungsi untuk mensinkronisasi selector (dropdown) dengan data di tab aktif
        function syncSelectorsWithTab(tabId) {
            if (isSyncing) return;
            isSyncing = true;

            console.log(`🔄 Syncing selectors with tab ${tabId}...`);

            const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (!container) {
                isSyncing = false;
                return;
            }

            // Visual feedback: brief pulse on the selector container
            const selectorCard = document.querySelector('.card:has(#formSelect)');
            if (selectorCard) {
                selectorCard.classList.add('sync-pulse');
                setTimeout(() => selectorCard.classList.remove('sync-pulse'), 500);
            }

            const currentForm = container.getAttribute('data-current-form') || '';
            const currentRes = container.getAttribute('data-current-resolution') || '';
            const currentCap = container.getAttribute('data-current-capacity') || '';
            const currentRep = container.getAttribute('data-current-repetition') || '';
            const currentThermo = container.getAttribute('data-current-thermo-type') || '';
            const currentTimbangan = container.getAttribute('data-current-timbangan-type') || '';
            const currentInsulation = container.getAttribute('data-current-insulation-type') || '';
            const currentCount = container.getAttribute('data-current-count') || '1';
            const formSelect = $('#formSelect');

            // Update main form select tanpa memicu event change yang memuat ulang form
            if (formSelect.val() !== currentForm) {
                formSelect.val(currentForm).trigger('change.select2');
            }

            // Update sub-options if they exist
            const subOptions = {
                '#dialresolutionSelect': currentRes,
                '#caliperresolutionSelect': currentCap,
                '#insideMicrometerCapacitySelect': currentCap,
                '#outsideMicrometerCapacitySelect': currentCap,
                '#depthMicrometerCapacitySelect': currentCap,
                '#enclosureRepetitionSelect': currentRep,
                '#chamberRepetitionSelect': currentRep,
                '#thermohygrometerTypeSelect': currentThermo,
                '#timbanganTypeSelect': currentTimbangan,
                '#insulationTypeSelect': currentInsulation,
                '#insideMicrometerCountSelect': currentCount,
                '#mikropipetDispensetCountSelect': currentCount,
                '#thermometerCountSelect': currentCount,
                '#utmCountSelect': currentCount,
                '#anakTimbanganCountSelect': currentCount,
                '#feelerGaugeCountSelect': currentCount,
                '#centrifugeCountSelect': currentCount,
                '#thermoIndicatorCountSelect': currentCount,
                '#outsideMicrometerCountSelect': currentCount,
                '#pinGaugeCountSelect': currentCount,
                '#ultrasonicThicknessGaugeCountSelect': currentCount,
                '#depthMicrometerCountSelect': currentCount,
                '#caliperCountSelect': currentCount,
                '#timbanganCountSelect': currentCount,
                '#chamberCountSelect': currentCount
            };

            Object.entries(subOptions).forEach(([selector, value]) => {
                const el = $(selector);
                if (el.length && el.val() !== value) {
                    el.val(value).trigger('change.select2');
                }
            });

            // Trigger manual change on formSelect to show/hide the correct wrappers
            // We use a custom event or flag to prevent reloading
            formSelect.trigger('change', [{
                isSync: true
            }]);

            isSyncing = false;
            console.log(`✅ Syncing complete for tab ${tabId}`);
        }

        // Listener untuk perubahan tab

        $(document).on('show.bs.tab', 'button[data-toggle="tab"]', function(e) {
            const targetId = $(e.target).attr('id');
            if (targetId && targetId.startsWith('lk-tab-')) {
                const tabId = parseInt(targetId.replace('lk-tab-', ''));

                // 🔥 UPDATE GLOBAL VARIABLE DENGAN TAB YANG AKTIF
                updateActiveTab(tabId);

                console.log(`🎯 Tab aktif terdeteksi: ${activeLkId}`);

                // Hentikan scanner jika aktif saat pindah tab
                if (typeof stopScanner === 'function') {
                    stopScanner();
                }

                // Sinkronkan selector dengan data di tab ini
                syncSelectorsWithTab(activeLkId);
            }
        });

        // Fungsi untuk search alat
        function searchAlat(keyword) {
            const searchResults = document.getElementById('searchResults');
            if (!searchResults) return;

            keyword = keyword.toLowerCase().trim();

            if (!keyword) {
                searchResults.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle mr-2"></i>
                        Ketik kata kunci untuk mencari alat ukur
                    </div>
                </div>
            `;
                return;
            }

            // Filter alat berdasarkan keyword
            const filtered = alatList.filter(alat =>
                alat.text.toLowerCase().includes(keyword) ||
                alat.value.toLowerCase().includes(keyword)
            );

            if (filtered.length === 0) {
                searchResults.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-warning mb-0">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Tidak ditemukan alat ukur dengan kata kunci: "${keyword}"
                    </div>
                </div>
            `;
                return;
            }

            // Tampilkan hasil
            let html = '';
            filtered.forEach(alat => {
                html += `
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border shadow-sm hover-shadow">
                        <div class="card-body">
                            <h6 class="card-title text-primary">${alat.text}</h6>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <button type="button" class="btn btn-sm btn-primary w-100 select-alat-btn" 
                                    data-value="${alat.value}">
                                <i class="fas fa-check mr-1"></i> Pilih
                            </button>
                        </div>
                    </div>
                </div>
            `;
            });

            searchResults.innerHTML = html;

            // Tambahkan event listener untuk tombol pilih
            document.querySelectorAll('.select-alat-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    $('#formSelect').val(value).trigger('change');

                    // Tutup modal
                    $('#searchModal').modal('hide');

                    // Tampilkan notifikasi sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `Form ${formNameMap[value] || value} telah dipilih`,
                        timer: 1500,
                        showConfirmButton: false
                    });
                });
            });
        }

        // Event untuk tombol search
        document.getElementById('searchBtn')?.addEventListener('click', function() {
            $('#searchModal').modal('show');

            // Focus ke input search setelah modal muncul
            setTimeout(() => {
                document.getElementById('searchInput')?.focus();
            }, 500);
        });

        // Event untuk input search
        let searchTimeout;
        document.getElementById('searchInput')?.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchAlat(this.value);
            }, 300);
        });

        // Event untuk enter di search input
        document.getElementById('searchInput')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchAlat(this.value);
            }
        });

        // Update Select2 saat window resize
        $(window).on('resize', function() {
            setTimeout(initSelect2, 100);
        });

        let tabCounter = 1; // Counter untuk ID tab

        // Fungsi untuk update nama tab
        function updateTabName(tabId, formType, formName = null) {
            const tabButton = document.getElementById(`lk-tab-${tabId}`);
            if (!tabButton) return;

            const displayName = formName || (formType ? (formNameMap[formType] || formType) : 'Tab ' + tabId);
            const badgeClass = formType ? 'badge-primary' : 'badge-secondary';
            const badgeText = formType ? 'Terisi' : 'Kosong';

            // Simpan data form type di container
            const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (container) {
                container.setAttribute('data-form-type', formType || '');
                container.setAttribute('data-form-name', displayName);

                // Jika formType kosong, reset metadata lain
                if (!formType) {
                    container.setAttribute('data-current-form', '');
                    container.setAttribute('data-current-resolution', '');
                    container.setAttribute('data-current-capacity', '');
                    container.setAttribute('data-current-repetition', '');
                    container.setAttribute('data-current-thermo-type', '');
                    container.setAttribute('data-current-timbangan-type', '');
                    container.setAttribute('data-current-insulation-type', '');
                } else {
                    container.setAttribute('data-current-form', formType);
                }
            }

            tabButton.innerHTML = `
            <i class="fas fa-file-alt mr-1"></i><span class="tab-name">${escapeHtml(displayName)}</span>
            <span class="badge ${badgeClass} ml-1">${badgeText}</span>
            <i class="fas fa-times ml-2 text-danger" style="cursor: pointer; ${tabId === 1 ? 'display: none;' : ''}" onclick="event.stopPropagation(); removeTab(${tabId})" title="Hapus Tab"></i>
        `;
        }

        // ==========================================
        // FUNGSI UNTUK UPDATE NAMA TAB BERDASARKAN NAMA ALAT
        // ==========================================

        // Fungsi untuk mengupdate nama tab berdasarkan form type dan nama alat
        function updateTabNameByFormType(tabId, formType, namaAlat) {
            const tabButton = document.getElementById(`lk-tab-${tabId}`);
            if (!tabButton) return;

            // Tentukan nama display
            let displayName = '';

            if (namaAlat && namaAlat !== '') {
                // Jika ada nama alat, gunakan nama alat (max 25 karakter)
                displayName = namaAlat.length > 25 ? namaAlat.substring(0, 22) + '...' : namaAlat;
            } else if (formType && formNameMap[formType]) {
                // Jika tidak ada nama alat tapi ada form type, gunakan nama form type
                displayName = formNameMap[formType];
            } else {
                // Default: Tab + nomor
                displayName = 'Tab ' + tabId;
            }

            // Update teks nama tab
            const tabNameSpan = tabButton.querySelector('.tab-name');
            if (tabNameSpan) {
                tabNameSpan.textContent = displayName;
            } else {
                // Fallback jika tidak ada span tab-name
                const existingHtml = tabButton.innerHTML;
                const newHtml = existingHtml.replace(/<i class="fas fa-file-alt mr-1"><\/i>[^<]*/, `<i class="fas fa-file-alt mr-1"></i><span class="tab-name">${escapeHtml(displayName)}</span>`);
                tabButton.innerHTML = newHtml;
            }

            // Update container attribute
            const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (container) {
                container.setAttribute('data-form-name', displayName);
            }

            console.log(`📛 Tab ${tabId} renamed to: ${displayName}`);
        }

        // Fungsi untuk mengupdate badge status tab (Kosong/Terisi/Tersimpan)
        function updateTabBadge(tabId, status, isSaved = false) {
            const tabButton = document.getElementById(`lk-tab-${tabId}`);
            if (!tabButton) return;

            let badge = tabButton.querySelector('.badge');
            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'badge ml-1';
                tabButton.appendChild(badge);
            }

            if (isSaved) {
                badge.className = 'badge badge-success ml-1';
                badge.innerHTML = '<i class="fas fa-check mr-1"></i>Tersimpan';
                tabButton.classList.add('tab-saved');
            } else if (status === 'terisi') {
                badge.className = 'badge badge-primary ml-1';
                badge.textContent = 'Terisi';
                tabButton.classList.remove('tab-saved');
            } else {
                badge.className = 'badge badge-secondary ml-1';
                badge.textContent = 'Kosong';
                tabButton.classList.remove('tab-saved');
            }
        }

        function loadFormToTab(tabId, formType, resolution = null, capacity = null, repetition = null, thermohygrometerType = null, timbanganType = null, insulationType = null, count = null) {
            return new Promise((resolve, reject) => {
                console.log(`🔍 loadFormToTab CALLED: tabId=${tabId}, formType=${formType}, count=${count}`);
                const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
                if (!container) return reject('Container not found');

                if (!formType) {
                    container.innerHTML = `<div class="alert alert-info mb-0">Pilih jenis alat ukur...</div>`;
                    return resolve();
                }

                // Build URL
                let url = `/get-form-html/${formType}`;
                const params = new URLSearchParams();

                if (capacity && capacity !== '') params.append('capacity', capacity);
                if (resolution) params.append('resolution', resolution);
                if (repetition) params.append('repetition', repetition);
                if (thermohygrometerType && thermohygrometerType !== '') {
                    params.append('type', thermohygrometerType);
                    console.log(`📤 Sending thermohygrometer type: ${thermohygrometerType}`);
                }
                if (timbanganType) params.append('timbangan_type', timbanganType);

                // 🔥 INSULATION TYPE - nilai dari dropdown (ac_voltage_50hz, dc_voltage, ac_current_50hz, dc_current)
                if (insulationType && insulationType !== '') {
                    params.append('insulation_type', insulationType);
                    console.log(`📤 Sending insulation type: ${insulationType}`);
                }

                if (count) params.append('count', count);

                // Kirim tab_id ke server
                params.append('tab_id', tabId);

                if (params.toString()) url += `?${params.toString()}`;

                console.log(`🔄 Loading form URL: ${url}`);

                showLoadingOverlay(tabId);

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP ${response.status}`);
                        return response.text();
                    })
                    .then(html => {
                        // 🔥 Ganti semua ID statis menjadi dinamis berdasarkan tabId
                        let modifiedHtml = html;

                        // Ganti id attributes: manualInputContainer_1 -> manualInputContainer_1_tab2
                        modifiedHtml = modifiedHtml.replace(/id="([^"]+?)_(\d+)"/g, (match, prefix, num) => {
                            return `id="${prefix}_${num}_tab${tabId}"`;
                        });

                        // Ganti name attributes
                        modifiedHtml = modifiedHtml.replace(/name="([^"]+?)_(\d+)"/g, (match, prefix, num) => {
                            return `name="${prefix}_${num}_tab${tabId}"`;
                        });

                        // Ganti for attributes
                        modifiedHtml = modifiedHtml.replace(/for="([^"]+?)_(\d+)"/g, (match, prefix, num) => {
                            return `for="${prefix}_${num}_tab${tabId}"`;
                        });

                        // 🔥 Ganti onchange untuk updateFormType
                        modifiedHtml = modifiedHtml.replace(/onchange="updateFormType\(this\.value,\s*(\d+)\)"/g, (match, num) => {
                            return `onchange="updateFormType(this.value, ${num}, ${tabId})"`;
                        });

                        // 🔥 Ganti oninput untuk syncNamaAlat
                        modifiedHtml = modifiedHtml.replace(/oninput="syncNamaAlat\((\d+)\)"/g, (match, num) => {
                            return `oninput="syncNamaAlat(${num}, ${tabId})"`;
                        });

                        // Ganti onclick
                        modifiedHtml = modifiedHtml.replace(/onclick="submitSemuaForm\(\)"/g, 'onclick="window.submitSemuaForm()"');
                        modifiedHtml = modifiedHtml.replace(/onclick="([^"]*?)\((\d+)\)"/g, (match, funcName, num) => {
                            return `onclick="${funcName}(${num}, ${tabId})"`;
                        });

                        container.innerHTML = '';
                        container.innerHTML = modifiedHtml;
                        container.querySelectorAll('form').forEach(f => {
                            f.setAttribute('novalidate', 'true');
                            f.noValidate = true;
                        });
                        container.classList.add('fade-in');

                        // 🔥 INJECT FIELD NO PO sebelum baris Nama Alat
                        // (dilakukan per-tab agar tiap form alat bisa punya No PO masing-masing)
                        setTimeout(() => {
                            if (!container.querySelector('input[name="no_po"]')) {
                                // Cari <td> yang berisi teks persis "Nama Alat"
                                let namaAlatRow = null;
                                container.querySelectorAll('td').forEach(td => {
                                    const txt = (td.querySelector('p') || td).textContent.trim();
                                    if (txt === 'Nama Alat' && !namaAlatRow) {
                                        namaAlatRow = td.closest('tr');
                                    }
                                });

                                if (namaAlatRow) {
                                    const noPORow = document.createElement('tr');
                                    noPORow.setAttribute('data-no-po-row', 'true');
                                    noPORow.innerHTML = `
                                        <td style="width: 20%;"><p style="margin: 0; color: #000000; font-weight: 500;">No. PO
                                            <span style="color: #6c757d; font-size: 11px;">(Purchase Order)</span>
                                        </p></td>
                                        <td colspan="3">
                                            <input type="text"
                                                   name="no_po"
                                                   id="no_po_tab${tabId}"
                                                   class="kalibrasi-input"
                                                   placeholder="Masukkan No PO / Nomor Order"
                                                   style="width: 100%;">
                                        </td>
                                    `;
                                    namaAlatRow.insertAdjacentElement('beforebegin', noPORow);
                                    console.log(`✅ Field No PO berhasil di-inject sebelum Nama Alat pada tab ${tabId}`);

                                    // Kembalikan nilai No PO jika ada di tempFormDataStore
                                    const savedTabData = (typeof tempFormDataStore !== 'undefined') ? tempFormDataStore[tabId] : null;
                                    if (savedTabData && savedTabData['no_po']) {
                                        const noPOInput = container.querySelector('input[name="no_po"]');
                                        if (noPOInput) {
                                            noPOInput.value = savedTabData['no_po'];
                                        }
                                    }
                                } else {
                                    console.warn(`⚠️ Baris "Nama Alat" tidak ditemukan pada form tab ${tabId}, No PO tidak di-inject.`);
                                }
                            }
                        }, 150);


                        // Append subform panel
                        console.log(`[loadFormToTab] Checking appendSubformPanelToTab status for tabId=${tabId}, formType=${formType}`);
                        if (typeof appendSubformPanelToTab === 'function') {
                            appendSubformPanelToTab(tabId, formType);
                        } else if (typeof window.appendSubformPanelToTab === 'function') {
                            window.appendSubformPanelToTab(tabId, formType);
                        } else {
                            console.warn(`⚠️ appendSubformPanelToTab is not defined yet. Delaying execution...`);
                            setTimeout(function() {
                                if (typeof window.appendSubformPanelToTab === 'function') {
                                    console.log(`🔌 appendSubformPanelToTab executed after delay for tabId=${tabId}`);
                                    window.appendSubformPanelToTab(tabId, formType);
                                } else {
                                    console.error(`🚨 appendSubformPanelToTab is still not defined after delay!`);
                                }
                            }, 100);
                        }

                        // Update metadata
                        container.setAttribute('data-form-type', formType || ''); // Mencegah bug salah simpan form type
                        container.setAttribute('data-current-form', formType || '');
                        container.setAttribute('data-current-resolution', resolution || '');
                        container.setAttribute('data-current-capacity', capacity || '');
                        container.setAttribute('data-current-repetition', repetition || '');
                        container.setAttribute('data-current-thermo-type', thermohygrometerType || '');
                        container.setAttribute('data-current-timbangan-type', timbanganType || '');
                        container.setAttribute('data-current-insulation-type', insulationType || '');
                        container.setAttribute('data-current-count', count || '1');
                        container.setAttribute('data-lk-id', tabId);

                        if (typeof updateTabName === 'function') {
                            updateTabName(tabId, formType);
                        }

                        // 🔥 DEFINISIKAN FUNGSI GLOBAL jika belum ada
                        if (typeof window.updateFormTypeGlobal === 'undefined') {
                            window.updateFormTypeGlobal = function(selectedAlat, formIndex, tabId) {
                                console.log(`📌 updateFormType: tab=${tabId}, formIndex=${formIndex}, selected=${selectedAlat}`);

                                const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
                                if (!container) {
                                    console.log(`❌ Container untuk tab ${tabId} tidak ditemukan`);
                                    return;
                                }

                                let manualContainer = container.querySelector('#manualInputContainer');
                                let manualInput = container.querySelector('#nama_alat_manual');
                                let finalInput = container.querySelector('#nama_alat_final');

                                if (!manualContainer) manualContainer = container.querySelector(`#manualInputContainer_${formIndex}_tab${tabId}`);
                                if (!manualInput) manualInput = container.querySelector(`#nama_alat_manual_${formIndex}_tab${tabId}`);
                                if (!finalInput) finalInput = container.querySelector(`#nama_alat_final_${formIndex}_tab${tabId}`);

                                console.log(`🔍 Elemen ditemukan: manualContainer=${!!manualContainer}, manualInput=${!!manualInput}`);

                                if (selectedAlat === 'MANUAL_INPUT') {
                                    if (manualContainer) {
                                        manualContainer.style.display = 'block';
                                        console.log(`✅ manualContainer ditampilkan di tab ${tabId}`);
                                    }
                                    if (manualInput) {
                                        manualInput.value = '';
                                        manualInput.required = true;
                                    }
                                    if (finalInput) finalInput.value = '';
                                } else {
                                    if (manualContainer) {
                                        manualContainer.style.display = 'none';
                                    }
                                    if (manualInput) {
                                        manualInput.value = '';
                                        manualInput.required = false;
                                    }
                                    if (finalInput && selectedAlat) finalInput.value = selectedAlat;
                                }
                            };

                            window.syncNamaAlatGlobal = function(formIndex, tabId) {
                                const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
                                if (!container) {
                                    console.log(`❌ Container untuk tab ${tabId} tidak ditemukan`);
                                    return;
                                }

                                let manualInput = container.querySelector('#nama_alat_manual');
                                let finalInput = container.querySelector('#nama_alat_final');

                                if (!manualInput) manualInput = container.querySelector(`#nama_alat_manual_${formIndex}_tab${tabId}`);
                                if (!finalInput) finalInput = container.querySelector(`#nama_alat_final_${formIndex}_tab${tabId}`);

                                if (manualInput && finalInput) {
                                    finalInput.value = manualInput.value;
                                    console.log(`✅ syncNamaAlatGlobal: finalInput = ${finalInput.value} (tab ${tabId})`);
                                }
                            };

                            window.updateKapasitasGlobal = function(formIndex, tabId) {
                                const rangeMaxInput = document.getElementById(`rentang_ukur_max_${formIndex}_tab${tabId}`);
                                const kapasitasInput = document.getElementById(`kapasitas_${formIndex}_tab${tabId}`);

                                if (rangeMaxInput && kapasitasInput) {
                                    let maxValue = parseFloat(rangeMaxInput.value);
                                    if (!isNaN(maxValue) && maxValue > 0) {
                                        kapasitasInput.value = maxValue;
                                    } else {
                                        kapasitasInput.value = '';
                                    }
                                }
                            };
                        }

                        // 🔥 EKSEKUSI SCRIPT yang ada di dalam HTML
                        const scripts = container.querySelectorAll('script');
                        scripts.forEach(oldScript => {
                            const newScript = document.createElement('script');
                            let scriptContent = oldScript.textContent || '';
                            // Always neutralize local submitSemuaForm and disableRequiredOnHiddenForms in injected scripts so global window functions are used
                            scriptContent = scriptContent.replace(/(async\s+)?function\s+submitSemuaForm/g, "$1function IGNORED_submitSemuaForm");
                            scriptContent = scriptContent.replace(/(async\s+)?function\s+disableRequiredOnHiddenForms/g, "$1function IGNORED_disableRequiredOnHiddenForms");
                            scriptContent = scriptContent.replace(/(?<!function\s+)\bdisableRequiredOnHiddenForms\(\)/g, "/* disableRequiredOnHiddenForms disabled */");


                            scriptContent = scriptContent.replace(/updateFormType\(([^,]+),\s*(\d+)\)/g, (match, param, num) => {
                                return `updateFormType(${param}, ${num}, ${tabId})`;
                            });

                            scriptContent = scriptContent.replace(/syncNamaAlat\((\d+)\)/g, (match, num) => {
                                return `syncNamaAlat(${num}, ${tabId})`;
                            });

                            scriptContent = scriptContent.replace(/updateKapasitas\((\d+)\)/g, (match, num) => {
                                return `updateKapasitas(${num}, ${tabId})`;
                            });

                            scriptContent = scriptContent.replace(/getElementById\(["']([^"']+?)_(\d+)["']\)/g, (match, prefix, num) => {
                                return `getElementById("${prefix}_${num}_tab${tabId}")`;
                            });

                            if (oldScript.src) {
                                newScript.src = oldScript.src;
                                newScript.async = false;
                            } else {
                                newScript.textContent = scriptContent;
                            }

                            Array.from(oldScript.attributes).forEach(attr => {
                                if (attr.name !== 'src' || !oldScript.src) {
                                    newScript.setAttribute(attr.name, attr.value);
                                }
                            });
                            oldScript.parentNode.replaceChild(newScript, oldScript);
                        });

                        // ==========================================
                        // 🔥 INISIALISASI UNTUK FORM
                        // ==========================================
                        setTimeout(() => {
                            const jumlahForm = parseInt(count) || 1;
                            const isMultipleForm = (formType === 'inside_micrometer' || formType === 'outside_micrometer' || formType === 'depth_micrometer');

                            console.log(`📌 Initializing for tab ${tabId}, formType: ${formType}, isMultipleForm: ${isMultipleForm}`);

                            // 🔥 KHUSUS UNTUK INSULATION - TAMPILKAN INFORMASI TYPE YANG DIPILIH
                            if (formType === 'insulation' && insulationType) {
                                console.log(`🔌 Insulation type: ${insulationType}`);
                                // Tambahkan hidden input untuk menyimpan insulation type
                                let hiddenInput = container.querySelector('input[name="insulation_type"]');
                                if (!hiddenInput) {
                                    hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'insulation_type';
                                    hiddenInput.value = insulationType;
                                    container.appendChild(hiddenInput);
                                }
                            }

                            if (isMultipleForm) {
                                // MULTIPLE FORM (Inside Micrometer, dll)
                                for (let i = 1; i <= jumlahForm; i++) {
                                    const namaAlatSelect = container.querySelector(`select[id*="nama_alat_select_${i}_tab${tabId}"]`);
                                    if (namaAlatSelect) {
                                        const newSelect = namaAlatSelect.cloneNode(true);
                                        namaAlatSelect.parentNode.replaceChild(newSelect, namaAlatSelect);

                                        newSelect.addEventListener('change', function() {
                                            console.log(`🔄 Select changed: value=${this.value}, formIndex=${i}, tabId=${tabId}`);
                                            window.updateFormTypeGlobal(this.value, i, tabId);

                                            setTimeout(() => {
                                                let namaAlat = '';
                                                if (this.value && this.value !== 'MANUAL_INPUT') {
                                                    namaAlat = this.value;
                                                } else {
                                                    const manualInput = container.querySelector(`input[name="nama_alat_manual"]`);
                                                    if (manualInput && manualInput.value) {
                                                        namaAlat = manualInput.value;
                                                    }
                                                }

                                                if (namaAlat && typeof updateTabNameByFormType === 'function') {
                                                    updateTabNameByFormType(tabId, formType, namaAlat);
                                                    updateTabBadge(tabId, 'terisi', false);
                                                }
                                            }, 100);
                                        });

                                        window.updateFormTypeGlobal(newSelect.value, i, tabId);
                                        console.log(`✅ Initialized select for form ${i} in tab ${tabId}`);
                                    }

                                    const rangeMax = container.querySelector(`input[id*="rentang_ukur_max_${i}_tab${tabId}"]`);
                                    if (rangeMax) {
                                        rangeMax.addEventListener('input', () => window.updateKapasitasGlobal(i, tabId));
                                        rangeMax.addEventListener('change', () => window.updateKapasitasGlobal(i, tabId));
                                        if (rangeMax.value) window.updateKapasitasGlobal(i, tabId);
                                    }
                                }
                            } else {
                                // SINGLE FORM
                                const namaAlatSelect = container.querySelector('select[name="nama_alat"]');
                                if (namaAlatSelect) {
                                    const newSelect = namaAlatSelect.cloneNode(true);
                                    namaAlatSelect.parentNode.replaceChild(newSelect, namaAlatSelect);

                                    newSelect.addEventListener('change', function() {
                                        console.log(`🔄 Select changed: value=${this.value}, tabId=${tabId}`);

                                        if (typeof window.updateFormTypeGlobal === 'function') {
                                            window.updateFormTypeGlobal(this.value, 1, tabId);
                                        }

                                        setTimeout(() => {
                                            let namaAlat = '';
                                            if (this.value && this.value !== 'MANUAL_INPUT') {
                                                namaAlat = this.value;
                                            } else {
                                                const manualInput = container.querySelector('input[name="nama_alat_manual"]');
                                                if (manualInput && manualInput.value) {
                                                    namaAlat = manualInput.value;
                                                }
                                            }

                                            if (namaAlat && typeof updateTabNameByFormType === 'function') {
                                                updateTabNameByFormType(tabId, formType, namaAlat);
                                                updateTabBadge(tabId, 'terisi', false);
                                            }
                                        }, 100);
                                    });

                                    if (typeof window.updateFormTypeGlobal === 'function') {
                                        window.updateFormTypeGlobal(newSelect.value, 1, tabId);
                                    }
                                    console.log(`✅ Initialized select in tab ${tabId}, value: ${newSelect.value}`);
                                } else {
                                    console.log(`⚠️ Select not found in tab ${tabId}`);
                                }

                                const manualInput = container.querySelector('input[name="nama_alat_manual"]');
                                if (manualInput) {
                                    const newManualInput = manualInput.cloneNode(true);
                                    manualInput.parentNode.replaceChild(newManualInput, manualInput);

                                    newManualInput.addEventListener('input', function() {
                                        console.log(`📝 Manual input changed: ${this.value}, tabId=${tabId}`);

                                        if (typeof window.syncNamaAlatGlobal === 'function') {
                                            window.syncNamaAlatGlobal(1, tabId);
                                        }

                                        if (this.value && typeof updateTabNameByFormType === 'function') {
                                            updateTabNameByFormType(tabId, formType, this.value);
                                            updateTabBadge(tabId, 'terisi', false);
                                        }
                                    });
                                }
                            }

                            // Select2 initialization
                            if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
                                $('.select2').select2({
                                    theme: 'bootstrap-5',
                                    width: '100%',
                                    placeholder: '-- Pilih --',
                                    allowClear: true
                                });
                            }

                            // UPDATE NAMA TAB
                            setTimeout(() => {
                                let namaAlat = '';
                                const selectNamaAlat = container.querySelector('select[name="nama_alat"]');
                                if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
                                    namaAlat = selectNamaAlat.value;
                                } else {
                                    const manualInput = container.querySelector('input[name="nama_alat_manual"]');
                                    if (manualInput && manualInput.value) {
                                        namaAlat = manualInput.value;
                                    }
                                }

                                if (namaAlat && typeof updateTabNameByFormType === 'function') {
                                    updateTabNameByFormType(tabId, formType, namaAlat);
                                    updateTabBadge(tabId, 'terisi', false);
                                } else if (formType && typeof formNameMap !== 'undefined' && formNameMap[formType]) {
                                    if (typeof updateTabNameByFormType === 'function') {
                                        updateTabNameByFormType(tabId, formType, null);
                                        updateTabBadge(tabId, 'terisi', false);
                                    }
                                }
                            }, 500);

                            console.log(`✅ Form loaded and initialized for tab ${tabId}`);
                            hideLoadingOverlay(tabId);
                            resolve();
                        }, 300);
                    })
                    .catch(err => {
                        console.error('Load form error:', err);
                        let errorMsg = err.message;
                        if (err.message.includes('HTTP 500')) {
                            errorMsg = `Form untuk ${formType} belum tersedia di server. Silakan hubungi administrator.`;
                        }
                        container.innerHTML = `<div class="alert alert-danger fade-in">Error: ${errorMsg}</div>`;
                        hideLoadingOverlay(tabId);
                        reject(err);
                    });
            });
        }
        // Fungsi untuk menambah tab baru
        function addNewTab(formType = null, formData = null) {
            tabCounter++;
            const tabId = tabCounter;
            const defaultName = 'Tab ' + tabId;

            // Tambah tab baru
            const tabsList = document.getElementById('lkTabs');
            const newTab = document.createElement('li');
            newTab.className = 'nav-item';
            newTab.setAttribute('role', 'presentation');
            const badgeClass = formType ? 'badge-primary' : 'badge-secondary';
            const badgeText = formType ? 'Terisi' : 'Kosong';

            // Tentukan nama awal
            let initialName = defaultName;
            if (formData && formData.namaAlat) {
                initialName = formData.namaAlat.length > 25 ? formData.namaAlat.substring(0, 22) + '...' : formData.namaAlat;
            } else if (formType && formNameMap[formType]) {
                initialName = formNameMap[formType];
            }

            newTab.innerHTML = `
                <button class="nav-link" id="lk-tab-${tabId}" data-toggle="tab" data-target="#lk-pane-${tabId}" type="button" role="tab" aria-controls="lk-pane-${tabId}" aria-selected="false">
                    <i class="fas fa-file-alt mr-1"></i><span class="tab-name">${escapeHtml(initialName)}</span>
                    <span class="badge ${badgeClass} ml-1">${badgeText}</span>
                    <i class="fas fa-times ml-2 text-danger" style="cursor: pointer; ${tabId === 1 ? 'display: none;' : ''}" onclick="event.stopPropagation(); removeTab(${tabId})" title="Hapus Tab"></i>
                </button>
            `;
            tabsList.appendChild(newTab);



            // Tambah pane konten
            const tabContent = document.getElementById('lkTabContent');
            const newPane = document.createElement('div');
            newPane.className = 'tab-pane fade';
            newPane.id = `lk-pane-${tabId}`;
            newPane.setAttribute('role', 'tabpanel');
            newPane.setAttribute('aria-labelledby', `lk-tab-${tabId}`);

            let initialContent = '';
            if (formType && formData) {
                initialContent = `
                <div class="lk-form-container" data-lk-id="${tabId}" data-form-type="${formType}" data-form-name="${formNameMap[formType] || formType}">
                    <div class="text-center my-4 my-md-5">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-2 text-muted">Memuat data...</p>
                    </div>
                </div>
            `;
            } else {
                initialContent = `
                <div class="lk-form-container" data-lk-id="${tabId}" data-form-type="" data-form-name="Kosong">
                    <div class="row fade-in">
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-4 bg-light text-center h-100 d-flex flex-column justify-content-center">
                                <i class="fas fa-hand-pointer text-primary fa-3x mb-3"></i>
                                <h5 class="text-primary">Pilih Manual</h5>
                                <p class="text-muted">Pilih jenis alat ukur dari dropdown di atas untuk menampilkan form kalibrasi di tab ini.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-4 text-center h-100 d-flex flex-column justify-content-center align-items-center bg-white shadow-sm hover-shadow transition-all">
                                <h5 class="text-success mb-3"><i class="fas fa-qrcode mr-2"></i>Scan / Input ID Kalibrasi</h5>
                                <p class="text-muted small mb-3">Scan QR Code dengan kamera atau ketik ID alat langsung di bawah.</p>
                                <div id="scanner-wrapper-${tabId}" class="w-100 mb-3" style="display:none; max-width: 300px; margin: 0 auto;">
                                    <div id="reader-${tabId}" class="qr-reader-container w-100 overflow-hidden rounded border border-success" style="min-height: 250px;"></div>
                                    <div id="scanResult-${tabId}" class="mt-3 text-center d-none alert alert-success p-2">
                                        <div class="spinner-border spinner-border-sm text-success mr-2" role="status"></div>
                                        <span>Mengambil data...</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center gap-2 mb-3 w-100" style="max-width: 320px;">
                                    <button type="button" class="btn btn-success btn-start-scan flex-grow-1" data-target-tab="${tabId}">
                                        <i class="fas fa-camera mr-1"></i> Buka Kamera
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-stop-scan" data-target-tab="${tabId}" style="display:none;">
                                        <i class="fas fa-stop-circle"></i>
                                    </button>
                                </div>

                                <div class="d-flex align-items-center w-100 my-2" style="max-width: 320px;">
                                    <hr class="flex-grow-1 my-0">
                                    <span class="px-2 text-muted small font-weight-bold">ATAU KETIK ID</span>
                                    <hr class="flex-grow-1 my-0">
                                </div>

                                <div class="w-100 mt-2" style="max-width: 320px;">
                                    <div class="input-group">
                                        <input type="text" id="manualInput-${tabId}" class="form-control manual-id-input" placeholder="Contoh: 125 atau URL QR" autocomplete="off" data-target-tab="${tabId}">
                                        <div class="input-group-append">
                                            <button class="btn btn-success btn-submit-manual" data-target-tab="${tabId}" type="button">
                                                <i class="fas fa-search mr-1"></i> Cari
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted text-left mt-2" style="font-size: 0.75rem; line-height: 1.4;">
                                        📌 <strong>Contoh:</strong> ID Kalibrasi <code>125</code> / Sertifikat <code>PAS-2024-001</code> / Link URL.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            }

            newPane.innerHTML = initialContent;
            tabContent.appendChild(newPane);

            // Deactivate all other tabs and panes manually
            document.querySelectorAll('#lkTabs .nav-link').forEach(el => {
                el.classList.remove('active');
                el.setAttribute('aria-selected', 'false');
            });
            document.querySelectorAll('#lkTabContent .tab-pane').forEach(el => {
                el.classList.remove('show', 'active');
            });

            // Set activeLkId DULU sebelum apapun, agar event listener show.bs.tab
            // menggunakan tab ID yang benar (bukan tab sebelumnya)
            activeLkId = tabId;

            // Aktifkan tab baru secara manual (tanpa $(tabEl).tab('show') agar
            // tidak memicu show.bs.tab yang bisa membaca state tab lama)
            const tabEl = document.getElementById(`lk-tab-${tabId}`);
            if (tabEl) {
                tabEl.classList.add('active');
                tabEl.setAttribute('aria-selected', 'true');
            }
            newPane.classList.add('show', 'active');

            // Scroll tab ke view
            if (tabEl) {
                tabEl.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
            }

            if (formType && formData) {
                // Tab diisi via data scan: sync selector lalu fill
                syncSelectorsWithTab(tabId);
                setTimeout(() => {
                    fillFormInTab(tabId, formData);
                }, 500);
            } else if (formType) {
                // Tab diisi via formType saja: sync selector lalu load
                syncSelectorsWithTab(tabId);
                if (!window.isRestoringState) {
                    setTimeout(() => {
                        loadFormToTab(tabId, formType);
                    }, 500);
                }
            } else {
                // Tab BARU KOSONG: jangan panggil syncSelectorsWithTab karena
                // akan memicu change event yang membawa form tab sebelumnya.
                // Cukup reset dropdown ke kosong secara diam-diam.
                const formSelectEl = $('#formSelect');
                if (formSelectEl.val()) {
                    isSyncing = true;
                    formSelectEl.val('').trigger('change.select2');
                    isSyncing = false;
                }
                // Highlight dropdown agar user tahu harus pilih form
                setTimeout(() => {
                    const formSelect = document.getElementById('formSelect');
                    if (formSelect) {
                        formSelect.focus();
                        formSelect.style.transition = 'box-shadow 0.3s';
                        formSelect.style.boxShadow = '0 0 0 3px rgba(13, 110, 253, 0.5)';
                        setTimeout(() => {
                            formSelect.style.boxShadow = '';
                        }, 2000);
                    }
                }, 300);
            }

            return tabId;
        }

        // Fungsi untuk menghapus tab
        window.removeTab = function(tabId) {
            if (tabId === 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Dapat Dihapus',
                    text: 'Tab default tidak dapat dihapus!',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Hapus Tab?',
                text: 'Apakah Anda yakin ingin menghapus tab ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash mr-1"></i>Ya, Hapus',
                cancelButtonText: '<i class="fas fa-times mr-1"></i>Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const tab = document.getElementById(`lk-tab-${tabId}`);
                    const pane = document.getElementById(`lk-pane-${tabId}`);

                    if (tab) {
                        const tabParent = tab.closest('li');
                        if (tabParent) tabParent.remove();
                    }
                    if (pane) pane.remove();

                    const firstTab = document.getElementById('lk-tab-1');
                    if (firstTab) {
                        $(firstTab).tab('show');
                    }

                    if (typeof debouncedSave === 'function') {
                        debouncedSave();
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus',
                        text: 'Tab berhasil dihapus',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        };

        // Event untuk tombol tambah tab
        document.getElementById('addLKTabBtn')?.addEventListener('click', function() {
            addNewTab();
            Swal.fire({
                icon: 'info',
                title: 'Tab Baru Dibuat',
                text: 'Tab baru telah ditambahkan. Silakan pilih jenis alat ukur dari dropdown di atas.',
                timer: 2000,
                showConfirmButton: false
            });
        });

        // GANTI fungsi getActiveTabId() yang lama dengan ini
        function getActiveTabId() {
            // PRIORITAS 1: Cari tab pane yang aktif (dari Bootstrap tab)
            const activePane = document.querySelector('.tab-pane.active');
            if (activePane && activePane.id) {
                const paneId = activePane.id;
                if (paneId && paneId.startsWith('lk-pane-')) {
                    const tabId = paneId.replace('lk-pane-', '');
                    console.log(`📍 Active tab ID from active pane: ${tabId}`);
                    return tabId;
                }
            }

            // PRIORITAS 2: Cari tab button dengan class active
            const activeTabButton = document.querySelector('.nav-link.active');
            if (activeTabButton && activeTabButton.id) {
                const id = activeTabButton.id;
                if (id && id.startsWith('lk-tab-')) {
                    const tabId = id.replace('lk-tab-', '');
                    console.log(`📍 Active tab ID from active button: ${tabId}`);
                    return tabId;
                }
            }

            // PRIORITAS 3: Cari container yang visible
            const containers = document.querySelectorAll('.lk-form-container');
            for (let i = 0; i < containers.length; i++) {
                const container = containers[i];
                const style = window.getComputedStyle(container);
                if (style.display !== 'none') {
                    const tabId = container.getAttribute('data-lk-id');
                    console.log(`📍 Active tab ID from visible container: ${tabId}`);
                    return tabId || '1';
                }
            }

            // Fallback ke variabel global
            console.log(`📍 Active tab ID from global (fallback): ${activeLkId}`);
            return activeLkId.toString();
        }

        function getActiveContainer() {
            return document.querySelector(`.lk-form-container[data-lk-id="${activeLkId}"]`);
        }

        function showLoadingOverlay(tabId) {
            const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (container) {
                // Jangan ganti innerHTML, cukup tambahkan class dan overlay
                container.classList.add('loading-overlay-active');

                // Hapus overlay yang sudah ada
                const existingOverlay = container.querySelector('.loading-overlay-content');
                if (existingOverlay) {
                    existingOverlay.remove();
                }

                // Buat elemen overlay baru
                const overlay = document.createElement('div');
                overlay.className = 'loading-overlay-content';
                overlay.innerHTML = `
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Memuat data...</p>
        `;
                container.appendChild(overlay);

                console.log(`⏳ Loading overlay shown for tab ${tabId}`);
            }
        }

        function hideLoadingOverlay(tabId) {
            const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (container) {
                container.classList.remove('loading-overlay-active');

                // Hapus overlay
                const overlay = container.querySelector('.loading-overlay-content');
                if (overlay) {
                    overlay.remove();
                }

                console.log(`✅ Loading overlay removed for tab ${tabId}`);
            }
        }

        function loadForm(formType, resolution = null, capacity = null, repetition = null, thermohygrometerType = null, timbanganType = null, insulationType = null, count = null) {
            if (isSyncing) return;
            console.log(`📝 loadForm called with:`, {
                formType,
                resolution,
                capacity,
                repetition,
                thermohygrometerType,
                timbanganType,
                insulationType,
                count
            });
            // Urutan parameter: tabId, formType, resolution, capacity, repetition, thermohygrometerType, timbanganType, insulationType, count
            loadFormToTab(activeLkId, formType, resolution, capacity, repetition, thermohygrometerType, timbanganType, insulationType, count);
        }

        // Helper debounce untuk input number (mencegah spam request saat user mengetik)
        function debounce(fn, delay) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function initializeFormEvents() {
            const formSelect = $('#formSelect');
            const insideMicrometerCapacitySelect = $('#insideMicrometerCapacitySelect');
            const insideMicrometerCountSelect = $('#insideMicrometerCountSelect');
            const mikropipetDispensetCountSelect = $('#mikropipetDispensetCountSelect');
            const conductivityMeterCountSelect = $('#conductivityMeterCountSelect');
            const thermometerCountSelect = $('#thermometerCountSelect');
            const utmCountSelect = $('#utmCountSelect');
            const anakTimbanganCountSelect = $('#anakTimbanganCountSelect');
            const feelerGaugeCountSelect = $('#feelerGaugeCountSelect');
            const centrifugeCountSelect = $('#centrifugeCountSelect');
            const thermoIndicatorCountSelect = $('#thermoIndicatorCountSelect');
            const outsideMicrometerCapacitySelect = $('#outsideMicrometerCapacitySelect');
            const outsideMicrometerCountSelect = $('#outsideMicrometerCountSelect');
            const pinGaugeCapacitySelect = $('#pinGaugeCapacitySelect');
            const pinGaugeCountSelect = $('#pinGaugeCountSelect');
            const ultrasonicThicknessGaugeCountSelect = $('#ultrasonicThicknessGaugeCountSelect');
            const depthMicrometerCapacitySelect = $('#depthMicrometerCapacitySelect');
            const depthMicrometerCountSelect = $('#depthMicrometerCountSelect');
            const dialResolutionSelect = $('#dialresolutionSelect');
            const caliperResolutionSelect = $('#caliperresolutionSelect');
            const caliperCountSelect = $('#caliperCountSelect');
            const enclosureRepetitionSelect = $('#enclosureRepetitionSelect');
            const chamberRepetitionSelect = $('#chamberRepetitionSelect');
            const chamberCountSelect = $('#chamberCountSelect');
            const thermohygrometerTypeSelect = $('#thermohygrometerTypeSelect');
            const timbanganTypeSelect = $('#timbanganTypeSelect');
            const timbanganCountSelect = $('#timbanganCountSelect');
            const insulationTypeSelect = $('#insulationTypeSelect');

            const insideMicrometerCapacityWrapper = document.getElementById('insideMicrometerCapacityWrapper');
            const insideMicrometerCountWrapper = document.getElementById('insideMicrometerCountWrapper');
            const mikropipetDispensetCountWrapper = document.getElementById('mikropipetDispensetCountWrapper');
            const conductivityMeterCountWrapper = document.getElementById('conductivityMeterCountWrapper');
            const thermometerCountWrapper = document.getElementById('thermometerCountWrapper');
            const utmCountWrapper = document.getElementById('utmCountWrapper');
            const anakTimbanganCountWrapper = document.getElementById('anakTimbanganCountWrapper');
            const feelerGaugeCountWrapper = document.getElementById('feelerGaugeCountWrapper');
            const centrifugeCountWrapper = document.getElementById('centrifugeCountWrapper');
            const thermoIndicatorCountWrapper = document.getElementById('thermoIndicatorCountWrapper');
            const outsideMicrometerCapacityWrapper = document.getElementById('outsideMicrometerCapacityWrapper');
            const outsideMicrometerCountWrapper = document.getElementById('outsideMicrometerCountWrapper');
            const pinGaugeCapacityWrapper = document.getElementById('pinGaugeCapacityWrapper');
            const pinGaugeCountWrapper = document.getElementById('pinGaugeCountWrapper');
            const ultrasonicThicknessGaugeCountWrapper = document.getElementById('ultrasonicThicknessGaugeCountWrapper');
            const depthMicrometerCapacityWrapper = document.getElementById('depthMicrometerCapacityWrapper');
            const depthMicrometerCountWrapper = document.getElementById('depthMicrometerCountWrapper');
            const dialResolutionWrapper = document.getElementById('dialResolutionWrapper');
            const caliperResolutionWrapper = document.getElementById('caliperResolutionWrapper');
            const caliperCountWrapper = document.getElementById('caliperCountWrapper');
            const enclosureRepetitionWrapper = document.getElementById('enclosureRepetitionWrapper');
            const chamberRepetitionWrapper = document.getElementById('chamberRepetitionWrapper');
            const chamberCountWrapper = document.getElementById('chamberCountWrapper');
            const thermohygrometerTypeWrapper = document.getElementById('thermohygrometerTypeWrapper');
            const timbanganTypeWrapper = document.getElementById('timbanganTypeWrapper');
            const timbanganCountWrapper = document.getElementById('timbanganCountWrapper');
            const insulationTypeWrapper = document.getElementById('insulationTypeWrapper');

            const wrappers = {
                'inside_micrometer': insideMicrometerCapacityWrapper,
                'outside_micrometer': outsideMicrometerCapacityWrapper,
                'depth_micrometer': depthMicrometerCapacityWrapper,
                'dial_indicator': dialResolutionWrapper,
                'dial_test_indicator': dialResolutionWrapper,
                'caliper': caliperResolutionWrapper,
                'enclosure': enclosureRepetitionWrapper,
                'chamber': chamberRepetitionWrapper,
                'thermohygrometer': thermohygrometerTypeWrapper,
                'timbangan': timbanganTypeWrapper,
                'insulation': insulationTypeWrapper
            };


            // ==========================================
            // FUNGSI SAVE & RESTORE DATA FORM YANG LEBIH HANDAL
            // ==========================================

            // // Objek untuk menyimpan data sementara
            // let tempFormData = {
            //     'nama_alat': '',
            //     'nama_alat_manual': '',
            //     'merek': '',
            //     'kode_alat': '',
            //     'type_alat': '',
            //     'no_seri': '',
            //     'rentang_ukur_min': '',
            //     'rentang_ukur_max': '',
            //     'kapasitas': '',
            //     'resolusi': '',
            //     'nama_pemilik': '',
            //     'tanggal_alat_masuk': '',
            //     'tanggal_kalibrasi': '',
            //     'tempat_kalibrasi': '',
            //     'jenis_pembacaan': '',
            //     'fungsi_komponen': '',
            //     'keterangan_fungsi_komponen': '',
            //     'suhu_awal': '',
            //     'suhu_tengah': '',
            //     'suhu_akhir': '',
            //     'rh_awal': '',
            //     'rh_tengah': '',
            //     'rh_akhir': ''
            // };

            // ==========================================
            // FUNGSI SAVE & RESTORE DATA FORM YANG HANDAL
            // ==========================================

            // ==========================================
            // GANTI tempFormData menjadi object per tab
            // ==========================================
            let tempFormDataStore = {}; // { tabId: { field: value } }
            let isRestoring = false;

            //             function saveCurrentFormData(tabId) {
            //     if (isRestoring) return;

            //     const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            //     if (!container) {
            //         console.warn('⚠️ Container tidak ditemukan untuk save');
            //         return;
            //     }

            //     console.log(`💾 Menyimpan data form untuk tab ${tabId}`);

            //     if (!tempFormDataStore[tabId]) {
            //         tempFormDataStore[tabId] = {};
            //     }

            //     tempFormDataStore[tabId] = {};

            //     // 🔥 SIMPAN NAMA ALAT (SELECT DROPDOWN)
            //     const selectNamaAlat = container.querySelector('select[name="nama_alat"]');
            //     if (selectNamaAlat && selectNamaAlat.value) {
            //         tempFormDataStore[tabId]['nama_alat'] = selectNamaAlat.value;
            //         console.log(`✅ [Tab ${tabId}] Tersimpan nama_alat: ${selectNamaAlat.value}`);
            //     }

            //     // 🔥 SIMPAN NAMA ALAT MANUAL (jika ada)
            //     const manualInput = container.querySelector('input[name="nama_alat_manual"]');
            //     if (manualInput && manualInput.value) {
            //         tempFormDataStore[tabId]['nama_alat_manual'] = manualInput.value;
            //         console.log(`✅ [Tab ${tabId}] Tersimpan nama_alat_manual: ${manualInput.value}`);
            //     }

            //     // 🔥 SIMPAN FIELD LAINNYA
            //     const allInputs = container.querySelectorAll('input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]), select');
            //     allInputs.forEach(input => {
            //         if (input.name && input.value && input.value !== '') {
            //             if (input.name === 'nama_alat' || input.name === 'nama_alat_manual') return;
            //             tempFormDataStore[tabId][input.name] = input.value;
            //             console.log(`✅ [Tab ${tabId}] Tersimpan: ${input.name} = ${input.value}`);
            //         }
            //     });

            //     // 🔥 SIMPAN RADIO BUTTON
            //     const radioButtons = container.querySelectorAll('input[type="radio"]');
            //     radioButtons.forEach(radio => {
            //         if (radio.checked) {
            //             tempFormDataStore[tabId][radio.name] = radio.value;
            //             console.log(`✅ [Tab ${tabId}] Tersimpan radio: ${radio.name} = ${radio.value}`);
            //         }
            //     });

            //     // 🔥 SIMPAN CHECKBOX
            //     const checkboxes = container.querySelectorAll('input[type="checkbox"]');
            //     checkboxes.forEach(checkbox => {
            //         if (checkbox.checked) {
            //             if (!tempFormDataStore[tabId][checkbox.name]) {
            //                 tempFormDataStore[tabId][checkbox.name] = [];
            //             }
            //             if (Array.isArray(tempFormDataStore[tabId][checkbox.name])) {
            //                 tempFormDataStore[tabId][checkbox.name].push(checkbox.value);
            //             }
            //         }
            //     });

            //     console.log(`💾 [Tab ${tabId}] Total data tersimpan:`, Object.keys(tempFormDataStore[tabId]).length);
            // }




            // function restoreSavedFormData(tabId) {
            //             return new Promise((resolve) => {
            //                 const tabData = tempFormDataStore[tabId] || {};

            //                 if (Object.keys(tabData).length === 0) {
            //                     console.log(`ℹ️ [Tab ${tabId}] Tidak ada data yang tersimpan`);
            //                     resolve(false);
            //                     return;
            //                 }

            //                 console.log(`🔄 Mengembalikan data form untuk tab ${tabId}`, tabData);

            //                 let attempts = 0;
            //                 const maxAttempts = 30;

            //                 const checkAndRestore = setInterval(() => {
            //                     attempts++;
            //                     const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);

            //                     if (!container) {
            //                         if (attempts >= maxAttempts) {
            //                             clearInterval(checkAndRestore);
            //                             resolve(false);
            //                         }
            //                         return;
            //                     }

            //                     // Cek apakah form sudah siap
            //                     const isReady = container.querySelector('input[name="merek"]') !== null ||
            //                                   container.querySelector('select[name="nama_alat"]') !== null ||
            //                                   container.querySelector('form') !== null;

            //                     if (isReady || attempts >= maxAttempts) {
            //                         clearInterval(checkAndRestore);
            //                         console.log(`🔄 [Tab ${tabId}] Form siap, restoring...`);

            //                         isRestoring = true;

            //                         // ========================================
            //                         // KHUSUS UNTUK NAMA ALAT
            //                         // ========================================
            //                         if (tabData['nama_alat'] !== undefined) {
            //                             // Cari select nama_alat
            //                             let namaAlatSelect = container.querySelector('select[name="nama_alat"]');
            //                             if (!namaAlatSelect) {
            //                                 namaAlatSelect = container.querySelector(`select[id*="nama_alat_select"][id*="_tab${tabId}"]`);
            //                             }

            //                             if (namaAlatSelect) {
            //                                 const selectedValue = tabData['nama_alat'];
            //                                 console.log(`📌 [Tab ${tabId}] Setting select to: ${selectedValue}`);

            //                                 // Set value select
            //                                 namaAlatSelect.value = selectedValue;

            //                                 // 🔥 FORCE trigger change event untuk memunculkan manual input jika perlu
            //                                 const changeEvent = new Event('change', { bubbles: true });
            //                                 namaAlatSelect.dispatchEvent(changeEvent);

            //                                 // 🔥 Jika nilai adalah MANUAL_INPUT, isi input manualnya
            //                                 if (selectedValue === 'MANUAL_INPUT' && tabData['nama_alat_manual']) {
            //                                     // Tunggu DOM update karena change event akan menampilkan manual container
            //                                     setTimeout(async () => {
            //                                         // Cari input manual
            //                                         let manualInput = container.querySelector('input[name="nama_alat_manual"]');
            //                                         if (!manualInput) {
            //                                             manualInput = container.querySelector(`input[id*="nama_alat_manual"][id*="_tab${tabId}"]`);
            //                                         }

            //                                         if (manualInput) {
            //                                             manualInput.value = tabData['nama_alat_manual'];
            //                                             manualInput.dispatchEvent(new Event('input', { bubbles: true }));
            //                                             manualInput.dispatchEvent(new Event('change', { bubbles: true }));
            //                                             console.log(`✅ [Tab ${tabId}] Manual input diisi: ${tabData['nama_alat_manual']}`);
            //                                         } else {
            //                                             console.warn(`⚠️ [Tab ${tabId}] Manual input tidak ditemukan, coba lagi...`);
            //                                             // Coba lagi setelah delay lebih lama
            //                                             setTimeout(() => {
            //                                                 const manualInputRetry = container.querySelector('input[name="nama_alat_manual"]');
            //                                                 if (manualInputRetry) {
            //                                                     manualInputRetry.value = tabData['nama_alat_manual'];
            //                                                     manualInputRetry.dispatchEvent(new Event('input', { bubbles: true }));
            //                                                     manualInputRetry.dispatchEvent(new Event('change', { bubbles: true }));
            //                                                     console.log(`✅ [Tab ${tabId}] Manual input diisi (retry): ${tabData['nama_alat_manual']}`);
            //                                                 }
            //                                             }, 500);
            //                                         }
            //                                     }, 300);
            //                                 }
            //                             }
            //                         }

            //                         // Kembalikan field lainnya setelah delay yang cukup
            //                         setTimeout(() => {
            //                             // 🔥 KEMBALIKAN SEMUA INPUT TEXT (kecuali nama_alat_manual karena sudah ditangani)
            //                             Object.keys(tabData).forEach(name => {
            //                                 if (name === 'nama_alat' || name === 'nama_alat_manual') return;
            //                                 if (name === '_token' || name === 'form_type') return;

            //                                 let inputs = container.querySelectorAll(`[name="${name}"]`);
            //                                 if (inputs.length === 0) {
            //                                     inputs = container.querySelectorAll(`[id*="${name}"][id*="_tab${tabId}"]`);
            //                                 }

            //                                 inputs.forEach(input => {
            //                                     if (input.type !== 'radio' && input.type !== 'checkbox') {
            //                                         input.value = tabData[name];
            //                                         input.dispatchEvent(new Event('input', { bubbles: true }));
            //                                         input.dispatchEvent(new Event('change', { bubbles: true }));
            //                                         console.log(`✅ [Tab ${tabId}] Dikembalikan: ${name} = ${tabData[name]}`);
            //                                     }
            //                                 });
            //                             });

            //                             // 🔥 KEMBALIKAN RADIO BUTTON
            //                             const radioNames = ['tempat_kalibrasi', 'fungsi_komponen'];
            //                             radioNames.forEach(radioName => {
            //                                 if (tabData[radioName]) {
            //                                     const radio = container.querySelector(`input[name="${radioName}"][value="${tabData[radioName]}"]`);
            //                                     if (radio) {
            //                                         radio.checked = true;
            //                                         radio.dispatchEvent(new Event('change', { bubbles: true }));
            //                                         console.log(`✅ [Tab ${tabId}] Radio ${radioName} = ${tabData[radioName]}`);
            //                                     }
            //                                 }
            //                             });

            //                             // 🔥 KEMBALIKAN CHECKBOX
            //                             if (tabData['alat_standar'] && Array.isArray(tabData['alat_standar'])) {
            //                                 const checkboxes = container.querySelectorAll('input[name="alat_standar[]"]');
            //                                 checkboxes.forEach(checkbox => {
            //                                     if (tabData['alat_standar'].includes(checkbox.value)) {
            //                                         checkbox.checked = true;
            //                                         checkbox.dispatchEvent(new Event('change', { bubbles: true }));
            //                                     }
            //                                 });
            //                             }

            //                             isRestoring = false;
            //                             resolve(true);
            //                         }, 600); // Delay lebih panjang (600ms)
            //                     }
            //                 }, 300);
            //             });
            //         }

            function saveCurrentFormData(tabId) {
                if (isRestoring) return;

                const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
                if (!container) {
                    console.warn('⚠️ Container tidak ditemukan untuk save');
                    return;
                }

                console.log(`💾 Menyimpan data form untuk tab ${tabId}`);

                if (!tempFormDataStore[tabId]) {
                    tempFormDataStore[tabId] = {};
                }

                // 🔥 JANGAN RESET SEMUA DATA

                // 🔥 KHUSUS UNTUK DIAL INDICATOR - SIMPAN RESOLUTION
                const resolutionInput = container.querySelector('input[name="resolution"], select[name="resolution"]');
                if (resolutionInput && resolutionInput.value) {
                    tempFormDataStore[tabId]['resolution'] = resolutionInput.value;
                    console.log(`✅ [Tab ${tabId}] Tersimpan resolution: ${resolutionInput.value}`);
                }

                // 🔥 SIMPAN NAMA ALAT
                const selectNamaAlat = container.querySelector('select[name="nama_alat"]');
                if (selectNamaAlat && selectNamaAlat.value) {
                    tempFormDataStore[tabId]['nama_alat'] = selectNamaAlat.value;
                    console.log(`✅ [Tab ${tabId}] Tersimpan nama_alat: ${selectNamaAlat.value}`);
                }

                // 🔥 SIMPAN NAMA ALAT MANUAL
                const manualInput = container.querySelector('input[name="nama_alat_manual"]');
                if (manualInput && manualInput.value) {
                    tempFormDataStore[tabId]['nama_alat_manual'] = manualInput.value;
                    console.log(`✅ [Tab ${tabId}] Tersimpan nama_alat_manual: ${manualInput.value}`);
                }

                // 🔥 SIMPAN FIELD LAINNYA (KECUALI PENUNJUKAN JIKA RESOLUTION BERBEDA)
                const currentResolution = tempFormDataStore[tabId]['resolution'];
                const allInputs = container.querySelectorAll('input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]), select');

                allInputs.forEach(input => {
                    if (input.name && input.value && input.value !== '') {
                        // Skip nama_alat dan manual (sudah ditangani)
                        if (input.name === 'nama_alat' || input.name === 'nama_alat_manual') return;
                        if (input.name === 'resolution') return;

                        // 🔥 UNTUK PENUNJUKAN, CEK APAKAH RESOLUTION SUDAH SESUAI
                        if (input.name === 'penunjukanAlat[]' || input.name === 'penunjukanAlat') {
                            // Cek apakah nilai penunjukan valid untuk resolution saat ini
                            // Jika resolution adalah 0.001, nilai seperti 0.0, 0.1 valid
                            // Tapi jika tiba-tiba ada nilai 50, itu tidak valid
                            const numValue = parseFloat(input.value);
                            if (currentResolution === '0.001' && numValue > 10) {
                                console.log(`⚠️ [Tab ${tabId}] Skip menyimpan penunjukan tidak valid: ${input.value}`);
                                return;
                            }
                        }

                        tempFormDataStore[tabId][input.name] = input.value;
                        console.log(`✅ [Tab ${tabId}] Tersimpan: ${input.name} = ${input.value}`);
                    }
                });

                // 🔥 SIMPAN RADIO BUTTON
                const radioButtons = container.querySelectorAll('input[type="radio"]');
                radioButtons.forEach(radio => {
                    if (radio.checked) {
                        tempFormDataStore[tabId][radio.name] = radio.value;
                        console.log(`✅ [Tab ${tabId}] Tersimpan radio: ${radio.name} = ${radio.value}`);
                    }
                });

                // 🔥 SIMPAN CHECKBOX
                const checkboxes = container.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        if (!tempFormDataStore[tabId][checkbox.name]) {
                            tempFormDataStore[tabId][checkbox.name] = [];
                        }
                        if (Array.isArray(tempFormDataStore[tabId][checkbox.name])) {
                            tempFormDataStore[tabId][checkbox.name].push(checkbox.value);
                        }
                    }
                });

                console.log(`💾 [Tab ${tabId}] Total data tersimpan:`, Object.keys(tempFormDataStore[tabId]).length);
            }


            function restoreSavedFormData(tabId) {
                return new Promise((resolve) => {
                    const tabData = tempFormDataStore[tabId] || {};

                    if (Object.keys(tabData).length === 0) {
                        console.log(`ℹ️ [Tab ${tabId}] Tidak ada data yang tersimpan`);
                        resolve(false);
                        return;
                    }

                    console.log(`🔄 Mengembalikan data form untuk tab ${tabId}`, tabData);

                    let attempts = 0;
                    const maxAttempts = 30;

                    const checkAndRestore = setInterval(() => {
                        attempts++;
                        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);

                        if (!container) {
                            if (attempts >= maxAttempts) {
                                clearInterval(checkAndRestore);
                                resolve(false);
                            }
                            return;
                        }

                        const isReady = container.querySelector('input[name="merek"]') !== null ||
                            container.querySelector('select[name="nama_alat"]') !== null ||
                            container.querySelector('form') !== null;

                        if (isReady || attempts >= maxAttempts) {
                            clearInterval(checkAndRestore);
                            console.log(`🔄 [Tab ${tabId}] Form siap, restoring...`);

                            isRestoring = true;

                            // ========================================
                            // KHUSUS UNTUK RESOLUTION DIAL INDICATOR
                            // ========================================
                            const currentFormType = container.getAttribute('data-current-form');
                            if (tabData['resolution'] && (currentFormType === 'dial_indicator' || currentFormType === 'dial_test_indicator')) {
                                console.log(`📌 [Tab ${tabId}] Setting resolution to: ${tabData['resolution']}`);

                                let resolutionInput = container.querySelector('input[name="resolution"], select[name="resolution"]');
                                if (resolutionInput) {
                                    resolutionInput.value = tabData['resolution'];
                                    resolutionInput.dispatchEvent(new Event('change', {
                                        bubbles: true
                                    }));
                                }
                            }

                            // ========================================
                            // KHUSUS UNTUK NAMA ALAT
                            // ========================================
                            if (tabData['nama_alat'] !== undefined) {
                                let namaAlatSelect = container.querySelector('select[name="nama_alat"]');
                                if (!namaAlatSelect) {
                                    namaAlatSelect = container.querySelector(`select[id*="nama_alat_select"][id*="_tab${tabId}"]`);
                                }

                                if (namaAlatSelect) {
                                    const selectedValue = tabData['nama_alat'];
                                    console.log(`📌 [Tab ${tabId}] Setting select to: ${selectedValue}`);

                                    namaAlatSelect.value = selectedValue;
                                    const changeEvent = new Event('change', {
                                        bubbles: true
                                    });
                                    namaAlatSelect.dispatchEvent(changeEvent);

                                    if (selectedValue === 'MANUAL_INPUT' && tabData['nama_alat_manual']) {
                                        setTimeout(async () => {
                                            let manualInput = container.querySelector('input[name="nama_alat_manual"]');
                                            if (!manualInput) {
                                                manualInput = container.querySelector(`input[id*="nama_alat_manual"][id*="_tab${tabId}"]`);
                                            }

                                            if (manualInput) {
                                                manualInput.value = tabData['nama_alat_manual'];
                                                manualInput.dispatchEvent(new Event('input', {
                                                    bubbles: true
                                                }));
                                                manualInput.dispatchEvent(new Event('change', {
                                                    bubbles: true
                                                }));
                                                console.log(`✅ [Tab ${tabId}] Manual input diisi: ${tabData['nama_alat_manual']}`);
                                            }
                                        }, 300);
                                    }
                                }
                            }

                            setTimeout(() => {
                                // 🔥 SKIP FIELD REPETITION AGAR TIDAK DI-RESTORE
                                Object.keys(tabData).forEach(name => {
                                    if (name === 'nama_alat' || name === 'nama_alat_manual') return;
                                    if (name === '_token' || name === 'form_type') return;
                                    if (name === 'resolution') return;
                                    // 🔥 TAMBAHKAN INI - JANGAN RESTORE REPETITION
                                    if (name === 'repetition') return;
                                    if (name === 'jumlah_form') return;
                                    if (name === 'form_index') return;
                                    if (name === 'type') return;


                                    // 🔥 CEK UNTUK PENUNJUKAN - JANGAN RESTORE JIKA NILAI TIDAK VALID
                                    if (name === 'penunjukanAlat[]' || name === 'penunjukanAlat') {
                                        const currentResolution = tabData['resolution'] || container.querySelector('input[name="resolution"]')?.value;
                                        const numValue = parseFloat(tabData[name]);

                                        // Jika resolution 0.001 dan nilai penunjukan > 10, skip (tidak valid)
                                        if (currentResolution === '0.001' && numValue > 10) {
                                            console.log(`⚠️ [Tab ${tabId}] Skip restore penunjukan tidak valid: ${tabData[name]}`);
                                            return;
                                        }
                                        // Jika resolution 0.01 dan nilai penunjukan > 100, skip
                                        if (currentResolution === '0.01' && numValue > 100) {
                                            console.log(`⚠️ [Tab ${tabId}] Skip restore penunjukan tidak valid: ${tabData[name]}`);
                                            return;
                                        }
                                    }

                                    let inputs = container.querySelectorAll(`[name="${name}"]`);
                                    if (inputs.length === 0) {
                                        inputs = container.querySelectorAll(`[id*="${name}"][id*="_tab${tabId}"]`);
                                    }

                                    inputs.forEach(input => {
                                        if (input.type !== 'radio' && input.type !== 'checkbox') {
                                            input.value = tabData[name];
                                            input.dispatchEvent(new Event('input', {
                                                bubbles: true
                                            }));
                                            input.dispatchEvent(new Event('change', {
                                                bubbles: true
                                            }));
                                            console.log(`✅ [Tab ${tabId}] Dikembalikan: ${name} = ${tabData[name]}`);
                                        }
                                    });
                                });

                                // Kembalikan radio button
                                const radioNames = ['tempat_kalibrasi', 'fungsi_komponen'];
                                radioNames.forEach(radioName => {
                                    if (tabData[radioName]) {
                                        const radio = container.querySelector(`input[name="${radioName}"][value="${tabData[radioName]}"]`);
                                        if (radio) {
                                            radio.checked = true;
                                            radio.dispatchEvent(new Event('change', {
                                                bubbles: true
                                            }));
                                        }
                                    }
                                });

                                // Kembalikan checkbox
                                if (tabData['alat_standar'] && Array.isArray(tabData['alat_standar'])) {
                                    const checkboxes = container.querySelectorAll('input[name="alat_standar[]"]');
                                    checkboxes.forEach(checkbox => {
                                        if (tabData['alat_standar'].includes(checkbox.value)) {
                                            checkbox.checked = true;
                                            checkbox.dispatchEvent(new Event('change', {
                                                bubbles: true
                                            }));
                                        }
                                    });
                                }

                                isRestoring = false;
                                resolve(true);
                            }, 600);
                        }
                    }, 300);
                });
            }

            // Fungsi utama untuk mengembalikan data
            function doRestoreData(tabId, container) {
                console.log('🔄 Mengembalikan data form...');

                // 🔥 KHUSUS UNTUK NAMA ALAT (DROPDOWN SELECT)
                if (tempFormData['nama_alat'] && tempFormData['nama_alat'] !== '') {
                    let namaAlatSelect = container.querySelector('select[name="nama_alat"]');
                    if (!namaAlatSelect) {
                        namaAlatSelect = container.querySelector('select[id*="nama_alat_select"]');
                    }

                    if (namaAlatSelect) {
                        // Cek apakah nilai ada di option
                        let optionExists = false;
                        for (let i = 0; i < namaAlatSelect.options.length; i++) {
                            if (namaAlatSelect.options[i].value === tempFormData['nama_alat']) {
                                optionExists = true;
                                break;
                            }
                        }

                        if (optionExists) {
                            namaAlatSelect.value = tempFormData['nama_alat'];
                            namaAlatSelect.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                            console.log('✅ Nama alat (dropdown) dikembalikan:', tempFormData['nama_alat']);
                        } else {
                            // Pilih MANUAL_INPUT
                            namaAlatSelect.value = 'MANUAL_INPUT';
                            namaAlatSelect.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                            console.log('📌 Select diubah ke MANUAL_INPUT');

                            // Tunggu input manual muncul
                            setTimeout(() => {
                                const manualInput = container.querySelector('input[name="nama_alat_manual"]');
                                if (manualInput) {
                                    const nilaiManual = tempFormData['nama_alat_manual'] || tempFormData['nama_alat'];
                                    manualInput.value = nilaiManual;
                                    manualInput.dispatchEvent(new Event('input', {
                                        bubbles: true
                                    }));
                                    manualInput.dispatchEvent(new Event('change', {
                                        bubbles: true
                                    }));
                                    console.log('✅ Nama alat manual dikembalikan:', nilaiManual);
                                }
                            }, 200);
                        }
                    }
                }

                // Field-field lainnya
                const fieldsToRestore = [
                    'merek', 'kode_alat', 'type_alat', 'no_seri',
                    'rentang_ukur_min', 'rentang_ukur_max', 'kapasitas', 'resolusi',
                    'nama_pemilik', 'tanggal_alat_masuk', 'tanggal_kalibrasi',
                    'jenis_pembacaan', 'keterangan_fungsi_komponen',
                    'suhu_awal', 'suhu_tengah', 'suhu_akhir',
                    'rh_awal', 'rh_tengah', 'rh_akhir'
                ];

                fieldsToRestore.forEach(field => {
                    if (tempFormData[field] && tempFormData[field] !== '') {
                        let input = container.querySelector(`[name="${field}"]`);
                        if (!input) {
                            input = container.querySelector(`[name="form_1_${field}"]`);
                        }
                        if (input && input.type !== 'radio' && input.type !== 'checkbox') {
                            input.value = tempFormData[field];
                            input.dispatchEvent(new Event('input', {
                                bubbles: true
                            }));
                            input.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                        }
                    }
                });

                // Kembalikan radio button
                if (tempFormData['tempat_kalibrasi']) {
                    const tempatRadio = container.querySelector(`input[name="tempat_kalibrasi"][value="${tempFormData['tempat_kalibrasi']}"]`);
                    if (tempatRadio) {
                        tempatRadio.checked = true;
                        tempatRadio.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    }
                }

                if (tempFormData['fungsi_komponen']) {
                    const kondisiRadio = container.querySelector(`input[name="fungsi_komponen"][value="${tempFormData['fungsi_komponen']}"]`);
                    if (kondisiRadio) {
                        kondisiRadio.checked = true;
                        kondisiRadio.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    }
                }

                console.log('✅ Data berhasil dikembalikan');
            }

            // Event change untuk formSelect
            formSelect.off('change').on('change', function(e, data) {
                if (isSyncing && (!data || !data.isSync)) return;
                const val = $(this).val();

                // Jika pergantian manual (bukan proses restore/sync), bersihkan tempFormDataStore
                if (!isSyncing && (!data || !data.isSync)) {
                    const activeTabId = typeof getActiveTabId === 'function' ? getActiveTabId() : activeLkId;
                    if (tempFormDataStore[activeTabId]) {
                        console.log(`🧹 Membersihkan tempFormDataStore untuk tab ${activeTabId} karena form type berubah manual.`);
                        tempFormDataStore[activeTabId] = {};
                    }
                }

                // Sembunyikan semua wrapper terlebih dahulu
                if (insideMicrometerCapacityWrapper) insideMicrometerCapacityWrapper.style.display = 'none';
                if (insideMicrometerCountWrapper) insideMicrometerCountWrapper.style.display = 'none';
                if (mikropipetDispensetCountWrapper) mikropipetDispensetCountWrapper.style.display = 'none';
                if (conductivityMeterCountWrapper) conductivityMeterCountWrapper.style.display = 'none';
                if (thermometerCountWrapper) thermometerCountWrapper.style.display = 'none';
                if (utmCountWrapper) utmCountWrapper.style.display = 'none';
                if (anakTimbanganCountWrapper) anakTimbanganCountWrapper.style.display = 'none';
                if (feelerGaugeCountWrapper) feelerGaugeCountWrapper.style.display = 'none';
                if (centrifugeCountWrapper) centrifugeCountWrapper.style.display = 'none';
                if (thermoIndicatorCountWrapper) thermoIndicatorCountWrapper.style.display = 'none';
                if (outsideMicrometerCapacityWrapper) outsideMicrometerCapacityWrapper.style.display = 'none';
                if (outsideMicrometerCountWrapper) outsideMicrometerCountWrapper.style.display = 'none';
                if (pinGaugeCapacityWrapper) pinGaugeCapacityWrapper.style.display = 'none';
                if (pinGaugeCountWrapper) pinGaugeCountWrapper.style.display = 'none';
                if (ultrasonicThicknessGaugeCountWrapper) ultrasonicThicknessGaugeCountWrapper.style.display = 'none';
                if (depthMicrometerCapacityWrapper) depthMicrometerCapacityWrapper.style.display = 'none';
                if (depthMicrometerCountWrapper) depthMicrometerCountWrapper.style.display = 'none';
                if (dialResolutionWrapper) dialResolutionWrapper.style.display = 'none';
                if (caliperResolutionWrapper) caliperResolutionWrapper.style.display = 'none';
                if (caliperCountWrapper) caliperCountWrapper.style.display = 'none';
                if (enclosureRepetitionWrapper) enclosureRepetitionWrapper.style.display = 'none';
                if (chamberRepetitionWrapper) chamberRepetitionWrapper.style.display = 'none';
                if (chamberCountWrapper) chamberCountWrapper.style.display = 'none';
                if (thermohygrometerTypeWrapper) thermohygrometerTypeWrapper.style.display = 'none';
                if (insulationTypeWrapper) insulationTypeWrapper.style.display = 'none';
                if (timbanganTypeWrapper) timbanganTypeWrapper.style.display = 'none';
                if (timbanganCountWrapper) timbanganCountWrapper.style.display = 'none';

                if (insulationTypeSelect) insulationTypeSelect.prop('required', false);

                // Reset required untuk semua select
                if (insideMicrometerCapacitySelect) insideMicrometerCapacitySelect.prop('required', false);
                if (outsideMicrometerCapacitySelect) outsideMicrometerCapacitySelect.prop('required', false);
                if (depthMicrometerCapacitySelect) depthMicrometerCapacitySelect.prop('required', false);
                if (dialResolutionSelect) dialResolutionSelect.prop('required', false);
                if (caliperResolutionSelect) caliperResolutionSelect.prop('required', false);
                if (enclosureRepetitionSelect) enclosureRepetitionSelect.prop('required', false);
                if (chamberRepetitionSelect) chamberRepetitionSelect.prop('required', false);
                if (thermohygrometerTypeSelect) thermohygrometerTypeSelect.prop('required', false);
                if (timbanganTypeSelect) timbanganTypeSelect.prop('required', false);
                if (insulationTypeSelect) insulationTypeSelect.prop('required', false);

                // Reset nilai jika tidak dipilih — SKIP saat sync/restore
                if (!(data && data.isSync)) {
                    if (val !== 'inside_micrometer') {
                        if (insideMicrometerCapacitySelect) insideMicrometerCapacitySelect.val('').trigger('change');
                        if (insideMicrometerCountSelect) insideMicrometerCountSelect.val(1);
                    }

                    if (val !== 'mikropipet_dispenset') {
                        if (mikropipetDispensetCountSelect) mikropipetDispensetCountSelect.val(1);
                    }

                    if (val !== 'conductivity_meter') {
                        if (conductivityMeterCountSelect) conductivityMeterCountSelect.val(1);
                    }

                    if (val !== 'thermometer') {
                        if (thermometerCountSelect) thermometerCountSelect.val(1);
                    }
                    if (val !== 'utm') {
                        if (utmCountSelect) utmCountSelect.val(1);
                    }
                    if (val !== 'anak_timbangan' && val !== 'anak_timbang') {
                        if (anakTimbanganCountSelect) anakTimbanganCountSelect.val(1);
                    }

                    if (val !== 'feeler_gauge') {
                        if (feelerGaugeCountSelect) feelerGaugeCountSelect.val(1);
                    }

                    // if (val !== 'gauge_block') {
                    //     if (gaugeBlockCountSelect) gaugeBlockCountSelect.val(1);
                    // }

                    if (val !== 'centrifuge') {
                        if (centrifugeCountSelect) centrifugeCountSelect.val(1);
                    }

                    if (val !== 'thermoindicator') {
                        if (thermoIndicatorCountSelect) thermoIndicatorCountSelect.val(1);
                    }

                    if (val !== 'outside_micrometer') {
                        if (outsideMicrometerCapacitySelect) outsideMicrometerCapacitySelect.val('').trigger('change');
                        if (outsideMicrometerCountSelect) outsideMicrometerCountSelect.val(1);
                    }

                    if (val !== 'pin_gauge') {
                        if (pinGaugeCapacitySelect) pinGaugeCapacitySelect.val('').trigger('change');
                        if (pinGaugeCountSelect) pinGaugeCountSelect.val(1);
                    }
                    if (val !== 'depth_micrometer') {
                        if (depthMicrometerCapacitySelect) depthMicrometerCapacitySelect.val('').trigger('change');
                        if (depthMicrometerCountSelect) depthMicrometerCountSelect.val(1);
                    }
                    if (val !== 'dial_indicator' && val !== 'dial_test_indicator') {
                        if (dialResolutionSelect) dialResolutionSelect.val('').trigger('change');
                    }
                    if (val !== 'caliper') {
                        if (caliperResolutionSelect) caliperResolutionSelect.val('').trigger('change');
                        if (caliperCountSelect) caliperCountSelect.val(1);
                    }
                    if (val !== 'enclosure') {
                        if (enclosureRepetitionSelect) enclosureRepetitionSelect.val('1').trigger('change');
                    }
                    if (val !== 'chamber') {
                        if (chamberRepetitionSelect) chamberRepetitionSelect.val('1').trigger('change');
                        if (chamberCountSelect) chamberCountSelect.val(1);
                    }
                    if (val !== 'thermohygrometer') {
                        if (thermohygrometerTypeSelect) thermohygrometerTypeSelect.val('').trigger('change');
                    }
                    if (val !== 'timbangan') {
                        if (timbanganTypeSelect) timbanganTypeSelect.val('').trigger('change.select2');
                        if (timbanganCountSelect) timbanganCountSelect.val(1);
                    }
                    if (val !== 'insulation') {
                        if (insulationTypeSelect) insulationTypeSelect.val('').trigger('change.select2');
                    }
                }

                if (data && data.isSync) {
                    if (wrappers[val]) {
                        wrappers[val].style.display = 'block';
                    }
                    if (val === 'inside_micrometer' && insideMicrometerCountWrapper) {
                        insideMicrometerCountWrapper.style.display = 'block';
                    }
                    if (val === 'mikropipet_dispenset' && mikropipetDispensetCountWrapper) {
                        mikropipetDispensetCountWrapper.style.display = 'block';
                    }

                    if (val === 'conductivity_meter' && conductivityMeterCountWrapper) {
                        conductivityMeterCountWrapper.style.display = 'block';
                    }

                    if (val === 'thermometer' && thermometerCountWrapper) {
                        thermometerCountWrapper.style.display = 'block';
                    }

                    if (val === 'utm' && utmCountWrapper) {
                        utmCountWrapper.style.display = 'block';
                    }

                    if ((val === 'anak_timbangan' || val === 'anak_timbang') && anakTimbanganCountWrapper) {
                        anakTimbanganCountWrapper.style.display = 'block';
                    }
                    if (val === 'feeler_gauge' && feelerGaugeCountWrapper) {
                        feelerGaugeCountWrapper.style.display = 'block';
                    }
                    if (val === 'centrifuge' && centrifugeCountWrapper) {
                        centrifugeCountWrapper.style.display = 'block';
                    }
                    if (val === 'thermoindicator' && thermoIndicatorCountWrapper) {
                        thermoIndicatorCountWrapper.style.display = 'block';
                    }
                    if (val === 'outside_micrometer' && outsideMicrometerCountWrapper) {
                        outsideMicrometerCountWrapper.style.display = 'block';
                    }
                    if (val === 'pin_gauge' && pinGaugeCountWrapper) {
                        pinGaugeCountWrapper.style.display = 'block';
                    }
                    if (val === 'ultrasonic_thickness_gauge' && ultrasonicThicknessGaugeCountWrapper) {
                        ultrasonicThicknessGaugeCountWrapper.style.display = 'block';
                    }
                    if (val === 'depth_micrometer' && depthMicrometerCountWrapper) {
                        depthMicrometerCountWrapper.style.display = 'block';
                    }
                    if (val === 'caliper' && caliperCountWrapper) {
                        caliperCountWrapper.style.display = 'block';
                    }
                    if (val === 'timbangan' && timbanganCountWrapper) {
                        timbanganCountWrapper.style.display = 'block';
                    }
                    if (val === 'chamber' && chamberCountWrapper) {
                        chamberCountWrapper.style.display = 'block';
                    }
                    return;
                }


                // Handle each form type - PERBAIKAN DI SINI
                if (val === 'inside_micrometer') {
                    if (insideMicrometerCapacityWrapper) {
                        insideMicrometerCapacityWrapper.style.display = 'block';
                        if (insideMicrometerCapacitySelect) insideMicrometerCapacitySelect.prop('required', false);
                    }
                    if (insideMicrometerCountWrapper) {
                        insideMicrometerCountWrapper.style.display = 'block';
                    }
                    const capacity = insideMicrometerCapacitySelect.val() || '';
                    const insideCount = insideMicrometerCountSelect.val() || '1';
                    console.log(`📊 Loading inside_micrometer with capacity=${capacity}, count=${insideCount}`);
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            capacity: capacity,
                            count: insideCount
                        },
                        tab_id: getActiveTabId()
                    });
                    // PASTIKAN: formType, resolution, capacity, repetition, thermohygrometerType, timbanganType, insulationType, count
                    loadForm(val, null, capacity, null, null, null, null, insideCount);
                    return;
                }

                if (val === 'mikropipet_dispenset') {
                    if (mikropipetDispensetCountWrapper) {
                        mikropipetDispensetCountWrapper.style.display = 'block';
                    }
                    const mikropipetCount = mikropipetDispensetCountSelect.val() || '1';
                    console.log('📊 Loading Mikropipet Dispenset with count:', mikropipetCount);
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: mikropipetCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, mikropipetCount);
                    return;
                }

                if (val === 'conductivity_meter') {
                    if (conductivityMeterCountWrapper) {
                        conductivityMeterCountWrapper.style.display = 'block';
                    }
                    const condCount = conductivityMeterCountSelect.val() || '1';
                    console.log('📊 Loading Conductivity Meter with count:', condCount);
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: condCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, condCount);
                    return;
                }

                if (val === 'thermometer') {
                    if (thermometerCountWrapper) {
                        thermometerCountWrapper.style.display = 'block';
                    }
                    const thermometerCount = thermometerCountSelect.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: thermometerCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, thermometerCount);
                    return;
                }

                if (val === 'utm') {
                    if (utmCountWrapper) {
                        utmCountWrapper.style.display = 'block';
                    }
                    const utmCount = utmCountSelect.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: utmCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, utmCount);
                    return;
                }

                if (val === 'anak_timbangan' || val === 'anak_timbang') {
                    if (anakTimbanganCountWrapper) {
                        anakTimbanganCountWrapper.style.display = 'block';
                    }
                    const anakTimbanganCount = anakTimbanganCountSelect.val() || '1';

                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: anakTimbanganCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, anakTimbanganCount);
                    return;
                }

                if (val === 'feeler_gauge') {
                    if (feelerGaugeCountWrapper) {
                        feelerGaugeCountWrapper.style.display = 'block';
                    }
                    const feelerCount = feelerGaugeCountSelect.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: feelerCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, feelerCount);
                    return;
                }

                if (val === 'centrifuge') {
                    if (centrifugeCountWrapper) {
                        centrifugeCountWrapper.style.display = 'block';
                    }
                    const centrifugeCount = centrifugeCountSelect.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: centrifugeCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, centrifugeCount);
                    return;
                }

                if (val === 'thermoindicator') {
                    if (thermoIndicatorCountWrapper) {
                        thermoIndicatorCountWrapper.style.display = 'block';
                    }
                    const thermoinCount = thermoIndicatorCountSelect.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: thermoinCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, thermoinCount);
                    return;
                }

                if (val === 'outside_micrometer') {
                    if (outsideMicrometerCapacityWrapper) {
                        outsideMicrometerCapacityWrapper.style.display = 'block';
                        if (outsideMicrometerCapacitySelect) outsideMicrometerCapacitySelect.prop('required', false);
                    }
                    if (outsideMicrometerCountWrapper) {
                        outsideMicrometerCountWrapper.style.display = 'block';
                    }
                    const outsideCount = outsideMicrometerCountSelect.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: outsideCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, outsideCount);
                    return;
                }

                if (val === 'pin_gauge') {
                    if (pinGaugeCapacityWrapper) {
                        pinGaugeCapacityWrapper.style.display = 'block';
                        if (pinGaugeCapacitySelect) pinGaugeCapacitySelect.prop('required', false);
                    }
                    if (pinGaugeCountWrapper) {
                        pinGaugeCountWrapper.style.display = 'block';
                    }
                    const pinGaugeCount = pinGaugeCountSelect.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: pinGaugeCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, pinGaugeCount);
                    return;
                }

                if (val === 'ultrasonic_thickness_gauge') {
                    if (ultrasonicThicknessGaugeCountWrapper) {
                        ultrasonicThicknessGaugeCountWrapper.style.display = 'block';
                    }
                    const utgCount = ultrasonicThicknessGaugeCountSelect.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: utgCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, utgCount);
                    return;
                }


                if (val === 'depth_micrometer') {
                    if (depthMicrometerCapacityWrapper) {
                        depthMicrometerCapacityWrapper.style.display = 'block';
                        if (depthMicrometerCapacitySelect) depthMicrometerCapacitySelect.prop('required', false);
                    }
                    if (depthMicrometerCountWrapper) {
                        depthMicrometerCountWrapper.style.display = 'block';
                    }
                    const depthCount = depthMicrometerCountSelect.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            count: depthCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, null, null, null, null, depthCount);
                    return;
                }

                if (val === 'dial_indicator' || val === 'dial_test_indicator') {
                    if (dialResolutionWrapper) {
                        dialResolutionWrapper.style.display = 'block';
                        if (dialResolutionSelect) dialResolutionSelect.prop('required', true);
                    }
                    // 📋 LOG: User memilih form dengan sub-option (menunggu resolusi dipilih)
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            resolution: dialResolutionSelect?.val() || 'belum_dipilih'
                        },
                        tab_id: getActiveTabId()
                    });
                    const activeContainer = getActiveContainer();
                    if (activeContainer) {
                        activeContainer.innerHTML = '<div class="alert alert-warning fade-in"><i class="fas fa-exclamation-triangle mr-2"></i>Silakan pilih resolusi Dial Indicator.</div>';
                    }
                    return;
                }

                if (val === 'caliper') {
                    if (caliperResolutionWrapper) {
                        caliperResolutionWrapper.style.display = 'block';
                        if (caliperResolutionSelect) caliperResolutionSelect.prop('required', true);
                    }
                    if (caliperCountWrapper) {
                        caliperCountWrapper.style.display = 'block';
                    }

                    // 🔥 AMBIL NILAI CAPACITY DARI DROPDOWN
                    const capacity = caliperResolutionSelect.val();
                    const caliperCount = caliperCountSelect.val() || '1';

                    console.log('📊 Loading Caliper with capacity:', capacity);

                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            capacity: capacity || 'belum_dipilih',
                            count: caliperCount
                        },
                        tab_id: getActiveTabId()
                    });

                    // 🔥 PERBAIKAN: Parameter ke-3 adalah capacity
                    loadForm(val, null, capacity, null, null, null, null, caliperCount);
                    return;
                }

                if (val === 'enclosure') {
                    if (enclosureRepetitionWrapper) {
                        enclosureRepetitionWrapper.style.display = 'block';
                        if (enclosureRepetitionSelect) enclosureRepetitionSelect.prop('required', true);
                    }
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            repetition: enclosureRepetitionSelect?.val() || '1'
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, '1');
                    return;
                }

                if (val === 'chamber') {
                    if (chamberRepetitionWrapper) {
                        chamberRepetitionWrapper.style.display = 'block';
                    }
                    if (chamberCountWrapper) {
                        chamberCountWrapper.style.display = 'block';
                    }
                    const repetition = chamberRepetitionSelect?.val() || '1';
                    const chamberCount = chamberCountSelect?.val() || '1';
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            repetition: repetition,
                            count: chamberCount
                        },
                        tab_id: getActiveTabId()
                    });
                    loadForm(val, null, null, repetition, null, null, null, chamberCount);
                    return;
                }

                if (val === 'thermohygrometer') {
                    if (thermohygrometerTypeWrapper) {
                        thermohygrometerTypeWrapper.style.display = 'block';
                    }
                    // 🔥 AMBIL NILAI TYPE DARI DROPDOWN
                    // Jika tidak dipilih atau kosong, gunakan 'single'
                    let type = thermohygrometerTypeSelect?.val();
                    if (!type || type === '') {
                        type = 'single';
                    }
                    console.log('📊 Thermohygrometer type selected:', type);
                    // 📋 LOG: User memilih form dengan sub-option
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            type: type
                        },
                        tab_id: getActiveTabId()
                    });
                    // Kirim type sebagai parameter ke-6 (thermohygrometerType)
                    loadForm(val, null, null, null, type);
                    return;
                }

                if (val === 'timbangan') {
                    if (timbanganTypeWrapper) {
                        timbanganTypeWrapper.style.display = 'block';
                        if (timbanganTypeSelect) timbanganTypeSelect.prop('required', false);
                    }
                    const timbanganType = timbanganTypeSelect?.val() || 'standar';

                    // 🔥 PERBAIKAN: Jika moisture, ganti form_type menjadi 'timbangan_moisture'
                    let finalFormType = val;
                    if (timbanganType === 'moisture') {
                        finalFormType = 'timbangan_moisture';
                        console.log('📌 Moisture selected, using form_type: timbangan_moisture');

                        if (timbanganCountWrapper) {
                            timbanganCountWrapper.style.display = 'none';
                        }
                        // 📋 LOG: User memilih form dengan sub-option (moisture)
                        logFormActivity('select_form', {
                            form_type: finalFormType,
                            form_name: 'Timbangan Moisture',
                            metode: 'manual',
                            sub_option: {
                                timbangan_type: timbanganType
                            },
                            tab_id: getActiveTabId()
                        });
                        // 🔥 Kirim finalFormType yang sudah diubah
                        loadForm(finalFormType, null, null, null, null, timbanganType, null, 1);
                    } else {
                        if (timbanganCountWrapper) {
                            timbanganCountWrapper.style.display = 'block';
                        }
                        const timbanganCount = timbanganCountSelect?.val() || '1';
                        // 📋 LOG: User memilih form dengan sub-option
                        logFormActivity('select_form', {
                            form_type: val,
                            form_name: formNameMap[val] || val,
                            metode: 'manual',
                            sub_option: {
                                timbangan_type: timbanganType,
                                count: timbanganCount
                            },
                            tab_id: getActiveTabId()
                        });
                        // 🔥 Kirim form_type asli (timbangan)
                        loadForm(finalFormType, null, null, null, null, timbanganType, null, timbanganCount);
                    }
                    return;
                }

                if (val === 'insulation') {
                    if (insulationTypeWrapper) {
                        insulationTypeWrapper.style.display = 'block';
                        if (insulationTypeSelect) insulationTypeSelect.prop('required', false);
                    }
                    // 📋 LOG: User memilih form dengan sub-option (menunggu tipe dipilih)
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        sub_option: {
                            insulation_type: insulationTypeSelect?.val() || 'belum_dipilih'
                        },
                        tab_id: getActiveTabId()
                    });
                    // 🔥 JANGAN LANGSUNG LOAD FORM, TUNGGU USER MEMILIH TIPE DULU
                    const activeContainer = getActiveContainer();
                    if (activeContainer) {
                        // Tampilkan pesan untuk memilih tipe terlebih dahulu
                        activeContainer.innerHTML = `
                        <div class="alert alert-info fade-in text-center p-5">
                            <i class="fas fa-info-circle fa-3x mb-3"></i>
                            <h5>Pilih Tipe Insulation Terlebih Dahulu</h5>
                            <p class="mb-0">Silakan pilih tipe insulation dari dropdown di atas untuk memuat form.</p>
                        </div>
                    `;
                    }
                    return;
                }


                if (val) {
                    // 📋 LOG: User memilih form secara manual
                    logFormActivity('select_form', {
                        form_type: val,
                        form_name: formNameMap[val] || val,
                        metode: 'manual',
                        tab_id: getActiveTabId()
                    });
                    loadForm(val);
                } else {
                    const activeContainer = getActiveContainer();
                    if (activeContainer) {
                        const currentTabId = activeContainer.getAttribute('data-lk-id');
                        activeContainer.innerHTML = `
                         <div class="row fade-in">
                            <div class="col-md-6 mb-3">
                                <div class="border rounded p-4 bg-light text-center h-100 d-flex flex-column justify-content-center">
                                    <i class="fas fa-hand-pointer text-primary fa-3x mb-3"></i>
                                    <h5 class="text-primary">Pilih Manual</h5>
                                    <p class="text-muted">Pilih jenis alat ukur dari dropdown di atas untuk menampilkan form kalibrasi di tab ini.</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="border rounded p-4 text-center h-100 d-flex flex-column justify-content-center align-items-center bg-white shadow-sm hover-shadow transition-all">
                                    <h5 class="text-success mb-3"><i class="fas fa-qrcode mr-2"></i>Scan / Input ID Kalibrasi</h5>
                                    <p class="text-muted small mb-3">Scan QR Code dengan kamera atau ketik ID alat langsung di bawah.</p>
                                    <div id="scanner-wrapper-${currentTabId}" class="w-100 mb-3" style="display:none; max-width: 300px; margin: 0 auto;">
                                        <div id="reader-${currentTabId}" class="qr-reader-container w-100 overflow-hidden rounded border border-success" style="min-height: 250px;"></div>
                                    </div>
                                    <div class="d-flex justify-content-center gap-2 mb-3 w-100" style="max-width: 320px;">
                                        <button type="button" class="btn btn-success btn-start-scan flex-grow-1" data-target-tab="${currentTabId}">
                                            <i class="fas fa-camera mr-1"></i> Buka Kamera
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-stop-scan" data-target-tab="${currentTabId}" style="display:none;">
                                            <i class="fas fa-stop-circle"></i>
                                        </button>
                                    </div>

                                    <div class="d-flex align-items-center w-100 my-2" style="max-width: 320px;">
                                        <hr class="flex-grow-1 my-0">
                                        <span class="px-2 text-muted small font-weight-bold">ATAU KETIK ID</span>
                                        <hr class="flex-grow-1 my-0">
                                    </div>

                                    <div class="w-100 mt-2" style="max-width: 320px;">
                                        <div class="input-group">
                                            <input type="text" id="manualInput-${currentTabId}" class="form-control manual-id-input" placeholder="Contoh: 125 atau URL QR" autocomplete="off" data-target-tab="${currentTabId}">
                                            <div class="input-group-append">
                                                <button class="btn btn-success btn-submit-manual" data-target-tab="${currentTabId}" type="button">
                                                    <i class="fas fa-search mr-1"></i> Cari
                                                </button>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted text-left mt-2" style="font-size: 0.75rem; line-height: 1.4;">
                                            📌 <strong>Contoh:</strong> ID Kalibrasi <code>125</code> / Sertifikat <code>PAS-2024-001</code> / Link URL.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    }
                }
            });



            // ==========================================
            // INSIDE MICROMETER
            // ==========================================

            // Event change untuk insideMicrometerCapacitySelect
            if (insideMicrometerCapacitySelect) {
                insideMicrometerCapacitySelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = $(this).val();
                    const insideCount = insideMicrometerCountSelect.val() || '1';

                    if (formType === 'inside_micrometer') {
                        console.log(`📊 Inside Micrometer: capacity=${capacity}, count=${insideCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, capacity, null, null, null, null, insideCount);
                        // Tidak perlu restore karena capacity berubah, form akan reload dengan data baru
                    }
                });
            }

            // Event change+input (debounce) untuk insideMicrometerCountSelect
            if (insideMicrometerCountSelect) {
                const debouncedInsideCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = insideMicrometerCapacitySelect.val();
                    const insideCount = insideMicrometerCountSelect[0].value || '1';
                    const countInt = parseInt(insideCount);
                    if (formType === 'inside_micrometer' && countInt >= 1) {
                        console.log(`📊 Inside Micrometer Count: capacity=${capacity}, count=${insideCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, capacity, null, null, null, null, insideCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                insideMicrometerCountSelect.off('change input').on('change input', debouncedInsideCount);
            }

            // ==========================================
            // OUTSIDE MICROMETER
            // ==========================================

            // Event change untuk outsideMicrometerCapacitySelect
            if (outsideMicrometerCapacitySelect) {
                outsideMicrometerCapacitySelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = $(this).val();
                    const outsideCount = outsideMicrometerCountSelect.val() || '1';

                    if (formType === 'outside_micrometer') {
                        console.log(`📊 Outside Micrometer: capacity=${capacity}, count=${outsideCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, capacity, null, null, null, null, outsideCount);
                        // Tidak perlu restore karena capacity berubah
                    }
                });
            }

            // Event change+input (debounce) untuk outsideMicrometerCountSelect
            if (outsideMicrometerCountSelect) {
                const debouncedOutsideCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = outsideMicrometerCapacitySelect.val();
                    const outsideCount = outsideMicrometerCountSelect[0].value || '1';
                    const countInt = parseInt(outsideCount);
                    if (formType === 'outside_micrometer' && countInt >= 1) {
                        console.log(`📊 Outside Micrometer Count: capacity=${capacity}, count=${outsideCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, capacity, null, null, null, null, outsideCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                outsideMicrometerCountSelect.off('change input').on('change input', debouncedOutsideCount);
            }

            // ==========================================
            // PIN GAUGE
            // ==========================================

            // Event change untuk pinGaugeCapacitySelect
            if (pinGaugeCapacitySelect) {
                pinGaugeCapacitySelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = $(this).val();
                    const pinGaugeCount = pinGaugeCountSelect.val() || '1';

                    if (formType === 'pin_gauge') {
                        console.log(`📊 pin_gauge: capacity=${capacity}, count=${pinGaugeCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, capacity, null, null, null, null, pinGaugeCount);
                        // Tidak perlu restore karena capacity berubah
                    }
                });
            }

            // Event change+input (debounce) untuk pinGaugeCountSelect
            if (pinGaugeCountSelect) {
                const debouncedPinGaugeCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = pinGaugeCapacitySelect.val();
                    const pinGaugeCount = pinGaugeCountSelect[0].value || '1';
                    const countInt = parseInt(pinGaugeCount);
                    if (formType === 'pin_gauge' && countInt >= 1) {
                        console.log(`📊 pin_gauge Count: capacity=${capacity}, count=${pinGaugeCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, capacity, null, null, null, null, pinGaugeCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                pinGaugeCountSelect.off('change input').on('change input', debouncedPinGaugeCount);
            }

            // Event change+input (debounce) untuk ultrasonicThicknessGaugeCountSelect
            if (ultrasonicThicknessGaugeCountSelect) {
                const debouncedUTGCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const utgCount = ultrasonicThicknessGaugeCountSelect[0].value || '1';
                    const countInt = parseInt(utgCount);
                    if (formType === 'ultrasonic_thickness_gauge' && countInt >= 1) {
                        console.log(`📊 Ultrasonic Thickness Gauge Count: count=${utgCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, null, null, utgCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                ultrasonicThicknessGaugeCountSelect.off('change input').on('change input', debouncedUTGCount);
            }
            // ==========================================
            // DEPTH MICROMETER
            // ==========================================

            // Event change untuk depthMicrometerCapacitySelect
            if (depthMicrometerCapacitySelect) {
                depthMicrometerCapacitySelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = $(this).val();
                    const depthCount = depthMicrometerCountSelect.val() || '1';

                    if (formType === 'depth_micrometer') {
                        console.log(`📊 Depth Micrometer: capacity=${capacity}, count=${depthCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, capacity, null, null, null, null, depthCount);
                        // Tidak perlu restore karena capacity berubah
                    }
                });
            }

            // Event change+input (debounce) untuk depthMicrometerCountSelect
            if (depthMicrometerCountSelect) {
                const debouncedDepthCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = depthMicrometerCapacitySelect.val();
                    const depthCount = depthMicrometerCountSelect[0].value || '1';
                    const countInt = parseInt(depthCount);
                    if (formType === 'depth_micrometer' && countInt >= 1) {
                        console.log(`📊 Depth Micrometer Count: capacity=${capacity}, count=${depthCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, capacity, null, null, null, null, depthCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                depthMicrometerCountSelect.off('change input').on('change input', debouncedDepthCount);
            }

            // ==========================================
            // CALIPER
            // ==========================================

            // Event change untuk caliperResolutionSelect

            if (caliperResolutionSelect) {
                caliperResolutionSelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = $(this).val(); // 🔥 Ini adalah CAPACITY, bukan resolution!
                    const caliperCount = caliperCountSelect.val() || '1';

                    if (formType === 'caliper') {
                        console.log(`📊 Caliper: capacity=${capacity}, count=${caliperCount}`);
                        saveCurrentFormData(activeLkId);

                        // Hapus data titik ukur dan ulangan dari store agar saat direstore 
                        // tidak menimpa nilai default baru dari server untuk kapasitas yang dipilih
                        if (tempFormDataStore[activeLkId]) {
                            for (let key in tempFormDataStore[activeLkId]) {
                                if (key.includes('_titik_ukur_') || key.includes('_ulangan')) {
                                    delete tempFormDataStore[activeLkId][key];
                                }
                            }
                        }

                        // 🔥 PERBAIKAN: Parameter ke-3 adalah capacity, ke-2 adalah resolution (null)
                        await loadForm(formType, null, capacity, null, null, null, null, caliperCount);
                        await restoreSavedFormData(activeLkId);
                    }
                });
            }

            // Event change+input (debounce) untuk caliperCountSelect
            if (caliperCountSelect) {
                const debouncedCaliperCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const capacity = caliperResolutionSelect.val(); // capacity, bukan resolution
                    const caliperCount = caliperCountSelect[0].value || '1';
                    const countInt = parseInt(caliperCount);
                    if (formType === 'caliper' && countInt >= 1) {
                        console.log(`📊 Caliper Count: capacity=${capacity}, count=${caliperCount}`);
                        saveCurrentFormData(activeLkId);
                        // PERBAIKAN: Parameter ke-3 adalah capacity, ke-2 adalah resolution (null)
                        await loadForm(formType, null, capacity, null, null, null, null, caliperCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                caliperCountSelect.off('change input').on('change input', debouncedCaliperCount);
            }



            // Event change untuk dialResolutionSelect - TANPA RELOAD FORM
            if (dialResolutionSelect) {
                // Hapus event listener lama
                dialResolutionSelect.off('change');

                dialResolutionSelect.on('change', async function() {
                    if (isSyncing || isRestoring) return;

                    const formType = formSelect.val();
                    const newResolution = $(this).val();
                    const oldResolution = tempFormDataStore[activeLkId]?.resolution || '';

                    console.log(`📊 Dial Indicator: resolution berubah dari ${oldResolution} menjadi ${newResolution}`);

                    if ((formType === 'dial_indicator' || formType === 'dial_test_indicator') && newResolution) {

                        // 🔥 SIMPAN DATA YANG SUDAH DIISI SEBELUMNYA
                        const container = getActiveContainer();
                        if (container) {
                            // Simpan semua nilai input saat ini
                            const allInputs = container.querySelectorAll('input, select, textarea');
                            allInputs.forEach(input => {
                                if (input.name && input.value && input.value !== '') {
                                    if (!tempFormDataStore[activeLkId]) tempFormDataStore[activeLkId] = {};
                                    tempFormDataStore[activeLkId][input.name] = input.value;
                                }
                            });

                            // Simpan radio buttons
                            const radioButtons = container.querySelectorAll('input[type="radio"]:checked');
                            radioButtons.forEach(radio => {
                                if (radio.name) {
                                    if (!tempFormDataStore[activeLkId]) tempFormDataStore[activeLkId] = {};
                                    tempFormDataStore[activeLkId][radio.name] = radio.value;
                                }
                            });

                            // Simpan checkbox alat standar
                            const checkboxes = container.querySelectorAll('input[type="checkbox"]:checked');
                            checkboxes.forEach(checkbox => {
                                if (checkbox.name === 'alat_standar[]') {
                                    if (!tempFormDataStore[activeLkId]['alat_standar']) {
                                        tempFormDataStore[activeLkId]['alat_standar'] = [];
                                    }
                                    tempFormDataStore[activeLkId]['alat_standar'].push(checkbox.value);
                                } else if (checkbox.name) {
                                    if (!tempFormDataStore[activeLkId]) tempFormDataStore[activeLkId] = {};
                                    tempFormDataStore[activeLkId][checkbox.name] = checkbox.checked;
                                }
                            });
                        }

                        // JIKA RESOLUTION BERUBAH, HAPUS DATA PENUNJUKAN LAMA
                        if (oldResolution !== newResolution && tempFormDataStore[activeLkId]) {
                            console.log(`⚠️ Resolution changed! Clearing old penunjukan data...`);

                            // Hapus semua data penunjukan yang lama
                            delete tempFormDataStore[activeLkId]['penunjukanAlat[]'];
                            delete tempFormDataStore[activeLkId]['penunjukanAlat'];

                            // Hapus juga data skala jika perlu di-reset
                            if (tempFormDataStore[activeLkId]['skala']) {
                                delete tempFormDataStore[activeLkId]['skala'];
                            }
                        }

                        // 🔥 UPDATE RESOLUTION DI STORAGEupdateFormType
                        if (!tempFormDataStore[activeLkId]) {
                            tempFormDataStore[activeLkId] = {};
                        }
                        tempFormDataStore[activeLkId]['resolution'] = newResolution;

                        // 🔥 LOAD FORM DENGAN RESOLUTION BARU (TAPI DATA LAIN AKAN DI-RESTORE)
                        await loadForm(formType, newResolution);

                        // 🔥 RESTORE DATA YANG SUDAH DISIMPAN
                        setTimeout(async () => {
                            await restoreSavedFormData(activeLkId);
                            console.log('✅ Data berhasil direstore setelah ganti resolusi');
                        }, 500);

                    } else if ((formType === 'dial_indicator' || formType === 'dial_test_indicator') && !newResolution) {
                        const activeContainer = getActiveContainer();
                        if (activeContainer) {
                            activeContainer.innerHTML = '<div class="alert alert-warning fade-in"><i class="fas fa-exclamation-triangle mr-2"></i>Silakan pilih resolusi Dial Indicator.</div>';
                        }
                    }
                });
            }
            // ==========================================
            // ENCLOSURE
            // ==========================================

            // Event change untuk enclosureRepetitionSelect
            if (enclosureRepetitionSelect) {
                enclosureRepetitionSelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const repetition = $(this).val();

                    if (formType === 'enclosure' && repetition) {
                        console.log(`📊 Enclosure: repetition=${repetition}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, repetition);
                        await restoreSavedFormData(activeLkId);
                    }
                });
            }

            // ==========================================
            // CHAMBER
            // ==========================================

            // ==========================================
            // CHAMBER
            // ==========================================

            // Event change untuk chamberRepetitionSelect
            if (chamberRepetitionSelect) {
                chamberRepetitionSelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const repetition = $(this).val();
                    const chamberCount = chamberCountSelect?.val() || '1';

                    if (formType === 'chamber') {
                        console.log(`📊 Chamber: repetition=${repetition}, count=${chamberCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, repetition, null, null, null, chamberCount);
                        await restoreSavedFormData(activeLkId);
                    }
                });
            }

            // Event change+input (debounce) untuk chamberCountSelect
            if (chamberCountSelect) {
                const debouncedChamberCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const repetition = chamberRepetitionSelect?.val() || '1';
                    const chamberCount = chamberCountSelect[0].value || '1';
                    const countInt = parseInt(chamberCount);
                    if (formType === 'chamber' && countInt >= 1) {
                        console.log(`📊 Chamber Count: repetition=${repetition}, count=${chamberCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, repetition, null, null, null, chamberCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                chamberCountSelect.off('change input').on('change input', debouncedChamberCount);
            }
            // ==========================================
            // THERMOHYGROMETER
            // ==========================================

            // Event change untuk thermohygrometerTypeSelect
            if (thermohygrometerTypeSelect) {
                thermohygrometerTypeSelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const selectedValue = $(this).val();
                    const formType = formSelect.val();

                    console.log('📌 Thermohygrometer type changed to:', selectedValue || 'empty');

                    if (formType === 'thermohygrometer') {
                        let typeValue = selectedValue;
                        if (!typeValue || typeValue === '') {
                            typeValue = 'single';
                        }

                        console.log('📊 Loading thermohygrometer with type:', typeValue);
                        saveCurrentFormData(activeLkId);

                        // 🔥 LOAD ULANG FORM DENGAN TYPE BARU
                        await loadForm(formType, null, null, null, typeValue);

                        // 🔥 SETELAH FORM LOAD, RESTORE DATA YANG SUDAH DISIMPAN
                        setTimeout(async () => {
                            await restoreSavedFormData(activeLkId);
                            console.log('✅ Data thermohygrometer restored');
                        }, 500);
                    }

                    // 🔥 TAMPILKAN/SEMBUNYIKAN FORM SESUAI TYPE
                    const container = getActiveContainer();
                    if (container) {
                        if (selectedValue === 'in_out') {
                            console.log('Mode IN/OUT dipilih - menampilkan form IN/OUT');
                            const inOutForm = container.querySelector('#inOutForm, .in-out-form, [data-form-type="in_out"]');
                            const singleForm = container.querySelector('#singleForm, .single-form, [data-form-type="single"]');
                            if (inOutForm) inOutForm.style.display = 'block';
                            if (singleForm) singleForm.style.display = 'none';

                            // Tampilkan elemen dengan class in-out
                            container.querySelectorAll('.in-out-only').forEach(el => el.style.display = 'block');
                            container.querySelectorAll('.single-only').forEach(el => el.style.display = 'none');
                        } else {
                            console.log('Mode SINGLE (default) - menampilkan form single');
                            const inOutForm = container.querySelector('#inOutForm, .in-out-form, [data-form-type="in_out"]');
                            const singleForm = container.querySelector('#singleForm, .single-form, [data-form-type="single"]');
                            if (inOutForm) inOutForm.style.display = 'none';
                            if (singleForm) singleForm.style.display = 'block';

                            // Tampilkan elemen dengan class single
                            container.querySelectorAll('.single-only').forEach(el => el.style.display = 'block');
                            container.querySelectorAll('.in-out-only').forEach(el => el.style.display = 'none');
                        }
                    }
                });
            }
            // ==========================================
            // TIMBANGAN
            // ==========================================

            // Event change untuk timbanganTypeSelect
            if (timbanganTypeSelect) {
                timbanganTypeSelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const timbanganType = $(this).val();
                    const timbanganCount = timbanganCountSelect?.val() || '1';

                    if (formType === 'timbangan') {
                        console.log(`📊 Timbangan: type=${timbanganType}, count=${timbanganCount}`);
                        saveCurrentFormData(activeLkId);
                        if (timbanganType === 'moisture') {
                            if (timbanganCountWrapper) timbanganCountWrapper.style.display = 'none';
                            await loadForm(formType, null, null, null, null, timbanganType, null, 1);
                        } else {
                            if (timbanganCountWrapper) timbanganCountWrapper.style.display = 'block';
                            await loadForm(formType, null, null, null, null, timbanganType, null, timbanganCount);
                        }
                        await restoreSavedFormData(activeLkId);
                    }
                });
            }

            // Event change+input (debounce) untuk timbanganCountSelect
            if (timbanganCountSelect) {
                const debouncedTimbanganCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const type = timbanganTypeSelect.val();
                    const timbanganCount = timbanganCountSelect[0].value || '1';
                    const countInt = parseInt(timbanganCount);
                    if (formType === 'timbangan' && countInt >= 1) {
                        console.log(`📊 Timbangan Count: type=${type}, count=${timbanganCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, type, null, timbanganCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                timbanganCountSelect.off('change input').on('change input', debouncedTimbanganCount);
            }

            // ==========================================
            // INSULATION
            // ==========================================

            // Event change untuk insulationTypeSelect
            if (insulationTypeSelect) {
                insulationTypeSelect.off('change').on('change', async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const insulationType = $(this).val();

                    console.log('📊 Insulation type selected:', insulationType);

                    if (formType === 'insulation' && insulationType && insulationType !== '') {
                        saveCurrentFormData(activeLkId);

                        // TAMPILKAN LOADING
                        const activeContainer = getActiveContainer();
                        if (activeContainer) {
                            activeContainer.innerHTML = `
                    <div class="text-center p-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Memuat form Insulation (${insulationType})...</p>
                    </div>
                `;
                        }

                        // LOAD FORM DENGAN INSULATION TYPE
                        // Parameter: formType, resolution, capacity, repetition, thermohygrometerType, timbanganType, insulationType, count
                        await loadForm(formType, null, null, null, null, null, insulationType);

                        // RESTORE DATA YANG SUDAH DISIMPAN
                        setTimeout(async () => {
                            await restoreSavedFormData(activeLkId);
                            console.log('✅ Data insulation restored');
                        }, 500);
                    } else if (formType === 'insulation' && (!insulationType || insulationType === '')) {
                        const activeContainer = getActiveContainer();
                        if (activeContainer) {
                            activeContainer.innerHTML = `
                    <div class="alert alert-warning fade-in text-center p-5">
                        <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                        <h5>Pilih Tipe Insulation</h5>
                        <p class="mb-0">Silakan pilih tipe insulation (AC Voltage, DC Voltage, AC Current, atau DC Current) untuk melanjutkan.</p>
                    </div>
                `;
                        }
                    }
                });
            }


            // ==========================================
            // MIKROPIPET DISPENSET
            // ==========================================

            // Event change+input (debounce) untuk mikropipetDispensetCountSelect
            if (mikropipetDispensetCountSelect) {
                const debouncedMikropipetCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const mikropipetCount = mikropipetDispensetCountSelect[0].value || '1';
                    const countInt = parseInt(mikropipetCount);
                    if (formType === 'mikropipet_dispenset' && countInt >= 1) {
                        console.log(`📊 Mikropipet Dispenset: count=${mikropipetCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, null, null, mikropipetCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                mikropipetDispensetCountSelect.off('change input').on('change input', debouncedMikropipetCount);
            }


            // ==========================================
            // Conductivity meter
            // ==========================================
            // Event change+input (debounce) untuk conductivityMeterCountSelect
            if (conductivityMeterCountSelect) {
                const debouncedCondCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const condCount = conductivityMeterCountSelect[0].value || '1';
                    const countInt = parseInt(condCount);
                    if (formType === 'conductivity_meter' && countInt >= 1) {
                        console.log(`📊 Conductivity Meter: count=${condCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, null, null, condCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                conductivityMeterCountSelect.off('change input').on('change input', debouncedCondCount);
            }


            // ==========================================
            // THERMOMETER
            // ==========================================

            // Event change+input (debounce) untuk thermometerCountSelect
            if (thermometerCountSelect) {
                const debouncedThermometerCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const thermometerCount = thermometerCountSelect[0].value || '1';
                    const countInt = parseInt(thermometerCount);
                    if (formType === 'thermometer' && countInt >= 1) {
                        console.log(`📊 Thermometer: count=${thermometerCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, null, null, thermometerCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                thermometerCountSelect.off('change input').on('change input', debouncedThermometerCount);
            }


            // ==========================================
            // UTM
            // ==========================================

            // Event change+input (debounce) untuk utmCountSelect
            if (utmCountSelect) {
                const debouncedUtmCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const utmCount = utmCountSelect[0].value || '1';
                    const countInt = parseInt(utmCount);
                    if (formType === 'utm' && countInt >= 1) {
                        console.log(`📊 utm: count=${utmCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, null, null, utmCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                utmCountSelect.off('change input').on('change input', debouncedUtmCount);
            }

            // ==========================================
            // ANAK TIMBANGAN
            // ==========================================
            if (anakTimbanganCountSelect) {
                const debouncedAnakTimbanganCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const anakTimbanganCount = anakTimbanganCountSelect[0].value || '1';
                    const countInt = parseInt(anakTimbanganCount);
                    if ((formType === 'anak_timbangan' || formType === 'anak_timbang') && countInt >= 1) {
                        console.log(`🔍 Anak Timbangan: count=${anakTimbanganCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, null, null, anakTimbanganCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                anakTimbanganCountSelect.off('change input').on('change input', debouncedAnakTimbanganCount);
            }


            // ==========================================
            // FEELER GAUGE
            // ==========================================

            // Event change+input (debounce) untuk feelerGaugeCountSelect
            if (feelerGaugeCountSelect) {
                const debouncedFeelerCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const feelerCount = feelerGaugeCountSelect[0].value || '1';
                    const countInt = parseInt(feelerCount);
                    if (formType === 'feeler_gauge' && countInt >= 1) {
                        console.log(`📊 Feeler Gauge: count=${feelerCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, null, null, feelerCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                feelerGaugeCountSelect.off('change input').on('change input', debouncedFeelerCount);
            }

            // ==========================================
            // CENTRIFUGE
            // ==========================================

            // Event change+input (debounce) untuk centrifugeCountSelect
            if (centrifugeCountSelect) {
                const debouncedCentrifugeCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const centrifugeCount = centrifugeCountSelect[0].value || '1';
                    const countInt = parseInt(centrifugeCount);
                    if (formType === 'centrifuge' && countInt >= 1) {
                        console.log(`📊 Centrifuge: count=${centrifugeCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, null, null, centrifugeCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                centrifugeCountSelect.off('change input').on('change input', debouncedCentrifugeCount);
            }

            // ==========================================
            // THERMOINDICATOR
            // ==========================================

            // Event change+input (debounce) untuk thermoIndicatorCountSelect
            if (thermoIndicatorCountSelect) {
                const debouncedThermoIndicatorCount = debounce(async function() {
                    if (isSyncing || isRestoring) return;
                    const formType = formSelect.val();
                    const thermoinCount = thermoIndicatorCountSelect[0].value || '1';
                    const countInt = parseInt(thermoinCount);
                    if (formType === 'thermoindicator' && countInt >= 1) {
                        console.log(`📊 Thermoindicator: count=${thermoinCount}`);
                        saveCurrentFormData(activeLkId);
                        await loadForm(formType, null, null, null, null, null, null, thermoinCount);
                        await restoreSavedFormData(activeLkId);
                    }
                }, 600);
                thermoIndicatorCountSelect.off('change input').on('change input', debouncedThermoIndicatorCount);
            }
        }

        initializeFormEvents();

        // ==========================================
        // 🔥 EVENT LISTENER UNTUK UPDATE NAMA TAB
        // ==========================================
        // Event listener untuk update nama tab saat nama alat berubah
        $(document).on('change', 'select[name="nama_alat"], input[name="nama_alat_manual"]', function() {
            console.log('🎯 Event triggered: nama alat berubah');

            const container = $(this).closest('.lk-form-container');
            if (container.length) {
                const tabId = container.attr('data-lk-id');

                let namaAlat = '';
                const selectNamaAlat = container.find('select[name="nama_alat"]');
                if (selectNamaAlat.length && selectNamaAlat.val() && selectNamaAlat.val() !== 'MANUAL_INPUT') {
                    namaAlat = selectNamaAlat.val();
                } else {
                    const manualInput = container.find('input[name="nama_alat_manual"]');
                    if (manualInput.length && manualInput.val()) {
                        namaAlat = manualInput.val();
                    }
                }

                if (namaAlat) {
                    console.log(`📛 Updating tab ${tabId} name to: ${namaAlat}`);
                    if (typeof updateTabNameByAlat === 'function') {
                        updateTabNameByAlat(tabId, namaAlat);
                        updateTabBadge(tabId, 'terisi', false);
                    }
                }
            }
        });

        // ==========================================
        // BARCODE SCANNER & AUTO-FILL LOGIC (PER-TAB)
        // ==========================================
        //     let currentScanner = null;
        //     let scanningTabId = null;

        //     function getScanner(tabId) {
        //         if (currentScanner && scanningTabId !== tabId) {
        //             stopScanner();
        //         }

        //         if (!currentScanner) {
        //             currentScanner = new Html5Qrcode(`reader-${tabId}`);
        //             scanningTabId = tabId;
        //         }
        //         return currentScanner;
        //     }

        //     window.startScanner = function(tabId) {
        //     const scannerWrapper = document.getElementById(`scanner-wrapper-${tabId}`);
        //     const startBtn = document.querySelector(`.btn-start-scan[data-target-tab="${tabId}"]`);
        //     const stopBtn = document.querySelector(`.btn-stop-scan[data-target-tab="${tabId}"]`);
        //     const readerContainer = document.getElementById(`reader-${tabId}`);

        //     if (!scannerWrapper) return;

        //     const scanner = getScanner(tabId);
        //     const config = { 
        //         fps: 10, 
        //         qrbox: { width: 250, height: 250 }
        //     };

        //     // Tambahkan class animasi sebelum start
        //     if (readerContainer) {
        //         readerContainer.classList.add('scanning-active');
        //     }
        //     scannerWrapper.style.display = 'block';

        //     scanner.start(
        //         { facingMode: "environment" }, 
        //         config,
        //         (decodedText, decodedResult) => onScanSuccess(decodedText, decodedResult, tabId)
        //     ).then(() => {
        //         if (startBtn) startBtn.style.display = 'none';
        //         if (stopBtn) stopBtn.style.display = 'inline-block';
        //     }).catch((err) => {
        //         console.error("Scanner error:", err);
        //         if (readerContainer) {
        //             readerContainer.classList.remove('scanning-active');
        //         }
        //         Swal.fire('Error', "Gagal mengakses kamera: " + err, 'error');
        //     });
        // };
        //     window.stopScanner = function(tabId = null) {
        //         const targetTabId = tabId || scanningTabId;
        //         if (!currentScanner || !targetTabId) return;

        //         currentScanner.stop().then(() => {
        //             const scannerWrapper = document.getElementById(`scanner-wrapper-${targetTabId}`);
        //             const startBtn = document.querySelector(`.btn-start-scan[data-target-tab="${targetTabId}"]`);
        //             const stopBtn = document.querySelector(`.btn-stop-scan[data-target-tab="${targetTabId}"]`);

        //             if (scannerWrapper) scannerWrapper.style.display = 'none';
        //             if (startBtn) startBtn.style.display = 'inline-block';
        //             if (stopBtn) stopBtn.style.display = 'none';

        //             currentScanner = null;
        //             scanningTabId = null;
        //         }).catch((err) => {
        //             console.error("Failed to stop scanner:", err);
        //         });
        //     };

        //     $(document).on('click', '.btn-start-scan', function() {
        //         const tabId = $(this).data('target-tab');
        //         window.startScanner(tabId);
        //     });

        //     $(document).on('click', '.btn-stop-scan', function() {
        //         const tabId = $(this).data('target-tab');
        //         window.stopScanner(tabId);
        //     });

        //     function onScanSuccess(decodedText, decodedResult, tabId) {
        //         window.stopScanner(tabId);

        //         const resultEl = document.getElementById(`scanResult-${tabId}`);
        //         if (resultEl) {
        //             resultEl.classList.remove('d-none');
        //             resultEl.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari data alat...';
        //         }

        //         let id = decodedText.trim();
        //         if (id.includes('/')) {
        //             const parts = id.split('/');
        //             id = parts[parts.length - 1];
        //         }
        //         id = id.replace(/[^A-Za-z0-9\-]/g, '');

        //         fetchCalibrationData(id, tabId);
        //     }

        // Variabel untuk menyimpan status scanner
        let currentScanner = null;
        let scanningTabId = null;
        let animationFrameId = null;

        function getScanner(tabId) {
            if (currentScanner && scanningTabId !== tabId) {
                stopScanner();
            }

            if (!currentScanner) {
                currentScanner = new Html5Qrcode(`reader-${tabId}`);
                scanningTabId = tabId;
            }
            return currentScanner;
        }

        // Fungsi untuk menggambar kotak di canvas
        function drawDetectionBox(canvas, x, y, width, height) {
            const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Gambar kotak hijau
            ctx.strokeStyle = '#00ff00';
            ctx.lineWidth = 3;
            ctx.strokeRect(x, y, width, height);

            // Gambar sudut-sudut (efek lebih keren)
            ctx.beginPath();
            ctx.strokeStyle = '#00ff00';
            ctx.lineWidth = 2;

            // Sudut kiri atas
            ctx.moveTo(x, y + 10);
            ctx.lineTo(x, y);
            ctx.lineTo(x + 10, y);

            // Sudut kanan atas
            ctx.moveTo(x + width - 10, y);
            ctx.lineTo(x + width, y);
            ctx.lineTo(x + width, y + 10);

            // Sudut kiri bawah
            ctx.moveTo(x, y + height - 10);
            ctx.lineTo(x, y + height);
            ctx.lineTo(x + 10, y + height);

            // Sudut kanan bawah
            ctx.moveTo(x + width - 10, y + height);
            ctx.lineTo(x + width, y + height);
            ctx.lineTo(x + width, y + height - 10);

            ctx.stroke();

            // Hapus setelah 1 detik
            setTimeout(() => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }, 1000);
        }

        window.startScanner = function(tabId) {
            const scannerWrapper = document.getElementById(`scanner-wrapper-${tabId}`);
            const startBtn = document.querySelector(`.btn-start-scan[data-target-tab="${tabId}"]`);
            const stopBtn = document.querySelector(`.btn-stop-scan[data-target-tab="${tabId}"]`);
            const readerContainer = document.getElementById(`reader-${tabId}`);
            const overlayCanvas = document.getElementById(`overlay-${tabId}`);

            if (!scannerWrapper) return;

            const scanner = getScanner(tabId);
            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                },
                aspectRatio: 1.0
            };

            scannerWrapper.style.display = 'block';
            if (readerContainer) {
                readerContainer.classList.add('scanning-active');
            }

            // Set ukuran canvas sesuai dengan container
            if (overlayCanvas) {
                const container = readerContainer.parentElement;
                overlayCanvas.width = container.clientWidth;
                overlayCanvas.height = container.clientHeight;
            }

            scanner.start({
                    facingMode: "environment"
                },
                config,
                (decodedText, decodedResult) => {
                    // Gambar kotak di sekitar QR code yang terdeteksi
                    if (decodedResult && decodedResult.result && decodedResult.result.cornerPoints) {
                        const points = decodedResult.result.cornerPoints;
                        if (overlayCanvas && points && points.length >= 4) {
                            // Hitung bounding box dari corner points
                            const xs = points.map(p => p.x);
                            const ys = points.map(p => p.y);
                            const minX = Math.min(...xs);
                            const minY = Math.min(...ys);
                            const maxX = Math.max(...xs);
                            const maxY = Math.max(...ys);

                            // Sesuaikan dengan ukuran canvas
                            const scaleX = overlayCanvas.width / 300;
                            const scaleY = overlayCanvas.height / 300;

                            drawDetectionBox(
                                overlayCanvas,
                                minX * scaleX,
                                minY * scaleY,
                                (maxX - minX) * scaleX,
                                (maxY - minY) * scaleY
                            );
                        }
                    }

                    onScanSuccess(decodedText, decodedResult, tabId);
                }
            ).then(() => {
                if (startBtn) startBtn.style.display = 'none';
                if (stopBtn) stopBtn.style.display = 'inline-block';
            }).catch((err) => {
                console.error("Scanner error:", err);
                if (readerContainer) {
                    readerContainer.classList.remove('scanning-active');
                }
                Swal.fire('Error', "Gagal mengakses kamera: " + err, 'error');
            });
        };

        window.stopScanner = function(tabId = null) {
            const targetTabId = tabId || scanningTabId;
            if (!currentScanner || !targetTabId) return;

            currentScanner.stop().then(() => {
                const scannerWrapper = document.getElementById(`scanner-wrapper-${targetTabId}`);
                const startBtn = document.querySelector(`.btn-start-scan[data-target-tab="${targetTabId}"]`);
                const stopBtn = document.querySelector(`.btn-stop-scan[data-target-tab="${targetTabId}"]`);
                const readerContainer = document.getElementById(`reader-${targetTabId}`);
                const overlayCanvas = document.getElementById(`overlay-${targetTabId}`);

                if (readerContainer) {
                    readerContainer.classList.remove('scanning-active');
                }

                if (overlayCanvas) {
                    const ctx = overlayCanvas.getContext('2d');
                    ctx.clearRect(0, 0, overlayCanvas.width, overlayCanvas.height);
                }

                if (scannerWrapper) scannerWrapper.style.display = 'none';
                if (startBtn) startBtn.style.display = 'inline-block';
                if (stopBtn) stopBtn.style.display = 'none';

                currentScanner = null;
                scanningTabId = null;
            }).catch((err) => {
                console.error("Failed to stop scanner:", err);
            });
        };

        function onScanSuccess(decodedText, decodedResult, tabId) {
            const readerContainer = document.getElementById(`reader-${tabId}`);

            // Efek flash sukses
            if (readerContainer) {
                readerContainer.style.transition = 'box-shadow 0.3s';
                readerContainer.style.boxShadow = '0 0 0 3px #00ff00';
                setTimeout(() => {
                    readerContainer.style.boxShadow = '';
                }, 500);
            }

            // Hentikan scanner
            window.stopScanner(tabId);

            const resultEl = document.getElementById(`scanResult-${tabId}`);
            if (resultEl) {
                resultEl.classList.remove('d-none');
                resultEl.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari data alat...';
            }

            if (navigator.vibrate) {
                navigator.vibrate(200);
            }

            let id = decodedText.trim();
            if (id.includes('pascalibration.com/')) {
                id = id.substring(id.indexOf('pascalibration.com/') + 'pascalibration.com/'.length);
                id = id.replace(/[\?#].*$/, '').replace(/\/+$/, '');
            } else if (id.includes('/')) {
                id = id.replace(/[\?#].*$/, '').replace(/\/+$/, '');
                const parts = id.split('/');
                id = parts[parts.length - 1];
            }
            id = id.replace(/[^A-Za-z0-9\-]/g, '');

            Swal.fire({
                icon: 'success',
                title: 'QR Code Terdeteksi!',
                text: `ID: ${id}`,
                timer: 1500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });

            // 📋 LOG: QR Code berhasil di-scan (sebelum fetch data)
            logFormActivity('scan_success', {
                qr_code: id,
                tab_id: tabId,
                waktu_scan: new Date().toISOString()
            });

            fetchCalibrationData(id, tabId);
        }

        $(document).on('click', '.btn-start-scan', function() {
            const tabId = $(this).data('target-tab');
            window.startScanner(tabId);
        });

        $(document).on('click', '.btn-stop-scan', function() {
            const tabId = $(this).data('target-tab');
            window.stopScanner(tabId);
        });

        // Handler untuk tombol Cari Manual & Enter pada input
        $(document).on('click', '.btn-submit-manual', function() {
            const tabId = $(this).data('target-tab');
            processManualInput(tabId);
        });

        $(document).on('keypress', '.manual-id-input', function(e) {
            if (e.which === 13) { // Tombol Enter
                e.preventDefault();
                const tabId = $(this).data('target-tab');
                processManualInput(tabId);
            }
        });

        function processManualInput(tabId) {
            const inputEl = document.getElementById(`manualInput-${tabId}`);
            if (!inputEl) return;

            let rawVal = inputEl.value.trim();
            if (!rawVal) {
                Swal.fire('Perhatian', 'Silakan masukkan ID Kalibrasi atau No. Seri terlebih dahulu.', 'warning');
                inputEl.focus();
                return;
            }

            let id = rawVal;
            if (id.includes('pascalibration.com/')) {
                id = id.substring(id.indexOf('pascalibration.com/') + 'pascalibration.com/'.length);
                id = id.replace(/[\?#].*$/, '').replace(/\/+$/, '');
            } else if (id.includes('/')) {
                id = id.replace(/[\?#].*$/, '').replace(/\/+$/, '');
                const parts = id.split('/');
                id = parts[parts.length - 1];
            }
            id = id.replace(/[^A-Za-z0-9\-]/g, '');

            Swal.fire({
                icon: 'success',
                title: 'Memproses ID...',
                text: `Mencari data untuk: ${id}`,
                timer: 1000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });

            logFormActivity('manual_input_search', {
                input_value: rawVal,
                parsed_id: id,
                tab_id: tabId
            });

            fetchCalibrationData(id, tabId);
        }

        function fetchCalibrationData(id, tabId) {
            const url = `/api/calibrations/fetch-data/${id}`;
            const resultEl = document.getElementById(`scanResult-${tabId}`);

            fetch(url)
                .then(response => response.json())
                .then(result => {
                    if (result.success && result.data) {
                        const apiData = result.data;

                        if (resultEl) resultEl.classList.add('d-none');

                        // 🔥 LANGSUNG PAKAI FORM_TYPE DARI API (DATABASE)
                        // JANGAN DETEKSI ULANG! KARENA DI DATABASE SUDAH ADA
                        let finalFormType = apiData.form_type;

                        // Log untuk debugging
                        console.log('📦 API Response:', {
                            form_type_dari_db: apiData.form_type,
                            namaAlat: apiData.namaAlat,
                            capacity: apiData.capacity,
                            jumlah_form: apiData.jumlah_form,
                            type: apiData.type,
                        });

                        // 🔥 VALIDASI: Jika form_type kosong atau 'general', TAMPILKAN PERINGATAN
                        if (!finalFormType || finalFormType === 'general' || finalFormType === '') {
                            console.error('❌ form_type di database masih kosong/general!');
                            Swal.fire({
                                icon: 'warning',
                                title: 'Perhatian',
                                text: `Data alat "${apiData.namaAlat}" belum memiliki form_type yang valid di database. Silakan update data terlebih dahulu.`,
                                confirmButtonText: 'OK'
                            });
                            // Tetap lanjut dengan form_type yang ada
                        }

                        const formData = {
                            namaAlat: apiData.namaAlat,
                            brandAlat: apiData.brandAlat,
                            kodeAlat: apiData.kodeAlat,
                            typeAlat: apiData.typeAlat,
                            NoSeri: apiData.NoSeri,
                            rangeMin: apiData.rangeMin,
                            rangeMax: apiData.rangeMax,
                            kapasitas: apiData.kapasitas,
                            resolusi: apiData.resolusi,
                            pemilikAlat: apiData.pemilikAlat,
                            lokasiPT: apiData.lokasiPT,
                            tanggalMasuk: apiData.tanggalMasuk,
                            tanggalKalibrasi: apiData.tanggalKalibrasi,
                            tempatKalibrasi: apiData.tempatKalibrasi,
                            jenisPembacaan: apiData.jenisPembacaan,
                            kondisiAlat: apiData.kondisiAlat,
                            keterangan: apiData.keterangan,
                            RT_condition1: apiData.RT_condition1,
                            RT_condition2: apiData.RT_condition2,
                            RT_condition3: apiData.RT_condition3,
                            RH_condition1: apiData.RH_condition1,
                            RH_condition2: apiData.RH_condition2,
                            RH_condition3: apiData.RH_condition3,
                            capacity: apiData.capacity || apiData.kapasitas,
                            skala: apiData.skala,
                            repetition: apiData.repetition,
                            type: apiData.type,
                            form_type: finalFormType, // 🔥 PAKAI FORM_TYPE DARI DATABASE
                            jumlah_form: apiData.jumlah_form || 1,
                        };

                        console.log('📦 Final formData:', {
                            form_type: formData.form_type,
                            namaAlat: formData.namaAlat,
                            capacity: formData.capacity,
                            jumlah_form: formData.jumlah_form,
                            type: formData.type
                        });

                        const displayName = formNameMap[finalFormType] || apiData.namaAlat || 'Alat';

                        // 📋 LOG: Data QR berhasil dimuat dari API → log ke ActivityLog
                        logFormActivity('select_form', {
                            form_type: finalFormType,
                            form_name: displayName,
                            metode: 'qrcode',
                            tab_id: tabId,
                            qr_code_id: id,
                            nama_alat: apiData.namaAlat,
                            no_seri: apiData.NoSeri,
                            merek: apiData.brandAlat,
                            capacity: apiData.capacity || apiData.kapasitas,
                            waktu: new Date().toISOString()
                        });

                        Swal.fire({
                            title: 'Data Ditemukan!',
                            html: `Berhasil memuat data <strong>${displayName}</strong>.<br>Di mana Anda ingin menerapkan data ini?`,
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: `<i class="fas fa-check-circle mr-1"></i>Tab ${tabId} (Aktif)`,
                            cancelButtonText: '<i class="fas fa-plus-circle mr-1"></i>Tab Baru',
                        }).then((swalResult) => {
                            if (swalResult.isConfirmed) {
                                fillFormInTab(tabId, formData);
                            } else if (swalResult.dismiss === Swal.DismissReason.cancel) {
                                addNewTab(finalFormType, formData);
                            }
                        });
                    } else {
                        throw new Error(result.message || 'Data alat tidak ditemukan');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    if (resultEl) {
                        resultEl.classList.remove('d-none');
                        resultEl.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i> ${error.message}`;
                        setTimeout(() => resultEl.classList.add('d-none'), 5000);
                    }
                    Swal.fire('Gagal', error.message, 'error');
                });
        }

        function formatDateForInput(dateString) {
            if (!dateString) return '';

            if (typeof dateString === 'string' && dateString.match(/^\d{4}-\d{2}-\d{2}$/)) {
                return dateString;
            }

            try {
                const date = new Date(dateString);
                if (isNaN(date.getTime())) return '';

                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');

                return `${year}-${month}-${day}`;
            } catch (e) {
                console.error('Error formatting date:', e);
                return '';
            }
        }
        // 🔥 DEFINISIKAN FUNGSI SET THERMOHYGROMETER TYPE DI SINI (SEBELUM DIGUNAKAN)
        function setThermohygrometerType(tabId, type) {
            console.log('📌 setThermohygrometerType called:', {
                tabId,
                type
            });

            const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (!container) {
                console.warn(`⚠️ Container tab ${tabId} tidak ditemukan`);
                return false;
            }

            // Cari select type
            let typeSelect = container.querySelector('#thermohygrometerTypeSelect');
            if (!typeSelect) {
                typeSelect = document.querySelector('#thermohygrometerTypeSelect');
            }
            if (!typeSelect) {
                typeSelect = container.querySelector('select[name="type"]');
            }

            if (typeSelect && type === 'in_out') {
                typeSelect.value = 'in_out';
                typeSelect.dispatchEvent(new Event('change', {
                    bubbles: true
                }));

                if (typeof $ !== 'undefined') {
                    $(typeSelect).trigger('change');
                }

                console.log('✅ Type thermohygrometer diisi: in_out');
                return true;
            } else if (typeSelect) {
                typeSelect.value = '';
                console.log('✅ Type thermohygrometer dibiarkan kosong (default single)');
                return true;
            }

            console.warn('⚠️ Select type untuk thermohygrometer tidak ditemukan');
            return false;
        }

        async function fillFormInTab(tabId, data) {
            console.log(`📝 Mengisi form di tab ${tabId} dengan data:`, data);

            const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (!container) return;

            // Tampilkan loading
            showLoadingOverlay(tabId);

            // 🔥 SET NILAI DROPDOWN TERLEBIH DAHULU
            const capacityValue = data.capacity || data.kapasitas || '';
            const jumlahFormValue = data.jumlah_form || data.count || '1';
            const formType = data.form_type;
            const type = data.type; // 🔥 type bisa 'in_out' atau undefined/null (berarti single)

            console.log('📌 Setting dropdown values:', {
                capacity: capacityValue,
                jumlah_form: jumlahFormValue,
                form_type: formType,
                type: type
            });

            // Set form select utama
            const formSelectEl = $('#formSelect');
            if (formSelectEl.val() !== formType) {
                formSelectEl.val(formType).trigger('change.select2');
            }

            // Set kapasitas di semua dropdown yang mungkin
            if (capacityValue) {
                $('#insideMicrometerCapacitySelect').val(capacityValue).trigger('change.select2');
                $('#outsideMicrometerCapacitySelect').val(capacityValue).trigger('change.select2');
                $('#depthMicrometerCapacitySelect').val(capacityValue).trigger('change.select2');
                $('#caliperresolutionSelect').val(capacityValue).trigger('change.select2');
                console.log('✅ Capacity dropdown set to:', capacityValue);
            }

            // Setelah setting dropdown values, tambahkan untuk resolusi
            if (data.skala) {
                console.log('📌 Setting resolusi/skala:', data.skala);
                $('#dialresolutionSelect').val(data.skala).trigger('change.select2');
            }

            // Set jumlah form
            $('#insideMicrometerCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#outsideMicrometerCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#pinGaugeCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#depthMicrometerCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#caliperCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#chamberCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#timbanganCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#thermometerCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#utmCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#anakTimbanganCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#feelerGaugeCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#centrifugeCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#mikropipetDispensetCountSelect').val(jumlahFormValue).trigger('change.select2');
            $('#thermoIndicatorCountSelect').val(jumlahFormValue).trigger('change.select2');
            console.log('✅ Jumlah form dropdown set to:', jumlahFormValue);

            // Tampilkan wrapper yang sesuai
            function showWrapper(wrapperId) {
                const wrapper = document.getElementById(wrapperId);
                if (wrapper) wrapper.style.display = 'block';
            }

            // Tampilkan wrapper berdasarkan form_type
            switch (formType) {
                case 'inside_micrometer':
                    showWrapper('insideMicrometerCapacityWrapper');
                    showWrapper('insideMicrometerCountWrapper');
                    break;
                case 'outside_micrometer':
                    showWrapper('outsideMicrometerCapacityWrapper');
                    showWrapper('outsideMicrometerCountWrapper');
                    break;
                case 'pin_gauge':
                    showWrapper('pinGaugeCapacityWrapper');
                    showWrapper('pinGaugeCountWrapper');
                    break;
                case 'depth_micrometer':
                    showWrapper('depthMicrometerCapacityWrapper');
                    showWrapper('depthMicrometerCountWrapper');
                    break;
                case 'caliper':
                    showWrapper('caliperResolutionWrapper');
                    showWrapper('caliperCountWrapper');
                    break;
                case 'chamber':
                    showWrapper('chamberRepetitionWrapper');
                    showWrapper('chamberCountWrapper');
                    break;
                case 'timbangan':
                    showWrapper('timbanganTypeWrapper');
                    if (data.timbangan_type !== 'moisture') {
                        showWrapper('timbanganCountWrapper');
                    }
                    break;
                case 'thermometer':
                    showWrapper('thermometerCountWrapper');
                    break;
                case 'utm':
                    showWrapper('utmCountWrapper');
                    break;
                case 'anak_timbangan':
                case 'anak_timbang':
                    showWrapper('anakTimbanganCountWrapper');
                    break;
                case 'feeler_gauge':
                    showWrapper('feelerGaugeCountWrapper');
                    break;
                case 'centrifuge':
                    showWrapper('centrifugeCountWrapper');
                    break;
                case 'mikropipet_dispenset':
                    showWrapper('mikropipetDispensetCountWrapper');
                    break;
                case 'thermoindicator':
                    showWrapper('thermoIndicatorCountWrapper');
                    break;
                case 'dial_indicator':
                case 'dial_test_indicator':
                    showWrapper('dialResolutionWrapper');
                    break;
                case 'enclosure':
                    showWrapper('enclosureRepetitionWrapper');
                    break;
                case 'thermohygrometer':
                    showWrapper('thermohygrometerTypeWrapper');
                    break;
                case 'insulation':
                    showWrapper('insulationTypeWrapper');
                    if (type === 'in_out') {
                        await new Promise(resolve => setTimeout(resolve, 300));
                        const typeSelect = container.querySelector('select[name="type"], #insulationTypeSelect');
                        if (typeSelect) {
                            typeSelect.value = 'in_out';
                            typeSelect.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                            console.log(`✅ Type insulation diisi: in_out`);
                        }
                    }
                    break;
            }


            // 🔥 PANGGIL LOADFORM TO TAB
            try {
                // 🔥 Untuk thermohygrometer, pastikan type dikirim ke server saat load form
                let thermohygrometerType = null;

                if (formType === 'thermohygrometer') {
                    if (type === 'in_out') {
                        thermohygrometerType = 'in_out';
                        console.log('📌 Akan memuat form dengan type: in_out');
                    } else {
                        thermohygrometerType = 'single';
                        console.log('📌 Akan memuat form dengan type: single (default)');
                    }
                }

                // 🔥 KIRIMKAN TYPE KE LOADFORM (parameter ke-6 adalah thermohygrometerType)
                await loadFormToTab(tabId, formType, null, capacityValue, null, thermohygrometerType, null, null, jumlahFormValue);

            } catch (error) {
                console.error('❌ Gagal memuat form:', error);
                hideLoadingOverlay(tabId);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memuat Form',
                    text: 'Form tidak dapat dimuat. Silakan coba lagi.'
                });
                return;
            }

            // Update nama tab
            updateTabName(tabId, formType, data.namaAlat);

            // Update metadata container
            container.setAttribute('data-current-form', formType);
            container.setAttribute('data-current-capacity', capacityValue);
            container.setAttribute('data-current-count', jumlahFormValue);
            if (type === 'in_out') {
                container.setAttribute('data-current-type', 'in_out');
            }

            // Tunggu DOM stabil
            await new Promise(resolve => setTimeout(resolve, 800));

            // ============================================================
            // 🔥 ISI FIELD-FIELD FORM (TERMASUK NAMA ALAT)
            // ============================================================

            let filledCount = 0;

            // ============================================================
            // 1. PENANGANAN KHUSUS UNTUK NAMA ALAT (SELECT DROPDOWN)
            // ============================================================
            if (data.namaAlat) {
                console.log('📌 Mengisi nama alat:', data.namaAlat);
                updateTabNameByFormType(tabId, formType, data.namaAlat);
                updateTabBadge(tabId, 'terisi', false);

                // Cari select dropdown untuk nama alat
                let namaAlatSelect = container.querySelector('select[name="nama_alat"]');
                if (!namaAlatSelect) {
                    namaAlatSelect = container.querySelector('select[id*="nama_alat_select"]');
                }

                if (namaAlatSelect) {
                    // 🔥 DAFTAR OPTION YANG TERSEDIA DI DROPDOWN
                    let availableOptions = [];
                    for (let i = 0; i < namaAlatSelect.options.length; i++) {
                        availableOptions.push(namaAlatSelect.options[i].value);
                    }
                    console.log('📌 Available options:', availableOptions);

                    // Cek apakah nilai yang akan diisi ada di option
                    let optionExists = availableOptions.includes(data.namaAlat);

                    if (optionExists) {
                        // 🔥 Jika ada di dropdown, pilih langsung
                        namaAlatSelect.value = data.namaAlat;
                        namaAlatSelect.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                        console.log(`✅ Select nama_alat diisi: ${data.namaAlat}`);
                        filledCount++;
                    } else {
                        // 🔥 Jika tidak ada di dropdown, pilih MANUAL_INPUT
                        console.log(`📌 Nama alat "${data.namaAlat}" tidak ada di dropdown, menggunakan MANUAL_INPUT`);

                        // Cari apakah ada opsi MANUAL_INPUT
                        let hasManualInput = availableOptions.includes('MANUAL_INPUT');

                        if (hasManualInput) {
                            // Pilih MANUAL_INPUT
                            namaAlatSelect.value = 'MANUAL_INPUT';
                            namaAlatSelect.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                            console.log(`📌 Select diubah ke MANUAL_INPUT`);

                            // Tunggu sebentar agar input manual muncul
                            await new Promise(resolve => setTimeout(resolve, 300));

                            // Cari input manual dan isi
                            const manualInput = container.querySelector('input[name="nama_alat_manual"]');
                            if (manualInput) {
                                manualInput.value = data.namaAlat;
                                manualInput.dispatchEvent(new Event('input', {
                                    bubbles: true
                                }));
                                manualInput.dispatchEvent(new Event('change', {
                                    bubbles: true
                                }));
                                console.log(`✅ Input manual nama_alat diisi: ${data.namaAlat}`);
                                filledCount++;
                            } else {
                                console.warn('⚠️ Input manual tidak ditemukan setelah memilih MANUAL_INPUT');
                                // Fallback: coba cari input dengan nama lain
                                const fallbackInput = container.querySelector('input[name="nama_alat_final"], input[name="nama_alat"]');
                                if (fallbackInput) {
                                    fallbackInput.value = data.namaAlat;
                                    fallbackInput.dispatchEvent(new Event('input', {
                                        bubbles: true
                                    }));
                                    console.log(`✅ Fallback input diisi: ${data.namaAlat}`);
                                    filledCount++;
                                }
                            }
                        } else {
                            // Jika tidak ada opsi MANUAL_INPUT, cari input text biasa
                            console.log('📌 Tidak ada opsi MANUAL_INPUT, mencari input text biasa');
                            const textInput = container.querySelector('input[name="nama_alat"], input[name="nama_alat_final"]');
                            if (textInput) {
                                textInput.value = data.namaAlat;
                                textInput.dispatchEvent(new Event('input', {
                                    bubbles: true
                                }));
                                textInput.dispatchEvent(new Event('change', {
                                    bubbles: true
                                }));
                                console.log(`✅ Input text nama_alat diisi: ${data.namaAlat}`);
                                filledCount++;
                            } else {
                                console.warn('⚠️ Tidak ditemukan field untuk mengisi nama alat');
                            }
                        }
                    }
                } else {
                    // Fallback jika tidak ada select dropdown
                    console.log('📌 Tidak ada select dropdown, mencari input text biasa');
                    let namaAlatInput = container.querySelector('input[name="nama_alat"]');
                    if (!namaAlatInput) namaAlatInput = container.querySelector('input[name="nama_alat_final"]');
                    if (namaAlatInput) {
                        namaAlatInput.value = data.namaAlat;
                        namaAlatInput.dispatchEvent(new Event('input', {
                            bubbles: true
                        }));
                        namaAlatInput.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                        console.log(`✅ Input nama_alat diisi: ${data.namaAlat}`);
                        filledCount++;
                    } else {
                        console.warn('⚠️ Field nama_alat tidak ditemukan');
                    }
                }
            }

            // ============================================================
            // 2. FIELD MAPPING UNTUK FIELD LAINNYA
            // ============================================================
            const fieldMappings = {
                'merek': data.brandAlat,
                'kode_alat': data.kodeAlat,
                'type_alat': data.typeAlat,
                'no_seri': data.NoSeri,
                'rentang_ukur_min': data.rangeMin,
                'rentang_ukur_max': data.rangeMax,
                'kapasitas': data.kapasitas,
                'resolusi': data.resolusi,
                'nama_pemilik': data.pemilikAlat,
                'lokasi_pt': data.lokasiPT,
                'tanggal_alat_masuk': formatDateForInput(data.tanggalMasuk),
                'tanggal_kalibrasi': formatDateForInput(data.tanggalKalibrasi),
                'tempat_kalibrasi': data.tempatKalibrasi,
                'jenis_pembacaan': data.jenisPembacaan,
                'fungsi_komponen': data.kondisiAlat,
                'keterangan_fungsi_komponen': data.keterangan,
                'suhu_awal': data.RT_condition1,
                'suhu_tengah': data.RT_condition2,
                'suhu_akhir': data.RT_condition3,
                'rh_awal': data.RH_condition1,
                'rh_tengah': data.RH_condition2,
                'rh_akhir': data.RH_condition3
            };

            // Isi field-field
            Object.entries(fieldMappings).forEach(([fieldName, value]) => {
                if (value === undefined || value === null || value === '') return;

                // Cari input dengan name yang sesuai
                let input = container.querySelector(`[name="${fieldName}"]`);

                // Coba dengan prefix form_1_ untuk multiple form
                if (!input) {
                    input = container.querySelector(`[name="form_1_${fieldName}"]`);
                }

                // Coba dengan field alternatif
                if (!input && fieldName === 'merek') {
                    input = container.querySelector(`[name="merek_display"]`);
                }
                if (!input && fieldName === 'kode_alat') {
                    input = container.querySelector(`[name="kode_alat_display"]`);
                }
                if (!input && fieldName === 'type_alat') {
                    input = container.querySelector(`[name="type_alat_display"]`);
                }
                if (!input && fieldName === 'no_seri') {
                    input = container.querySelector(`[name="no_seri_display"]`);
                }

                if (input) {
                    input.value = value;
                    input.dispatchEvent(new Event('input', {
                        bubbles: true
                    }));
                    input.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                    filledCount++;
                    console.log(`✅ Field ${fieldName} diisi:`, value);
                } else {
                    console.warn(`⚠️ Field ${fieldName} tidak ditemukan`);
                }
            });

            // ============================================================
            // 3. SET RADIO BUTTON
            // ============================================================
            if (data.tempatKalibrasi) {
                const tempatRadio = container.querySelector(`input[name="tempat_kalibrasi"][value="${data.tempatKalibrasi}"]`);
                if (tempatRadio) {
                    tempatRadio.checked = true;
                    tempatRadio.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                    console.log(`✅ Radio tempat_kalibrasi diisi: ${data.tempatKalibrasi}`);
                }
            }

            if (data.kondisiAlat) {
                const kondisiRadio = container.querySelector(`input[name="fungsi_komponen"][value="${data.kondisiAlat}"]`);
                if (kondisiRadio) {
                    kondisiRadio.checked = true;
                    kondisiRadio.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                    console.log(`✅ Radio fungsi_komponen diisi: ${data.kondisiAlat}`);
                }
            }

            // ============================================================
            // 4. SET DROPDOWN LAINNYA (JIKA ADA)
            // ============================================================
            if (data.skala) {
                // Untuk Dial Indicator dan Dial Test Indicator
                const skalaSelect = container.querySelector('select[name="resolution"], select[name="skala"], #dialresolutionSelect');
                if (skalaSelect) {
                    skalaSelect.value = data.skala;
                    skalaSelect.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                    console.log(`✅ Skala/Resolusi diisi: ${data.skala}`);

                    // 🔥 UPDATE JUGA KE TEMPSTORAGE
                    if (typeof saveCurrentFormData === 'function') {
                        if (!tempFormDataStore[tabId]) tempFormDataStore[tabId] = {};
                        tempFormDataStore[tabId]['resolution'] = data.skala;
                    }
                } else {
                    console.warn(`⚠️ Select resolusi tidak ditemukan untuk skala: ${data.skala}`);
                }
            }

            // Untuk Dial Indicator - coba cari dengan ID spesifik
            if ((formType === 'dial_indicator' || formType === 'dial_test_indicator') && data.skala) {
                let resolutionSelect = container.querySelector('#dialresolutionSelect');
                if (!resolutionSelect) {
                    resolutionSelect = container.querySelector('select[name="resolution"]');
                }
                if (!resolutionSelect) {
                    resolutionSelect = container.querySelector('select[id*="resolution"]');
                }

                if (resolutionSelect) {
                    resolutionSelect.value = data.skala;
                    resolutionSelect.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                    console.log(`✅ Resolusi Dial Indicator diisi: ${data.skala}`);
                }
            }

            // 🔥 KHUSUS UNTUK THERMOHYGROMETER: Set type di sini juga (fallback) - HANYA UNTUK IN_OUT
            // 🔥 SET NILAI DROPDOWN TYPE (setelah form loading selesai)
            if (formType === 'thermohygrometer' && type === 'in_out') {
                console.log('📌 Setting dropdown type after form loaded: in_out');

                // Cari select type
                let typeSelect = container.querySelector('#thermohygrometerTypeSelect');
                if (!typeSelect) {
                    typeSelect = document.querySelector('#thermohygrometerTypeSelect');
                }

                if (typeSelect) {
                    typeSelect.value = 'in_out';
                    typeSelect.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                    if (typeof $ !== 'undefined') {
                        $(typeSelect).trigger('change');
                    }
                    console.log('✅ Dropdown type diisi: in_out');
                }
            }

            if (data.repetition) {
                const repetitionSelect = container.querySelector('select[name="repetition"], #enclosureRepetitionSelect, #chamberRepetitionSelect');
                if (repetitionSelect) {
                    repetitionSelect.value = data.repetition;
                    repetitionSelect.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                    console.log(`✅ Repetition diisi: ${data.repetition}`);
                }
            }

            console.log(`✅ Form di tab ${tabId} berhasil diisi! Total field terisi: ${filledCount}`);

            // Sembunyikan loading
            hideLoadingOverlay(tabId);
            isSyncing = false;

            // Notifikasi sukses
            let successMessage = `${data.namaAlat} dimuat di tab ${tabId}`;
            if (formType === 'thermohygrometer' && type === 'in_out') {
                successMessage += ` (Mode IN/OUT)`;
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: successMessage,
                timer: 1500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }
        // ==========================================
        // LOGIKA PENYIMPANAN AJAX PER-TAB
        // ==========================================

        window.isTabbedMode = true;

        window.saveTabForm = function(tabId, $container) {
            window.submitSemuaForm();
        };

        function handleSaveSuccess(tabId, data) {
            console.log('handleSaveSuccess called with data:', data);

            const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (!container) {
                console.error(`Container for tab ${tabId} not found!`);
                return;
            }

            const tabButton = document.getElementById(`lk-tab-${tabId}`);
            if (tabButton) {
                tabButton.classList.add('tab-saved');
                const badge = tabButton.querySelector('.badge');
                if (badge) {
                    badge.className = 'badge badge-success ml-1';
                    badge.innerHTML = '<i class="fas fa-check mr-1"></i>Tersimpan';
                }
            }

            if (typeof saveCalibrationState === 'function') {
                saveCalibrationState();
            }

            // Hapus draft dari localStorage & server karena sudah berhasil disimpan ke DB
            if (typeof window.clearAllDraft === 'function') {
                window.clearAllDraft();
            }

            // Bersihkan file array di window untuk gauge_block jika ada
            if (typeof window['fileGaugeBlock_tab_' + tabId] !== 'undefined') {
                window['fileGaugeBlock_tab_' + tabId] = [];
            }

            const formName = container.getAttribute('data-form-name') || 'Alat';
            const calibrationId = data.calibration_id || data.id || '-';
            const printLabelUrl = data.print_label_url || `/calibrations/${calibrationId}/print-label`;

            // 🔥 TAMPILKAN SUCCESS MESSAGE DENGAN 3 PILIHAN
            container.innerHTML = `
                    <div class="save-success-overlay text-center p-5 fade-in">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success fa-5x"></i>
                        </div>
                        <h3 class="text-success mb-2">✓ Simpan Berhasil!</h3>
                        <p class="text-muted mb-3">Data kalibrasi untuk <strong>${escapeHtml(formName)}</strong> telah berhasil disimpan ke database.</p>
                        
                        <div class="alert alert-info d-inline-block mb-4 p-3" style="border-radius: 12px; text-align: left;">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>ID Kalibrasi:</strong> <code>${escapeHtml(calibrationId)}</code>
                            <br>
                            <small class="text-muted">Status: <span class="badge badge-success">Draft</span></small>
                        </div>
                        
                        <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
                            <button type="button" class="btn btn-lg btn-primary shadow-sm" onclick="window.open('${printLabelUrl}', '_blank')">
                                <i class="fas fa-print mr-2"></i> 🖨️ Cetak Label
                            </button>
                            <button type="button" class="btn btn-lg btn-outline-secondary" onclick="resetTabForNewScan(${tabId})">
                                <i class="fas fa-plus-circle mr-2"></i> ➕ Input Lagi
                            </button>
                            <button type="button" class="btn btn-lg btn-outline-danger" onclick="removeTab(${tabId})">
                                <i class="fas fa-trash-alt mr-2"></i> 🗑️ Tutup Tab
                            </button>
                        </div>
                        
                        <div class="mt-3 text-muted small">
                            <i class="fas fa-clock mr-1"></i> Data tersimpan sebagai Draft. 
                            Klik <strong>Cetak Label</strong> untuk mencetak, atau <strong>Input Lagi</strong> untuk melanjutkan kalibrasi berikutnya.
                        </div>
                    </div>
                `;

            const finishContainer = document.getElementById('finish-action-container');
            if (finishContainer) finishContainer.classList.remove('d-none');

            Swal.fire({
                icon: "success",
                title: "✓ Data Tersimpan!",
                html: "<strong>" + escapeHtml(formName) + "</strong><br>ID: " + calibrationId,
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: "top-end"
            });
        }
        window.handleSaveSuccess = handleSaveSuccess;

        window.resetTabForNewScan = function(tabId) {
            const container = document.querySelector(".lk-form-container[data-lk-id=\"" + tabId + "\"]");
            if (!container) return;

            const tabButton = document.getElementById("lk-tab-" + tabId);
            if (tabButton) {
                tabButton.classList.remove("tab-saved");
                const badge = tabButton.querySelector(".badge");
                if (badge) {
                    badge.className = "badge badge-secondary ml-1";
                    badge.textContent = "Kosong";
                }
            }

            updateTabName(tabId, null, "Tab " + tabId);

            container.innerHTML =
                "<div class=\"row fade-in\">" +
                "    <div class=\"col-md-6 mb-3\">" +
                "        <div class=\"border rounded p-4 bg-light text-center h-100 d-flex flex-column justify-content-center\">" +
                "            <i class=\"fas fa-hand-pointer text-primary fa-3x mb-3\"></i>" +
                "            <h5 class=\"text-primary\">Pilih Manual</h5>" +
                "            <p class=\"text-muted\">Pilih jenis alat ukur dari dropdown di atas untuk menampilkan form kalibrasi di tab ini.</p>" +
                "        </div>" +
                "    </div>" +
                "    <div class=\"col-md-6 mb-3\">" +
                "        <div class=\"border rounded p-4 text-center h-100 d-flex flex-column justify-content-center align-items-center bg-white shadow-sm hover-shadow transition-all\">" +
                "            <h5 class=\"text-success mb-3\"><i class=\"fas fa-qrcode mr-2\"></i>Scan QR Code Kalibrasi</h5>" +
                "            <p class=\"text-muted small mb-3\">Scan QR Code alat untuk memuat form sekaligus mengisi data secara instan.</p>" +
                "            <div id=\"scanner-wrapper-" + tabId + "\" class=\"w-100 mb-3\" style=\"display:none; max-width: 300px; margin: 0 auto;\">" +
                "                <div id=\"reader-" + tabId + "\" class=\"qr-reader-container w-100 overflow-hidden rounded border border-success\" style=\"min-height: 250px;\"></div>" +
                "                <div id=\"scanResult-" + tabId + "\" class=\"mt-3 text-center d-none alert alert-success p-2\">" +
                "                    <div class=\"spinner-border spinner-border-sm text-success mr-2\" role=\"status\"></div>" +
                "                    <span>Mengambil data...</span>" +
                "                </div>" +
                "            </div>" +
                "            <button type=\"button\" class=\"btn btn-success btn-start-scan\" data-target-tab=\"" + tabId + "\">" +
                "                <i class=\"fas fa-camera mr-1\"></i> Mulai Scan" +
                "            </button>" +
                "            <button type=\"button\" class=\"btn btn-outline-danger btn-stop-scan mt-2\" data-target-tab=\"" + tabId + "\" style=\"display:none;\">" +
                "                <i class=\"fas fa-stop-circle mr-1\"></i> Matikan Kamera" +
                "            </button>" +
                "        </div>" +
                "    </div>" +
                "</div>";


            container.setAttribute('data-form-type', '');
            container.setAttribute('data-form-name', 'Kosong');
            container.setAttribute('data-current-form', '');
            container.setAttribute('data-current-resolution', '');
            container.setAttribute('data-current-capacity', '');
            container.setAttribute('data-current-repetition', '');
            container.setAttribute('data-current-thermo-type', '');
            container.setAttribute('data-current-timbangan-type', '');
            container.setAttribute('data-current-insulation-type', '');
            container.setAttribute('data-current-count', '1');

            Swal.fire({
                icon: 'info',
                title: 'Tab Siap Digunakan Lagi',
                text: 'Anda dapat memilih form baru atau scan QR code untuk mengisi data kalibrasi berikutnya.',
                timer: 2000,
                showConfirmButton: false
            });
        };


        const formSelect = $('#formSelect');
        const hasDraft = localStorage.getItem('calibration_draft_state_' + '{{ auth()->user()->id }}') !== null;
        if (formSelect.val() && !hasDraft) {
            setTimeout(() => {
                formSelect.trigger('change');
            }, 300);
        }

        @if(session('swal_error'))
        Swal.fire({
            icon: 'error',
            title: '{{ session('
            swal_title ', '
            Gagal!') }}',
            text: '{{ session('
            swal_text ', '
            Terjadi kesalahan.Silakan coba lagi.
            ') }}',
            confirmButtonText: 'OK'
        });
        @endif

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('
            success ') }}',
            timer: 2000,
            showConfirmButton: false
        });
        @endif

        // ==================================================================
        // 💾 SYSTEM DRAFT AUTO-SAVE & AUTO-RESTORE (localStorage + Server)
        // ==================================================================
        // Key localStorage unik per akun user agar draft tidak bocor antar akun
        const DRAFT_USER_ID = parseInt("{{ auth()->user()->id }}", 10);
        const DRAFT_KEY = 'calibration_draft_state_' + DRAFT_USER_ID;
        window.DRAFT_KEY = DRAFT_KEY; // expose agar bisa diakses dari global-form.js

        window.isRestoringState = false;
        let saveTimeout;
        let serverSyncTimeout;

        // ────────────────────────────────────────────────────────────────
        // Helper: kumpulkan semua nilai input dalam container (termasuk disabled)
        // ────────────────────────────────────────────────────────────────
        function collectInputValues(container, tabId) {
            const values = {};
            // Sertakan disabled agar field seperti kode_alat_display juga tersimpan
            const inputs = container.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.name === '_token' || input.type === 'password' || !input.name) return;
                const key = `tab_${tabId}_${input.name}`;
                if (input.type === 'checkbox' || input.type === 'radio') {
                    if (input.checked) {
                        if (!values[key]) values[key] = [];
                        if (!values[key].includes(input.value)) values[key].push(input.value);
                    }
                } else {
                    // Simpan value meski disabled — pakai .value (bukan getAttribute)
                    if (input.value !== '') {
                        values[key] = input.value;
                    } else if (!(key in values)) {
                        values[key] = '';
                    }
                }
            });
            return values;
        }

        // ────────────────────────────────────────────────────────────────
        // Helper: kumpulkan state subform yang aktif
        // ────────────────────────────────────────────────────────────────
        function collectSubformState(container, tabId) {
            const subforms = [];
            // Checkbox subform yang dicentang
            container.querySelectorAll(`.subform-checkbox-create[data-tab-id="${tabId}"]:checked`).forEach(chk => {
                subforms.push(chk.value);
            });
            return subforms;
        }

        // ────────────────────────────────────────────────────────────────
        // SAVE STATE → localStorage (dan jadwalkan sync ke server)
        // ────────────────────────────────────────────────────────────────
        window.debouncedSave = function() {
            if (window.isRestoringState) return;
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(saveCalibrationState, 800);
        };

        window.saveCalibrationState = function() {
            if (window.isRestoringState) return;

            const state = {
                tabs: [],
                inputs: {},
                savedAt: Date.now()
            };
            const tabButtons = document.querySelectorAll('#lkTabs .nav-link');

            if (tabButtons.length === 0) {
                localStorage.removeItem(DRAFT_KEY);
                return;
            }

            let hasActiveTabs = false;
            tabButtons.forEach(btn => {
                if (btn.classList.contains('tab-saved')) return;

                const tabIdAttr = btn.getAttribute('id');
                if (!tabIdAttr) return;
                const tabId = tabIdAttr.replace('lk-tab-', '');

                const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
                if (!container) return;

                const formType = container.getAttribute('data-current-form');
                if (!formType) return;

                hasActiveTabs = true;

                // Ambil nama tab untuk info display
                const tabNameEl = btn.querySelector('.tab-name');
                const tabName = tabNameEl ? tabNameEl.textContent.trim() : formType;

                state.tabs.push({
                    tabId: tabId,
                    formType: formType,
                    formName: tabName,
                    resolution: container.getAttribute('data-current-resolution'),
                    capacity: container.getAttribute('data-current-capacity'),
                    repetition: container.getAttribute('data-current-repetition'),
                    thermoType: container.getAttribute('data-current-thermo-type'),
                    timbanganType: container.getAttribute('data-current-timbangan-type'),
                    insulationType: container.getAttribute('data-current-insulation-type'),
                    count: container.getAttribute('data-current-count'),
                    subforms: collectSubformState(container, tabId), // ← subform aktif
                });

                // Kumpulkan semua nilai input (termasuk disabled)
                const vals = collectInputValues(container, tabId);
                Object.assign(state.inputs, vals);
            });

            const activeTab = document.querySelector('#lkTabs .nav-link.active');
            if (activeTab && activeTab.getAttribute('id')) {
                state.activeTabId = activeTab.getAttribute('id').replace('lk-tab-', '');
            }

            if (hasActiveTabs) {
                localStorage.setItem(DRAFT_KEY, JSON.stringify(state));
                scheduleServerSync(state);
            } else {
                localStorage.removeItem(DRAFT_KEY);
            }
        };

        // ────────────────────────────────────────────────────────────────
        // SERVER SYNC — kirim draft ke server setiap 30 detik
        // ────────────────────────────────────────────────────────────────
        function scheduleServerSync(state) {
            clearTimeout(serverSyncTimeout);
            serverSyncTimeout = setTimeout(() => syncDraftToServer(state), 30000);
        }

        function syncDraftToServer(state) {
            const draftStr = state ? JSON.stringify(state) : localStorage.getItem(DRAFT_KEY);
            if (!draftStr) return;

            fetch('/api/calibration-draft/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        draft_data: draftStr
                    }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        console.log(`✅ Draft synced to server at ${data.last_saved_at}`);
                        // Tampilkan indikator kecil
                        showDraftSyncIndicator(data.last_saved_at);
                    }
                })
                .catch(err => console.warn('Draft server sync failed (offline?):', err));
        }

        function showDraftSyncIndicator(time) {
            let indicator = document.getElementById('draft-sync-indicator');
            if (!indicator) {
                indicator = document.createElement('div');
                indicator.id = 'draft-sync-indicator';
                indicator.style.cssText = 'position:fixed;bottom:12px;right:12px;background:rgba(40,167,69,0.92);color:#fff;padding:5px 12px;border-radius:20px;font-size:12px;z-index:9999;transition:opacity 0.5s;pointer-events:none;';
                document.body.appendChild(indicator);
            }
            indicator.textContent = `💾 Draft tersimpan ke server ${time}`;
            indicator.style.opacity = '1';
            setTimeout(() => {
                indicator.style.opacity = '0';
            }, 3000);
        }

        function clearServerDraft() {
            fetch('/api/calibration-draft/clear', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
            }).catch(() => {});
        }

        // ────────────────────────────────────────────────────────────────
        // HELPER: set nilai 1 input + trigger events
        // ────────────────────────────────────────────────────────────────
        function applyInputValue(input, savedValue) {
            if (savedValue === undefined || savedValue === null) return;

            if (input.type === 'checkbox' || input.type === 'radio') {
                const wasChecked = input.checked;
                if (Array.isArray(savedValue)) {
                    input.checked = savedValue.includes(input.value);
                } else {
                    input.checked = (savedValue === input.value || savedValue === true);
                }
                if (input.checked !== wasChecked) {
                    input.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                }
            } else {
                if (input.value !== savedValue) {
                    // Hilangkan disabled sementara agar bisa diisi (field display)
                    const wasDisabled = input.disabled;
                    if (wasDisabled) input.removeAttribute('disabled');
                    input.value = savedValue;
                    if (wasDisabled) input.setAttribute('disabled', 'disabled');

                    input.dispatchEvent(new Event('input', {
                        bubbles: true
                    }));
                    input.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                }

                // Select2 support
                if (typeof $ !== 'undefined' && $(input).data('select2')) {
                    $(input).val(savedValue).trigger('change.select2');
                }
            }
        }

        // ────────────────────────────────────────────────────────────────
        // RESTORE semua input dalam container dari state.inputs
        // ────────────────────────────────────────────────────────────────
        function restoreInputsInContainer(container, tabIdOld, tabIdNew) {
            const stateStr = localStorage.getItem(DRAFT_KEY);
            if (!stateStr) return;
            const state = JSON.parse(stateStr);

            // Query SEMUA input termasuk disabled
            const inputs = container.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.name === '_token' || input.type === 'password' || !input.name) return;

                // Coba key dengan tabId lama
                const oldKey = `tab_${tabIdOld}_${input.name}`;
                let savedValue = state.inputs[oldKey];

                // Fallback: coba juga dengan tabId baru (jika tabId sama)
                if (savedValue === undefined) {
                    const newKey = `tab_${tabIdNew}_${input.name}`;
                    savedValue = state.inputs[newKey];
                }

                if (savedValue !== undefined) {
                    applyInputValue(input, savedValue);
                }
            });
        }

        // ────────────────────────────────────────────────────────────────
        // RESTORE STATE — dari localStorage (fallback ke server jika kosong)
        // ────────────────────────────────────────────────────────────────
        window.restoreCalibrationState = async function(stateOverride) {
            const raw = stateOverride || localStorage.getItem(DRAFT_KEY);
            if (!raw) return;

            let state;
            try {
                state = (typeof raw === 'object') ? raw : JSON.parse(raw);
                if (!state || !state.tabs || state.tabs.length === 0) return;
            } catch (e) {
                console.error('Invalid draft JSON:', e);
                return;
            }

            window.isRestoringState = true;
            console.log('🔄 Restoring calibration draft...', state);

            Swal.fire({
                title: 'Memulihkan Draft...',
                html: `<small class="text-muted">Memuat ${state.tabs.length} form kalibrasi, mohon tunggu.</small>`,
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading(),
            });

            // Hapus tab default
            document.querySelectorAll('#lkTabs .nav-item').forEach(el => el.remove());
            document.querySelectorAll('#lkTabContent .tab-pane').forEach(el => el.remove());
            tabCounter = 0;

            for (let i = 0; i < state.tabs.length; i++) {
                const tabInfo = state.tabs[i];

                addNewTab(tabInfo.formType);
                const newTabId = tabCounter;

                // Load form HTML
                await loadFormToTab(
                    newTabId,
                    tabInfo.formType,
                    tabInfo.resolution,
                    tabInfo.capacity,
                    tabInfo.repetition,
                    tabInfo.thermoType,
                    tabInfo.timbanganType,
                    tabInfo.insulationType,
                    tabInfo.count
                );

                // Tunggu semua setTimeout di loadFormToTab selesai (injeksi no_po, select2, dll)
                await new Promise(r => setTimeout(r, 600));

                const container = document.querySelector(`.lk-form-container[data-lk-id="${newTabId}"]`);
                if (!container) continue;

                // Restore subform checkboxes dahulu (agar subform ter-load)
                if (tabInfo.subforms && tabInfo.subforms.length > 0) {
                    for (const sfType of tabInfo.subforms) {
                        const chk = container.querySelector(`.subform-checkbox-create[value="${sfType}"]`);
                        if (chk && !chk.checked) {
                            chk.checked = true;
                            // Load subform
                            if (typeof window.loadSubformCreate === 'function') {
                                await window.loadSubformCreate(newTabId, sfType);
                            }
                        }
                    }
                    // Tunggu subform selesai load
                    await new Promise(r => setTimeout(r, 800));
                }

                // Restore semua nilai input (1st pass)
                restoreInputsInContainer(container, tabInfo.tabId, newTabId);

                // 2nd pass setelah 400ms — untuk field yang muncul setelah event cascade
                await new Promise(r => setTimeout(r, 400));
                restoreInputsInContainer(container, tabInfo.tabId, newTabId);

                console.log(`✅ Tab ${newTabId} (${tabInfo.formType}) restored`);
            }

            // Set active tab
            if (state.activeTabId) {
                const index = state.tabs.findIndex(t => t.tabId == state.activeTabId);
                const targetIdx = index !== -1 ? index + 1 : 1;
                const tabBtn = document.getElementById(`lk-tab-${targetIdx}`);
                if (tabBtn) {
                    document.querySelectorAll('#lkTabs .nav-link').forEach(el => {
                        el.classList.remove('active');
                        el.setAttribute('aria-selected', 'false');
                    });
                    document.querySelectorAll('#lkTabContent .tab-pane').forEach(el => {
                        el.classList.remove('show', 'active');
                    });
                    tabBtn.classList.add('active');
                    tabBtn.setAttribute('aria-selected', 'true');
                    const paneId = tabBtn.getAttribute('data-target');
                    if (paneId) {
                        const pane = document.querySelector(paneId);
                        if (pane) pane.classList.add('show', 'active');
                    }
                    if (typeof $ !== 'undefined') $(tabBtn).tab('show');
                }
            }

            Swal.close();
            window.isRestoringState = false;

            Swal.fire({
                icon: 'success',
                title: 'Draft Berhasil Dipulihkan!',
                text: `${state.tabs.length} form kalibrasi berhasil dimuat kembali.`,
                timer: 2500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        };

        // ────────────────────────────────────────────────────────────────
        // CLEAR DRAFT (localStorage + server)
        // ────────────────────────────────────────────────────────────────
        window.clearAllDraft = function() {
            localStorage.removeItem(DRAFT_KEY);
            clearServerDraft();
        };

        // ────────────────────────────────────────────────────────────────
        // EVENT LISTENERS — auto-save saat user mengetik
        // ────────────────────────────────────────────────────────────────
        document.addEventListener('input', function(e) {
            if (e.target.closest('.lk-form-container')) debouncedSave();
        });
        document.addEventListener('change', function(e) {
            if (e.target.closest('.lk-form-container') || e.target.closest('#lkTabs')) debouncedSave();
        });

        // ────────────────────────────────────────────────────────────────
        // STARTUP: cek draft (localStorage dulu, fallback ke server)
        // ────────────────────────────────────────────────────────────────
        setTimeout(async () => {
            let draftStr = localStorage.getItem(DRAFT_KEY);
            let source = 'local';
            let lastSaved = null;

            // Jika tidak ada di localStorage, coba load dari server
            if (!draftStr) {
                try {
                    const res = await fetch('/api/calibration-draft/load', {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const data = await res.json();
                    if (data.success && data.draft) {
                        draftStr = (typeof data.draft === 'string') ? data.draft : JSON.stringify(data.draft);
                        lastSaved = data.last_saved_at;
                        source = 'server';
                        // Simpan ke localStorage agar sesi berikutnya lebih cepat
                        localStorage.setItem(DRAFT_KEY, draftStr);
                        console.log('📥 Draft loaded from server (last saved:', lastSaved, ')');
                    }
                } catch (e) {
                    console.warn('Could not reach server for draft:', e);
                }
            }

            if (!draftStr) return;

            let draftInfo = '';
            try {
                const draftData = (typeof draftStr === 'object') ? draftStr : JSON.parse(draftStr);
                if (draftData && draftData.tabs && draftData.tabs.length > 0) {
                    const tabCount = draftData.tabs.length;
                    const tabNames = draftData.tabs
                        .map(t => t.formName && t.formName !== 'Kosong' ? t.formName : (t.formType || null))
                        .filter(Boolean).slice(0, 4).join(', ');
                    const savedDate = draftData.savedAt ?
                        new Date(draftData.savedAt).toLocaleString('id-ID') :
                        (lastSaved || '—');
                    draftInfo = `<br><small class="text-muted"><b>${tabCount} form:</b> ${tabNames || 'Data tersimpan'}</small>
                                 <br><small class="text-muted">Terakhir disimpan: ${savedDate}</small>`;
                    if (source === 'server') {
                        draftInfo += `<br><span class="badge badge-info mt-1">Dipulihkan dari server (data saat logout)</span>`;
                    }
                }
            } catch (e) {}

            Swal.fire({
                icon: 'question',
                title: 'Pulihkan Data Sebelumnya?',
                html: `Ditemukan data input yang belum disimpan dari sesi sebelumnya.${draftInfo}<br><br>Apakah Anda ingin melanjutkan dari data tersebut?`,
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-history mr-1"></i> Ya, Pulihkan',
                cancelButtonText: '<i class="fas fa-trash mr-1"></i> Tidak, Mulai Baru',
                reverseButtons: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    restoreCalibrationState(draftStr);
                } else {
                    window.clearAllDraft();
                    Swal.fire({
                        icon: 'info',
                        title: 'Data Lama Dihapus',
                        text: 'Halaman siap untuk input data baru.',
                        timer: 1500,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                    });
                }
            });
        }, 400);

        // Auto-save lokal setiap 10 detik
        setInterval(() => {
            if (typeof saveCalibrationState === 'function' && !window.isRestoringState) {
                saveCalibrationState();
            }
        }, 10000);

        // Auto-sync ke server setiap 30 detik (independent dari debounce)
        setInterval(() => {
            if (!window.isRestoringState) {
                const draftStr = localStorage.getItem(DRAFT_KEY);
                if (draftStr) syncDraftToServer(null);
            }
        }, 30000);
    });
</script>

<script>
    // ==========================================
    // FUNGSI LOG MENGGUNAKAN LogHelper VIA AJAX
    // ==========================================

    function sendLog(event, data) {
        fetch('/api/log-activity', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                event: event,
                data: data
            })
        }).catch(err => console.error('Log error:', err));
    }

    // Log functions
    function logSelectFormJS(formType, formName, tabId = null, additionalData = {}) {
        sendLog('select_form', {
            form_type: formType,
            form_name: formName,
            tab_id: tabId,
            ...additionalData
        });
    }

    function logStartScanJS(tabId) {
        sendLog('start_scan', {
            tab_id: tabId
        });
    }

    function logScanSuccessJS(tabId, qrCode) {
        sendLog('scan_success', {
            tab_id: tabId,
            qr_code: qrCode
        });
    }

    function logScanFailedJS(tabId, qrCode, error) {
        sendLog('scan_failed', {
            tab_id: tabId,
            qr_code: qrCode,
            error: error
        });
    }

    function logAutoFillJS(tabId, formType, namaAlat, filledCount) {
        sendLog('auto_fill_form', {
            tab_id: tabId,
            form_type: formType,
            nama_alat: namaAlat,
            filled_count: filledCount
        });
    }

    function logLoadFormJS(tabId, formType, params = {}) {
        sendLog('load_form', {
            tab_id: tabId,
            form_type: formType,
            params: params
        });
    }

    function logCreateTabJS(tabId, formType = null, namaAlat = null) {
        sendLog('create_tab', {
            tab_id: tabId,
            form_type: formType,
            nama_alat: namaAlat
        });
    }

    function logDeleteTabJS(tabId) {
        sendLog('delete_tab', {
            tab_id: tabId
        });
    }

    function logChangeTabJS(oldTabId, newTabId, formType = null) {
        sendLog('change_tab', {
            old_tab_id: oldTabId,
            new_tab_id: newTabId,
            form_type: formType
        });
    }

    function logSaveCalibrationJS(tabId, calibrationId, namaAlat, formType) {
        sendLog('save_calibration', {
            tab_id: tabId,
            calibration_id: calibrationId,
            nama_alat: namaAlat,
            form_type: formType
        });
    }
</script>

<style>
    /* Custom CSS untuk Scanner dalam Tab */
    .transition-all {
        transition: all 0.3s ease;
    }

    .qr-reader-container {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        position: relative;
        min-height: 250px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%23ccc' d='M50 30c-11 0-20 9-20 20s9 20 20 20 20-9 20-20-9-20-20-20zm0 36c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16z'/%3E%3Cpath fill='%23666' d='M50 10c-22.1 0-40 17.9-40 40s17.9 40 40 40 40-17.9 40-40-17.9-40-40-40zm0 76c-19.9 0-36-16.1-36-36s16.1-36 36-36 36 16.1 36 36-16.1 36-36 36z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 80px;
    }

    .qr-reader-container video {
        border-radius: 0.5rem;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    .lk-tabs-container {
        background-color: #f8f9fa;
        padding-top: 5px;
    }

    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }

    .nav-tabs .nav-link {
        background-color: #e9ecef;
        border: 1px solid #dee2e6;
        border-bottom: none;
        margin-right: 3px;
        color: #495057;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        transition: all 0.2s;
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .nav-tabs .nav-link:hover {
        background-color: #dee2e6;
        border-color: #ced4da;
    }

    .nav-tabs .nav-link.active {
        background-color: #ffffff;
        border-bottom-color: transparent;
        color: #0d6efd;
        font-weight: 500;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.05);
    }

    .nav-tabs .nav-link .fa-times {
        opacity: 0.5;
        transition: opacity 0.2s;
    }

    .nav-tabs .nav-link .fa-times:hover {
        opacity: 1;
    }

    .tab-content {
        background-color: #ffffff;
        min-height: 400px;
    }

    .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.4rem;
    }

    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .select-alat-btn:hover {
        transform: scale(1.05);
        transition: transform 0.2s ease;
    }

    .form-select:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
    }

    @media (max-width: 768px) {
        .nav-tabs .nav-link {
            padding: 0.4rem 0.6rem;
            font-size: 0.8rem;
            max-width: 180px;
        }
    }

    .sync-pulse {
        animation: syncPulse 0.5s ease-out;
    }

    @keyframes syncPulse {
        0% {
            box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
        }
    }

    .lk-form-container {
        position: relative;
        transition: filter 0.3s ease;
    }

    .loading-overlay-active {
        filter: blur(2px) grayscale(50%);
        pointer-events: none;
        min-height: 200px;
    }

    .loading-overlay-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        text-align: center;
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .nav-tabs .nav-link.tab-saved {
        border-top: 3px solid #28a745;
        background-color: #f0fff4;
    }

    .save-success-overlay {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin: 20px auto;
        max-width: 800px;
        border: 1px solid #e1e8ed;
    }

    #finish-action-container .alert {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.15) !important;
    }


    .qr-reader-container {
        background-color: #000;
        border-radius: 12px;
        overflow: hidden;
    }

    .qr-reader-container video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    /* Efek scanning aktif - hanya border */
    .qr-reader-container.scanning-active {
        border: 2px solid #00ff00;
        animation: borderPulse 1.5s ease-in-out infinite;
    }

    @keyframes borderPulse {

        0%,
        100% {
            border-color: #00ff00;
            box-shadow: 0 0 5px rgba(0, 255, 0, 0.3);
        }

        50% {
            border-color: #00cc00;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.6);
        }
    }

    /* Di style section */
    .radio-group-tempat,
    .radio-group-fungsi,
    .checkbox-group-alat-standar {
        padding: 10px;
        border-radius: 5px;
        transition: border 0.3s ease;
    }

    .radio-group-tempat.error,
    .radio-group-fungsi.error,
    .checkbox-group-alat-standar.error {
        border: 2px solid #dc3545 !important;
        background-color: #fff5f5;
    }
</style>

<script>
    // =====================================================
    // NAVIGASI SEPERTI EXCEL: TAB = ke Bawah (bukan kanan)
    // ENTER   = ke Bawah (kolom yang sama)
    // SHIFT+TAB = ke Atas
    // Berlaku di form input kalibrasi baru
    // =====================================================
    document.addEventListener('keydown', function(e) {
        // Hanya proses Tab dan Enter
        if (e.key !== 'Tab' && e.key !== 'Enter') return;

        var activeEl = document.activeElement;
        if (!activeEl) return;

        // Hanya berlaku untuk input di dalam sel tabel (<td>)
        var currentTd = activeEl.closest('td');
        var currentTr = activeEl.closest('tr');
        if (!currentTd || !currentTr) return;

        // Hanya untuk input teks/angka (bukan hidden, button, dll.)
        if (activeEl.tagName !== 'INPUT' && activeEl.tagName !== 'SELECT') return;
        if (activeEl.type === 'hidden' || activeEl.type === 'button' ||
            activeEl.type === 'submit' || activeEl.type === 'checkbox') return;

        // Tentukan arah: ke bawah (Tab/Enter) atau ke atas (Shift+Tab)
        var goUp = (e.key === 'Tab' && e.shiftKey);
        var targetTr = goUp ? currentTr.previousElementSibling : currentTr.nextElementSibling;

        // Kalau tidak ada baris berikutnya/sebelumnya, biarkan Tab berjalan normal
        if (!targetTr) return;

        // Lewati baris header (thead)
        if (targetTr.closest('thead')) return;

        // Gunakan posisi visual (getBoundingClientRect) agar akurat meski ada rowspan/colspan
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

        // Jika tidak ditemukan, biarkan Tab/Enter berjalan normal (pindah ke luar tabel)
    });

    // Global Multi-Form dynamic subforms list from Laravel Registry
    const formTypesList = JSON.parse('@json(array_keys(\App\Http\Controllers\CalibrationController::$formRegistry))');

    // ==========================================
    // 🔥 SAVE STATE RADIO & CHECKBOX (UNTUK SUBFORM)
    // ==========================================
    function saveRadioCheckboxState(container) {
        const state = {
            radios: {},
            checkboxes: {}
        };

        // Simpan semua radio button yang dipilih
        container.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
            state.radios[radio.name] = radio.value;
            console.log(`💾 Saved radio: ${radio.name} = ${radio.value}`);
        });

        // Simpan semua checkbox yang dipilih
        container.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
            if (!state.checkboxes[checkbox.name]) {
                state.checkboxes[checkbox.name] = [];
            }
            state.checkboxes[checkbox.name].push(checkbox.value);
            console.log(`💾 Saved checkbox: ${checkbox.name} = ${checkbox.value}`);
        });

        return state;
    }

    // ==========================================
    // 🔥 RESTORE STATE RADIO & CHECKBOX (DIPERBAIKI)
    // ==========================================
    function restoreRadioCheckboxState(container, state) {
        if (!state) return;

        console.log('🔄 Restoring state:', state);

        // Restore radio buttons
        Object.keys(state.radios).forEach(name => {
            const value = state.radios[name];
            const radio = container.querySelector(`input[type="radio"][name="${name}"][value="${value}"]`);
            if (radio) {
                radio.checked = true;
                radio.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
                radio.dispatchEvent(new Event('click', {
                    bubbles: true
                }));
                radio.dispatchEvent(new Event('input', {
                    bubbles: true
                }));
                console.log(`✅ Restored radio: ${name} = ${value}`);
            } else {
                console.warn(`⚠️ Radio not found: ${name} = ${value}`);
                const radios = container.querySelectorAll(`input[type="radio"][name="${name}"]`);
                radios.forEach(r => {
                    if (r.value === value) {
                        r.checked = true;
                        r.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                        console.log(`✅ Restored radio (fallback): ${name} = ${value}`);
                    }
                });
            }
        });

        // Restore checkboxes
        Object.keys(state.checkboxes).forEach(name => {
            const values = state.checkboxes[name];
            const checkboxes = container.querySelectorAll(`input[type="checkbox"][name="${name}"]`);
            checkboxes.forEach(checkbox => {
                if (values.includes(checkbox.value)) {
                    checkbox.checked = true;
                    checkbox.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                    console.log(`✅ Restored checkbox: ${name} = ${checkbox.value}`);
                }
            });
        });
    }

    // ==========================================
    // 🔥 FORCE RESTORE RADIO STATE
    // ==========================================
    function forceRestoreRadioState(container) {
        const savedState = window._lastSavedRadioState || {};
        console.log('🔧 Force restoring radio state:', savedState);

        Object.keys(savedState).forEach(name => {
            const value = savedState[name];
            const radio = container.querySelector(`input[type="radio"][name="${name}"][value="${value}"]`);
            if (radio) {
                radio.checked = true;
                radio.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
                radio.dispatchEvent(new Event('click', {
                    bubbles: true
                }));
                console.log(`✅ Force restored radio: ${name} = ${value}`);
            }
        });
    }

    // Override saveRadioCheckboxState untuk menyimpan ke global
    const originalSaveRadioCheckboxState = saveRadioCheckboxState;
    saveRadioCheckboxState = function(container) {
        const state = originalSaveRadioCheckboxState(container);
        window._lastSavedRadioState = state.radios;
        return state;
    };

    window.appendSubformPanelToTab = function(tabId, mainFormType) {
        console.log(`🔌 [appendSubformPanelToTab] Starting execution for tabId=${tabId}, mainFormType=${mainFormType}`);
        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
        if (!container || !mainFormType) {
            console.warn(`⚠️ [appendSubformPanelToTab] Container or mainFormType missing. container:`, container, `mainFormType:`, mainFormType);
            return;
        }

        const oldPanel = container.querySelector('#subform-panel-wrapper_tab' + tabId);
        if (oldPanel) oldPanel.remove();
        const oldContainer = container.querySelector('#subform-container_tab' + tabId);
        if (oldContainer) oldContainer.remove();

        const subformContainer = document.createElement('div');
        subformContainer.id = 'subform-container_tab' + tabId;
        subformContainer.className = 'mt-3';

        const panelWrapper = document.createElement('div');
        panelWrapper.id = 'subform-panel-wrapper_tab' + tabId;
        panelWrapper.className = 'card card-outline card-primary mt-4';

        let checkboxesHtml = '';
        formTypesList.forEach(type => {
            if (type !== mainFormType) {
                const label = type.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                checkboxesHtml += `
                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input subform-checkbox-create" type="checkbox" data-tab-id="${tabId}" data-form-type="${type}" id="chk_subform_${type}_tab${tabId}" value="${type}">
                            <label for="chk_subform_${type}_tab${tabId}" class="form-check-label font-weight-normal">${label}</label>
                        </div>
                    </div>
                `;
            }
        });

        panelWrapper.innerHTML = `
            <div class="card-header">
                <h3 class="card-title font-weight-bold"><i class="fas fa-plus-circle mr-1"></i> Form Tambahan (Optional Worksheets)</h3>
            </div>
            <div class="card-body">
                <p class="text-muted small">Pilih form tambahan yang ingin digabungkan ke transaksi kalibrasi ini:</p>
                <div class="row">
                    ${checkboxesHtml}
                </div>
            </div>
        `;

        const style = document.createElement('style');
        style.innerHTML = `
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
                overflow-x: auto !important;
            }
        `;
        container.appendChild(style);

        const saveBtn = container.querySelector('#btnSimpanSemua') || container.querySelector('.btn-primary') || container.querySelector('button[type="submit"]');
        if (saveBtn) {
            const parentDiv = saveBtn.closest('div');
            if (parentDiv) {
                parentDiv.parentNode.insertBefore(subformContainer, parentDiv);
                parentDiv.parentNode.insertBefore(panelWrapper, parentDiv);
            } else {
                container.appendChild(subformContainer);
                container.appendChild(panelWrapper);
            }
        } else {
            container.appendChild(subformContainer);
            container.appendChild(panelWrapper);
        }
    };

    $(document).on('change', '.subform-checkbox-create', function() {
        const tabId = $(this).data('tab-id');
        const formType = $(this).data('form-type');
        const isChecked = $(this).is(':checked');

        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
        const savedState = saveRadioCheckboxState(container);
        console.log('💾 State saved before checkbox change:', savedState);

        if (isChecked) {
            window.loadSubformCreate(tabId, formType);
        } else {
            window.removeSubformCreate(tabId, formType);
        }

        setTimeout(() => {
            const containerAfter = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            restoreRadioCheckboxState(containerAfter, savedState);
            console.log('🔄 State restored after 500ms');
        }, 500);

        setTimeout(() => {
            const containerAfter = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            restoreRadioCheckboxState(containerAfter, savedState);
            forceRestoreRadioState(containerAfter);
            console.log('🔄 State restored after 1000ms (force)');
        }, 1000);
    });

    $(document).on('click', '.remove-subform-create-btn', function() {
        const tabId = $(this).data('tab-id');
        const formType = $(this).data('form-type');
        window.removeSubformCreate(tabId, formType);
    });

    window.loadSubformCreate = function(tabId, formType) {
        return new Promise((resolve, reject) => {
            const $container = $('#subform-container_tab' + tabId);
            if ($container.find('.subform-wrapper[data-form-type="' + formType + '"]').length > 0) {
                return resolve();
            }

            const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            const savedState = saveRadioCheckboxState(container);
            console.log('💾 State saved before loading subform:', savedState);

            if (!window.isRestoringState) {
                Swal.fire({
                    title: 'Loading form...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }

            var url = '/get-form-html/' + formType + '?is_subform=true';

            $.ajax({
                url: url,
                type: 'GET',
                success: function(html) {
                    if (!window.isRestoringState) Swal.close();

                    html = html.replace(/\bsubmitSemuaForm\b/g, "subform_submitSemuaForm");
                    var label = formType.replace(/_/g, ' ').toUpperCase();
                    var wrapper = $('<div class="subform-wrapper mb-4 border p-3 rounded bg-light" data-form-type="' + formType + '" data-tab-id="' + tabId + '"></div>');
                    var header = $('<div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">' +
                        '<h5 class="m-0 text-secondary"><i class="fas fa-file-alt"></i> Form Tambahan: ' + label + '</h5>' +
                        '<button type="button" class="btn btn-sm btn-danger remove-subform-create-btn" data-tab-id="' + tabId + '" data-form-type="' + formType + '">Hapus Form</button>' +
                        '</div>');

                    var hiddenInput = $('<input type="hidden" name="additional_forms[]" value="' + formType + '">');

                    wrapper.append(header);
                    wrapper.append(hiddenInput);
                    wrapper.append(html);

                    $container.append(wrapper);

                    window.processSubformCreate(wrapper);

                    setTimeout(() => {
                        const containerAfter = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
                        restoreRadioCheckboxState(containerAfter, savedState);
                        console.log('🔄 State restored after loading subform (500ms)');
                    }, 500);

                    setTimeout(() => {
                        const containerAfter = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
                        restoreRadioCheckboxState(containerAfter, savedState);
                        forceRestoreRadioState(containerAfter);
                        console.log('🔄 State restored after loading subform (1000ms - force)');
                    }, 1000);

                    resolve();
                },
                error: function(xhr) {
                    if (!window.isRestoringState) {
                        Swal.close();
                        Swal.fire('Error', 'Gagal memuat form tambahan.', 'error');
                    }
                    $('#chk_subform_' + formType + '_tab' + tabId).prop('checked', false);
                    reject(xhr);
                }
            });
        });
    };

    window.removeSubformCreate = function(tabId, formType) {
        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
        const savedState = saveRadioCheckboxState(container);
        console.log('💾 State saved before removing subform:', savedState);

        $('#subform-container_tab' + tabId).find('.subform-wrapper[data-form-type="' + formType + '"]').remove();
        $('#chk_subform_' + formType + '_tab' + tabId).prop('checked', false);

        setTimeout(() => {
            const containerAfter = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            restoreRadioCheckboxState(containerAfter, savedState);
            console.log('🔄 State restored after removing subform');
        }, 200);
    };

    // ================================================================
    // 🔥 PROCESS SUBFORM - TAMBAHKAN PREFIX sub_ PADA SEMUA FIELD
    // ================================================================
    window.processSubformCreate = function($wrapper) {
        // Bungkus semua tabel dalam div.table-responsive
        $wrapper.find('table').each(function() {
            var $table = $(this);
            if (!$table.parent().hasClass('table-responsive')) {
                $table.wrap('<div class="table-responsive"></div>');
            }
        });

        // =========================================================
        // 🔥 TAMBAHKAN PREFIX sub_ PADA SEMUA INPUT DI SUBFORM
        // =========================================================
        $wrapper.find('input, select, textarea').each(function() {
            const $el = $(this);
            const name = $el.attr('name');
            if (name && !name.startsWith('sub_')) {
                // Simpan nama asli sebagai data attribute
                $el.data('original-name', name);
                // Ubah name menjadi dengan prefix sub_
                $el.attr('name', 'sub_' + name);
                console.log(`🔄 Subform field renamed: ${name} -> sub_${name}`);
            }

            // Mencegah select Nama Alat di subform me-reload halaman
            if ($el.attr('onchange') && $el.attr('onchange').includes('updateFormType')) {
                $el.removeAttr('onchange');
            }
        });

        // Hapus attribute 'required' dari semua field identitas subform agar bersifat opsional
        $wrapper.find('.kalibrasi-header-table').find('input, select, textarea').removeAttr('required');
        $wrapper.find('.kalibrasi-main-table').find('input, select, textarea').removeAttr('required');

        // Hapus attribute 'required' dari kondisi kalibrasi subform
        var $kondisiHeader = $wrapper.find('.kalibrasi-section-header').filter(function() {
            var text = $(this).text().trim().toLowerCase();
            return text === 'kondisi kalibrasi' || text === 'kondisi';
        });
        if ($kondisiHeader.length > 0) {
            $kondisiHeader.closest('.row').find('input, select, textarea').removeAttr('required');
        }

        // Tambahkan hidden input agar backend tetap memproses custom identity ini
        if ($wrapper.find('input[name="sub_use_custom_identity"]').length === 0) {
            $wrapper.append(`<input type="hidden" name="sub_use_custom_identity" value="1">`);
        } else {
            $wrapper.find('input[name="sub_use_custom_identity"]').val('1');
        }

        // Tampilkan semua isi tabel main subform
        $wrapper.find('.kalibrasi-main-table').show();

        // Hapus tombol simpan di subform
        $wrapper.find('#btnSimpanSemua').closest('div').hide();
        $wrapper.find('#btnSimpanSemua').hide();
        $wrapper.find('.btn-primary').hide();

        console.log('✅ Subform processed successfully');
    };

    // ==================================================================
    // 🔒 CENTRALIZED SUBMIT SEMUA FORM
    // ==================================================================
    // ==================================================================
    // 🔒 CENTRALIZED SUBMIT SEMUA FORM
    // ==================================================================
    window.isSubmittingForm = false;

    window.submitSemuaForm = async function(specificTabId = null) {
        if (window.isSubmittingForm) {
            console.warn('⚠️ Submit form is already in progress. Ignoring duplicate trigger.');
            return;
        }
        window.isSubmittingForm = true;

        try {
            // Prevent browser native constraint validation errors on hidden tab inputs
            document.querySelectorAll('form').forEach(f => {
                f.setAttribute('novalidate', 'true');
                f.noValidate = true;
            });

            // Determine target tab ID to save (defaults to active tab if specificTabId is not passed)
            let tabIdToSubmit = specificTabId;
            if (!tabIdToSubmit) {
                const activePane = document.querySelector('.tab-pane.active');
                if (activePane && activePane.id && activePane.id.startsWith('lk-pane-')) {
                    tabIdToSubmit = activePane.id.replace('lk-pane-', '');
                } else if (typeof getActiveTabId === 'function') {
                    tabIdToSubmit = getActiveTabId();
                } else {
                    tabIdToSubmit = '1';
                }
            }

            const activeContainer = document.querySelector(`.lk-form-container[data-lk-id="${tabIdToSubmit}"]`);
            if (!activeContainer) {
                Swal.fire('Error', 'Container form untuk tab ini tidak ditemukan!', 'error');
                return;
            }

            const tabName = activeContainer.dataset.formName || `Tab ${tabIdToSubmit}`;

            // Disable save buttons temporarily to prevent double submission
            const submitBtns = activeContainer.querySelectorAll('#btnSimpanSemua, .btn-submit-calibration, button[type="submit"]');
            submitBtns.forEach(btn => btn.disabled = true);

            try {
                // Find all forms in activeContainer (excluding subforms)
                const allFormsInTab = Array.from(activeContainer.querySelectorAll('form')).filter(f => !f.closest('.subform-wrapper') && f.id !== 'noLabelForm' && !f.id.includes('Modal'));

                // Tentukan form_type utama
                let mainFormType = '';
                const formTypeInputInTab = allFormsInTab.length > 0 ? allFormsInTab[0].querySelector('input[name="form_type"]') : activeContainer.querySelector('input[name="form_type"]');
                const timbanganTypeInput = activeContainer.querySelector('input[name="timbanganType"]') || activeContainer.querySelector('select[name="timbangan_type"]');
                const currentTimbanganType = activeContainer.dataset.currentTimbanganType || (timbanganTypeInput ? timbanganTypeInput.value : '');

                if (formTypeInputInTab && formTypeInputInTab.value && formTypeInputInTab.value !== 'timbangan') {
                    mainFormType = formTypeInputInTab.value;
                } else if (currentTimbanganType === 'moisture' || (timbanganTypeInput && timbanganTypeInput.value === 'moisture')) {
                    mainFormType = 'timbangan_moisture';
                } else {
                    mainFormType = activeContainer.dataset.currentForm || activeContainer.dataset.formType || '';
                    if (mainFormType === 'timbangan' && currentTimbanganType === 'moisture') {
                        mainFormType = 'timbangan_moisture';
                    }
                }

                if (!mainFormType) {
                    const selectNamaAlat = activeContainer.querySelector('select[name="nama_alat"]');
                    if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
                        const mapping = {
                            'Bore Gauge': 'bore_gauge',
                            'Inside Micrometer': 'inside_micrometer',
                            'Outside Micrometer': 'outside_micrometer',
                            'Depth Micrometer': 'depth_micrometer',
                            'Dial Indicator': 'dial_indicator',
                            'Dial Test Indicator': 'dial_test_indicator',
                            'Caliper': 'caliper',
                            'Thermometer': 'thermometer',
                            'Depth Caliper': 'depth_caliper',
                            'Torque Wrench': 'torque_wrench',
                            'Torque Meter': 'torque_meter',
                            'Thickness Gauge': 'thickness_gauge',
                            'Penggaris': 'penggaris',
                            'Enclosure': 'enclosure',
                            'Chamber': 'chamber',
                            'Pressure Gauge': 'pressure_gauge',
                            'Differential Pressure Gauge': 'differential_pressure_gauge',
                            'Volumetrik': 'volumetrik',
                            'Thermohygrometer': 'thermohygrometer',
                            'Viscometer': 'viscometer',
                            'Push Pull': 'push_pull',
                            'Timbangan': 'timbangan',
                            'Gauge Block': 'gauge_block',
                            'Holetest': 'holetest',
                            'Conductivity Meter': 'conductivity_meter',
                            'Coating Thickness': 'coating_thickness',
                            'Mikropipet': 'mikropipet_dispenset',
                            'Taper Gauge': 'taper_gauge',
                            'Feeler Gauge': 'feeler_gauge',
                            'PH Meter': 'ph_meter',
                            'Tachometer': 'tachometer',
                            'Pin Gauge': 'pin_gauge',
                            'Visco Cup': 'visco_cup',
                            'Plain Limit Gauge': 'plain_limit_gauge',
                            'Temp Humid Transmitter': 'temp_humid_transmitter',
                            'Temp Transmitter': 'temp_transmitter',
                            'IR Thermometer': 'ir_thermometer',
                            'Thermoindicator': 'thermoindicator',
                            'Plastic Shim': 'plastic_shim',
                            'Profil Projector': 'profil_projector',
                            'Surface Roughness Tester': 'surface_roughness_tester',
                            'Thread Gauge': 'thread_gauge',
                            'Stopwatch': 'stopwatch',
                            'Centrifuge': 'centrifuge',
                            'UTM': 'utm',
                            'Anak Timbang': 'anak_timbangan',
                            'Pressure Transmitter': 'pressure_transmitter',
                            'Surface Plate': 'surface_plate',
                        };
                        mainFormType = mapping[selectNamaAlat.value] || selectNamaAlat.value;
                    }
                }

                if (!mainFormType) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: `Form type tidak ditemukan pada Tab ${tabIdToSubmit}. Silakan pilih jenis alat ukur kembali.`
                    });
                    return;
                }

                console.log(`📋 SUBMITTING TAB ${tabIdToSubmit} (${tabName}) WITH MAIN FORM TYPE: ${mainFormType}`);

                Swal.fire({
                    title: 'Menyimpan data kalibrasi...',
                    text: `Harap tunggu, menyimpan data ${tabName}...`,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Simpan visualisasi canvas sebelum submit
                if (typeof window.saveCanvasToHidden === 'function') {
                    window.saveCanvasToHidden();
                }
                if (typeof saveCanvasToInput === 'function') {
                    saveCanvasToInput();
                }

                const canvasEl = activeContainer.querySelector('canvas#drawCanvas') || activeContainer.querySelector('canvas');
                const hiddenKeterangan = activeContainer.querySelector('input[name="keterangan"]') || activeContainer.querySelector('#keterangan') || activeContainer.querySelector('#keteranganGambar');
                if (canvasEl && hiddenKeterangan && (!hiddenKeterangan.value || hiddenKeterangan.value.length < 50)) {
                    try {
                        const tempCanvas = document.createElement('canvas');
                        tempCanvas.width = canvasEl.width;
                        tempCanvas.height = canvasEl.height;
                        const tempCtx = tempCanvas.getContext('2d');
                        tempCtx.fillStyle = '#FFFFFF';
                        tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
                        tempCtx.drawImage(canvasEl, 0, 0);
                        hiddenKeterangan.value = tempCanvas.toDataURL('image/png');
                    } catch (e) {
                        console.error('Error drawing canvas fallback:', e);
                    }
                }

                const formData = new FormData();
                const isBulk = allFormsInTab.length > 1;

                if (isBulk) {
                    console.log(`📦 Bulk submit mode: ${allFormsInTab.length} forms in tab ${tabIdToSubmit}`);
                    for (let j = 0; j < allFormsInTab.length; j++) {
                        const form = allFormsInTab[j];
                        const fData = new FormData(form);
                        const formIndex = j + 1;

                        for (let [key, value] of fData.entries()) {
                            if (key === '_token' || key === 'submit_all') continue;

                            if (key === 'alat_standar[]') {
                                formData.append(`form_${formIndex}_alat_standar[]`, value);
                            } else if (key !== 'form_index' && key !== 'jumlah_form') {
                                formData.append(`form_${formIndex}_${key}`, value);
                                if (formIndex === 1 && !formData.has(key)) {
                                    formData.append(key, value);
                                }
                            }
                        }
                        formData.append(`form_${formIndex}_form_index`, String(formIndex));
                    }
                    formData.append('jumlah_form', allFormsInTab.length.toString());
                    formData.append('submit_all', 'true');
                } else {
                    const inputsToProcess = allFormsInTab.length === 1 ?
                        allFormsInTab[0].querySelectorAll('input, select, textarea') :
                        activeContainer.querySelectorAll('input, select, textarea');

                    inputsToProcess.forEach(function(el) {
                        if (!el.name || el.disabled) return;
                        if (el.closest('.subform-wrapper')) return;

                        if (el.type === 'radio') {
                            if (el.checked) formData.append(el.name, el.value);
                            return;
                        }

                        if (el.type === 'checkbox') {
                            if (el.checked) formData.append(el.name, el.value);
                            return;
                        }

                        if (el.type === 'file') {
                            // Cek apakah ada file dari memory/array per tab (seperti gauge_block)
                            const tabKey = 'fileGaugeBlock_tab_' + tabIdToSubmit;
                            const tabFiles = (typeof window[tabKey] !== 'undefined' && Array.isArray(window[tabKey]) && window[tabKey].length > 0) ?
                                window[tabKey] :
                                (el.files && el.files.length > 0 ? Array.from(el.files) : []);

                            if (tabFiles && tabFiles.length > 0) {
                                const fieldName = (el.multiple && !el.name.endsWith('[]')) ? el.name + '[]' : el.name;
                                tabFiles.forEach(function(file) {
                                    formData.append(fieldName, file, file.name);
                                });
                                console.log(`📎 [Submit] Menambahkan ${tabFiles.length} file untuk ${fieldName} di tab ${tabIdToSubmit}`);
                            }
                            return; // PENTING: jangan sampai append el.value (string fakepath)
                        }

                        if (el.tagName === 'SELECT' && el.multiple) {
                            Array.from(el.options).forEach(function(opt) {
                                if (opt.selected) formData.append(el.name, opt.value);
                            });
                            return;
                        }

                        if (el.value !== null && el.value !== undefined && el.value !== '') {
                            formData.append(el.name, el.value);
                        }
                    });

                    // Fallback khusus file attachment gauge_block jika tidak terdeteksi dari inputsToProcess
                    const gaugeBlockFiles = window['fileGaugeBlock_tab_' + tabIdToSubmit] || [];
                    if (gaugeBlockFiles.length > 0 && !formData.has('attachments[]') && !formData.has('attachments')) {
                        gaugeBlockFiles.forEach(function(file) {
                            formData.append('attachments[]', file, file.name);
                        });
                        console.log(`📎 [Submit Fallback] Menambahkan ${gaugeBlockFiles.length} file gauge block dari window array untuk tab ${tabIdToSubmit}`);
                    }

                    const currentCount = parseInt(activeContainer.dataset.currentCount || '1');
                    if (currentCount > 1) {
                        formData.append('jumlah_form', currentCount.toString());
                        formData.append('submit_all', 'true');
                    }
                }

                const tempatRadioChecked = activeContainer.querySelector('input[name="tempat_kalibrasi"]:checked');
                if (tempatRadioChecked && !formData.has('tempat_kalibrasi')) {
                    formData.append('tempat_kalibrasi', tempatRadioChecked.value);
                }

                const fungsiRadioChecked = activeContainer.querySelector('input[name="fungsi_komponen"]:checked');
                if (fungsiRadioChecked && !formData.has('fungsi_komponen')) {
                    formData.append('fungsi_komponen', fungsiRadioChecked.value);
                }

                const alatStandarCheckboxes = activeContainer.querySelectorAll('input[name="alat_standar[]"]:checked');
                if (alatStandarCheckboxes.length > 0 && !formData.has('alat_standar[]')) {
                    alatStandarCheckboxes.forEach(function(checkbox) {
                        formData.append('alat_standar[]', checkbox.value);
                    });
                }

                // Subforms (.subform-wrapper)
                const subformWrappers = activeContainer.querySelectorAll('.subform-wrapper');
                subformWrappers.forEach(function(wrapper) {
                    const inputs = wrapper.querySelectorAll('input, select, textarea');
                    inputs.forEach(function(el) {
                        if (!el.name || el.disabled) return;
                        if (el.type === 'submit' || el.type === 'button') return;

                        const subName = el.name;
                        if (el.type === 'radio') {
                            if (el.checked) formData.append(subName, el.value);
                            return;
                        }
                        if (el.type === 'checkbox') {
                            if (el.checked) formData.append(subName, el.value);
                            return;
                        }
                        if (el.tagName === 'SELECT' && el.multiple) {
                            Array.from(el.options).forEach(function(opt) {
                                if (opt.selected) formData.append(subName, opt.value);
                            });
                            return;
                        }
                        if (el.value !== null && el.value !== undefined && el.value !== '') {
                            formData.append(subName, el.value);
                        }
                    });
                });

                // Additional forms
                document.querySelectorAll('.subform-checkbox-create:checked').forEach(function(checkbox) {
                    if (checkbox.dataset.tabId == tabIdToSubmit && checkbox.dataset.formType) {
                        formData.append('additional_forms[]', checkbox.dataset.formType);
                    }
                });

                formData.delete('form_type');
                formData.append('form_type', mainFormType);
                if (!formData.has('jumlah_form')) {
                    formData.append('jumlah_form', activeContainer.dataset.currentCount || '1');
                }
                formData.append('is_tabbed_mode', 'true');
                formData.append('tab_id', String(tabIdToSubmit));
                formData.append('X-Requested-With', 'XMLHttpRequest');

                let url = '/calibrations';
                if (allFormsInTab.length > 0 && allFormsInTab[0].action) {
                    url = allFormsInTab[0].action;
                }

                console.log(`Sending AJAX submit for Tab ${tabIdToSubmit} to ${url}`);

                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                    }
                });

                const result = await response.json();
                console.log(`Tab ${tabIdToSubmit} response:`, result);

                if (!response.ok || result.success === false) {
                    let errorMsg = result.error || result.message || 'Gagal menyimpan data.';
                    if (result.errors) {
                        const errs = Object.values(result.errors).flat();
                        errorMsg = 'Validasi gagal:\n' + errs.map(e => `• ${e}`).join('\n');
                    }
                    throw new Error(errorMsg);
                }

                Swal.close();
                handleSaveSuccess(tabIdToSubmit, result);

            } catch (err) {
                console.error(`❌ Tab ${tabIdToSubmit} save error:`, err);
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan Data',
                    text: err.message || 'Terjadi kesalahan saat menyimpan data.',
                    confirmButtonColor: '#3085d6'
                });
            } finally {
                submitBtns.forEach(btn => btn.disabled = false);
            }
        } finally {
            window.isSubmittingForm = false;
        }
    };

    // Intercept form submissions globally for tabbed form containers
    document.addEventListener('submit', function(e) {
        if (e.target && (e.target.id.startsWith('kalibrasiForm') || e.target.closest('.lk-form-container'))) {
            e.preventDefault();
            e.stopPropagation();
            const container = e.target.closest('.lk-form-container');
            const tabId = container ? container.dataset.lkId : null;
            window.submitSemuaForm(tabId);
        }
    }, true);

    $(document).off('click', '#btnSimpanSemua, .btn-submit-calibration').on('click', '#btnSimpanSemua, .btn-submit-calibration', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const container = this.closest('.lk-form-container');
        const tabId = container ? container.dataset.lkId : null;
        window.submitSemuaForm(tabId);
    });
</script>
@endpush