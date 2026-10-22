@extends('layouts.app')

@section('title', 'Desain Label')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center">Desain Label Custom</h2>

    <div class="row justify-content-center">
        <!-- Canvas -->
        <div class="col-md-6 text-center mb-4">
            <canvas id="labelCanvas" width="240" height="400" style="border: 3px solid #333; background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.2);"></canvas>
        </div>

        <!-- Kontrol -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>Kontrol Desain Label</h5>
                </div>
                <div class="card-body">
                    <!-- Input ID Kalibrasi -->
                    <div class="mb-3">
                        <label for="calibId" class="form-label">ID Kalibrasi (untuk barcode)</label>
                        <input type="text" id="calibId" class="form-control" placeholder="Contoh: CAL-2025-001">
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-grid gap-2">
                        <button id="btnAddText" class="btn btn-primary">Tambah Teks Kustom</button>
                        <button id="btnAddBarcode" class="btn btn-success">Tambah Barcode</button>
                        <button id="btnAddInfo" class="btn btn-info">Tambah Info ID</button>
                        <button id="btnPreview" class="btn btn-warning">Preview</button>
                        <button id="btnPrint" class="btn btn-danger">Print ke Printer</button>
                        <button id="btnClear" class="btn btn-secondary">Hapus Semua</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<!-- Script Editor -->
<script>
    // Inisialisasi canvas
    const canvas = new fabric.Canvas('labelCanvas', {
        backgroundColor: '#fff',
        selection: true,
        preserveObjectStacking: true
    });

    // Layout dasar
    function initLayout() {
        const header = new fabric.Text('PAS CALIBRATION', {
            left: 120,
            top: 40,
            fontSize: 36,
            fill: '#000',
            fontWeight: 'bold',
            originX: 'center'
        });
        canvas.add(header);

        // Logo
        fabric.Image.fromURL('/logo/logo_pas_basic.png', img => {
            img.set({ left: 70, top: 80, scaleX: 0.4, scaleY: 0.4 });
            canvas.add(img);
        }, { crossOrigin: 'anonymous' });
    }

    initLayout();

    // Fungsi-fungsi (tidak perlu window. lagi karena pakai event listener)
    function addText() {
        const text = new fabric.Textbox('Teks Baru', {
            left: 50,
            top: 150,
            width: 140,
            fontSize: 30,
            fill: '#000',
            editable: true
        });
        canvas.add(text);
        canvas.setActiveObject(text);
    }

    function addBarcode() {
        const id = document.getElementById('calibId').value.trim() || 'CAL-TEST';
        const bc = document.createElement('canvas');
        JsBarcode(bc, id, {
            format: "CODE128",
            width: 2,
            height: 80,
            displayValue: true,
            fontSize: 16
        });
        fabric.Image.fromURL(bc.toDataURL(), img => {
            img.set({ left: 20, top: 250, scaleX: 1, scaleY: 1 });
            canvas.add(img);
            canvas.setActiveObject(img);
        });
    }

    function addCalibrationInfo() {
        const id = document.getElementById('calibId').value.trim() || 'CAL-TEST';
        const info = new fabric.Textbox(`ID Kalibrasi: ${id}\nTanggal: ${new Date().toLocaleDateString('id-ID')}`, {
            left: 20,
            top: 180,
            width: 200,
            fontSize: 24,
            fill: '#000',
            editable: true
        });
        canvas.add(info);
        canvas.setActiveObject(info);
    }

    function previewLabel() {
        const dataURL = canvas.toDataURL({ format: 'png' });
        const win = window.open();
        win.document.write('<img src="' + dataURL + '" style="max-width:100%;">');
    }

    async function printLabel() {
        if (!window.niimbot || !window.niimbot.isConnected()) {
            alert('Printer belum terhubung!');
            return;
        }

        const dataURL = canvas.toDataURL({ format: 'png' });
        const img = new Image();
        img.src = dataURL;
        img.onload = async () => {
            try {
                // Kirim ke printer
                await window.niimbot.printCompleteLabel();  // atau logic print image kamu
                alert('Label berhasil dikirim ke printer!');
            } catch (e) {
                alert('Gagal print: ' + e.message);
            }
        };
    }

    function clearCanvas() {
        if (confirm('Hapus semua elemen di canvas?')) {
            canvas.clear();
            initLayout();
        }
    }

    // Event listener (bukan onclick inline)
    document.getElementById('btnAddText').addEventListener('click', addText);
    document.getElementById('btnAddBarcode').addEventListener('click', addBarcode);
    document.getElementById('btnAddInfo').addEventListener('click', addCalibrationInfo);
    document.getElementById('btnPreview').addEventListener('click', previewLabel);
    document.getElementById('btnPrint').addEventListener('click', printLabel);
    document.getElementById('btnClear').addEventListener('click', clearCanvas);
</script>
@endsection