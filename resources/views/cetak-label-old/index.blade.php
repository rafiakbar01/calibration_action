@extends('layouts.app')

@section('title', 'Cetak Label Old')

@push('styles')
<style>
    /* Netralisir padding bawaan AdminLTE */
    .content-wrapper .content {
        padding: 0 !important;
    }
    .content-wrapper .content > .container-fluid {
        padding: 0 !important;
        margin: 0 !important;
    }
    .cl-wrap {
        padding: 15px;
    }
    @media (max-width: 767px) {
        .cl-wrap {
            padding: 10px;
        }
    }
</style>
@endpush

@section('content')
<style>
    /* ========================================= */
    /* GLOBAL                                    */
    /* ========================================= */
    .cl-wrap { font-family: 'Inter', Arial, sans-serif; }

    .page-hero {
        background: linear-gradient(135deg, #1a237e 0%, #0d47a1 55%, #1565c0 100%);
        padding: 22px 24px; border-radius: 14px; margin-bottom: 18px;
        color: white; display: flex; align-items: center; justify-content: space-between;
        box-shadow: 0 6px 24px rgba(13,71,161,.25);
    }
    .page-hero h2 { font-size: 20px; font-weight: 800; margin: 0; letter-spacing: -.4px; }
    .page-hero p  { font-size: 13px; margin: 4px 0 0; opacity: .8; }
    .page-hero .hero-icon { font-size: 48px; opacity: .15; }

    /* Panel Card */
    .p-card {
        background: #fff; border-radius: 12px;
        box-shadow: 0 2px 14px rgba(0,0,0,.07); border: 1px solid #e8eaf6;
        overflow: hidden; margin-bottom: 14px;
    }
    .p-card-hd {
        padding: 13px 18px; background: linear-gradient(90deg,#f5f7ff,#eef0ff);
        border-bottom: 1px solid #e8eaf6; display: flex; align-items: center; gap: 9px;
    }
    .p-card-hd h5 { font-size: 13px; font-weight: 700; margin: 0; color: #1a237e; }
    .p-card-hd i  { color: #3f51b5; font-size: 14px; }
    .p-card-bd { padding: 16px 18px; }

    /* ========================================= */
    /* BLUETOOTH STEPS                           */
    /* ========================================= */
    .bt-steps { display: flex; flex-direction: column; gap: 9px; }
    .bt-step {
        display: flex; align-items: center; gap: 11px; padding: 11px 13px;
        border: 1.5px solid #e8eaf6; border-radius: 9px; background: #fafbff; transition: all .3s;
    }
    .bt-step.on { border-color: #3f51b5; background: #f0f2ff; }
    .step-num {
        width: 28px; height: 28px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 13px; flex-shrink: 0; transition: all .3s;
    }
    .sn-active { background: linear-gradient(135deg,#3f51b5,#1a237e); color:#fff; box-shadow:0 2px 8px rgba(63,81,181,.4); }
    .sn-wait   { background: #e0e0e0; color: #757575; }
    .sn-done   { background: linear-gradient(135deg,#43a047,#2e7d32); color: #fff; }
    .step-info strong { display:block; font-size:13px; color:#1a237e; font-weight:700; }
    .step-info small  { font-size:11px; color:#757575; }

    .badge-bt { padding:6px 12px; border-radius:20px; font-size:11px; font-weight:700; display:inline-flex; align-items:center; gap:6px; }
    .badge-bt.on  { background:#e8f5e9; color:#2e7d32; border:1.5px solid #a5d6a7; }
    .badge-bt.off { background:#ffebee; color:#c62828; border:1.5px solid #ef9a9a; }
    .pulse-dot { width:8px; height:8px; border-radius:50%; flex-shrink:0; }
    .pd-on  { background:#4caf50; animation:pulseOn 1.5s infinite; }
    .pd-off { background:#f44336; }
    @keyframes pulseOn { 0%,100%{box-shadow:0 0 0 0 rgba(76,175,80,.4);} 70%{box-shadow:0 0 0 7px rgba(76,175,80,0);} }

    .btn-bt-connect {
        background: linear-gradient(135deg,#1565c0,#1e88e5); color:#fff;
        border:none; border-radius:8px; padding:8px 16px; font-size:13px; font-weight:600;
        cursor:pointer; transition:all .25s; display:inline-flex; align-items:center; gap:6px;
        box-shadow:0 2px 10px rgba(21,101,192,.3); white-space:nowrap;
    }
    .btn-bt-connect:hover { transform:translateY(-1px); box-shadow:0 4px 14px rgba(21,101,192,.4); }
    .btn-bt-disc { background:#ffebee; color:#c62828; border:1.5px solid #ef9a9a; border-radius:8px; padding:7px 11px; font-size:12px; cursor:pointer; transition:all .2s; }
    .btn-bt-disc:hover { background:#ffcdd2; }

    /* ========================================= */
    /* PAPER SIZE                                */
    /* ========================================= */
    .paper-row { display:flex; gap:10px; flex-wrap:wrap; }
    .paper-opt { border:2px solid #e0e0e0; border-radius:9px; padding:9px 14px; cursor:pointer; transition:all .2s; display:flex; align-items:center; gap:8px; background:#fff; }
    .paper-opt:hover { border-color:#3f51b5; background:#f8f9ff; }
    .paper-opt.sel  { border-color:#1a237e; background:#eeefff; }
    .paper-opt span { font-size:12px; font-weight:600; color:#37474f; }

    /* ========================================= */
    /* FORMAT CARD SELECTOR                      */
    /* ========================================= */
    .fmt-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:9px; }
    .fmt-card {
        border:2px solid #e8eaf6; border-radius:10px; padding:12px 10px;
        cursor:pointer; transition:all .22s; display:flex; align-items:center; gap:9px;
        background:#fff; position:relative; min-width:0;
    }
    .fmt-card:hover { border-color:#3f51b5; background:#f8f9ff; transform:translateY(-2px); box-shadow:0 4px 14px rgba(63,81,181,.1); }
    .fmt-card.sel   { border-color:#1a237e; background:#eeefff; box-shadow:0 3px 12px rgba(26,35,126,.13); }
    .fmt-icon { width:36px; height:36px; border-radius:8px; background:linear-gradient(135deg,#e8eaf6,#c5cae9); display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; transition:all .22s; }
    .fmt-card.sel .fmt-icon { background:linear-gradient(135deg,#3f51b5,#1a237e); color:#fff; }
    .fmt-txt { min-width:0; }
    .fmt-txt strong { display:block; font-size:12px; color:#1a237e; font-weight:700; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .fmt-txt small  { font-size:10px; color:#9e9e9e; }
    .fmt-chk { position:absolute; top:7px; right:7px; width:16px; height:16px; border-radius:50%; background:#1a237e; color:#fff; font-size:8px; display:none; align-items:center; justify-content:center; }
    .fmt-card.sel .fmt-chk { display:flex; }

    /* ========================================= */
    /* INPUT FIELDS                              */
    /* ========================================= */
    .input-lbl  { font-size:12px; font-weight:600; color:#37474f; margin-bottom:4px; display:block; }
    .input-ctrl { border-radius:7px !important; border:1.5px solid #e0e0e0 !important; font-size:13px !important; padding:8px 11px !important; transition:border-color .2s; }
    .input-ctrl:focus { border-color:#3f51b5 !important; box-shadow:0 0 0 3px rgba(63,81,181,.1) !important; }

    /* ========================================= */
    /* FORMAT PANEL SWITCHING                    */
    /* ========================================= */
    .fmt-panel { display:none; animation:fsIn .28s ease; }
    .fmt-panel.active { display:block; }
    @keyframes fsIn { from{opacity:0;transform:translateY(6px);} to{opacity:1;transform:translateY(0);} }

    /* ========================================= */
    /* CETAK BUTTON                              */
    /* ========================================= */
    .btn-cetak {
        background:linear-gradient(135deg,#1a237e,#3f51b5); color:#fff;
        border:none; border-radius:9px; padding:12px 24px; font-size:14px; font-weight:700;
        cursor:pointer; transition:all .22s; width:100%;
        display:flex; align-items:center; justify-content:center; gap:8px;
        box-shadow:0 3px 12px rgba(26,35,126,.28);
    }
    .btn-cetak:hover  { transform:translateY(-2px); box-shadow:0 6px 18px rgba(26,35,126,.38); }
    .btn-cetak:active { transform:translateY(0); }

    /* ========================================= */
    /* PREVIEW PANEL                             */
    /* ========================================= */
    .preview-bg {
        background: repeating-conic-gradient(#efefef 0% 25%,#fff 0% 50%) 0 0 / 14px 14px;
        border-radius:10px; display:flex; align-items:center; justify-content:center;
        padding:18px; min-height:180px; overflow-x:auto;
    }

    /* ========================================= */
    /* TWO-COLUMN LAYOUT                         */
    /* ========================================= */
    .cl-grid {
        display: grid;
        grid-template-columns: 42% 1fr;
        gap: 16px;
        align-items: start;
    }

    /* ========================================= */
    /* LABEL VISUAL STYLES                       */
    /* ========================================= */
    .calibration-label-1, .calibration-label-2 {
        width:424px; min-width:424px; height:192px; border:2px solid #000;
        border-radius:20px; background:#fff; display:flex; overflow:hidden;
        box-shadow:0 4px 8px rgba(0,0,0,.1); margin:0 auto;
    }
    .calibration-label-3 {
        width:440px; min-width:440px; height:224px; border:3px solid #0040A0;
        border-radius:18px; background:#fff; display:flex; flex-direction:row;
        overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,.15); margin:0 auto;
    }
    .calibration-label-1 .left-section,
    .calibration-label-2 .left-section { width:70px; border-right:2px solid #000; display:flex; justify-content:center; align-items:center; padding:10px; }
    .calibration-label-3 .left-section { width:85px; border-right:3px solid #0040A0; display:flex; justify-content:center; align-items:center; padding:10px 6px; }
    .calibration-label-1 .left-section img,
    .calibration-label-2 .left-section img,
    .calibration-label-3 .left-section img { width:160px; height:50px; object-fit:contain; transform:rotate(-90deg); }
    .calibration-label-1 .right-section,
    .calibration-label-2 .right-section,
    .calibration-label-3 .right-section { flex:1; display:flex; flex-direction:column; min-width:0; }
    /* Format 1 */
    .calibration-label-1 .row-date { height:60px; border-bottom:2px solid #000; display:flex; justify-content:space-between; align-items:center; padding:0 10px; }
    .calibration-label-1 .date-group { display: flex; flex-direction: column; align-items: center; justify-content: center; }
    .calibration-label-1 .row-date .label-text { font-weight:bold; font-size:12px; white-space:nowrap; }
    .calibration-label-1 .row-date .date-val { font-weight:bold; font-size:18px; margin-top:2px; }
    .calibration-label-1 .kan-logo { height:52px; object-fit:contain; }
    .calibration-label-1 .row-serial { flex:1; padding:8px 10px; display:flex; flex-direction:column; }
    .calibration-label-1 .serial-title { font-weight:bold; font-size:12px; }
    .calibration-label-1 .serial-value { font-weight:bold; font-size:22px; text-align:center; flex:1; display:flex; align-items:center; justify-content:center; letter-spacing: 1px; }
    .calibration-label-1 .row-company { height:40px; border-top:2px solid #000; display:flex; align-items:center; justify-content:center; }
    .calibration-label-1 .row-company h3 { font-size:15px; font-weight:bold; letter-spacing:.5px; color:#000; margin:0; }
    /* Format 2 */
    .calibration-label-2 .row-date,
    .calibration-label-2 .row-next-cal { height:46px; border-bottom:2px solid #000; display:flex; justify-content:space-between; align-items:center; padding:0 10px; }
    .calibration-label-2 .row-next-cal { align-items: flex-start; padding-top: 5px; }
    .calibration-label-2 .date-group { display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; }
    .calibration-label-2 .row-date .date-group { width: auto; }
    .calibration-label-2 .row-next-cal .date-group { align-items: flex-start; }
    .calibration-label-2 .row-date .label-text,
    .calibration-label-2 .row-next-cal .label-text { font-weight:bold; font-size:11px; white-space:nowrap; }
    .calibration-label-2 .row-date .date-val,
    .calibration-label-2 .row-next-cal .date-val { font-weight:bold; font-size:15px; margin-top:2px; }
    .calibration-label-2 .kan-logo { height:42px; object-fit:contain; }
    .calibration-label-2 .row-serial { flex:1; padding:5px 10px; display:flex; flex-direction:column; border-bottom:2px solid #000; }
    .calibration-label-2 .serial-title { font-weight:bold; font-size:11px; }
    .calibration-label-2 .serial-value { font-weight:bold; font-size:18px; text-align:center; flex:1; display:flex; align-items:center; justify-content:center; letter-spacing: 0.5px; }
    .calibration-label-2 .row-company { height:35px; display:flex; align-items:center; justify-content:center; }
    .calibration-label-2 .row-company h3 { font-size:14px; font-weight:bold; letter-spacing:.5px; color:#000; margin:0; }
    /* Format 3 */
    .calibration-label-3 .label-row { border-bottom:2px solid #0040A0; padding:0 12px; display:flex; align-items:center; color:#000; }
    .calibration-label-3 .label-row:last-child { border-bottom:none; }
    .calibration-label-3 .row-calibrated { flex:1.4; justify-content:space-between; }

    /* ========================================= */
    /* 30x20 SPECIFIC LAYOUT (Ratio 1.5)         */
    /* ========================================= */
    .calibration-label-1.is-30x20, .calibration-label-2.is-30x20, .calibration-label-3.is-30x20 {
        width: 360px !important; min-width: 360px !important; height: 240px !important; margin: 0;
    }
    
    /* Format 1 - 30x20 */
    .calibration-label-1.is-30x20 .left-section,
    .calibration-label-2.is-30x20 .left-section { width: 65px; }
    .calibration-label-1.is-30x20 .row-date { height: 75px; }
    .calibration-label-1.is-30x20 .row-date .label-text { font-size: 14px; }
    .calibration-label-1.is-30x20 .row-date .date-val { font-size: 22px; }
    .calibration-label-1.is-30x20 .row-serial { padding: 12px 10px; }
    .calibration-label-1.is-30x20 .serial-title { font-size: 14px; }
    .calibration-label-1.is-30x20 .serial-value { font-size: 26px; }
    .calibration-label-1.is-30x20 .row-company { height: 50px; }
    .calibration-label-1.is-30x20 .row-company h3 { font-size: 16px; }
    .calibration-label-1.is-30x20 .kan-logo { height: 60px; }

    /* Format 2 - 30x20 */
    .calibration-label-2.is-30x20 .row-date,
    .calibration-label-2.is-30x20 .row-next-cal { height: 70px; }
    .calibration-label-2.is-30x20 .row-date .label-text,
    .calibration-label-2.is-30x20 .row-next-cal .label-text { font-size: 13px; }
    .calibration-label-2.is-30x20 .row-date .date-val,
    .calibration-label-2.is-30x20 .row-next-cal .date-val { font-size: 18px; margin-top: 4px; }
    .calibration-label-2.is-30x20 .serial-title { font-size: 13px; }
    .calibration-label-2.is-30x20 .serial-value { font-size: 22px; }
    .calibration-label-2.is-30x20 .row-company { height: 45px; }
    .calibration-label-2.is-30x20 .row-company h3 { font-size: 15px; }
    .calibration-label-2.is-30x20 .kan-logo { height: 55px; }

    /* Format 3 - 30x20 */
    .calibration-label-3.is-30x20 .left-section { width: 75px; }
    .calibration-label-3.is-30x20 .row-calibrated { flex: 1.2; }
    .calibration-label-3.is-30x20 .main-title { font-size: 26px; }
    .calibration-label-3.is-30x20 .sub-title { font-size: 14px; }
    .calibration-label-3.is-30x20 .row-date { padding: 10px 12px; }
    .calibration-label-3.is-30x20 .date-title { font-size: 12px; }
    .calibration-label-3.is-30x20 .date-format { font-size: 26px; }
    .calibration-label-3.is-30x20 .row-company { height: 50px; font-size: 16px; }
    .calibration-label-3.is-30x20 .kan-logo { height: 60px; }
    .calibration-label-3 .text-calibrated { display:flex; flex-direction:column; justify-content:center; }
    .calibration-label-3 .main-title { font-size:24px; font-weight:900; letter-spacing:.5px; line-height:1.1; }
    .calibration-label-3 .sub-title  { font-size:13px; font-weight:bold; margin-top:2px; }
    .calibration-label-3 .kan-logo   { height:50px; object-fit:contain; }
    .calibration-label-3 .row-date   { flex:1; display:flex; flex-direction:row; align-items:center; justify-content:center; position:relative; padding:0 12px; }
    .calibration-label-3 .date-title { position:absolute; top:5px; left:12px; font-weight:bold; font-size:11px; }
    .calibration-label-3 .date-format { font-size:24px; font-weight:bold; color:#333; }
    .calibration-label-3 .row-company { height:45px; justify-content:flex-start; font-weight:bold; font-size:15px; letter-spacing:.5px; }

    /* ========================================= */
    /* RESPONSIVE                                */
    /* ========================================= */
    @media (max-width: 900px) {
        .cl-grid { grid-template-columns: 1fr; }
        .cl-preview-col { order: -1; }
        .page-hero .hero-icon { display: none; }
        .page-hero h2 { font-size: 17px; }
        .page-hero { padding: 16px; }
        .fmt-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 500px) {
        .fmt-grid { grid-template-columns: 1fr 1fr 1fr; gap: 6px; }
        .fmt-icon { width: 28px; height: 28px; font-size: 13px; }
        .fmt-txt strong { font-size: 10px; }
        .paper-row { gap: 6px; }
        .paper-opt { padding: 7px 10px; }
        .btn-bt-connect { padding: 7px 12px; font-size: 12px; }
        .bt-step { flex-wrap: wrap; }
    }
</style>

{{-- Semua konten langsung di sini, TANPA wrapper content-wrapper/section/container-fluid --}}
{{-- karena sudah di-wrap oleh layouts/app.blade.php --}}
<div class="cl-wrap">

    <!-- Hero Banner -->
    <div class="page-hero mb-3">
        <div>
            <h2><i class="fas fa-tags mr-2"></i>Cetak Label Kalibrasi</h2>
            <p>Pilih format, hubungkan printer NIIMBOT B1 via Bluetooth, lalu cetak.</p>
        </div>
        <div class="hero-icon"><i class="fas fa-print"></i></div>
    </div>

    <!-- Two-column grid -->
    <div class="cl-grid">

        <!-- ====== LEFT: Controls ====== -->
        <div class="cl-controls-col">

            <!-- Step 1: Bluetooth -->
            <div class="p-card">
                <div class="p-card-hd">
                    <i class="fab fa-bluetooth-b"></i>
                    <h5>Langkah 1 — Hubungkan Printer</h5>
                    <span id="statusBadge" class="badge-bt off" style="margin-left:auto;">
                        <div class="pulse-dot pd-off" id="pulseDot"></div>
                        <span id="statusText">Tidak Terhubung</span>
                    </span>
                </div>
                <div class="p-card-bd">
                    <div class="bt-steps">
                        <div class="bt-step" id="btStep1">
                            <div class="step-num sn-active" id="stepNum1">1</div>
                            <div class="step-info">
                                <strong>Hubungkan NIIMBOT B1</strong>
                                <small>Klik Connect → pilih printer dari dialog Bluetooth</small>
                            </div>
                            <div style="display:flex;gap:7px;flex-shrink:0;margin-left:auto;">
                                <button class="btn-bt-connect" id="connectBtn" onclick="doConnect()">
                                    <i class="fab fa-bluetooth-b"></i> Connect
                                </button>
                                <button class="btn-bt-disc" id="disconnectBtn" onclick="doDisconnect()" style="display:none;">
                                    <i class="fas fa-power-off"></i>
                                </button>
                            </div>
                        </div>
                        <div class="bt-step" id="btStep2" style="opacity:.5;">
                            <div class="step-num sn-wait" id="stepNum2">2</div>
                            <div class="step-info">
                                <strong>Siap Mencetak</strong>
                                <small>Pilih format & klik "Cetak Label"</small>
                            </div>
                            <div id="printStatus" style="margin-left:auto;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Ukuran Kertas -->
            <div class="p-card">
                <div class="p-card-hd">
                    <i class="fas fa-ruler-combined"></i>
                    <h5>Langkah 2 — Ukuran Kertas</h5>
                </div>
                <div class="p-card-bd">
                    <div class="paper-row">
                        <label class="paper-opt sel" onclick="selectPaper(this,'50x30')" id="paper-50x30">
                            <input type="radio" name="paperSize" value="50x30" checked style="accent-color:#1a237e;">
                            <i class="fas fa-sticky-note" style="color:#3f51b5;font-size:16px;"></i>
                            <div>
                                <span>50 × 30 mm</span>
                                <small style="display:block;color:#9e9e9e;font-size:10px;">Label Besar</small>
                            </div>
                        </label>
                        <label class="paper-opt" onclick="selectPaper(this,'30x20')" id="paper-30x20">
                            <input type="radio" name="paperSize" value="30x20" style="accent-color:#1a237e;">
                            <i class="fas fa-sticky-note" style="color:#78909c;font-size:12px;"></i>
                            <div>
                                <span>30 × 20 mm</span>
                                <small style="display:block;color:#9e9e9e;font-size:10px;">Label Kecil</small>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Step 3: Format -->
            <div class="p-card">
                <div class="p-card-hd">
                    <i class="fas fa-layer-group"></i>
                    <h5>Langkah 3 — Pilih Format Label</h5>
                </div>
                <div class="p-card-bd">
                    <div class="fmt-grid">
                        <div class="fmt-card sel" onclick="selectFormat(1)" id="fmt-card-1">
                            <div class="fmt-icon"><i class="fas fa-id-card"></i></div>
                            <div class="fmt-txt">
                                <strong>Format 1</strong>
                                <small>SN + Tanggal</small>
                            </div>
                            <div class="fmt-chk"><i class="fas fa-check"></i></div>
                        </div>
                        <div class="fmt-card" onclick="selectFormat(2)" id="fmt-card-2">
                            <div class="fmt-icon"><i class="fas fa-clipboard-list"></i></div>
                            <div class="fmt-txt">
                                <strong>Format 2</strong>
                                <small>Aset + Next Cal</small>
                            </div>
                            <div class="fmt-chk"><i class="fas fa-check"></i></div>
                        </div>
                        <div class="fmt-card" onclick="selectFormat(3)" id="fmt-card-3">
                            <div class="fmt-icon"><i class="fas fa-certificate"></i></div>
                            <div class="fmt-txt">
                                <strong>Format 3</strong>
                                <small>CALIBRATED</small>
                            </div>
                            <div class="fmt-chk"><i class="fas fa-check"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4: Input + Cetak -->
            <div class="p-card">
                <div class="p-card-hd">
                    <i class="fas fa-keyboard"></i>
                    <h5>Langkah 4 — Isi Data &amp; Cetak</h5>
                </div>
                <div class="p-card-bd">

                    <!-- Format 1 Inputs -->
                    <div class="fmt-panel active" id="inputs-format-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label class="input-lbl"><i class="fas fa-calendar-alt mr-1"></i>Tanggal Kalibrasi</label>
                                    <input type="date" id="f1_tanggal" class="form-control input-ctrl"
                                        value="{{ date('Y-m-d') }}"
                                        onchange="if(this.value){const p=this.value.split('-');document.getElementById('preview_f1_tanggal').innerText=p[2]+'-'+p[1]+'-'+p[0];}else{document.getElementById('preview_f1_tanggal').innerText='';}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label class="input-lbl"><i class="fas fa-barcode mr-1"></i>Serial Number</label>
                                    <input type="text" id="f1_serial" class="form-control input-ctrl" placeholder="Masukkan SN..."
                                        oninput="document.getElementById('preview_f1_serial').innerText=this.value">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Format 2 Inputs -->
                    <div class="fmt-panel" id="inputs-format-2">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group mb-2">
                                    <label class="input-lbl"><i class="fas fa-calendar-alt mr-1"></i>Tgl. Kalibrasi</label>
                                    <input type="date" id="f2_tanggal" class="form-control input-ctrl"
                                        value="{{ date('Y-m-d') }}"
                                        onchange="if(this.value){const p=this.value.split('-');document.getElementById('preview_f2_tanggal').innerText=p[2]+'-'+p[1]+'-'+p[0];}else{document.getElementById('preview_f2_tanggal').innerText='';}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-2">
                                    <label class="input-lbl"><i class="fas fa-calendar-check mr-1"></i>Next Calibration</label>
                                    <input type="date" id="f2_next" class="form-control input-ctrl"
                                        value="{{ date('Y-m-d', strtotime('+1 year')) }}"
                                        onchange="if(this.value){const p=this.value.split('-');document.getElementById('preview_f2_next').innerText=p[2]+'-'+p[1]+'-'+p[0];}else{document.getElementById('preview_f2_next').innerText='';}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-2">
                                    <label class="input-lbl"><i class="fas fa-tag mr-1"></i>No. Id / Aset</label>
                                    <input type="text" id="f2_serial" class="form-control input-ctrl" placeholder="Masukkan Aset..."
                                        oninput="document.getElementById('preview_f2_serial').innerText=this.value">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Format 3 Inputs -->
                    <div class="fmt-panel" id="inputs-format-3">
                        <div class="form-group mb-2">
                            <label class="input-lbl"><i class="fas fa-calendar-alt mr-1"></i>Tanggal Kalibrasi</label>
                            <input type="date" id="f3_tanggal" class="form-control input-ctrl"
                                value="{{ date('Y-m-d') }}"
                                onchange="if(this.value){const p=this.value.split('-');document.getElementById('preview_f3_tanggal').innerText=p[2]+'-'+p[1]+'-'+p[0];}else{document.getElementById('preview_f3_tanggal').innerText='';}">
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn-cetak" id="btn-cetak-main">
                            <i class="fas fa-print"></i>
                            <span id="btn-cetak-text">Cetak Format 1</span>
                        </button>
                    </div>
                </div>
            </div>

        </div><!-- /cl-controls-col -->

        <!-- ====== RIGHT: Live Preview ====== -->
        <div class="cl-preview-col">
            <div class="p-card">
                <div class="p-card-hd">
                    <i class="fas fa-eye"></i>
                    <h5>Preview Label</h5>
                    <span style="margin-left:auto;font-size:11px;color:#9e9e9e;font-style:italic;">Live preview</span>
                </div>
                <div class="p-card-bd">

                    <!-- Preview Format 1 -->
                    <div class="fmt-panel active" id="preview-format-1">
                        <p class="text-center text-muted mb-2" style="font-size:11px;">
                            <strong>Format 1</strong> — Serial Number + Tanggal Kalibrasi
                        </p>
                        <div class="preview-bg">
                            <div class="calibration-label-1" id="label-format-1-preview">
                                <div class="left-section">
                                    <img src="{{ asset('logo_pas_basic.png') }}" alt="PAS Logo">
                                </div>
                                <div class="right-section">
                                    <div class="row-date">
                                        <div class="date-group">
                                            <span class="label-text">Calibrated On:</span>
                                            <span class="date-val" id="preview_f1_tanggal">{{ date('d-m-Y') }}</span>
                                        </div>
                                        <img src="{{ asset('logo/logo_kan.png') }}" alt="KAN Logo" class="kan-logo">
                                    </div>
                                    <div class="row-serial">
                                        <div class="serial-title">Serial Number:</div>
                                        <div class="serial-value" id="preview_f1_serial"></div>
                                    </div>
                                    <div class="row-company">
                                        <h3>PT PANANJUNG ANUGRAH SOLUTION</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Format 2 -->
                    <div class="fmt-panel" id="preview-format-2">
                        <p class="text-center text-muted mb-2" style="font-size:11px;">
                            <strong>Format 2</strong> — No. Aset + Calibration Date + Next Calibration
                        </p>
                        <div class="preview-bg">
                            <div class="calibration-label-2" id="label-format-2-preview">
                                <div class="left-section">
                                    <img src="{{ asset('logo_pas_basic.png') }}" alt="PAS Logo">
                                </div>
                                <div class="right-section">
                                    <div class="row-date">
                                        <div class="date-group">
                                            <span class="label-text">Calibration Date:</span>
                                            <span class="date-val" id="preview_f2_tanggal">{{ date('d-m-Y') }}</span>
                                        </div>
                                        <img src="{{ asset('logo/logo_kan.png') }}" alt="KAN Logo" class="kan-logo">
                                    </div>
                                    <div class="row-serial">
                                        <div class="serial-title">No. Id/Aset:</div>
                                        <div class="serial-value" id="preview_f2_serial"></div>
                                    </div>
                                    <div class="row-next-cal">
                                        <div class="date-group">
                                            <span class="label-text">Next Calibration:</span>
                                            <span class="date-val" id="preview_f2_next">{{ date('d-m-Y', strtotime('+1 year')) }}</span>
                                        </div>
                                    </div>
                                    <div class="row-company">
                                        <h3>PT PANANJUNG ANUGRAH SOLUTION</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Format 3 -->
                    <div class="fmt-panel" id="preview-format-3">
                        <p class="text-center text-muted mb-2" style="font-size:11px;">
                            <strong>Format 3</strong> — CALIBRATED Status + Tanggal
                        </p>
                        <div class="preview-bg">
                            <div class="calibration-label-3" id="label-format-3-preview">
                                <div class="left-section">
                                    <img src="{{ asset('logo_pas_basic.png') }}" alt="PAS Logo">
                                </div>
                                <div class="right-section">
                                    <div class="label-row row-calibrated">
                                        <div class="text-calibrated">
                                            <span class="main-title">CALIBRATED</span>
                                            <span class="sub-title">SUDAH DIKALIBRASI</span>
                                        </div>
                                        <img src="{{ asset('logo/logo_kan.png') }}" alt="KAN Logo" class="kan-logo">
                                    </div>
                                    <div class="label-row row-date">
                                        <div class="date-title">DATE/TANGGAL :</div>
                                        <div class="date-format" id="preview_f3_tanggal">{{ date('d-m-Y') }}</div>
                                    </div>
                                    <div class="label-row row-company">
                                        PT. PANANJUNG ANUGRAH SOLUTION
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- /cl-preview-col -->

    </div><!-- /.cl-grid -->
</div><!-- /.cl-wrap -->
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="{{ asset('js/libs/niimbluelib.js') }}"></script>
<script>
    let client = null, _lib = null;
    let selectedFormat = 1, selectedPaper = '50x30';

    // ─── Load niimbluelib ─────────────────────────────────────
    (async () => {
        const wait = () => new Promise(r => {
            if (window.niimbluelib) { r(window.niimbluelib); return; }
            const t = setInterval(() => { if (window.niimbluelib) { clearInterval(t); r(window.niimbluelib); } }, 100);
            setTimeout(() => { clearInterval(t); r(null); }, 8000);
        });
        _lib = await wait();
        console.log(_lib ? 'niimbluelib ready' : 'niimbluelib failed');
    })();

    // ─── Format Selector ──────────────────────────────────────
    function selectFormat(n) {
        selectedFormat = n;
        [1,2,3].forEach(i => document.getElementById('fmt-card-' + i).classList.toggle('sel', i === n));
        document.querySelectorAll('.fmt-panel').forEach(p => p.classList.remove('active'));
        document.getElementById('inputs-format-' + n).classList.add('active');
        document.getElementById('preview-format-' + n).classList.add('active');
        document.getElementById('btn-cetak-text').textContent = 'Cetak Format ' + n;
    }

    // ─── Paper Selector ───────────────────────────────────────
    function selectPaper(el, val) {
        selectedPaper = val;
        document.querySelectorAll('.paper-opt').forEach(p => p.classList.remove('sel'));
        el.classList.add('sel');
    }

    // ─── Bluetooth UI ─────────────────────────────────────────
    function setUI(on, name = '') {
        document.getElementById('statusBadge').className = 'badge-bt ' + (on ? 'on' : 'off');
        document.getElementById('pulseDot').className    = 'pulse-dot ' + (on ? 'pd-on' : 'pd-off');
        document.getElementById('statusText').textContent = on ? (name || 'Terhubung') : 'Tidak Terhubung';
        document.getElementById('disconnectBtn').style.display = on ? 'inline-block' : 'none';
        document.getElementById('connectBtn').style.display    = on ? 'none' : 'inline-block';
        const n1 = document.getElementById('stepNum1');
        const s2 = document.getElementById('btStep2');
        const n2 = document.getElementById('stepNum2');
        if (on) {
            n1.className = 'step-num sn-done'; n1.textContent = '✓';
            s2.style.opacity = '1'; n2.className = 'step-num sn-active';
        } else {
            n1.className = 'step-num sn-active'; n1.textContent = '1';
            s2.style.opacity = '.5'; n2.className = 'step-num sn-wait';
        }
    }

    async function doConnect() {
        if (!_lib) { alert('Library Bluetooth belum siap'); return; }
        if (client) { alert('Sudah terhubung'); return; }
        client = new _lib.NiimbotBluetoothClient();
        client.on('connect', () => setUI(true, client.deviceName || 'NIIMBOT'));
        client.on('printprogress', e => {
            document.getElementById('printStatus').innerHTML =
                '<span style="font-size:11px;font-weight:600;color:#1565c0;">🖨 ' + e.pagePrintProgress + '%</span>';
        });
        client.on('disconnect', () => { setUI(false); client = null; });
        try { await client.connect(); }
        catch (e) {
            client = null;
            if (typeof Swal !== 'undefined') Swal.fire({ icon: 'error', title: 'Gagal Menghubungkan', text: e.message });
            else alert('Gagal: ' + e.message);
        }
    }

    function doDisconnect() { client?.disconnect(); client = null; setUI(false); }

    // ─── 1-Bit Filter ─────────────────────────────────────────
    function convertTo1Bit(imageData, threshold) {
        threshold = threshold || 180;
        const data = imageData.data;
        let hist = new Array(256).fill(0);
        for (let i = 0; i < data.length; i += 4)
            hist[Math.round((data[i] + data[i+1] + data[i+2]) / 3)]++;
        let total = data.length / 4, sum = 0;
        for (let i = 0; i < 256; i++) sum += i * hist[i];
        let sumB = 0, wB = 0, wF = 0, maxV = 0, otsu = threshold;
        for (let i = 0; i < 256; i++) {
            wB += hist[i]; if (!wB) continue;
            wF = total - wB; if (!wF) break;
            sumB += i * hist[i];
            const mB = sumB/wB, mF = (sum-sumB)/wF, v = wB*wF*(mB-mF)*(mB-mF);
            if (v > maxV) { maxV = v; otsu = i; }
        }
        const ft = Math.round((threshold + otsu) / 2);
        for (let i = 0; i < data.length; i += 4) {
            const r = data[i], g = data[i+1], b = data[i+2];
            const gray = (r>200 && g>200 && b>200) ? 255 : 0.299*r + 0.587*g + 0.114*b;
            data[i] = data[i+1] = data[i+2] = (gray > ft ? 255 : 0);
        }
    }

    // ─── Core Print ───────────────────────────────────────────
    async function corePrint(canvas, qty) {
        qty = qty || 1;
        if (!client) throw new Error('Printer belum terhubung!');
        document.getElementById('printStatus').innerHTML =
            '<span style="font-size:11px;font-weight:600;color:#f57c00;"><i class="fas fa-spinner fa-spin mr-1"></i>Memproses...</span>';
        // Menggunakan 'up' agar tidak diputar 90 derajat (kertas 50x30 lebarnya 50, tinggi 30)
        // Jika hasil print masih kebalik atas-bawah (180 derajat), ubah 'up' menjadi 'down'.
        const encoded = _lib.ImageEncoder.encodeCanvas(canvas, 'up');
        let taskType;
        try { taskType = client.getPrintTaskType ? client.getPrintTaskType() : 'B1'; } catch(_) { taskType = 'B1'; }
        const pt = client.abstraction.newPrintTask(taskType, { totalPages: qty, statusPollIntervalMs: 200, statusTimeoutMs: 20000 });
        await pt.printInit();
        await pt.printPage(encoded, qty);
        await pt.waitForFinished();
        await pt.printEnd();
        document.getElementById('printStatus').innerHTML =
            '<span style="font-size:11px;font-weight:600;color:#2e7d32;">✓ Berhasil</span>';
        setTimeout(function() { document.getElementById('printStatus').innerHTML = ''; }, 3000);
    }

    // ─── Print Click ──────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn-cetak-main').addEventListener('click', async function() {
            var fmt = selectedFormat;

            if (fmt === 1 && !document.getElementById('f1_serial').value.trim()) {
                if (typeof Swal !== 'undefined') Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Serial Number harus diisi!' });
                else alert('Serial Number harus diisi!'); return;
            }
            if (fmt === 2 && !document.getElementById('f2_serial').value.trim()) {
                if (typeof Swal !== 'undefined') Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'No. Id/Aset harus diisi!' });
                else alert('No. Id/Aset harus diisi!'); return;
            }
            if (!client) {
                if (typeof Swal !== 'undefined')
                    Swal.fire({ icon: 'info', title: 'Printer Belum Terhubung', text: 'Silakan hubungkan printer NIIMBOT B1 terlebih dahulu pada Langkah 1.' });
                else alert('Silakan hubungkan printer NIIMBOT B1 terlebih dahulu.'); return;
            }

            try {
                var el = document.getElementById('label-format-' + fmt + '-preview');

                var isSmall = (selectedPaper === '30x20');
                if (isSmall) {
                    el.classList.add('is-30x20');
                }

                var w = isSmall ? 360 : (fmt === 3 ? 440 : 424);
                var h = isSmall ? 240 : (fmt === 3 ? 224 : 192);

                var srcCanvas = await html2canvas(el, { scale: 2, backgroundColor: '#FFFFFF', width: w, height: h });

                if (isSmall) {
                    el.classList.remove('is-30x20');
                }

                var targetW = 400, targetH = 240;
                var padX = 12, padY = 8; // Margin aman agar garis luar tidak terpotong
                if (isSmall) { 
                    targetW = 240; targetH = 160; 
                    padX = 8; padY = 6; // Margin aman proporsional
                }

                var canvas = document.createElement('canvas');
                canvas.width = targetW; canvas.height = targetH;
                var ctx = canvas.getContext('2d');
                ctx.fillStyle = '#FFFFFF';
                ctx.fillRect(0, 0, targetW, targetH);
                
                // Kalkulasi skala dengan mengurangi padding agar gambar lebih kecil sedikit di tengah
                var sc = Math.min((targetW - padX * 2)/srcCanvas.width, (targetH - padY * 2)/srcCanvas.height);
                var dw = srcCanvas.width*sc, dh = srcCanvas.height*sc;
                ctx.imageSmoothingEnabled = true; ctx.imageSmoothingQuality = 'high';
                ctx.drawImage(srcCanvas, (targetW-dw)/2, (targetH-dh)/2, dw, dh);

                var imgData = ctx.getImageData(0, 0, targetW, targetH);
                convertTo1Bit(imgData, 180);
                ctx.putImageData(imgData, 0, 0);

                await corePrint(canvas, 1);
                if (typeof Swal !== 'undefined')
                    Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Label Format ' + fmt + ' berhasil dicetak.', timer: 1800, showConfirmButton: false });

            } catch (err) {
                console.error(err);
                if (typeof Swal !== 'undefined') Swal.fire({ icon: 'error', title: 'Error Print', text: err.message });
                else alert(err.message);
            }
        });
    });
</script>
@endpush
