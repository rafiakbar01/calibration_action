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

                    <!-- Select Utama dengan Select2 -->
                    <div class="mb-3 mb-md-4">
                        <label for="formSelect" class="form-label fw-bold">Jenis Alat Ukur</label>
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
                            <option value="temperatur_humidity_transmitter">Temperatur Humidity Transmitter</option>
                            <option value="insulation">Insulation </option>
                            <option value="centrifuge">Centrifuge </option>
                            <option value="plastic_shim">Plastic Shim </option>
                            <option value="durometer">Durometer </option>
                            <option value="feeler_gauge">Feeler Gauge </option>
                           
                            
                        </select>
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


                          <!-- Sub Option: Hanya muncul jika Thermohygrometer dipilih -->
                        <div id="insulationTypeWrapper" class="mb-3 mb-md-4" style="display: none;">
                            <label for="insulationTypeSelect" class="form-label fw-bold">Pilih Tipe</label>
                            <select id="insulationTypeSelect" class="form-select select2">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="ac_voltage_50hz">AC VOLTAGE 50Hz</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tempat Form Kalibrasi akan dimuat -->
                    <div id="formContainer" class="mt-3 mt-md-4">
                        <div class="alert alert-info mb-0" id="emptyFormMessage">
                            <i class="fas fa-info-circle me-2"></i>  Pilih jenis alat ukur untuk menampilkan form kalibrasi.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sisanya sama dengan kode sebelumnya (CSS dan JavaScript) -->

<!-- Include JavaScript Select2 dan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                dropdownParent: $('#subOptionsContainer'),
                minimumResultsForSearch: 10
            });
        } catch (error) {
            console.error('Error initializing Select2:', error);
        }
    }
    
    initSelect2();
    
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
        if (formType === 'inside_micrometer') {
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
        const dialResolutionSelect = $('#dialresolutionSelect');
        const caliperResolutionSelect = $('#caliperresolutionSelect');
        const enclosureRepetitionSelect = $('#enclosureRepetitionSelect');
        const chamberRepetitionSelect = $('#chamberRepetitionSelect');
        const thermohygrometerTypeSelect = $('#thermohygrometerTypeSelect');
        const timbanganTypeSelect = $('#timbanganTypeSelect');
        
        const insideMicrometerCapacityWrapper = document.getElementById('insideMicrometerCapacityWrapper');
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
            if (dialResolutionWrapper) dialResolutionWrapper.style.display = 'none';
            if (caliperResolutionWrapper) caliperResolutionWrapper.style.display = 'none';
            if (enclosureRepetitionWrapper) enclosureRepetitionWrapper.style.display = 'none';
            if (chamberRepetitionWrapper) chamberRepetitionWrapper.style.display = 'none';
            if (thermohygrometerTypeWrapper) thermohygrometerTypeWrapper.style.display = 'none';
            if (insulationTypeWrapper) insulationTypeWrapper.style.display = 'none';

            if (timbanganTypeWrapper) timbanganTypeWrapper.style.display = 'none';
            
            // Reset required untuk semua select
            if (insideMicrometerCapacitySelect) insideMicrometerCapacitySelect.prop('required', false);
            if (dialResolutionSelect) dialResolutionSelect.prop('required', false);
            if (caliperResolutionSelect) caliperResolutionSelect.prop('required', false);
            if (enclosureRepetitionSelect) enclosureRepetitionSelect.prop('required', false);
            if (chamberRepetitionSelect) chamberRepetitionSelect.prop('required', false);
            if (thermohygrometerTypeSelect) thermohygrometerTypeSelect.prop('required', false);
            if (timbanganTypeSelect) timbanganTypeSelect.prop('required', false);
            
            // Reset nilai jika tidak dipilih
            if (val !== 'inside_micrometer') {
                if (insideMicrometerCapacitySelect) insideMicrometerCapacitySelect.val('').trigger('change');
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

            if (val === 'inside_micrometer') {
                if (insideMicrometerCapacityWrapper) {
                    insideMicrometerCapacityWrapper.style.display = 'block';
                    if (insideMicrometerCapacitySelect) insideMicrometerCapacitySelect.prop('required', false);
                }
                
                // Load form Inside Micrometer (tanpa capacity dulu)
                if (emptyMessage) emptyMessage.style.display = 'none';
                loadForm(val, null, null);
                
            } else if (val === 'dial_indicator' || val === 'dial_test_indicator') {
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
                
            } 
            else if (val === 'insulation') {
                if (insulationTypeWrapper) {
                    insulationTypeWrapper.style.display = 'block';
                    if (insulationTypeSelect) insulationTypeSelect.prop('required', false); // Tidak wajib
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
                
            } else if (val) {
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

           // Event change untuk insulationTypeSelect
        if (insulationTypeSelect) {
            insulationTypeSelect.off('change').on('change', function() {
                const formType = formSelect.val();
                
                if (formType === 'insulation') {
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
@endsection