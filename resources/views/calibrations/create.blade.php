@extends('layouts.app')

@section('title', 'Pilih Form Kalibrasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0">Pilih Jenis Form Kalibrasi</h4>
                </div>
                <div class="card-body p-3 p-md-4">

                    <!-- Include CSS Select2 -->
                    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
                    <!-- Include FontAwesome for icons -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

                    <!-- Search Box dan Select -->
                    <div class="mb-3 mb-md-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-bold">Jenis Alat Ukur</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="searchBtn">
                                <i class="fas fa-search me-1"></i> Cari Alat
                            </button>
                        </div>
                        
                        <select id="formSelect" class="form-select select2">
                            <option value="">-- Pilih Form --</option>
                            <option value="inside_micrometer">Inside Micrometer</option>
                            <option value="outside_micrometer">Outside Micrometer</option>
                            <option value="depth_micrometer">Depth Micrometer</option>
                            <option value="thermometer">Thermometer</option>
                            <option value="dial_indicator">Dial Indicator</option>
                            <option value="dial_test_indicator">Dial Test Indicator</option>
                            <option value="depth_caliper">Depth Caliper</option>
                            <option value="caliper">Caliper</option>
                            <option value="torque_wrench">Torque Wrench-Driver</option>
                            <option value="torque_meter">Torque Tester-Meter</option>
                            <option value="thickness_gauge">Thickness Gauge</option>
                            <option value="penggaris">Penggaris</option>
                            <option value="enclosure">Enclosure</option>
                            <option value="chamber">Chamber</option>
                            <option value="pressure_gauge">Pressure Gauge</option>
                            <option value="differential_pressure_gauge">Differential Pressure Gauge</option>
                            <option value="volumetrik">Volumetrik</option>
                            <option value="thermohygrometer">Thermohygrometer</option>
                            <option value="viscometer">Viscometer</option>
                            <option value="push_pull">Push Pull</option>
                            <option value="timbangan">Timbangan</option>
                            <option value="timbangan_bias">Timbangan Bias</option>
                            <option value="gauge_block">Gauge Block</option>
                            <option value="holetest">Holetest</option>
                            <option value="conductivity_meter">Conductivity Meter</option>
                            <option value="coating_thickness">Coating Thickness</option>
                            <option value="mikropipet_dispenset">Mikropipet Dispenset</option>
                            <option value="temp_humid_transmitter">Temperature Humidity Transmitter</option>
                            <option value="insulation">Insulation</option>
                            <option value="centrifuge">Centrifuge</option>
                            <option value="plastic_shim">Plastic Shim</option>
                            <option value="durometer">Durometer</option>
                            <option value="plain_limit_gauge">Plain Limit Gauge</option>
                            <option value="surface_roughness_tester">Surface Roughness Tester</option>
                            <option value="feeler_gauge">Feeler Gauge</option>
                            <option value="stopwatch">Stopwatch</option>
                            <option value="thermometer_infrared">Thermometer Infrared</option>
                            <option value="tachometer">Tachometer</option>
                            <option value="surface_plate">Surface Plate</option>
                            <option value="visco_cup">Visco Cup</option>
                            <option value="taper_gauge">Taper Gauge</option>
                            <option value="bore_gauge">Bore Gauge</option>
                            <option value="ph_meter">PH Meter</option>
                            <option value="pin_gauge">Pin Gauge</option>
                            <option value="profil_projector">Profil Projector / Microscope</option>
                            <option value="thread_gauge">Thread Gauge</option>
                            <option value="pressure_transmitter">Pressure Transmitter / Diff Pressure Transmitter</option>
                            <option value="ultrasonic_thickness_gauge">Ultrasonic Thickness Gauge</option>
                            <option value="temperature_transmitter">Temperature Transmitter</option>
                            <option value="thermoindicator">Thermoindicator</option>
                            <option value="anak_timbang">Anak Timbang</option>
                            <option value="utm">Mesin Uji Tarik & Tekan</option>    
                        </select>
                    </div>

                    <!-- Modal untuk Search -->
                  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="searchModalLabel">
                    <i class="fas fa-search me-2"></i>Cari Alat Ukur
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Search Input -->
                <div class="input-group mb-4">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="Ketik nama alat ukur...">
                </div>
                
                <!-- Search Results -->
                <div id="searchResults" class="row g-3" style="max-height: 400px; overflow-y: auto;">
                    <!-- Hasil pencarian akan muncul di sini -->
                    <div class="col-12">
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Ketik kata kunci untuk mencari alat ukur
                        </div>
                    </div>
                </div>
            </div>
          <button type="button" class="btn btn-secondary" 
        onclick="bootstrap.Modal.getOrCreateInstance(document.getElementById('searchModal')).hide()">
    Tutup
</button>
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

                        <!-- Sub Option: Hanya muncul jika Dial Indicator atau Dial Test Indicator dipilih -->
                        <div id="dialResolutionWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="dialresolutionSelect" class="form-label fw-bold">Resolusi Dial Indicator</label>
                            <select id="dialresolutionSelect" class="form-select select2">
                                <option value="">-- Pilih Resolusi --</option>
                                <option value="0.01">0,01 mm</option>
                                <option value="0.001">0,001 mm</option>
                            </select>
                        </div>

                        <!-- Sub Option: Hanya muncul jika Caliper dipilih -->
                        <div id="caliperResolutionWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="caliperresolutionSelect" class="form-label fw-bold">Kapasitas Caliper</label>
                            <select id="caliperresolutionSelect" class="form-select select2">
                                <option value="">-- Pilih Kapasitas --</option>
                                <option value="300">300 mm</option>
                                <option value="450">450 mm</option>
                                <option value="600">600 mm</option>
                                <option value="1000">1000 mm</option>
                            </select>
                        </div>

                        <!-- Sub Option: Hanya muncul jika Enclosure dipilih -->
                        <div id="enclosureRepetitionWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="enclosureRepetitionSelect" class="form-label fw-bold">Jumlah Pengulangan Pengukuran</label>
                            <select id="enclosureRepetitionSelect" class="form-select select2">
                                <option value="1">1 Kali Pengukuran</option>
                                <option value="2">2 Kali Pengukuran</option>
                                <option value="3">3 Kali Pengukuran</option>
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

                        <!-- Sub Option: Hanya muncul jika Insulation dipilih -->
                        <div id="insulationTypeWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="insulationTypeSelect" class="form-label fw-bold">Pilih Tipe</label>
                            <select id="insulationTypeSelect" class="form-select select2">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="ac_voltage_50hz">AC VOLTAGE 50Hz</option>
                                <option value="dc_voltage">DC VOLTAGE</option>
                                <option value="ac_current_50hz">AC Current 50Hz</option>
                                <option value="dc_current">DC Current</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tempat Form Kalibrasi akan dimuat -->
                    <div id="formContainer" class="mt-3 mt-md-4">
                        <div class="alert alert-info mb-0" id="emptyFormMessage">
                            <i class="fas fa-info-circle me-2"></i> Pilih jenis alat ukur untuk menampilkan form kalibrasi.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include JavaScript Select2 dan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
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
                dropdownParent: $('#subOptionsContainer')
            });
        } catch (error) {
            console.error('Error initializing Select2:', error);
        }
    }
    
    initSelect2();
    
    // Data alat ukur untuk search
    const alatList = [
        { value: 'inside_micrometer', label: 'Inside Micrometer' },
        { value: 'outside_micrometer', label: 'Outside Micrometer' },
        { value: 'depth_micrometer', label: 'Depth Micrometer' },
        { value: 'thermometer', label: 'Thermometer' },
        { value: 'dial_indicator', label: 'Dial Indicator' },
        { value: 'dial_test_indicator', label: 'Dial Test Indicator' },
        { value: 'depth_caliper', label: 'Depth Caliper' },
        { value: 'caliper', label: 'Caliper' },
        { value: 'torque_wrench', label: 'Torque Wrench-Driver' },
        { value: 'torque_meter', label: 'Torque Tester-Meter' },
        { value: 'thickness_gauge', label: 'Thickness Gauge' },
        { value: 'penggaris', label: 'Penggaris' },
        { value: 'enclosure', label: 'Enclosure' },
        { value: 'chamber', label: 'Chamber' },
        { value: 'pressure_gauge', label: 'Pressure Gauge' },
        { value: 'differential_pressure_gauge', label: 'Differential Pressure Gauge' },
        { value: 'volumetrik', label: 'Volumetrik' },
        { value: 'thermohygrometer', label: 'Thermohygrometer' },
        { value: 'viscometer', label: 'Viscometer' },
        { value: 'push_pull', label: 'Push Pull' },
        { value: 'timbangan', label: 'Timbangan' },
        { value: 'timbangan_bias', label: 'Timbangan Bias' },
        { value: 'gauge_block', label: 'Gauge Block' },
        { value: 'holetest', label: 'Holetest' },
        { value: 'conductivity_meter', label: 'Conductivity Meter' },
        { value: 'coating_thickness', label: 'Coating Thickness' },
        { value: 'mikropipet_dispenset', label: 'Mikropipet Dispenset' },
        { value: 'temp_humid_transmitter', label: 'Temperature Humidity Transmitter' },
        { value: 'insulation', label: 'Insulation' },
        { value: 'centrifuge', label: 'Centrifuge' },
        { value: 'plastic_shim', label: 'Plastic Shim' },
        { value: 'durometer', label: 'Durometer' },
        { value: 'plain_limit_gauge', label: 'Plain Limit Gauge' },
        { value: 'surface_roughness_tester', label: 'Surface Roughness Tester' },
        { value: 'feeler_gauge', label: 'Feeler Gauge' },
        { value: 'stopwatch', label: 'Stopwatch' },
        { value: 'thermometer_infrared', label: 'Thermometer Infrared' },
        { value: 'tachometer', label: 'Tachometer' },
        { value: 'surface_plate', label: 'Surface Plate' },
        { value: 'visco_cup', label: 'Visco Cup' },
        { value: 'taper_gauge', label: 'Taper Gauge' },
        { value: 'bore_gauge', label: 'Bore Gauge' },
        { value: 'ph_meter', label: 'PH Meter' },
        { value: 'pin_gauge', label: 'Pin Gauge' },
        { value: 'profil_projector', label: 'Profil Projector / Microscope' },
        { value: 'thread_gauge', label: 'Thread Gauge' },
        { value: 'pressure_transmitter', label: 'Pressure Transmitter / Diff Pressure Transmitter' },
        { value: 'ultrasonic_thickness_gauge', label: 'Ultrasonic Thickness Gauge' },
        { value: 'temperature_transmitter', label: 'Temperature Transmitter' },
        { value: 'thermoindicator', label: 'Thermoindicator' },
        { value: 'anak_timbang', label: 'Anak Timbang' },
        { value: 'utm', label: 'Mesin Uji Tarik & Tekan' }
    ];
    
    // Fungsi untuk search alat
    function searchAlat(keyword) {
        const searchResults = document.getElementById('searchResults');
        if (!searchResults) return;
        
        keyword = keyword.toLowerCase().trim();
        
        if (!keyword) {
            searchResults.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Ketik kata kunci untuk mencari alat ukur
                    </div>
                </div>
            `;
            return;
        }
        
        // Filter alat berdasarkan keyword
        const filtered = alatList.filter(alat => 
            alat.label.toLowerCase().includes(keyword) || 
            alat.value.toLowerCase().includes(keyword)
        );
        
        if (filtered.length === 0) {
            searchResults.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-warning mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
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
                            <h6 class="card-title text-primary">${alat.label}</h6>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <button type="button" class="btn btn-sm btn-primary w-100 select-alat-btn" 
                                    data-value="${alat.value}">
                                <i class="fas fa-check me-1"></i> Pilih
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
                const modal = bootstrap.Modal.getInstance(document.getElementById('searchModal'));
                if (modal) modal.hide();
            });
        });
    }
    
    // Event untuk tombol search
    document.getElementById('searchBtn')?.addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('searchModal'));
        modal.show();
        
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
    
    let currentLoaded = null;

    function loadForm(formType, resolution = null, capacity = null, repetition = null, thermohygrometerType = null, timbanganType = null) {
        let key = formType;
        if (resolution) key += `|${resolution}`;
        if (capacity !== null && capacity !== '') key += `|${capacity}`;
        if (repetition) key += `|${repetition}`;
        if (thermohygrometerType) key += `|${thermohygrometerType}`;
        if (timbanganType) key += `|${timbanganType}`;
        
        if (currentLoaded === key) return;
        currentLoaded = key;

        const container = document.getElementById('formContainer');
        const emptyMessage = document.getElementById('emptyFormMessage');

        if (!container) return;

        if (!formType) {
            if (emptyMessage) emptyMessage.style.display = 'block';
            container.innerHTML = '';
            return;
        }

        // Khusus untuk Inside Micrometer, selalu load form meski capacity belum dipilih
        if (formType === 'inside_micrometer' || formType === 'outside_micrometer'|| formType === 'depth_micrometer') {
            // Kosongkan empty message
            if (emptyMessage) emptyMessage.style.display = 'none';
            
            // Build URL - kirim capacity meski null/empty
            let url = `/get-form-html/${formType}`;
            const params = new URLSearchParams();
            
            if (capacity && capacity !== '') {
                params.append('capacity', capacity);
            }
            
            if (params.toString()) {
                url += `?${params.toString()}`;
            }
            
            container.innerHTML = `
                <div class="text-center my-4 my-md-5 fade-in">
                    <div class="spinner-border text-primary"></div>
                    <p class="mt-2 text-muted">Memuat form...</p>
                </div>
            `;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal memuat form');
                return response.text();
            })
            .then(html => {
                container.innerHTML = html;
                container.classList.add('fade-in');
                
                setTimeout(initializeFormEvents, 100);
                
                if ($(window).width() < 768) {
                    $('html, body').animate({
                        scrollTop: $(container).offset().top - 20
                    }, 500);
                }
            })
            .catch(err => {
                container.innerHTML = `<div class="alert alert-danger fade-in"><i class="fas fa-times-circle me-2"></i>Error: ${err.message}</div>`;
            });
            
            return;
        }

        // Untuk Thermohygrometer, tidak wajib pilih tipe (boleh kosong)
        // Jika dipilih "IN Out", maka kirim parameter, jika kosong tidak perlu

        // Untuk Timbangan, tidak wajib pilih tipe (boleh langsung load form timbangan biasa)
        if (formType === 'timbangan') {
            // Kosongkan empty message
            if (emptyMessage) emptyMessage.style.display = 'none';
            
            // Build URL - kirim timbangan type jika ada
            let url = `/get-form-html/${formType}`;
            const params = new URLSearchParams();
            
            if (timbanganType && timbanganType !== '') {
                params.append('timbangan_type', timbanganType);
            }
            
            if (params.toString()) {
                url += `?${params.toString()}`;
            }
            
            container.innerHTML = `
                <div class="text-center my-4 my-md-5 fade-in">
                    <div class="spinner-border text-primary"></div>
                    <p class="mt-2 text-muted">Memuat form timbangan...</p>
                </div>
            `;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal memuat form');
                return response.text();
            })
            .then(html => {
                container.innerHTML = html;
                container.classList.add('fade-in');
                
                setTimeout(initializeFormEvents, 100);
                
                if ($(window).width() < 768) {
                    $('html, body').animate({
                        scrollTop: $(container).offset().top - 20
                    }, 500);
                }
            })
            .catch(err => {
                container.innerHTML = `<div class="alert alert-danger fade-in"><i class="fas fa-times-circle me-2"></i>Error: ${err.message}</div>`;
            });
            
            return;
        }

        // Untuk form lain yang perlu sub-option wajib
        if ((formType === 'dial_indicator' || formType === 'dial_test_indicator') && !resolution) {
            if (emptyMessage) emptyMessage.style.display = 'none';
            container.innerHTML = '<div class="alert alert-warning fade-in"><i class="fas fa-exclamation-triangle me-2"></i>Silakan pilih resolusi Dial Indicator.</div>';
            return;
        }

        if (formType === 'caliper' && !capacity) {
            if (emptyMessage) emptyMessage.style.display = 'none';
            container.innerHTML = '<div class="alert alert-warning fade-in"><i class="fas fa-exclamation-triangle me-2"></i>Silakan pilih kapasitas Caliper.</div>';
            return;
        }

        // Build URL untuk form lainnya
        let url = `/get-form-html/${formType}`;
        const params = new URLSearchParams();
        
        if (resolution) {
            params.append('resolution', resolution);
        }
        if (capacity && capacity !== '') {
            params.append('capacity', capacity);
        }
        if (repetition) {
            params.append('repetition', repetition);
        }
        if (thermohygrometerType) {
            params.append('type', thermohygrometerType);
        }
        
        if (params.toString()) {
            url += `?${params.toString()}`;
        }

        if (emptyMessage) emptyMessage.style.display = 'none';
        container.innerHTML = `
            <div class="text-center my-4 my-md-5 fade-in">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2 text-muted">Memuat form...</p>
            </div>
        `;

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal memuat form');
            return response.text();
        })
        .then(html => {
            container.innerHTML = html;
            container.classList.add('fade-in');
            
            setTimeout(initializeFormEvents, 100);
            
            if ($(window).width() < 768) {
                $('html, body').animate({
                    scrollTop: $(container).offset().top - 20
                }, 500);
            }
        })
        .catch(err => {
            container.innerHTML = `<div class="alert alert-danger fade-in"><i class="fas fa-times-circle me-2"></i>Error: ${err.message}</div>`;
        });
    }

    function initializeFormEvents() {
        const formSelect = $('#formSelect');
        const insideMicrometerCapacitySelect = $('#insideMicrometerCapacitySelect');
        const outsideMicrometerCapacitySelect = $('#outsideMicrometerCapacitySelect');
        const depthMicrometerCapacitySelect = $('#depthMicrometerCapacitySelect');
        const dialResolutionSelect = $('#dialresolutionSelect');
        const caliperResolutionSelect = $('#caliperresolutionSelect');
        const enclosureRepetitionSelect = $('#enclosureRepetitionSelect');
        const chamberRepetitionSelect = $('#chamberRepetitionSelect');
        const thermohygrometerTypeSelect = $('#thermohygrometerTypeSelect');
        const timbanganTypeSelect = $('#timbanganTypeSelect');
        const insulationTypeSelect = $('#insulationTypeSelect');
        
        const insideMicrometerCapacityWrapper = document.getElementById('insideMicrometerCapacityWrapper');
        const outsideMicrometerCapacityWrapper = document.getElementById('outsideMicrometerCapacityWrapper');
        const depthMicrometerCapacityWrapper = document.getElementById('depthMicrometerCapacityWrapper');
        const dialResolutionWrapper = document.getElementById('dialResolutionWrapper');
        const caliperResolutionWrapper = document.getElementById('caliperResolutionWrapper');
        const enclosureRepetitionWrapper = document.getElementById('enclosureRepetitionWrapper');
        const chamberRepetitionWrapper = document.getElementById('chamberRepetitionWrapper');
        const thermohygrometerTypeWrapper = document.getElementById('thermohygrometerTypeWrapper');
        const timbanganTypeWrapper = document.getElementById('timbanganTypeWrapper');
        const insulationTypeWrapper = document.getElementById('insulationTypeWrapper');
        const emptyMessage = document.getElementById('emptyFormMessage');

        // Event change untuk formSelect
        formSelect.off('change').on('change', function() {
            const val = $(this).val();

            // Sembunyikan semua wrapper terlebih dahulu
            if (insideMicrometerCapacityWrapper) insideMicrometerCapacityWrapper.style.display = 'none';
            if (outsideMicrometerCapacityWrapper) outsideMicrometerCapacityWrapper.style.display = 'none';
            if (depthMicrometerCapacityWrapper) depthMicrometerCapacityWrapper.style.display = 'none';
            if (dialResolutionWrapper) dialResolutionWrapper.style.display = 'none';
            if (caliperResolutionWrapper) caliperResolutionWrapper.style.display = 'none';
            if (enclosureRepetitionWrapper) enclosureRepetitionWrapper.style.display = 'none';
            if (chamberRepetitionWrapper) chamberRepetitionWrapper.style.display = 'none';
            if (thermohygrometerTypeWrapper) thermohygrometerTypeWrapper.style.display = 'none';
            if (insulationTypeWrapper) insulationTypeWrapper.style.display = 'none';
            if (timbanganTypeWrapper) timbanganTypeWrapper.style.display = 'none';
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

            // Reset nilai jika tidak dipilih
            if (val !== 'inside_micrometer') {
                if (insideMicrometerCapacitySelect) insideMicrometerCapacitySelect.val('').trigger('change');
            }
            if (val !== 'outside_micrometer') {
                if (outsideMicrometerCapacitySelect) outsideMicrometerCapacitySelect.val('').trigger('change');
            }
            if (val !== 'depth_micrometer') {
                if (depthMicrometerCapacitySelect) depthMicrometerCapacitySelect.val('').trigger('change');
            }
            if (val !== 'dial_indicator' && val !== 'dial_test_indicator') {
                if (dialResolutionSelect) dialResolutionSelect.val('').trigger('change');
            }
            if (val !== 'caliper') {
                if (caliperResolutionSelect) caliperResolutionSelect.val('').trigger('change');
            }
            if (val !== 'enclosure') {
                if (enclosureRepetitionSelect) enclosureRepetitionSelect.val('1').trigger('change');
            }
            if (val !== 'chamber') {
                if (chamberRepetitionSelect) chamberRepetitionSelect.val('1').trigger('change');
            }
            if (val !== 'thermohygrometer') {
                if (thermohygrometerTypeSelect) thermohygrometerTypeSelect.val('').trigger('change');
            }
            if (val !== 'timbangan') {
                if (timbanganTypeSelect) timbanganTypeSelect.val('').trigger('change');
            }
              if (val !== 'insulation') {
                if (insulationTypeSelect) insulationTypeSelect.val('').trigger('change');
            }

            if (val === 'inside_micrometer') {
                if (insideMicrometerCapacityWrapper) {
                    insideMicrometerCapacityWrapper.style.display = 'block';
                    if (insideMicrometerCapacitySelect) insideMicrometerCapacitySelect.prop('required', false);
                }
                
                // Load form Inside Micrometer (tanpa capacity dulu)
                if (emptyMessage) emptyMessage.style.display = 'none';
                loadForm(val, null, null);
                
            } else if (val === 'outside_micrometer') {
                if (outsideMicrometerCapacityWrapper) {
                    outsideMicrometerCapacityWrapper.style.display = 'block';
                    if (outsideMicrometerCapacitySelect) outsideMicrometerCapacitySelect.prop('required', false);
                }
                
                // Load form Outside Micrometer (tanpa capacity dulu)
                if (emptyMessage) emptyMessage.style.display = 'none';
                loadForm(val, null, null);
                
            }else if (val === 'depth_micrometer') {
                if (depthMicrometerCapacityWrapper) {
                    depthMicrometerCapacityWrapper.style.display = 'block';
                    if (depthMicrometerCapacitySelect) depthMicrometerCapacitySelect.prop('required', false);
                }
                
                // Load form Outside Micrometer (tanpa capacity dulu)
                if (emptyMessage) emptyMessage.style.display = 'none';
                loadForm(val, null, null);
                
            }else if (val === 'dial_indicator' || val === 'dial_test_indicator') {
                if (dialResolutionWrapper) {
                    dialResolutionWrapper.style.display = 'block';
                    if (dialResolutionSelect) dialResolutionSelect.prop('required', true);
                }
                
                // Jika belum pilih resolusi
                if (emptyMessage) emptyMessage.style.display = 'none';
                const formContainer = document.getElementById('formContainer');
                if (formContainer) {
                    formContainer.innerHTML = '<div class="alert alert-warning fade-in"><i class="fas fa-exclamation-triangle me-2"></i>Silakan pilih resolusi Dial Indicator.</div>';
                }
                
            } else if (val === 'caliper') {
                if (caliperResolutionWrapper) {
                    caliperResolutionWrapper.style.display = 'block';
                    if (caliperResolutionSelect) caliperResolutionSelect.prop('required', true);
                }
                
                // Jika belum pilih kapasitas
                if (emptyMessage) emptyMessage.style.display = 'none';
                const formContainer = document.getElementById('formContainer');
                if (formContainer) {
                    formContainer.innerHTML = '<div class="alert alert-warning fade-in"><i class="fas fa-exclamation-triangle me-2"></i>Silakan pilih kapasitas Caliper.</div>';
                }
                
            } else if (val === 'enclosure') {
                if (enclosureRepetitionWrapper) {
                    enclosureRepetitionWrapper.style.display = 'block';
                    if (enclosureRepetitionSelect) enclosureRepetitionSelect.prop('required', true);
                }
                
                loadForm(val, null, null, '1');
                
            } else if (val === 'chamber') {
                if (chamberRepetitionWrapper) {
                    chamberRepetitionWrapper.style.display = 'block';
                    if (chamberRepetitionSelect) chamberRepetitionSelect.prop('required', true);
                }
                
                loadForm(val, null, null, '1');
                
            } else if (val === 'thermohygrometer') {
                if (thermohygrometerTypeWrapper) {
                    thermohygrometerTypeWrapper.style.display = 'block';
                    if (thermohygrometerTypeSelect) thermohygrometerTypeSelect.prop('required', false); // Tidak wajib
                }
                
                // Load form Thermohygrometer langsung (tidak perlu tunggu pilih tipe)
                if (emptyMessage) emptyMessage.style.display = 'none';
                loadForm(val);
                
            } else if (val === 'timbangan') {
                if (timbanganTypeWrapper) {
                    timbanganTypeWrapper.style.display = 'block';
                    if (timbanganTypeSelect) timbanganTypeSelect.prop('required', false); // Tidak wajib
                }
                
                // Load form Timbangan langsung (tidak perlu tunggu pilih tipe)
                if (emptyMessage) emptyMessage.style.display = 'none';
                loadForm(val, null, null, null, null, null);

            } else if (val === 'insulation') {
                if (insulationTypeWrapper) {
                    insulationTypeWrapper.style.display = 'block';
                    if (insulationTypeSelect) insulationTypeSelect.prop('required', false); // Tidak wajib
                }
                
                // Load form Timbangan langsung (tidak perlu tunggu pilih tipe)
                if (emptyMessage) emptyMessage.style.display = 'none';
                loadForm(val, null, null, null, null, null);
                
            }else if (val) {
                if (emptyMessage) emptyMessage.style.display = 'none';
                loadForm(val);
            } else {
                if (emptyMessage) emptyMessage.style.display = 'block';
                const formContainer = document.getElementById('formContainer');
                if (formContainer) {
                    formContainer.innerHTML = '';
                }
            }
        });

        // Event change untuk insideMicrometerCapacitySelect
        if (insideMicrometerCapacitySelect) {
            insideMicrometerCapacitySelect.off('change').on('change', function() {
                const formType = formSelect.val();
                const capacity = $(this).val();
                
                if (formType === 'inside_micrometer') {
                    // Selalu load form dengan capacity yang dipilih (atau empty)
                    loadForm(formType, null, capacity);
                }
            });
        }

        // Event change untuk outsideMicrometerCapacitySelect
        if (outsideMicrometerCapacitySelect) {
            outsideMicrometerCapacitySelect.off('change').on('change', function() {
                const formType = formSelect.val();
                const capacity = $(this).val();
                
                if (formType === 'outside_micrometer') {
                    // Selalu load form dengan capacity yang dipilih (atau empty)
                    loadForm(formType, null, capacity);
                }
            });
        }

         // Event change untuk depthMicrometerCapacitySelect
        if (depthMicrometerCapacitySelect) {
            depthMicrometerCapacitySelect.off('change').on('change', function() {
                const formType = formSelect.val();
                const capacity = $(this).val();
                
                if (formType === 'depth_micrometer') {
                    // Selalu load form dengan capacity yang dipilih (atau empty)
                    loadForm(formType, null, capacity);
                }
            });
        }

        // Event change untuk dialResolutionSelect
        if (dialResolutionSelect) {
            dialResolutionSelect.off('change').on('change', function() {
                const formType = formSelect.val();
                
                if ((formType === 'dial_indicator' || formType === 'dial_test_indicator') && $(this).val()) {
                    loadForm(formType, $(this).val());
                } else if ((formType === 'dial_indicator' || formType === 'dial_test_indicator') && !$(this).val()) {
                    if (emptyMessage) emptyMessage.style.display = 'none';
                    const formContainer = document.getElementById('formContainer');
                    if (formContainer) {
                        formContainer.innerHTML = '<div class="alert alert-warning fade-in"><i class="fas fa-exclamation-triangle me-2"></i>Silakan pilih resolusi Dial Indicator.</div>';
                    }
                }
            });
        }

        // Event change untuk caliperResolutionSelect
        if (caliperResolutionSelect) {
            caliperResolutionSelect.off('change').on('change', function() {
                const formType = formSelect.val();
                
                if (formType === 'caliper' && $(this).val()) {
                    loadForm(formType, null, $(this).val());
                } else if (formType === 'caliper' && !$(this).val()) {
                    if (emptyMessage) emptyMessage.style.display = 'none';
                    const formContainer = document.getElementById('formContainer');
                    if (formContainer) {
                        formContainer.innerHTML = '<div class="alert alert-warning fade-in"><i class="fas fa-exclamation-triangle me-2"></i>Silakan pilih kapasitas Caliper.</div>';
                    }
                }
            });
        }

        // Event change untuk enclosureRepetitionSelect
        if (enclosureRepetitionSelect) {
            enclosureRepetitionSelect.off('change').on('change', function() {
                const formType = formSelect.val();
                
                if (formType === 'enclosure' && $(this).val()) {
                    loadForm(formType, null, null, $(this).val());
                }
            });
        }

        // Event change untuk chamberRepetitionSelect
        if (chamberRepetitionSelect) {
            chamberRepetitionSelect.off('change').on('change', function() {
                const formType = formSelect.val();
                
                if (formType === 'chamber' && $(this).val()) {
                    loadForm(formType, null, null, $(this).val());
                }
            });
        }

        // Event change untuk thermohygrometerTypeSelect
        if (thermohygrometerTypeSelect) {
            thermohygrometerTypeSelect.off('change').on('change', function() {
                const formType = formSelect.val();
                
                if (formType === 'thermohygrometer') {
                    loadForm(formType, null, null, null, $(this).val());
                }
            });
        }

        // Event change untuk timbanganTypeSelect
        if (timbanganTypeSelect) {
            timbanganTypeSelect.off('change').on('change', function() {
                const formType = formSelect.val();
                const timbanganType = $(this).val();
                
                if (formType === 'timbangan') {
                    loadForm(formType, null, null, null, null, timbanganType);
                }
            });
        }

        // Event change untuk insulationTypeSelect
        if (insulationTypeSelect) {
            insulationTypeSelect.off('change').on('change', function() {
                const formType = formSelect.val();
                const insulationType = $(this).val();
                
                if (formType === 'insulation') {
                    loadForm(formType, null, null, null, null, insulationType);
                }
            });
        }
    }

    // Inisialisasi events
    initializeFormEvents();
    
    // Jika ada nilai yang dipilih sebelumnya
    const formSelect = $('#formSelect');
    if (formSelect.val()) {
        setTimeout(() => {
            formSelect.trigger('change');
        }, 300);
    }
    
    // Handle orientation change
    $(window).on('orientationchange', function() {
        setTimeout(() => {
            initSelect2();
        }, 200);
    });

});
</script>

<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

.select-alat-btn:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease;
}

#searchResults .card {
    cursor: pointer;
}
</style>
@endsection