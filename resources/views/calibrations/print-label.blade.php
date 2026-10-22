<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Label — {{ $data['namaAlat'] }}</title>
    
    {{-- Meta tags untuk modal (hanya jika showModal = true) --}}
    @if($showModal)
        <meta name="show-no-label-modal" content="true">
        <meta name="calibration-id" content="{{ $data['id'] }}">
        <meta name="form-type" content="print-label">
    @endif
       
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
      
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- libs - URUTAN PENTING: jQuery dulu, baru yang lain -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
<script src="https://unpkg.com/@mmote/niimbluelib@0.0.1-alpha.33/dist/umd/niimbluelib.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
    <style>
        body { background: #fdfbf7; font-family:'Poppins', sans-serif; color:#4a4a4a; min-height:100vh; }
        .container { max-width:800px !important; }
    
        /* Card & Layout */
        .card { background:#fff; border:none; border-radius:24px; box-shadow:0 10px 40px rgba(0,0,0,0.04); overflow:hidden; transition:transform 0.3s ease; }
        .card:hover { transform:translateY(-2px); }
        .card-header { background:#fff; border-bottom:2px solid #f0f2f5; padding:20px 24px; border-radius:24px 24px 0 0 !important; }
        .card-body { padding:24px; }

        /* Typography */
        h4 { color:#2d3436; font-weight:700; letter-spacing:-0.5px; }
        h5 { color:#2d3436; font-weight:600; }
        .text-secondary { color:#b2bec3 !important; font-weight:500; }
        a.back-link { color:#7fabf7; font-weight:600; text-decoration:none; transition:0.2s; background:#eef4ff; padding:8px 16px; border-radius:12px; }
        a.back-link:hover { background:#dce9ff; text-decoration:none; color:#5b8def; }

        /* Status Badges */
        .badge-status { display:inline-flex; align-items:center; gap:8px; padding:6px 16px; border-radius:30px; font-weight:600; font-size:.85rem; transition:0.3s; }
        .badge-status.off { background:#fff0f0; color:#ef5350; border:1px solid #ffcccc; }
        .badge-status.on  { background:#e8f8f5; color:#00b894; border:1px solid #b8e9d4; }
        
        .pulse { width:10px; height:10px; border-radius:50%; animation:pulse 2s infinite; }
        .pulse.r { background:#ef5350; box-shadow:0 0 0 4px rgba(239,83,80,0.2); }
        .pulse.g { background:#00b894; box-shadow:0 0 0 4px rgba(0,184,148,0.2); }
        @keyframes pulse { 0% {box-shadow:0 0 0 0 rgba(0,0,0,0.2)} 70% {box-shadow:0 0 0 10px rgba(0,0,0,0)} 100% {box-shadow:0 0 0 0 rgba(0,0,0,0)} }

        /* Data Chips */
        .chip { background:#f1f5f9; border:1px solid #e2e8f0; border-radius:16px; padding:10px 16px; 
                font-size:.9rem; display:inline-block; margin:4px; transition:0.2s; }
        .chip:hover { background:#e6eff5; border-color:#cbd5e1; }
        .chip strong { display:block; font-size:.7rem; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:2px; }

        /* Steps */
        .step { display:flex; align-items:center; gap:16px; padding:16px; border-radius:16px; margin-bottom:12px; 
                border:1px solid #f1f2f6; background:#fafbfc; transition:0.3s; }
        .step:hover { background:#fff; box-shadow:0 4px 15px rgba(0,0,0,0.03); border-color:#e1e2e6; }
        
        .step-num { width:36px; height:36px; border-radius:12px; display:flex; align-items:center; justify-content:center; 
                    font-weight:700; font-size:1rem; flex-shrink:0; transition:0.3s; }
        .step-num.done   { background:#00b894; color:#fff; box-shadow:0 4px 10px rgba(0,184,148,0.3); }
        .step-num.active { background:#ff7675; color:#fff; box-shadow:0 4px 10px rgba(255,118,117,0.3); animation:bounce 1s infinite; }
        .step-num.wait   { background:#dfe6e9; color:#b2bec3; }
        
        @keyframes bounce { 0%,100%{transform:scale(1)} 50%{transform:scale(1.1)} }

        /* Controls */
        .form-select { background:#fff; border:2px solid #f1f2f6; color:#2d3436; border-radius:12px; padding:10px 16px; 
                       font-weight:500; cursor:pointer; background-image:none; }
        .form-select:focus { border-color:#ff7675; box-shadow:0 0 0 4px rgba(255,118,117,0.15); outline:none; }
        .canvas-wrap { background:#fff; border:2px dashed #d1d8e0; border-radius:16px; padding:8px; display:inline-flex; }

        /* Log Box */
        .log-box { background:#fdfdfd; border:2px solid #f1f2f6; border-radius:16px; padding:16px; 
                   font-family:'Courier New', monospace; font-size:.8rem; height:180px; overflow-y:auto; color:#636e72; }
        .ls{color:#00b894; font-weight:600} .le{color:#d63031; font-weight:600} 
        .li{color:#0984e3} .lw{color:#e17055}

        /* Buttons */
        .btn { border-radius:12px; font-weight:600; padding:10px 24px; letter-spacing:0.3px; border:none; transition:all 0.3s; }
        .btn-primary { background:linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%); 
                       background:linear-gradient(to right, #ff7675, #fab1a0); color:#fff; box-shadow:0 8px 20px rgba(255,118,117,0.3); }
        .btn-primary:hover { transform:translateY(-3px); box-shadow:0 12px 25px rgba(255,118,117,0.4); background:linear-gradient(to right, #ff6b6b, #ff9f43); color:#fff; }
        .btn-primary:active { transform:translateY(-1px); }

        .btn-danger { background:#ffecec; color:#ff6b6b; border:1px solid #ffcccc; box-shadow:none; }
        .btn-danger:hover { background:#ff6b6b; color:#fff; border-color:#ff6b6b; }
        
        /* Custom Input */
        label { color:#636e72; font-weight:600; font-size:.9rem; }
        i { opacity:0.8; }
        
        /* Modal Styling */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .modal-header {
            border-bottom: 2px solid #f0f2f5;
            padding: 20px 24px;
        }
        .modal-body {
            padding: 24px;
        }
        .modal-footer {
            border-top: 2px solid #f0f2f5;
            padding: 16px 24px;
        }
        .modal-title {
            font-weight: 700;
            color: #2d3436;
        }
        .no-label-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #f1f2f6;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .no-label-input:focus {
            border-color: #ff7675;
            outline: none;
            box-shadow: 0 0 0 4px rgba(255,118,117,0.15);
        }
        .modal-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2d3436;
        }
        body { 
            margin: 0; 
            padding: 0; 
        }
    </style>
</head>
<body>
<div class="container py-4" style="max-width:760px;">

    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <div>
            <h4 class="mb-0"><i class="fas fa-tag me-2"></i>Cetak Label Kalibrasi</h4>
            <small class="text-secondary">{{ $data['namaAlat'] }} — {{ $data['NoSeri'] }}</small>
        </div>
        <div>
            <button onclick="handleSelesai()" class="back-link me-2">
                <i class="fas fa-check me-1"></i> Selesai
            </button>
            <a href="{{ route('calibrations.index') }}" class="back-link">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    @if($successMessage)
    <div class="alert alert-success alert-dismissible fade show mb-3">
        <i class="fas fa-check-circle me-2"></i>{{ $successMessage }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="mb-3">
        <div class="chip"><strong>ID Alat</strong>#{{ $data['id_alat'] }}</div>
        <div class="chip"><strong>No. Seri</strong>{{ $data['NoSeri'] }}</div>
        <div class="chip"><strong>No. LK</strong>{{ $data['LK'] }}</div>
        <div class="chip"><strong>Tgl Kalibrasi</strong>{{ $data['tanggalKalibrasi'] }}</div>
            
         <!-- 🔥 TAMPILKAN NO LABEL (klik untuk edit) -->
        <div class="chip" style="background: #e8f8f5; border-color: #00b894; cursor: pointer;" onclick="showNoLabelModal()">
            <strong>No. Label</strong>
            <i class="fas fa-tag me-1 text-success"></i>
            {{ $data['no_label'] ?? 'Belum diisi' }}
            <i class="fas fa-pen ms-1 text-muted" style="font-size: 10px;"></i>
        </div>
        
         <!-- INPUT NEXT KALIBRASI - BISA DIUBAH -->
        <div class="chip d-flex align-items-center gap-2">
            <strong>Next Kalibrasi:</strong>
            <!-- Ganti input dengan -->
            <input type="text" 
                   id="nextDateInput" 
                   class="form-control form-control-sm d-inline-block datepicker" 
                   style="width: auto; max-width: 180px; border: 2px solid #f1f2f6; border-radius: 12px; padding: 6px 12px; text-align: center;"
                   value="{{ $data['nextTanggalKalibrasi'] ?? date('d-m-Y', strtotime('+1 year')) }}"
                   placeholder="DD-MM-YYYY">
            <i class="fas fa-calendar-alt text-primary ms-1"></i>
        </div>
        
        <div class="chip"><strong>Tgl Cetak</strong>{{ $data['today'] }}</div>
    </div>

        <!-- Ukuran Label & Printer & Identifier -->
    <div class="card mb-3">
        <div class="card-body px-4 py-3">
            <!-- Baris dropdown (3 kolom) -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="mb-2"><i class="fas fa-ruler-combined me-1"></i> Pilih Ukuran Label</label>
                    <select id="labelSize" class="form-select" onchange="renderPreview()">
                        <option value="50x30" selected>50×30 mm (besar)</option>
                        <option value="30x20">30×20 mm (kecil)</option>
                        <option value="12x30">12×30 mm (D11_H)</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="mb-2"><i class="fas fa-print me-1"></i> Pilih Printer</label>
                    <select id="printerType" class="form-select" onchange="updatePrinterName()">
                        <option value="B1" selected>NIIMBOT B1</option>
                        <option value="D11_H">NIIMBOT D11_H</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="mb-2"><i class="fas fa-tag me-1"></i> Pilih Identifier Label</label>
                    <select id="identifierType" class="form-select" onchange="renderPreview()">
                        <option value="noseri" selected>No Seri</option>
                        <option value="kodealat">Kode Alat</option>
                        <option value="type">Type</option>
                    </select>
                    <small class="text-muted d-block mt-2" style="font-size: 0.75rem; line-height: 1.4;">
                        <i class="fas fa-info-circle me-1"></i>
                        Pilih salah satu data yang akan ditampilkan di bawah QR Code.
                        Jika data yang dipilih kosong, label akan menampilkan tanda <strong>"—"</strong>.
                    </small>
                </div>
            </div>
    
            <!-- Preview canvas (di tengah) -->
            <div class="text-center">
                <div class="canvas-wrap">
                    <canvas id="previewCanvas"></canvas>
                </div>
            </div>
        </div>
    </div>
        
    

    <!-- Steps -->
    <div class="card mb-3">
        <div class="card-header py-3 px-4 d-flex align-items-center justify-content-between">
          <h5 class="mb-0">
    <i class="fas fa-print me-2"></i>
    <span id="printerName">Printer NIIMBOT B1</span>
</h5>
            <span id="statusBadge" class="badge-status off">
                <div class="pulse r" id="pulseDot"></div>
                <span id="statusText">Tidak Terhubung</span>
            </span>
        </div>
        <div class="card-body px-4 py-3">
            <div class="step">
                <div class="step-num active" id="stepNum1">1</div>
                <div>
                    <div class="fw-semibold">Hubungkan Printer</div>
                    <small class="text-secondary">Klik → pilih NIIMBOT B1 dari dialog Bluetooth</small>
                </div>
                <div class="ms-auto d-flex gap-2">
                    <button id="connectBtn" class="btn btn-primary" onclick="doConnect()">
                        <i class="fas fa-bluetooth me-1"></i> Connect
                    </button>
                    <button id="disconnectBtn" class="btn btn-outline-danger btn-sm" onclick="doDisconnect()">
                        <i class="fas fa-power-off"></i>
                    </button>
                </div>
            </div>
            <div class="step" id="step2" style="opacity:.5">
                <div class="step-num wait" id="stepNum2">2</div>
                <div>
                    <div class="fw-semibold">Mencetak Label</div>
                    <small class="text-secondary">Otomatis dimulai setelah printer terhubung</small>
                </div>
                <div class="ms-auto" id="printStatus"></div>
            </div>
        </div>
    </div>

    <!-- Log -->
    <div class="card">
        <div class="card-header py-2 px-4 d-flex justify-content-between align-items-center">
            <span style="font-weight:600"><i class="fas fa-terminal me-1 text-danger"></i> Log</span>
            <button class="btn btn-outline-secondary btn-sm" onclick="clearLog()"><i class="fas fa-trash"></i></button>
        </div>
        <div class="card-body px-4 py-2">
            <div class="log-box" id="logBox"><span class="li">▶ Siap...</span><br></div>
        </div>
    </div>
</div>

<!-- MODAL INPUT NO LABEL -->
<!-- MODAL INPUT NO LABEL - VERSION YANG SUDAH DIPERBAIKI -->
<div class="modal fade" id="noLabelModal" tabindex="-1" aria-labelledby="noLabelModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noLabelModalLabel">
                    <i class="fas fa-tag me-2"></i>
                    {{ isset($data['no_label']) && $data['no_label'] ? 'Lihat / Ubah No. Label' : 'Lengkapi No. Label Kalibrasi' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('calibrations.update-label', $data['id']) }}" id="noLabelForm">
                @csrf
                <div class="modal-body">
                    @if(isset($data['no_label']) && $data['no_label'])
                        <div class="alert alert-success mb-4">
                            <i class="fas fa-check-circle me-2"></i>
                            No. Label saat ini: <strong>{{ $data['no_label'] }}</strong>
                            <br>
                            <small class="text-muted">Anda dapat mengubah No. Label di bawah ini jika diperlukan.</small>
                        </div>
                    @else
                        <div class="alert alert-info mb-4">
                            <i class="fas fa-print me-2"></i>
                            Label telah dicetak. Silakan lengkapi No. Label untuk menyelesaikan proses.
                        </div>
                    @endif
                    
                    <label for="no_label_input" class="modal-label">
                        <i class="fas fa-barcode me-1"></i>No. Label Kalibrasi
                    </label>
                    <input type="text" 
                           name="no_label"
                           id="no_label_input" 
                           class="no-label-input" 
                           placeholder="Contoh: LAB-001/2024" 
                           maxlength="50"
                           autocomplete="off"
                           value="{{ $data['no_label'] ?? '' }}"
                           >
                    
                    <div id="noLabelError" class="text-danger mt-2" style="display: none;">
                        <i class="fas fa-exclamation-circle me-1"></i>No. Label wajib diisi!
                    </div>
                    
                    <div id="noLabelHelp" class="form-text mt-2 text-muted">
                        Nomor label wajib diisi. Format bebas, contoh: LAB-001/2024 atau PAS-001/2026
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="calibration_id" value="{{ $data['id'] }}">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        {{ isset($data['no_label']) && $data['no_label'] ? 'Update No. Label' : 'Simpan No. Label' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- libs -->
<script src="https://unpkg.com/@mmote/niimbluelib@0.0.1-alpha.33/dist/umd/niimbluelib.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Data dari Blade -->
<script>
const CALIB = {!! json_encode([
    'id' => $data['id'],
    'id_alat' => $data['id_alat'],
    'certificate_id' => $data['certificate_id'] ?? '',
    'qr_code_url' => $data['qr_code_url'] ?? ('https://pascalibration.com/' . ($data['certificate_id'] ?? '')),
    'NoSeri' => $data['NoSeri'] ?? '',
    'kodeAlat' => $data['kodeAlat'] ?? '',
    'type' => $data['type'] ?? '',
    'LK' => $data['LK'],
    'tanggalKalibrasi' => $data['tanggalKalibrasi'],
    'NextTanggalKalibrasi' => $data['NextTanggalKalibrasi'] ?? date('d-m-Y', strtotime('+1 year')),
    'today' => $data['today'],
    'namaAlat' => $data['namaAlat']
]) !!};

const SHOW_MODAL = {{ $showModal ? 'true' : 'false' }};
const CALIBRATION_ID = '{{ $data['id'] }}';
const LOGO_URL = "{!! $logoBase64 !!}" || "{{ asset('logo/logo_pas_basic.png') }}";
</script>

<!-- Log util -->
<script>
function addLog(msg,t='i'){
    const lb=document.getElementById('logBox');
    const s=document.createElement('span'); s.className=`l${t}`; s.textContent=msg;
    lb.appendChild(s); lb.appendChild(document.createElement('br'));
    lb.scrollTop=lb.scrollHeight;
}
function clearLog(){document.getElementById('logBox').innerHTML='<span class="li">▶ Dibersihkan</span><br>';}
const _cl=console.log.bind(console),_ce=console.error.bind(console),_cw=console.warn.bind(console);
console.log=(...a)=>{_cl(...a);addLog(a.join(' '),'i');};
console.error=(...a)=>{_ce(...a);addLog(a.join(' '),'e');};
console.warn=(...a)=>{_cw(...a);addLog(a.join(' '),'w');};
</script>

<!-- Canvas Builder (Ditaruh di atas agar loadLogoAndRender terdefinisi sebelum dipanggil) -->
<script>
let logoImg = null;
// Cek apakah No. Label sudah ada
const hasNoLabel = '{{ $data['no_label'] ?? '' }}' !== '';

// Jika No. Label sudah ada, jangan tampilkan modal
if (hasNoLabel) {
    console.log('✅ No. Label sudah ada: {{ $data['no_label'] }}');
    // Tidak perlu menampilkan modal
} else {
    console.log('⚠️ No. Label belum ada, akan tampilkan modal setelah print');
}
function loadImage(url){
    return new Promise((res,rej)=>{
        const img=new Image(); img.crossOrigin='anonymous';
        img.onload=()=>res(img);
        img.onerror=()=>{ console.warn('Logo gagal dimuat, pakai teks'); res(null); };
        img.src=url;
    });
}

async function loadLogoAndRender(){
    logoImg = await loadImage(LOGO_URL);
    renderPreview();
}

function getIdentifier(d) {
    const select = document.getElementById('identifierType');
    const mode = select ? select.value : 'noseri'; // 🔥 default No Seri
    
    const noSeri   = (d.NoSeri   && d.NoSeri.trim())   ? d.NoSeri.trim()   : '';
    const kodeAlat = (d.kodeAlat && d.kodeAlat.trim()) ? d.kodeAlat.trim() : '';
    const type     = (d.type     && d.type.trim())     ? d.type.trim()     : '';
    
    switch (mode) {
        case 'kodealat': return kodeAlat || '—';
        case 'type':     return type     || '—';
        case 'noseri':
        default:         return noSeri   || '—';
    }
}

function cText(ctx,t,cx,y){ ctx.fillText(t,cx-ctx.measureText(t).width/2,y); }
    function drawQR(ctx,data,x,y,size){
    const qr=qrcode(0,'M'); qr.addData(String(data||'0')); qr.make();
    const m=qr.getModuleCount(), cell=Math.floor(size/m), off=Math.floor((size-cell*m)/2);
    ctx.fillStyle='#000';
    for(let r=0;r<m;r++) for(let c=0;c<m;c++)
        if(qr.isDark(r,c)) ctx.fillRect(x+off+c*cell, y+off+r*cell, cell, cell);
}

/**
 * Menggambar teks dengan auto-wrap jika melebihi maxWidth.
 * Setiap baris akan selalu di-center secara horizontal.
 * Mengembalikan total tinggi yang digunakan.
 */
function drawWrappedText(ctx, text, cx, y, maxWidth, lineHeight) {
    // Cek apakah teks muat dalam satu baris
    if (ctx.measureText(text).width <= maxWidth) {
        // Muat dalam satu baris -> langsung center
        cText(ctx, text, cx, y);
        return lineHeight;
    }

    // Tidak muat -> pecah per kata
    const words = text.split(' ');
    let line = '';
    let lines = [];

    for (let i = 0; i < words.length; i++) {
        const testLine = line + (line ? ' ' : '') + words[i];
        if (ctx.measureText(testLine).width > maxWidth && line !== '') {
            lines.push(line);
            line = words[i];
        } else {
            line = testLine;
        }
    }
    if (line) lines.push(line);

    // Jika masih terlalu panjang (1 kata sangat panjang), paksa pecah per karakter
    if (lines.length === 1 && ctx.measureText(lines[0]).width > maxWidth) {
        lines = [];
        let part = '';
        for (let ch of text) {
            if (ctx.measureText(part + ch).width > maxWidth) {
                lines.push(part);
                part = ch;
            } else {
                part += ch;
            }
        }
        if (part) lines.push(part);
    }

    // 🔥 Gambar setiap baris dengan perhitungan center yang benar
    lines.forEach((l, idx) => {
        cText(ctx, l, cx, y + idx * lineHeight); // <-- cText otomatis hitung center
    });

    return lines.length * lineHeight;
}

// Gambar logo (atau fallback teks) di posisi (x,y) dengan lebar maxW dan tinggi maxH
function drawLogo(ctx,img,x,y,maxW,maxH){
    if(img){
        const scale = Math.min(maxW/img.naturalWidth, maxH/img.naturalHeight);
        const w = img.naturalWidth * scale;
        const h = img.naturalHeight * scale;
        const ox = x + (maxW - w) / 2;
        
        // 🔹 PERBAIKI: Filter lebih lembut untuk thermal printer
        // Gunakan threshold yang lebih baik agar logo tidak terlalu tebal
        ctx.filter = 'grayscale(100%) brightness(150%) contrast(120%)';
        ctx.drawImage(img, ox, y, w, h);
        ctx.filter = 'none';
        
        return h;
    } else {
        ctx.fillStyle='#000';
        ctx.font='12px Arial'; cText(ctx,'PAS',x+maxW/2,y+12);
        ctx.font='7px Arial';  cText(ctx,'CALIBRATION',x+maxW/2,y+22);
        return 26;
    }
}

// Fungsi baru untuk konversi ke 1-bit dengan threshold adaptif
function convertTo1Bit(imageData, threshold = 180) {
    const data = imageData.data;
    
    // Hitung histogram untuk threshold adaptif
    let histogram = new Array(256).fill(0);
    for (let i = 0; i < data.length; i += 4) {
        const avg = Math.round((data[i] + data[i+1] + data[i+2]) / 3);
        histogram[avg]++;
    }
    
    // Cari threshold optimal (metode Otsu sederhana)
    let total = data.length / 4;
    let sum = 0;
    for (let i = 0; i < 256; i++) sum += i * histogram[i];
    
    let sumB = 0;
    let wB = 0;
    let wF = 0;
    let maxVariance = 0;
    let threshold_otsu = threshold;
    
    for (let i = 0; i < 256; i++) {
        wB += histogram[i];
        if (wB === 0) continue;
        
        wF = total - wB;
        if (wF === 0) break;
        
        sumB += i * histogram[i];
        let mB = sumB / wB;
        let mF = (sum - sumB) / wF;
        
        let variance = wB * wF * Math.pow(mB - mF, 2);
        if (variance > maxVariance) {
            maxVariance = variance;
            threshold_otsu = i;
        }
    }
    
    // Gunakan threshold yang lebih rendah untuk area logo
    const finalThreshold = Math.min(threshold_otsu, 200);
    
    for (let i = 0; i < data.length; i += 4) {
        const r = data[i];
        const g = data[i+1];
        const b = data[i+2];
        
        // Weighted luminance (lebih sensitif ke hijau)
        const luminance = 0.299 * r + 0.587 * g + 0.114 * b;
        
        // Threshold dengan sedikit dithering untuk gradasi halus
        const val = luminance > finalThreshold ? 255 : 0;
        data[i] = val;
        data[i+1] = val;
        data[i+2] = val;
    }
}

function build30x20(logo, d){
    // PORTRAIT: 160px (W) x 240px (H) ~ 20mm x 30mm
    const W = 160, H = 240, cx = W / 2;
    const cv = document.createElement('canvas'); 
    cv.width = W; 
    cv.height = H;
    const ctx = cv.getContext('2d');
    
    // Background putih
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, W, H);
    
    // ══════════════════════════════════════
    // Siapkan teks dulu
    // ══════════════════════════════════════
   const identifier = getIdentifier(d);
   
    let tglK = d.tanggalKalibrasi || '—';
    if (tglK && tglK.match(/^\d{4}-\d{2}-\d{2}$/)) {
        const [year, month, day] = tglK.split('-');
        tglK = `${day}-${month}-${year}`;
    }
    
    // ══════════════════════════════════════
    // LOGO (max tinggi 38px)
    // ══════════════════════════════════════
    let y = 18;
    ctx.save();
    if (logo) {
        const maxLogoH = 38;
        const maxLogoW = W - 20;
        const scale = Math.min(maxLogoW / logo.naturalWidth, maxLogoH / logo.naturalHeight);
        const w = logo.naturalWidth * scale;
        const h = logo.naturalHeight * scale;
        const ox = (W - w) / 2;
        
        ctx.filter = 'grayscale(100%) brightness(130%) contrast(110%)';
        ctx.drawImage(logo, ox, y, w, h);
        ctx.filter = 'none';
        y += h + 6;
    } else {
        ctx.fillStyle = '#000';
        ctx.textAlign = 'left';
        ctx.font = '14px Arial';
        cText(ctx, 'PAS', cx, y + 12);
        ctx.font = '8px Arial';
        cText(ctx, 'CALIBRATION', cx, y + 24);
        y += 28;
    }
    ctx.restore();
    
    // ── LK-150-IDN ──
    ctx.font = '16px Arial';
    ctx.fillStyle = '#000';
    ctx.textAlign = 'left';
    cText(ctx, 'LK-150-IDN', cx, y + 12);
    y += 20;
    
    // ── QR CODE (KECIL — 94px seperti semula) ──
    const qrS = 94;
    const qrX = Math.floor((W - qrS) / 2);
    ctx.fillStyle = '#fff';
    ctx.fillRect(qrX - 2, y - 2, qrS + 4, qrS + 4);
    
    const qrContent = d.qr_code_url || ('https://pascalibration.com/' + (d.certificate_id || ''));
    drawQR(ctx, qrContent, qrX, y, qrS);
    y += qrS + 6;
    
    // ── No Seri (auto-shrink terbatas + wrap multi-baris) ──
    let idFontSize = 14;
    const MIN_FONT = 11;
    ctx.font = `${idFontSize}px Arial`;
    while (ctx.measureText(identifier).width > (W - 12) && idFontSize > MIN_FONT) {
        idFontSize -= 1;
        ctx.font = `${idFontSize}px Arial`;
    }
    ctx.fillStyle = '#000';
    ctx.textAlign = 'left';
    
    const idLineH = idFontSize + 3;
    const idH = drawWrappedText(ctx, identifier, cx, y + idFontSize, W - 12, idLineH);
    y += idH + 6;
    
    // ── Tanggal Kalibrasi ──
    ctx.font = '14px Arial';
    ctx.fillStyle = '#000';
    ctx.textAlign = 'left';
    cText(ctx, tglK, cx, y + 12);
    
    // Konversi ke 1-bit
    const imageData = ctx.getImageData(0, 0, W, H);
    convertTo1Bit(imageData, 180);
    ctx.putImageData(imageData, 0, 0);
    
    return cv;
}
function build50x30(logo, d){
    // PORTRAIT: 240px (W) x 400px (H) ~ 30mm x 50mm
    const W = 240, H = 400, cx = W / 2;
    const cv = document.createElement('canvas'); 
    cv.width = W; 
    cv.height = H;
    const ctx = cv.getContext('2d');
    
    // Background putih penuh
    ctx.fillStyle = '#fff'; 
    ctx.fillRect(0, 0, W, H);

    // ══════════════════════════════════════
    // Siapkan semua teks dulu
    // ══════════════════════════════════════
  const identifier = getIdentifier(d);
    
    let tglK = d.tanggalKalibrasi || '—';
    if (tglK && tglK.match(/^\d{4}-\d{2}-\d{2}$/)) {
        const [year, month, day] = tglK.split('-');
        tglK = `${day}-${month}-${year}`;
    }
    
    let nextDate = d.nextTanggalKalibrasi 
        || (typeof currentNextDate !== 'undefined' ? currentNextDate : null) 
        || '—';
    if (nextDate.match(/^\d{4}-\d{2}-\d{2}$/)) {
        const [year, month, day] = nextDate.split('-');
        nextDate = `${day}-${month}-${year}`;
    }

    // ══════════════════════════════════════
    // 1. LOGO (max tinggi 70px)
    // ══════════════════════════════════════
    let y = 22;
    ctx.save();
    if (logo) {
        const maxLogoH = 70;
        const maxLogoW = W - 30;
        const scale = Math.min(maxLogoW / logo.naturalWidth, maxLogoH / logo.naturalHeight);
        const w = logo.naturalWidth * scale;
        const h = logo.naturalHeight * scale;
        const ox = (W - w) / 2;
        
        ctx.filter = 'grayscale(100%) brightness(130%) contrast(110%)';
        ctx.drawImage(logo, ox, y, w, h);
        ctx.filter = 'none';
        y += h + 14;
    } else {
        ctx.fillStyle = '#000';
        ctx.textAlign = 'left';
        ctx.font = '24px Arial'; 
        cText(ctx, 'PAS', cx, y + 24);
        ctx.font = '14px Arial'; 
        cText(ctx, 'CALIBRATION', cx, y + 42);
        y += 50 + 14;
    }
    ctx.restore();

    // ══════════════════════════════════════
    // 2. LK-150-IDN (font 24px)
    // ══════════════════════════════════════
    ctx.font = '24px Arial'; 
    ctx.fillStyle = '#000';
    ctx.textAlign = 'left';
    cText(ctx, 'LK-150-IDN', cx, y + 18);
    y += 18 + 16;

    // ══════════════════════════════════════
    // 3. QR CODE (ukuran 150px — lebih besar)
    // ══════════════════════════════════════
    const qrS = 150;
    const qrX = (W - qrS) / 2;
    ctx.fillStyle = '#fff'; 
    ctx.fillRect(qrX - 4, y - 4, qrS + 8, qrS + 8);
    
    const qrContent = d.qr_code_url || ('https://pascalibration.com/' + (d.certificate_id || ''));
    drawQR(ctx, qrContent, qrX, y, qrS);
    y += qrS + 18;

    // ══════════════════════════════════════
    // 4. NO SERI (auto-shrink terbatas + wrap multi-baris)
    // ══════════════════════════════════════
    let idFontSize = 20;
    const MIN_FONT = 14; // jangan lebih kecil dari 14px
    ctx.font = `${idFontSize}px Arial`;
    while (ctx.measureText(identifier).width > (W - 20) && idFontSize > MIN_FONT) {
        idFontSize -= 1;
        ctx.font = `${idFontSize}px Arial`;
    }
    ctx.fillStyle = '#000';
    ctx.textAlign = 'left';
    
    const idLineH = idFontSize + 4;
    const idH = drawWrappedText(ctx, identifier, cx, y + idFontSize, W - 20, idLineH);
    y += idH + 10;

    // ══════════════════════════════════════
    // 5. TANGGAL KALIBRASI (font 20px)
    // ══════════════════════════════════════
    ctx.font = '20px Arial'; 
    ctx.fillStyle = '#000';
    ctx.textAlign = 'left';
    cText(ctx, tglK, cx, y + 16);
    y += 16 + 10;

    // ══════════════════════════════════════
    // 6. NEXT KALIBRASI (font 20px)
    // ══════════════════════════════════════
    ctx.font = '20px Arial'; 
    ctx.fillStyle = '#000';
    ctx.textAlign = 'left';
    cText(ctx, nextDate, cx, y + 16);

    // ══════════════════════════════════════
    // Konversi ke 1-bit
    // ══════════════════════════════════════
    const imageData = ctx.getImageData(0, 0, W, H);
    if (typeof convertTo1Bit === 'function') {
        convertTo1Bit(imageData, 180);
    }
    ctx.putImageData(imageData, 0, 0);

    return cv;
}

function build12x30(logo, d) {
    const W = 380, H = 152;
    const cv = document.createElement('canvas');
    cv.width = W;
    cv.height = H;
    const ctx = cv.getContext('2d');
    
    ctx.fillStyle = '#fff';
    ctx.fillRect(0, 0, W, H);
    
    const identifier = getIdentifier(d);
    
    let tglK = d.tanggalKalibrasi || '—';
    if (tglK && tglK.match(/^\d{2}-\d{2}-\d{4}$/)) {
        const [day, month, year] = tglK.split('-');
        tglK = `${day}-${month}-${year}`;
    }
    
    let nextDate = d.nextTanggalKalibrasi || currentNextDate || '—';
    if (nextDate && nextDate.match(/^\d{2}-\d{2}-\d{4}$/)) {
        const [day, month, year] = nextDate.split('-');
        nextDate = `${day}-${month}-${year}`;
    }
    
    // 1. QR CODE (KIRI) - rapatkan margin
    const qrS = 128;
    const qrX = 6;
    const qrY = Math.floor((H - qrS) / 2);
    
    ctx.fillStyle = '#fff';
    ctx.fillRect(qrX - 1, qrY - 1, qrS + 2, qrS + 2);
    
    const qrContent = d.qr_code_url || ('https://pascalibration.com/' + (d.certificate_id || ''));
    drawQR(ctx, qrContent, qrX, qrY, qrS);
    
    let logoX = qrX + qrS + 6;
    
    // 2. LOGO PAS (TENGAH) - rapatkan dengan QR
    if (logo) {
        const maxLogoH = 130;
        const maxLogoW = 70;
        const scale = Math.min(maxLogoW / logo.naturalWidth, maxLogoH / logo.naturalHeight);
        const w = logo.naturalWidth * scale;
        const h = logo.naturalHeight * scale;
        
        ctx.save();
        ctx.translate(logoX + w / 2, H / 2);
        ctx.rotate(Math.PI * 1.5);
        
        ctx.filter = 'grayscale(100%) brightness(130%) contrast(110%)';
        ctx.drawImage(logo, -w / 2, -h / 2, w, h);
        ctx.filter = 'none';
        ctx.restore();
        
        logoX += w + 6;
    } else {
        ctx.fillStyle = '#000';
        ctx.font = 'bold 20px Arial';
        ctx.textAlign = 'left';
        ctx.fillText('PAS', logoX, H/2 - 10);
        ctx.font = '12px Arial';
        ctx.fillText('CAL', logoX, H/2 + 12);
        logoX += 45;
    }
    
    // 3. TEXT 3 BARIS (KANAN) - rapatkan dengan logo
    const textX = logoX + 4;
    const lineHeight = 25;
    let textY = (H - (3 * lineHeight)) / 2 + lineHeight - 5;
    
    ctx.fillStyle = '#000';
    ctx.textAlign = 'left';
    
    ctx.font = 'bold 20px Arial';
    ctx.fillText(identifier, textX, textY);
    textY += lineHeight + 4;
    
    ctx.font = '18px Arial';
    ctx.fillText(tglK, textX, textY);
    textY += lineHeight + 4;
    
    ctx.font = '18px Arial';
    ctx.fillText(nextDate, textX, textY);
    
    const imageData = ctx.getImageData(0, 0, W, H);
    convertTo1Bit(imageData, 180);
    ctx.putImageData(imageData, 0, 0);
    
    return cv;
}

// Tambahkan fungsi dithering untuk hasil lebih halus (opsional)
function applyFloydSteinberg(imageData) {
    const data = imageData.data;
    const width = imageData.width;
    const height = imageData.height;
    
    for (let y = 0; y < height; y++) {
        for (let x = 0; x < width; x++) {
            const i = (y * width + x) * 4;
            const oldR = data[i];
            const oldG = data[i+1];
            const oldB = data[i+2];
            const oldGray = 0.299 * oldR + 0.587 * oldG + 0.114 * oldB;
            
            const newGray = oldGray > 128 ? 255 : 0;
            data[i] = data[i+1] = data[i+2] = newGray;
            
            const error = oldGray - newGray;
            
            // Sebar error ke pixel tetangga
            if (x + 1 < width) {
                const j = (y * width + (x + 1)) * 4;
                data[j] += error * 7/16;
                data[j+1] += error * 7/16;
                data[j+2] += error * 7/16;
            }
            if (y + 1 < height) {
                if (x > 0) {
                    const j = ((y + 1) * width + (x - 1)) * 4;
                    data[j] += error * 3/16;
                    data[j+1] += error * 3/16;
                    data[j+2] += error * 3/16;
                }
                const j = ((y + 1) * width + x) * 4;
                data[j] += error * 5/16;
                data[j+1] += error * 5/16;
                data[j+2] += error * 5/16;
                if (x + 1 < width) {
                    const j = ((y + 1) * width + (x + 1)) * 4;
                    data[j] += error * 1/16;
                    data[j+1] += error * 1/16;
                    data[j+2] += error * 1/16;
                }
            }
        }
    }
}

function renderPreview(){
    const size = document.getElementById('labelSize').value;
    if(!window.build30x20) return;
    
    let src;
    if (size === '30x20') {
        src = build30x20(logoImg, CALIB);
    } else if (size === '12x30') {
        src = build12x30(logoImg, CALIB);
    } else {
        src = build50x30(logoImg, CALIB);
    }
    
    const scale = Math.min(1, 280 / src.height);
    const dst = document.getElementById('previewCanvas');
    if (dst) {
        dst.width = Math.round(src.width * scale);
        dst.height = Math.round(src.height * scale);
        dst.getContext('2d').drawImage(src, 0, 0, dst.width, dst.height);
    }
}

function updatePrinterName(){
    const printer = document.getElementById('printerType')?.value || 'B1';
    const printerName = document.getElementById('printerName');
    if (printerName) {
        printerName.textContent = `Printer NIIMBOT ${printer}`;
    }
}

window.addEventListener('DOMContentLoaded', ()=>{ if(logoImg) renderPreview(); });
</script>

<!-- NIIMBOT Client & Modal Handler -->
<script>
let client=null,_lib=null;

// Fungsi untuk menampilkan modal no label
function showNoLabelModal() {
    const modalElement = document.getElementById('noLabelModal');
    if (!modalElement) {
        console.error('Modal element tidak ditemukan!');
        return;
    }
    const hasNoLabel = '{{ $data['no_label'] ?? '' }}' !== '';
    const currentNoLabel = '{{ $data['no_label'] ?? '' }}';
    try {
        const modal = new bootstrap.Modal(modalElement);
        const input = document.getElementById('no_label_input');
        const error = document.getElementById('noLabelError');
        
        if (input) {
            input.value = '';
            input.classList.remove('is-invalid');
        }
        if (error) error.style.display = 'none';
        
        // Set form action
        const form = document.getElementById('noLabelForm');
        if (form) {
            form.action = '/calibrations/' + CALIBRATION_ID + '/update-label';
        }
        
        modal.show();
        setTimeout(() => input?.focus(), 500);
        console.log('📌 Modal ditampilkan');
        
    } catch (e) {
        console.error('Error menampilkan modal:', e);
        alert('Terjadi kesalahan saat menampilkan modal.');
    }
}

// Fungsi handle selesai (tombol Selesai)
function handleSelesai() {
    if (SHOW_MODAL) {
        showNoLabelModal();
    } else {
        window.location.href = '{{ route('calibrations.index') }}';
    }
}

(async()=>{
    const w=()=>new Promise(r=>{
        if(window.niimbluelib){r(window.niimbluelib);return;}
        const t=setInterval(()=>{if(window.niimbluelib){clearInterval(t);r(window.niimbluelib);}},100);
        setTimeout(()=>{clearInterval(t);r(null);},8000);
    });
    _lib=await w();
    addLog(_lib?'✅ niimbluelib siap':'❌ niimbluelib gagal',_lib?'s':'e');
    await loadLogoAndRender();
    
    // Cek apakah perlu menampilkan modal setelah print
    if (SHOW_MODAL) {
        console.log('📌 Mode: Cetak label kemudian tampilkan modal');
    }
})();

function setUI(on,name=''){
    document.getElementById('statusBadge').className='badge-status '+(on?'on':'off');
    document.getElementById('pulseDot').className='pulse '+(on?'g':'r');
    document.getElementById('statusText').textContent=on?(name||'Terhubung'):'Tidak Terhubung';
    document.getElementById('disconnectBtn').style.display=on?'inline-block':'none';
    document.getElementById('connectBtn').style.display=on?'none':'inline-block';
    const n1=document.getElementById('stepNum1');
    const s2=document.getElementById('step2');
    const n2=document.getElementById('stepNum2');
    if(on){
        n1.className='step-num done'; n1.textContent='✓';
        s2.style.opacity='1'; n2.className='step-num active';
    } else {
        n1.className='step-num active'; n1.textContent='1';
        s2.style.opacity='.5'; n2.className='step-num wait';
    }
}

async function doConnect(){
    if(!_lib){alert('Library belum siap');return;}
    if(client){addLog('⚠️ Sudah terhubung','w');return;}

    client=new _lib.NiimbotBluetoothClient();

    // Logging paket — sama dengan printer-test.html
    client.on('packetsent', e=>{
        try{ addLog(`TX ${_lib.RequestCommandId?.[e.packet.command]??e.packet.command} ${_lib.Utils.bufToHex(e.packet.toBytes())}`,'i'); }catch(_){}
    });
    client.on('packetreceived', e=>{
        try{ addLog(`RX ${_lib.ResponseCommandId?.[e.packet.command]??e.packet.command} ${_lib.Utils.bufToHex(e.packet.toBytes())}`,'i'); }catch(_){}
    });
    client.on('printprogress', e=>{
        addLog(`🖨 ${e.page}/${e.pagesTotal} | ${e.pagePrintProgress}%`,'i');
        document.getElementById('printStatus').innerHTML=
            `<span class="badge bg-primary">${e.pagePrintProgress}%</span>`;
    });
    client.on('connect', async ()=>{
        const n=client.deviceName||'NIIMBOT';
        addLog('✅ Terhubung: '+n,'s');
        setUI(true,n);
        await autoPrint();
    });
    client.on('disconnect', ()=>{
        addLog('🔌 Terputus','w'); setUI(false); client=null;
    });

    try{
        addLog('📡 Membuka dialog Bluetooth...','i');
        await client.connect();
    }catch(e){
        addLog('❌ '+e.message,'e'); client=null;
    }
}

function doDisconnect(){client?.disconnect();client=null;setUI(false);}

// ── Core print — SAMA dengan printer-test.html ──
async function corePrint(canvas, qty){
    if(!client) throw new Error('Printer belum terhubung!');

    const selectedPrinter = document.getElementById('printerType')?.value || 'B1';
    addLog(`📐 Encoding ${canvas.width}x${canvas.height}px qty=${qty} (Printer: ${selectedPrinter})`,'i');
    
    const encoded = _lib.ImageEncoder.encodeCanvas(canvas, 'left');

    let taskType;
    if (selectedPrinter === 'D11_H') {
        taskType = 'D110M_V4';
    } else {
        try{ taskType = client.getPrintTaskType?.()??'B1'; }catch(_){ taskType='B1'; }
    }
    addLog('🔧 Task type: '+taskType,'i');

    const printTask = client.abstraction.newPrintTask(taskType, {
        totalPages: qty,
        statusPollIntervalMs: 200,
        statusTimeoutMs: 20000
    });

    addLog('🔄 printInit...','i');
    await printTask.printInit();
    addLog('🖨️ printPage...','i');
    await printTask.printPage(encoded, qty);
    addLog('⏳ waitForFinished...','i');
    await printTask.waitForFinished();
    addLog('🏁 printEnd...','i');
    await printTask.printEnd();
    addLog('✅ Cetak selesai!','s');
    
    // Jika ini adalah cetak dari alur yang perlu modal, tampilkan modal setelah sukses
    if (SHOW_MODAL) {
        addLog('📋 Menampilkan form input No. Label...','i');
        setTimeout(showNoLabelModal, 1000);
    }
}

async function autoPrint(){
    const size=document.getElementById('labelSize').value;
    let cv;
    if (size === '30x20') {
        cv = build30x20(logoImg, CALIB);
    } else if (size === '12x30') {
        cv = build12x30(logoImg, CALIB);
    } else {
        cv = build50x30(logoImg, CALIB);
    }
    const ps=document.getElementById('printStatus');
    ps.innerHTML='<span class="badge bg-warning text-dark"><i class="fas fa-spinner fa-spin me-1"></i>Mencetak...</span>';
    addLog(`🖨 Auto-cetak ${size}...`,'i');
    try{
        await corePrint(cv,1);
        ps.innerHTML='<span class="badge bg-success">✓ Selesai</span>';
        document.getElementById('stepNum2').textContent='✓';
        document.getElementById('stepNum2').className='step-num done';
        
        // Simpan next date ke database
        await saveNextDateToDatabase(currentNextDate);
        
        // 🔥 TAMPILKAN MODAL INPUT NO LABEL
        addLog('📋 Menampilkan form input No. Label...', 'i');
        showNoLabelModal();
        
    }catch(e){
        addLog('❌ '+e.message,'e');
        ps.innerHTML='<span class="badge bg-danger">❌ Gagal: '+e.message+'</span>';
    }
}

// Fungsi untuk simpan next date
// Fungsi untuk simpan next date ke database
async function saveNextDateToDatabase(nextDate) {
    try {
        // Konversi dari DD-MM-YYYY ke YYYY-MM-DD untuk database
        let dateToSave = nextDate;
        if (nextDate && nextDate.match(/^\d{2}-\d{2}-\d{4}$/)) {
            const [day, month, year] = nextDate.split('-');
            dateToSave = `${year}-${month}-${day}`;
        }
        
        console.log('Saving next date:', dateToSave);
        
        const response = await fetch('/calibrations/' + CALIBRATION_ID + '/update-next-date', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value || '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ next_date: dateToSave })
        });
        
        if (!response.ok) {
            const errorText = await response.text();
            console.error('Response error:', errorText);
            throw new Error('HTTP error ' + response.status);
        }
        
        const result = await response.json();
        if (result.success) {
            addLog('✅ Next date tersimpan: ' + nextDate, 's');
        } else {
            addLog('⚠️ Gagal simpan next date: ' + (result.error || result.message || 'Unknown error'), 'w');
        }
    } catch (e) {
        console.error('Error saving next date:', e);
        addLog('❌ Error simpan next date: ' + e.message, 'e');
    }
}

// Event setelah print selesai (untuk browser yang support)
window.onafterprint = function() {
    if (SHOW_MODAL) {
        console.log('📌 Print dialog ditutup, tampilkan modal');
        setTimeout(showNoLabelModal, 500);
    }
};

// Handle sebelum halaman ditutup
window.onbeforeunload = function() {
    if (SHOW_MODAL && !document.getElementById('no_label_input')?.value) {
        return 'Anda belum mengisi No. Label. Yakin ingin meninggalkan halaman?';
    }
};
</script>

<script>
// ==========================================
// HANDLER SUBMIT NO LABEL
// ==========================================

// Definisikan currentNextDate di awal
let currentNextDate = '{{ $data['nextTanggalKalibrasi'] ?? date('d-m-Y', strtotime('+1 year')) }}';

// Fungsi update next date
function updateNextDate(value) {
    currentNextDate = value;
    if (typeof CALIB !== 'undefined') {
        CALIB.nextTanggalKalibrasi = value;
    }
    if (typeof renderPreview === 'function') {
        renderPreview();
    }
    console.log('Next date diupdate ke:', value);
    saveNextDateToDatabase(value);
}

// Inisialisasi datepicker setelah DOM ready
$(document).ready(function() {
    console.log('Initializing datepicker...');
    
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        language: 'id',
        orientation: 'bottom'
    }).on('changeDate', function(e) {
        console.log('Date selected:', e.format('dd-mm-yyyy'));
        updateNextDate(e.format('dd-mm-yyyy'));
    });
    
    const initialDate = $('#nextDateInput').val();
    if (initialDate) {
        $('.datepicker').datepicker('setDate', initialDate);
    }
});

// ==========================================
// HANDLER SUBMIT FORM NO LABEL
// ==========================================

// Validasi form sebelum submit (tanpa AJAX)
document.getElementById('noLabelForm')?.addEventListener('submit', function(e) {
    const noLabelInput = document.getElementById('no_label_input');
    const noLabel = noLabelInput?.value.trim();
    
    if (!noLabel) {
        e.preventDefault();
        noLabelInput?.classList.add('is-invalid');
        noLabelInput?.focus();
        alert('No. Label wajib diisi!');
        return false;
    }
    
    // Jika sudah diisi, form akan submit normal
    console.log('Submitting form with No. Label:', noLabel);
    return true;
});

// Hapus class invalid saat user mengetik
document.getElementById('no_label_input')?.addEventListener('input', function() {
    if (this.value.trim()) {
        this.classList.remove('is-invalid');
    }
});

// Mencegah modal ditutup jika user klik backdrop atau tombol close (opsional)
document.getElementById('noLabelModal')?.addEventListener('hide.bs.modal', function (e) {
    const noLabel = document.getElementById('no_label_input')?.value.trim();
    // Jika belum diisi dan belum disimpan, tahan modal
    if (!noLabel && !window._noLabelSaved) {
        e.preventDefault();
        const errorDiv = document.getElementById('noLabelError');
        if (errorDiv) {
            errorDiv.style.display = 'block';
            errorDiv.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>Harap isi No. Label terlebih dahulu!';
        }
    }
});

// Tandai sudah disimpan saat submit berhasil
// Di dalam fetch成功后, sebelum redirect, set window._noLabelSaved = true
// Reset error saat input berubah
document.getElementById('no_label_input')?.addEventListener('input', function() {
    const errorDiv = document.getElementById('noLabelError');
    if (errorDiv) errorDiv.style.display = 'none';
    this.classList.remove('is-invalid');
});
</script>
<script>
// Perbaikan untuk menutup modal dengan JavaScript jika diperlukan
document.addEventListener('DOMContentLoaded', function() {
    // Cari semua tombol yang seharusnya menutup modal
    const closeButtons = document.querySelectorAll('#noLabelModal .btn-close, #noLabelModal .btn-secondary');
    
    closeButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const modalElement = document.getElementById('noLabelModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            
            if (modalInstance) {
                modalInstance.hide();
            } else {
                // Fallback jika instance tidak ditemukan
                $(modalElement).modal('hide');
            }
            
            // Hapus backdrop yang mungkin tersisa
            setTimeout(function() {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(function(backdrop) {
                    backdrop.remove();
                });
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            }, 150);
        });
    });
});

// Fungsi showNoLabelModal yang diperbaiki
function showNoLabelModal() {
    const modalElement = document.getElementById('noLabelModal');
    if (!modalElement) {
        console.error('Modal element tidak ditemukan!');
        return;
    }
    
    // Reset error
    const errorDiv = document.getElementById('noLabelError');
    if (errorDiv) errorDiv.style.display = 'none';
    
    const input = document.getElementById('no_label_input');
    if (input) {
        input.classList.remove('is-invalid');
    }
    
    try {
        // Gunakan jQuery sebagai fallback
        if (typeof $ !== 'undefined' && $.fn.modal) {
            $(modalElement).modal('show');
        } else if (typeof bootstrap !== 'undefined') {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        } else {
            console.error('Bootstrap modal tidak tersedia');
            alert('Modal tidak bisa ditampilkan');
        }
        
        setTimeout(() => input?.focus(), 500);
        console.log('📌 Modal ditampilkan');
        
    } catch (e) {
        console.error('Error menampilkan modal:', e);
        alert('Terjadi kesalahan saat menampilkan modal.');
    }
}

// Handle form submit tanpa reload halaman (AJAX) agar modal bisa tertutup dengan baik
document.getElementById('noLabelForm')?.addEventListener('submit', function(e) {
    const noLabelInput = document.getElementById('no_label_input');
    const noLabel = noLabelInput?.value.trim();
    
    if (!noLabel) {
        e.preventDefault();
        const errorDiv = document.getElementById('noLabelError');
        if (errorDiv) {
            errorDiv.style.display = 'block';
            errorDiv.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>No. Label wajib diisi!';
        }
        noLabelInput?.classList.add('is-invalid');
        noLabelInput?.focus();
        return false;
    }
    
    // Gunakan AJAX submit agar modal bisa tertutup
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value || '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tutup modal
            const modalElement = document.getElementById('noLabelModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            } else if (typeof $ !== 'undefined' && $.fn.modal) {
                $(modalElement).modal('hide');
            }
            
            // Hapus backdrop
            setTimeout(() => {
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            }, 150);
            
            // Tampilkan pesan sukses
            if (data.message) {
                // Cari atau buat alert container
                let alertContainer = document.getElementById('alertContainer');
                if (!alertContainer) {
                    alertContainer = document.createElement('div');
                    alertContainer.id = 'alertContainer';
                    alertContainer.className = 'container mt-3';
                    document.querySelector('.container').prepend(alertContainer);
                }
                
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success alert-dismissible fade show';
                alertDiv.innerHTML = `
                    <i class="fas fa-check-circle me-2"></i>${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                alertContainer.innerHTML = '';
                alertContainer.appendChild(alertDiv);
                
                // Update chip no label
                const noLabelChip = document.querySelector('.chip[onclick="showNoLabelModal()"]');
                if (noLabelChip) {
                    noLabelChip.innerHTML = `
                        <strong>No. Label</strong>
                        <i class="fas fa-tag me-1 text-success"></i>
                        ${noLabel}
                        <i class="fas fa-pen ms-1 text-muted" style="font-size: 10px;"></i>
                    `;
                }
            }
            
            // Redirect jika diperlukan
            if (data.redirect) {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            } else if (data.reload) {
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        } else {
            alert(data.message || 'Terjadi kesalahan. Silakan coba lagi.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    });
    
    return false;
});
</script>

</body>
</html>