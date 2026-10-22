<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kalibrasi - PT. PANANJUNG ANUGRAH SOLUTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Pastikan semua text berwarna hitam */
        .form-kalibrasi-container,
        .form-kalibrasi-container *:not(input):not(select):not(textarea):not(button) {
            color: #000000 !important;
        }
        
        /* Input fields tetap dengan warna default mereka */
        .kalibrasi-input {
            color: #000000 !important;
            border: 1px solid #ced4da !important;
            padding: 6px 10px;
            border-radius: 4px;
            width: 100%;
        }
        
        /* Placeholder text */
        .kalibrasi-input::placeholder {
            color: #666666 !important;
        }

        /* Styling khusus untuk input suhu dan RH */
        .kondisi-input {
            border: 1px solid #000 !important;
            text-align: center;
            width: 100%;
            padding: 4px;
        }

        /* Header styling */
        .kalibrasi-header-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .kalibrasi-header-table td {
            padding: 5px;
            vertical-align: top;
        }

        /* Main form styling */
        .kalibrasi-main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .kalibrasi-main-table td {
            padding: 8px;
            vertical-align: middle;
        }

        /* Data kalibrasi table styling */
        .kalibrasi-data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .kalibrasi-data-table td {
            padding: 0;
            border: 2px solid #000;
            text-align: center;
            vertical-align: middle;
        }

        .kalibrasi-data-table input {
            border: none;
            width: 100%;
            height: 100%;
            text-align: center;
            font-size: 10pt;
            color: #000;
            padding: 2px;
            background: transparent;
        }

        /* Section headers */
        .kalibrasi-section-header {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
            text-align: center;
            padding-bottom: 5px;
            border-bottom: 2px solid #000;
        }

        .data-kalibrasi-header {
            font-weight: bold;
            font-size: 18px;
            margin: 25px 0 15px;
            text-align: center;
            padding: 8px;
            background-color: #f0f0f0;
            border: 1px solid #000;
        }

        /* Submit Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border: none;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            border: none;
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
            background: linear-gradient(135deg, #4b5563, #374151);
        }

        /* Form validation styling */
        input:required:invalid {
            border-color: #dc3545 !important;
        }

        input:required:valid {
            border-color: #198754 !important;
        }

        /* Active state untuk tombol warna dan ukuran */
        .color-btn.active {
            border-color: #000;
            box-shadow: 0 0 5px rgba(0,0,0,0.5);
            transform: scale(1.1);
        }

        .size-btn.active {
            background-color: #007bff;
            color: white;
            border-color: #0056b3;
        }

        /* Kolom keterangan dengan canvas drawing */
        .keterangan-cell {
            vertical-align: top;
            text-align: center;
        }

        .drawing-container {
            border: 1px solid #000;
            background: white;
            margin-top: 8px;
            display: inline-block;
            width: 100%;
        }

        .canvas-wrapper {
            width: 100%;
            height: 200px;
            position: relative;
        }

        /* Canvas element */
        #enclosureCanvas {
            border: 2px solid #000 !important;
            background: #fff !important;
            cursor: crosshair !important;
            display: block !important;
            width: 100% !important;
            touch-action: none;
        }

        .enclosure-canvas-wrapper {
            width: 100%;
            height: 200px;
            border: 1px solid #ccc;
            background: #fff;
            position: relative;
        }

        .enclosure-canvas-label {
            font-family: Arial;
            font-size: 8pt;
            color: #666;
            text-align: center;
            margin-top: 4px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <!-- resources/views/formhtml/enclosure.blade.php -->
        <form method="POST" action="/calibrations" id="kalibrasiForm">
        @csrf
        <input type="hidden" name="form_type" id="form_type_input"  value="enclosure">
        <input type="hidden" name="repetition" value="{{ $repetition ?? '' }}">

            <div class="form-kalibrasi-container">
                <table class="kalibrasi-header-table">
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">PAS-FLK29</p>
                        </td>
                        <td rowspan="5" style="text-align: center; vertical-align: middle; padding: 10px 0;">
                          <div style="display: inline-block; text-align: center;">
                              <div style="margin-bottom: 15px;">
                                  <!-- Logo PT. PANANJUNG ANUGRAH SOLUTION -->
                                  <img src="/logo/logo_pas_basic.png" alt="Logo PT. PAS" style="width: 107px; height: 54px; display: block; margin: 0 auto;">
                              </div>
                              <p style="font-weight: bold; margin: 0; font-size: 15px; color: #000000;">PT. PANANJUNG ANUGRAH SOLUTION</p>
                          </div>
                      </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-size: 14px; color: #000000;">LEMBAR KERJA KALIBRASI</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin: 0; font-weight: bold; font-size: 14px; color: #000000;">ENCLOSURE</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 10px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 25%;">
                            <p style="margin: 0; font-size: 14px; color: #000000;">No. Sertifikat</p>
                        </td>
                        <td style="width: 45%;">
                            <p style="margin: 0; font-size: 14px; color: #000000; font-weight: bold;">PAS - </p>
                        </td>
                    </tr>
                </table>

                <!-- Main Form Section -->
                <table class="kalibrasi-main-table">
                    <!-- Nama Alat -->
                     <tr>
                           <td style="width: 20%;">
                                <p style="margin: 0; color: #000000;">Nama Alat</p>
                            </td>
                            <td colspan="3">
                                <!-- Hidden input untuk form type -->
                                <input type="hidden" name="form_type" id="form_type" value="depth_caliper">
                                
                                <select name="nama_alat" id="nama_alat_select" class="kalibrasi-input" onchange="updateFormType(this.value)" required style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;">
                                    <option value="">-- Pilih Alat  --</option>
                                    <option value="Oven">Oven</option>
                                    <option value="Freezer">Freezer</option>
                                    <option value="Furnace">Furnace</option>
                                    <option value="Incubator">Incubator</option>
                                    <option value="Waterbath">Waterbath</option>
                                    <option value="Autoclave">Autoclave</option>
                                    <option value="MANUAL_INPUT">-- Input Manual Nama Alat --</option>
                                </select>
                                
                                <!-- Input Manual - HIDANG AWALNYA -->
                                <div id="manualInputContainer" style="display: none; margin-top: 10px;">
                                    <input type="text" name="nama_alat_manual" id="nama_alat_manual"
                                           placeholder="Ketik nama alat secara manual"
                                           style="background-color: #f5f5f5; color: #333; border: 1px solid #ced4da; padding: 6px 10px; border-radius: 4px; width: 100%;"
                                           oninput="syncNamaAlat()">
                                </div>
                                
                                <!-- Hidden input untuk menyimpan nama alat final -->
                                <input type="hidden" name="nama_alat_final" id="nama_alat_final" value="">
                                
                                <!-- Hidden input untuk display (opsional) -->
                                <input type="hidden" name="nama_alat_display" id="nama_alat_display" value="">
                            </td>
                        </tr>

                   

                    <!-- Merek & Kode Alat -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Merek</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="merek" class="kalibrasi-input me-3" placeholder="Masukkan merek alat" style="width: 60%;" required>
                                <span class="me-3" style="color: #000000;">Kode Alat :</span>
                                <input type="text" name="kode_alat" class="kalibrasi-input" placeholder="Masukkan kode" style="width: 30%;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Type / No. Seri -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Type / No. Seri</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="type_alat" class="kalibrasi-input me-3" placeholder="Masukkan Type" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="no_seri" class="kalibrasi-input" placeholder="Masukkan No. Seri" style="width: 45%;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Kapasitas / Resolusi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kapasitas / Resolusi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <input type="text" name="kapasitas" class="kalibrasi-input me-3" placeholder="Masukkan kapasitas" style="width: 45%;" required>
                                <span class="me-3" style="color: #000000;">/</span>
                                <input type="text" name="resolusi" class="kalibrasi-input" placeholder="Masukkan Resolusi" style="width: 45%;" required>
                            </div>
                        </td>
                    </tr>

                    <!-- Nama Pemilik -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Nama Pemilik</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="nama_pemilik" class="kalibrasi-input" placeholder="Masukkan nama pemilik / instansi" required>
                        </td>
                    </tr>

                    <!-- Tanggal Alat Masuk & Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Alat Masuk</p>
                        </td>
                        <td colspan="3">
                            <input type="date" name="tanggal_alat_masuk" class="kalibrasi-input" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tanggal Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex align-items-center">
                                <!-- Tanggal Kalibrasi -->
                                <input type="date" name="tanggal_kalibrasi" class="kalibrasi-input me-3" style="width: 45%;" required>
                                
                                <span class="me-3" style="color: #000000;">Jenis Pembacaan:</span>
                                
                                <!-- Dropdown Jenis Pembacaan -->
                                <select name="jenis_pembacaan" class="kalibrasi-input" style="width: 45%;" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="manual">Manual</option>
                                    <option value="digital">Digital</option>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <!-- Tempat Kalibrasi -->
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Tempat Kalibrasi</p>
                        </td>
                        <td colspan="3">
                            <div class="d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="lab.PT PAS" id="lab" required>
                                    <label class="form-check-label" for="lab" style="color: #000000;">Lab. PT.PAS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tempat_kalibrasi" value="insitu" id="insitu" required>
                                    <label class="form-check-label" for="insitu" style="color: #000000;">Insitu</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Lokasi PT</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="lokasi_pt" class="kalibrasi-input" placeholder="Masukkan Lokasi PT" >
                        </td>
                    </tr>
                    
                       <tr>
                        <td>
                            <p style="margin: 0; color: #000000;">Kode TH</p>
                        </td>
                        <td colspan="3">
                            <input type="text" name="kode_th" class="kalibrasi-input" placeholder="Masukkan Kode Th" >
                        </td>
                    </tr>
                </table>

                <!-- Fungsi Komponen Lainnya & Kondisi Kalibrasi -->
                <div class="row mt-4">
                    <!-- Fungsi Komponen Lainnya -->
                    <div class="col-md-6 mb-4">
                        <div class="kalibrasi-section-header" style="color: #000000;">Fungsi Komponen Lainnya</div>
                        
                        <div class="d-flex justify-content-around align-items-center my-4">
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000;">Ok</span>
                                <input type="radio" name="fungsi_komponen" value="ok" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                            <div class="text-center">
                                <span class="fw-bold d-block" style="color: #000000;">Rusak</span>
                                <input type="radio" name="fungsi_komponen" value="rusak" style="transform: scale(1.5); margin: 10px 0;" required>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mt-4">
                            <span class="fw-bold me-3" style="color: #000000;">Keterangan :</span>
                            <div style="flex: 1; border-bottom: 2px solid #000;">
                                <input type="text" name="keterangan_fungsi_komponen" class="kalibrasi-input" placeholder="Masukkan Keterangan" style="border: none;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kondisi Kalibrasi -->
                        <div class="col-md-6 mb-4">
                            <div class="kalibrasi-section-header" style="color: #000000;">Kondisi Kalibrasi</div>
                            
                            <table class="table table-bordered">
                                <tr>
                                    <td class="table-secondary fw-bold" style="width: 30%; color: #000000;"></td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Awal</td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Tengah</td>
                                    <td class="table-secondary fw-bold text-center" style="color: #000000;">Akhir</td>
                                </tr>
                               <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">Suhu (°C)</td>
                                    <td><input type="text" name="suhu_awal" class="kondisi-input" required></td>
                                    <td><input type="text" name="suhu_tengah" class="kondisi-input" required></td>
                                    <td><input type="text" name="suhu_akhir" class="kondisi-input" required></td>
                                </tr>
                                <tr>
                                    <td class="bg-light fw-bold" style="color: #000000;">RH (%)</td>
                                    <td><input type="text" name="rh_awal" class="kondisi-input" required></td>
                                    <td><input type="text" name="rh_tengah" class="kondisi-input" required></td>
                                    <td><input type="text" name="rh_akhir" class="kondisi-input" required></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <!-- Data Kalibrasi Section -->
                <div class="data-kalibrasi-header" style="color: #000000;">DATA KALIBRASI</div>
                
                <ol type="1" style="margin:0pt; padding-left:0pt">
        <li class="ListParagraph" style="margin-top:0.5pt; margin-left:10.05pt; text-indent:0pt; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt">
          <span>Penempatan</span>
          <span style="letter-spacing:-0.05pt"></span>
          <span>Sensor</span>
        </li>
      </ol>
      <p style="margin-left:0.05pt; font-size:10pt">
            <!-- Gambar Kiri -->
            <div style="display: inline-block; vertical-align: top; text-align: center; margin-right: 20px;">
                <img src="/logo/foto_rektangular.png" width="350" height="190" alt="" 
                    style="border: 2px solid #000000; padding: 5px; -aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:inline" />
                <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
                Rektangular
                </div>
            </div>
            
            <!-- Canvas Input Tengah -->
            <div style="display: inline-block; vertical-align: top; text-align: center; margin: 0 10px; min-width: 200px; max-width: 260px;">
                <strong style="font-family: Arial; font-size: 9pt; color: #000000;">Penempatan Sensor:</strong>
                <div class="enclosure-canvas-wrapper">
                    <canvas id="enclosureCanvas" height="200"></canvas>
                </div>
                <div style="margin-top: 5px; text-align: center;">
                    <button type="button" id="enclosureClearBtn" class="btn btn-danger btn-sm"
                        style="padding: 3px 12px; font-size: 8pt; font-family: Arial;
                               background-color: #dc3545 !important; color: #ffffff !important; border: none;
                               border-radius: 3px; cursor: pointer; display: inline-block !important; visibility: visible !important;">
                        🗑️ Hapus Gambar
                    </button>
                </div>
                <div class="enclosure-canvas-label">Gambar penempatan sensor di sini</div>
                <!-- INPUT HIDDEN UNTUK GAMBAR CANVAS -->
                <input type="hidden" name="keterangan_gambar" id="enclosureCanvasHidden">
            </div>

            <script>
var tempFormDataStore = window.tempFormDataStore;
var isRestoring = window.isRestoring;
var tabSubmitStatus = window.tabSubmitStatus;
var currentActiveTabId = '1';

            // =============================================
            // ENCLOSURE FREE-DRAW CANVAS (TANPA TOOLBAR)
            // =============================================
            (function() {
                function initEnclosureCanvas() {
                    var canvas = document.getElementById('enclosureCanvas');
                    if (!canvas) return;

                    var wrapper = canvas.parentElement;
                    canvas.width = wrapper.clientWidth || 240;
                    canvas.height = 200;

                    var ctx = canvas.getContext('2d');
                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.strokeStyle = '#000000';
                    ctx.lineWidth = 2;
                    ctx.lineCap = 'round';
                    ctx.lineJoin = 'round';

                    var drawing = false;
                    var lastX = 0, lastY = 0;

                    function getPos(e) {
                        var rect = canvas.getBoundingClientRect();
                        var scaleX = canvas.width / rect.width;
                        var scaleY = canvas.height / rect.height;
                        if (e.touches) {
                            return {
                                x: (e.touches[0].clientX - rect.left) * scaleX,
                                y: (e.touches[0].clientY - rect.top) * scaleY
                            };
                        }
                        return {
                            x: (e.clientX - rect.left) * scaleX,
                            y: (e.clientY - rect.top) * scaleY
                        };
                    }

                    function startDraw(e) {
                        e.preventDefault();
                        drawing = true;
                        var pos = getPos(e);
                        lastX = pos.x;
                        lastY = pos.y;
                        ctx.beginPath();
                        ctx.moveTo(lastX, lastY);
                    }

                    function draw(e) {
                        if (!drawing) return;
                        e.preventDefault();
                        var pos = getPos(e);
                        ctx.lineTo(pos.x, pos.y);
                        ctx.stroke();
                        lastX = pos.x;
                        lastY = pos.y;
                    }

                    function stopDraw(e) {
                        if (!drawing) return;
                        drawing = false;
                        ctx.beginPath();
                        saveCanvas();
                    }

                    function saveCanvas() {
                        var hidden = document.getElementById('enclosureCanvasHidden');
                        if (hidden) {
                            hidden.value = canvas.toDataURL('image/png');
                        }
                    }

                    // Mouse events
                    canvas.addEventListener('mousedown', startDraw);
                    canvas.addEventListener('mousemove', draw);
                    canvas.addEventListener('mouseup', stopDraw);
                    canvas.addEventListener('mouseleave', stopDraw);

                    // Touch events
                    canvas.addEventListener('touchstart', startDraw, {passive: false});
                    canvas.addEventListener('touchmove', draw, {passive: false});
                    canvas.addEventListener('touchend', stopDraw);

                    // Tombol Hapus Gambar
                    var clearBtn = document.getElementById('enclosureClearBtn');
                    if (clearBtn) {
                        clearBtn.addEventListener('click', function() {
                            ctx.clearRect(0, 0, canvas.width, canvas.height);
                            ctx.fillStyle = '#ffffff';
                            ctx.fillRect(0, 0, canvas.width, canvas.height);
                            var hidden = document.getElementById('enclosureCanvasHidden');
                            if (hidden) hidden.value = '';
                        });
                    }

                    // Auto-save before form submit
                    var form = canvas.closest('form');
                    if (form) {
                        form.addEventListener('submit', saveCanvas);
                    }

                    window._enclosureCanvasSave = saveCanvas;
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initEnclosureCanvas);
                } else {
                    initEnclosureCanvas();
                }
            })();
            </script>
            
            <!-- Gambar Kanan -->
            <div style="display: inline-block; vertical-align: top; text-align: center; margin-left: 20px;">
                <img src="/logo/foto_silindrik.png" width="240" height="190" alt="" 
                    style="border: 2px solid #000000; padding: 5px; -aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:inline" />
                <div style="margin-top: 8px; font-family: Arial; font-size: 9pt; font-weight: bold; color: #000000; text-align: center;">
                Silindrik atau Sferik
                </div>
            </div>
            </p>
      <p class="BodyText" style="margin-top:2.45pt">
        <span style="-aw-import:ignore">&#xa0;</span>
      </p>
      <?php
// Ambil nilai repetition dari controller
$repetition = $repetition ?? 1; // Default 1 jika tidak ada
$interval_waktu = [1, 2, 3, 4, 5, 13, 20, 30];
?>

@for($p = 1; $p <= $repetition; $p++)
<ol start="2" type="1" style="margin:0pt; padding-left:0pt">
    <li class="ListParagraph" style="margin-right:468.8pt; margin-bottom:2.65pt; text-indent:0pt; line-height:147%; font-size:11pt; font-weight:bold; letter-spacing:-0.1pt; list-style-position:inside">
        <span style="height:0pt; display:block; position:absolute; z-index:0">
            <img src="images/Aspose.Words.3583c371-5f86-44ec-a7f9-7c86fc979546.011.png" width="108" height="1" alt="" style="margin-top:23.16pt; margin-left:55.02pt; -aw-left-pos:75.02pt; -aw-rel-hpos:page; -aw-rel-vpos:paragraph; -aw-top-pos:23.16pt; -aw-wrap-type:none; position:absolute" />
        </span>
        <span>Data</span>
        <span style="letter-spacing:-0.45pt"></span>
        <span>Pengukuran</span>
        <span style="letter-spacing:normal"> Setting</span>
        <span style="letter-spacing:-0.05pt"></span>
        <span style="letter-spacing:normal">Suhu</span>
        <span style="letter-spacing:-0.05pt"></span>
        <span>ke-{{ $p }}</span>
        <span style="width:31.99pt; letter-spacing:normal; display:inline-block">&#xa0;</span>
        <span style="font-family:'Arial MT'; font-weight:normal; letter-spacing:-0.5pt">:</span>
        <input type="text"
       name="suhu_setting_{{ $p }}"
       value="{{ old('suhu_setting_'.$p, $detail->suhu_setting ?? '') }}"
       
       style="font-size:10pt;
              border:none;
              border-bottom:0.75pt solid #000;
              width:100pt;
              margin-left:5pt;
              background:transparent;
              color:#000;
              padding:0;
              font-family:'Arial MT';
              height:18pt;
              text-align:center;">

        <span style="font-family:Arial; font-size:7pt; font-weight:bold; letter-spacing:-0.25pt"></span>
        <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt; vertical-align:-3pt; font-size:9pt;"></span>
    </li>
</ol>

<table cellspacing="0" cellpadding="0" class="TableNormal" style="width:100%; margin-left:0.48pt; border:2px solid #000000; border-collapse:collapse; margin-bottom: {{ $p < $repetition ? '40px' : '20px' }}">
    <tr style="background: #d9d9d9; height:14pt">
        <td style="width:10%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">Interval Waktu</span>
        </td>
        <td style="width:12%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Alat</span>
        </td>
        <td colspan="9" style="border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">Pembacaan Sensor</span>
        </td>
    </tr>
    <tr style="background: #e8e8e8; height:13pt">
        <td style="border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight:bold; color:#000000; font-size:9pt;">(Menit)</span>
        </td>
        <td style="border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-family:Arial; font-size:6pt; font-weight:bold; letter-spacing:-0.25pt">o</span>
            <span style="font-family:Arial; font-weight:bold; letter-spacing:-0.25pt; vertical-align:-3pt; font-size:9pt;">C</span>
        </td>
        <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">1</span>
        </td>
        <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">2</span>
        </td>
        <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">3</span>
        </td>
        <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">4</span>
        </td>
        <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">5</span>
        </td>
        <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">6</span>
        </td>
        <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">7</span>
        </td>
        <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">8</span>
        </td>
        <td style="width:8.67%; border:2px solid #000; vertical-align:middle; text-align:center">
            <span style="font-weight: bold; color: #000000; font-size:9pt">9</span>
        </td>
    </tr>
    
    @foreach($interval_waktu as $interval)
    <tr style="height:22pt;">
        <td style="border:2px solid #000; padding:0; vertical-align:middle;">
            <input type="text" name="interval_{{ $p }}_{{ $interval }}" readonly value="{{ $interval }}" style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;font-weight:bold;box-sizing:border-box;">
        </td>
        <td style="border:2px solid #000; padding:0; vertical-align:middle;">
            <input type="text" name="alat_{{ $p }}_{{ $interval }}" value=""  style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
        </td>
        
        @for($s = 1; $s <= 9; $s++)
        <td style="border:2px solid #000; padding:0; vertical-align:middle;">
            <input type="text" name="sensor_{{ $p }}_{{ $interval }}_{{ $s }}" value=""  style="width:100%;height:100%;border:none;background:transparent;text-align:center;font-size:10pt;color:#000;padding:2px;box-sizing:border-box;">
        </td>
        @endfor
    </tr>
    @endforeach
</table>
@endfor

                <div style="height: 50px;"></div>


              <!-- Footer Section -->
              <table class="kalibrasi-main-table" style="width: 100%; border-collapse: collapse;">
    <!-- HEADER FOOTER -->
    <tr>
        <td colspan="6" style="text-align: center; border: 1px solid #000; border-bottom: none; padding: 10px 0;">
            <span style="font-weight: bold; font-size: 18px; color: #000000;">Isilah lembar data kalibrasi dengan lengkap dan jelas!</span>
        </td>
    </tr>

    <!-- ALAT STANDAR + CHECKBOX -->
    <tr style="height: 40px;">
        <td rowspan="3" style="width: 20%; border: 1px solid #000; vertical-align: middle; text-align: center; font-weight: bold; font-size: 10pt; color: #000000; background-color: #f8f9fa;">
            Alat<br>Standar
        </td>

        <!-- Alat 1 -->
        <td style="width: 5%; border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Mini Data Logger Graphtec GL-220" id="alat1" 
                style="transform: scale(1.2); cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <label for="alat1" style="cursor: pointer; color: #000000; display: block; padding: 5px 0;">
                Mini Data Logger Graphtec GL-220
            </label>
        </td>

        <!-- Dikalibrasi oleh -->
        <td rowspan="3" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Dikalibrasi<br>oleh</strong>
        </td>
        <!-- Diperiksa oleh -->
        <td rowspan="3" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: top; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding-top: 15px;">
            <strong>Diperiksa<br>oleh</strong>
        </td>
    </tr>

    <!-- Alat 2 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Mini Data Logger Graphtec GL-240" id="alat2" 
                style="transform: scale(1.2); cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <label for="alat2" style="cursor: pointer; color: #000000; display: block; padding: 5px 0;">
                Mini Data Logger Graphtec GL-240
            </label>
        </td>
    </tr>

    <!-- Alat 3 -->
    <tr style="height: 40px;">
        <td style="border: 1px solid #000; text-align: center; vertical-align: middle;">
            <input type="checkbox" name="alat_standar[]" value="Mini Data Logger Huato" id="alat3" 
                style="transform: scale(1.2); cursor: pointer;">
        </td>
        <td colspan="2" style="border: 1px solid #000; padding-left: 12px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <label for="alat3" style="cursor: pointer; color: #000000; display: block; padding: 5px 0;">
                 Mini Data Logger Huato
            </label>
        </td>
    </tr>

    <!-- METODE KALIBRASI + TTD & NAMA -->
    <tr style="height: 40px;">
        <td rowspan="2" style="width: 20%; border: 1px solid #000; text-align: center; vertical-align: middle; font-size: 9pt; color: #000000; background-color: #f8f9fa; padding: 10px;">
            <strong>Metode Kalibrasi</strong>
        </td>
        <td colspan="3" rowspan="2" style="border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; line-height: 1.4;">
            PAS-IK1102-29
        </td>
        
        <!-- Input Nama Dikalibrasi Oleh -->
        <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <div style="display:flex; align-items:center; width:100%; gap:6px;">
    <strong style="font-size:9pt;">Nama :</strong>
    <input type="text" 
           name="calibrated_by" 
           class="kalibrasi-input" 
           placeholder="Nama Lengkap" 
           style="flex:1; border:none; outline:none; padding:5px; font-size:9pt; background:transparent;"
           required  readonly value="{{ auth()->user()->nama ?? 'System' }}">
</div>

        </td>
        
        <!-- Input Nama Diperiksa Oleh -->
        <td style="width: 20%; border: 1px solid #000; padding: 5px; font-size: 9pt; vertical-align: middle; color: #000000;">
            <div style="display:flex; align-items:center; width:100%; gap:6px;">
    <strong style="font-size:9pt;">Nama :</strong>
    <input type="text" 
           name="verified_by" 
           class="kalibrasi-input" 
           placeholder="-" 
           style="flex:1; border:none; outline:none; padding:5px; font-size:9pt; background:transparent;"
           readonly>
</div>

        </td>
    </tr>

    <!-- TTD -->
    <tr style="height: 40px;">
        <!-- Kolom kosong untuk metode kalibrasi -->
        <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
            <strong>TTD :</strong>
        </td>
        <td style="width: 20%; border: 1px solid #000; padding: 10px; font-size: 9pt; vertical-align: middle; color: #000000; text-align: left;">
            <strong>TTD :</strong>
        </td>
    </tr>
</table>


                <!-- Submit Button Section -->
                   <!-- Submit Button Section -->
                  <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button type="button" id="btnSimpanSemua" class="btn btn-primary btn-lg" onclick="submitSemuaForm()" style="padding: 12px 40px; font-size: 16px; font-weight: bold; border-radius: 8px;">
                            <i class="fas fa-save me-2"></i>Simpan Data Kalibrasi
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    

    <script>
// ==========================================
// STORAGE PER TAB - GLOBAL
// ==========================================
if (typeof window.tempFormDataStore === 'undefined') {
    window.tempFormDataStore = {};
}
if (typeof window.isRestoring === 'undefined') {
    window.isRestoring = false;
}
if (typeof window.tabSubmitStatus === 'undefined') {
    window.tabSubmitStatus = {};
}

// ==========================================
// FUNGSI GET TAB AKTIF
// ==========================================
function getActiveTabId() {
    const activePane = document.querySelector('.tab-pane.active');
    if (activePane && activePane.id && activePane.id.startsWith('lk-pane-')) {
        const tabId = activePane.id.replace('lk-pane-', '');
        currentActiveTabId = tabId;
        return tabId;
    }
    
    const activeTabButton = document.querySelector('.nav-link.active');
    if (activeTabButton && activeTabButton.id && activeTabButton.id.startsWith('lk-tab-')) {
        const tabId = activeTabButton.id.replace('lk-tab-', '');
        currentActiveTabId = tabId;
        return tabId;
    }
    
    const containers = document.querySelectorAll('.lk-form-container');
    for (let i = 0; i < containers.length; i++) {
        const style = window.getComputedStyle(containers[i]);
        if (style.display !== 'none') {
            const tabId = containers[i].getAttribute('data-lk-id');
            if (tabId) return tabId;
        }
    }
    
    return currentActiveTabId;
}

function updateActiveTab(tabId) {
    currentActiveTabId = tabId;
    console.log(`🔄 Global active tab updated to: ${tabId}`);
}

// ==========================================
// FUNGSI UNTUK MENONAKTIFKAN REQUIRED PADA FORM YANG TIDAK VISIBLE
// ==========================================
function disableRequiredOnHiddenForms() {
    console.log('🔧 disableRequiredOnHiddenForms called');
    
    // Cari semua form yang ada di halaman
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    
    allForms.forEach((form, index) => {
        const formIndex = index + 1;
        const container = form.closest('.lk-form-container');
        const isVisible = container && window.getComputedStyle(container).display !== 'none';
        
        console.log(`📌 Form ${formIndex}: isVisible=${isVisible}`);
        
        const requiredInputs = form.querySelectorAll('[required]');
        
        if (!isVisible) {
            // Nonaktifkan required untuk form yang tidak visible
            requiredInputs.forEach(input => {
                console.log(`🔧 Disabling required for: ${input.name}`);
                input.removeAttribute('required');
                input.setAttribute('data-required-temp', 'true');
            });
        } else {
            // Aktifkan kembali required untuk form yang visible
            requiredInputs.forEach(input => {
                if (input.hasAttribute('data-required-temp')) {
                    console.log(`🔧 Re-enabling required for: ${input.name}`);
                    input.setAttribute('required', 'required');
                    input.removeAttribute('data-required-temp');
                }
            });
        }
    });
}

function restoreRequiredOnAllForms() {
    const allForms = document.querySelectorAll('form[id^="kalibrasiForm"]');
    allForms.forEach(form => {
        form.querySelectorAll('[data-required-temp]').forEach(input => {
            input.setAttribute('required', 'required');
            input.removeAttribute('data-required-temp');
        });
    });
}

// ==========================================
// UPDATE FORM TYPE
// ==========================================
function updateFormType(selectedAlat) {
    const manualInputContainer = document.getElementById('manualInputContainer');
    const manualInput = document.getElementById('nama_alat_manual');
    const finalInput = document.getElementById('nama_alat_final');
    
    if (!manualInputContainer || !manualInput) return;
    
    if (selectedAlat === 'MANUAL_INPUT') {
        manualInputContainer.style.display = 'block';
        manualInput.required = true;
        if (finalInput) finalInput.value = '';
    } else {
        manualInputContainer.style.display = 'none';
        manualInput.required = false;
        manualInput.value = '';
        if (finalInput && selectedAlat) finalInput.value = selectedAlat;
    }
}

function syncNamaAlat() {
    const manualInput = document.getElementById('nama_alat_manual');
    const finalInput = document.getElementById('nama_alat_final');
    if (manualInput && finalInput) {
        finalInput.value = manualInput.value;
    }
}

function formatNumberInput(input) {
    if (!input) return;
    let value = input.value;
    if (value === '' || value === null) return;
    value = value.toString().replace(/,/g, '');
    if (!isNaN(value) && value !== '') {
        let num = parseFloat(value);
        if (!isNaN(num)) input.value = num.toString();
    }
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==========================================
// HANDLE SAVE SUCCESS
// ==========================================
window.handleSaveSuccess = function(tabId, data) {
    console.log('🎉 handleSaveSuccess called for tab:', tabId, data);
    
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

    const formName = container.getAttribute('data-form-name') || 'Enclosure';
    const calibrationId = data.calibration_id || data.id || '-';
    const printLabelUrl = data.print_label_url || `/calibrations/${calibrationId}/print-label`;
    
    tabSubmitStatus[tabId] = {
        success: true,
        calibrationId: calibrationId,
        printLabelUrl: printLabelUrl,
        formName: formName,
        timestamp: Date.now()
    };
    
    container.innerHTML = `
        <div class="save-success-overlay text-center p-5 fade-in" style="background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
       <div class="mb-4">
                    <i class="fas fa-check-circle text-success fa-5x"></i>
                </div>
                <h3 class="text-success mb-2">Simpan Berhasil!</h3>
                <p class="mb-3" style="color: black;">Data kalibrasi untuk <strong>${escapeHtml(formName)}</strong> telah berhasil disimpan ke database.</p>
                
                <div class="d-inline-block mb-4 p-3" style="border-radius: 12px; text-align: left; background: white; border: 1px solid #ddd;">
                    <i class="fas fa-info-circle mr-2" style="color: #0d6efd;"></i>
                    <strong style="color: black;">ID Kalibrasi:</strong> <code style="background: #f5f5f5; color: black; font-weight: bold;">${escapeHtml(calibrationId)}</code>
                    <br>
                    <small style="color: black;">Status: <span class="badge bg-success">Draft</span></small>
                </div>
        
        <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
            <!-- Button Cetak Label - Blue -->
            <button type="button" class="btn btn-primary btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="window.open('${printLabelUrl}', '_blank')">
                <i class="fas fa-print me-2"></i> Cetak Label
            </button>
            
            <!-- Button Input Lagi - Green -->
            <button type="button" class="btn btn-success btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="resetTabForNewScan(${tabId})">
                <i class="fas fa-plus-circle me-2"></i> Input Lagi
            </button>
            
            <!-- Button Tutup Tab - Red -->
            <button type="button" class="btn btn-danger btn-lg px-4 py-2" 
                    style="border-radius: 10px; transition: all 0.2s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    onmousedown="this.style.transform='translateY(1px)';"
                    onmouseup="this.style.transform='translateY(-2px)';"
                    onclick="removeTab(${tabId})">
                <i class="fas fa-times me-2"></i> Tutup Tab
            </button>
        </div>
        
        <div class="mt-3 text-muted small">
            <i class="fas fa-info-circle me-1"></i> Data tersimpan sebagai Draft. 
            Klik <strong>Cetak Label</strong> untuk mencetak, atau <strong>Input Lagi</strong> untuk melanjutkan kalibrasi berikutnya.
        </div>
    </div>
    `;

    const finishContainer = document.getElementById('finish-action-container');
    if (finishContainer) finishContainer.classList.remove('d-none');

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: 'success',
            title: '✓ Data Tersimpan!',
            html: `<strong>${escapeHtml(formName)}</strong><br>ID: ${calibrationId}`,
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }
};

window.resetTabForNewScan = function(tabId) {
    if (confirm('Data yang belum disimpan akan hilang. Lanjutkan?')) {
        delete tabSubmitStatus[tabId];
        location.reload();
    }
};

window.removeTab = function(tabId) {
    if (tabId == 1) {
        alert('Tab utama tidak bisa ditutup!');
        return;
    }
    if (confirm(`Apakah Anda yakin ingin menutup Form ${tabId}?`)) {
        delete tabSubmitStatus[tabId];
        delete tempFormDataStore[tabId];
        const container = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
        if (container) container.remove();
        const tabBtn = document.getElementById(`lk-tab-${tabId}`);
        if (tabBtn) tabBtn.remove();
        const firstContainer = document.querySelector('.lk-form-container[data-lk-id="1"]');
        if (firstContainer) firstContainer.style.display = 'block';
        updateActiveTab('1');
    }
};

// ==========================================
// SUBMIT Enclosure - SINGLE FORM PER TAB
// ==========================================
// ==========================================
// SUBMIT Enclosure - SINGLE FORM
// ==========================================
async function submitSemuaForm() {
    // Dapatkan tab ID yang aktif
    const activeTabId = getActiveTabId();
    console.log('📌 Submitting from active tab:', activeTabId);
    
    // Cari container yang aktif
    const activeContainer = document.querySelector(`.lk-form-container[data-lk-id="${activeTabId}"]`);
    if (!activeContainer) {
        alert('Container form tidak ditemukan!');
        return;
    }
    
    // 🔥 CARI FORM DENGAN ID TEPAT (BUKAN querySelectorAll)
    // Enclosure menggunakan ID "kalibrasiForm" (tanpa angka)
    let form = activeContainer.querySelector('#kalibrasiForm');
    
    // Jika tidak ditemukan, coba cari form dengan ID yang mengandung "kalibrasiForm"
    if (!form) {
        form = activeContainer.querySelector('form[id^="kalibrasiForm"]');
    }
    
    // Jika masih tidak ditemukan, cari form pertama di container
    if (!form) {
        form = activeContainer.querySelector('form');
    }
    
    if (!form) {
        alert('Form tidak ditemukan!');
        return;
    }
    
    console.log(`✅ Form ditemukan di tab ${activeTabId}`);
    
    // 🔥 HAPUS SEMUA ATRIBUT REQUIRED
    form.querySelectorAll('[required]').forEach(el => {
        el.removeAttribute('required');
    });
    
    // 🔥 NONAKTIFKAN VALIDASI BROWSER
    form.setAttribute('novalidate', 'novalidate');
    form.noValidate = true;
    
    // Validasi alat standar
    const alatStandar = form.querySelectorAll('input[name="alat_standar[]"]:checked');
    if (alatStandar.length === 0) {
        alert('Pilih minimal 1 alat standar!');
        return;
    }
    
    const btn = document.getElementById('btnSimpanSemua');
    if (!btn) {
        alert('Tombol simpan tidak ditemukan!');
        return;
    }
    
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan Data...';
    
    try {
        const formData = new FormData(form);
        
        // Tambahkan field wajib yang mungkin kosong
        formData.append('form_type', 'enclosure');
        formData.append('rentang_ukur_min', '0');
        formData.append('rentang_ukur_max', '0');
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }
        
        console.log('📤 Mengirim data dari tab:', activeTabId);
        
        const response = await fetch('/calibrations', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        const contentType = response.headers.get('content-type');
        
        let result;
        if (contentType && contentType.includes('application/json')) {
            result = await response.json();
        } else {
            const text = await response.text();
            console.error('Non-JSON response:', text.substring(0, 500));
            throw new Error('Server mengembalikan response yang tidak valid');
        }
        
        if (!response.ok) {
            throw new Error(result.error || `Gagal menyimpan data: ${response.status}`);
        }
        
        // Ambil nama form
        let formName = 'Enclosure';
        const selectNamaAlat = form.querySelector('select[name="nama_alat"]');
        if (selectNamaAlat && selectNamaAlat.value && selectNamaAlat.value !== 'MANUAL_INPUT') {
            formName = selectNamaAlat.value;
        } else {
            const manualNamaAlat = form.querySelector('input[name="nama_alat_manual"]');
            if (manualNamaAlat && manualNamaAlat.value) {
                formName = manualNamaAlat.value;
            }
        }
        
        // Update data-form-name di container
        activeContainer.setAttribute('data-form-name', formName);
        
        console.log('📌 Saving success for tab:', activeTabId);
        
        // Panggil handleSaveSuccess dengan tabId yang benar
        if (typeof window.handleSaveSuccess === 'function') {
            window.handleSaveSuccess(activeTabId, result);
        } else {
            alert('Data berhasil disimpan!');
        }
        
    } catch (err) {
        console.error('Submit error:', err);
        alert('Error: ' + err.message);
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}

// ==========================================
// SETUP TAB SWITCHING
// ==========================================
function setupTabSwitching() {
    $(document).on('shown.bs.tab', 'button[data-toggle="tab"]', function (e) {
        const targetId = $(e.target).attr('id');
        if (targetId && targetId.startsWith('lk-tab-')) {
            const tabId = targetId.replace('lk-tab-', '');
            console.log('🎯 Tab switched to:', tabId);
            updateActiveTab(tabId);
            
            // Sembunyikan semua container
            document.querySelectorAll('.lk-form-container').forEach(container => {
                container.style.display = 'none';
            });
            
            // Tampilkan container yang dipilih
            const targetContainer = document.querySelector(`.lk-form-container[data-lk-id="${tabId}"]`);
            if (targetContainer) {
                targetContainer.style.display = 'block';
            }
        }
    });
    
    const activeButton = document.querySelector('.nav-link.active');
    if (activeButton && activeButton.id) {
        const tabId = activeButton.id.replace('lk-tab-', '');
        updateActiveTab(tabId);
    }
}

// ==========================================
// INISIALISASI
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM Content Loaded - Initializing Enclosure...');
    
    // Setup tab switching
    setupTabSwitching();
    
    // Setup event listeners untuk form yang ada
    const selectAlat = document.getElementById('nama_alat_select');
    if (selectAlat) {
        updateFormType(selectAlat.value);
        selectAlat.addEventListener('change', function() {
            updateFormType(this.value);
        });
    }
    
    const manualInput = document.getElementById('nama_alat_manual');
    if (manualInput) {
        manualInput.addEventListener('input', syncNamaAlat);
    }
    
    // Nonaktifkan required pada form yang tidak visible pertama kali
    setTimeout(() => {
        disableRequiredOnHiddenForms();
    }, 500);
    
    console.log('✅ Enclosure initialization complete!');
});
</script>
</body>
</html>