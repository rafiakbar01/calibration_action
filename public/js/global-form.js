// public/js/global-form.js - UNTUK SEMUA JENIS ALAT KALIBRASI

// ==================== FUNGSI MODAL NO LABEL ====================

window.showNoLabelModal = function() {
    const modalElement = document.getElementById('noLabelModal');
    if (!modalElement) {
        // console.error('Modal element tidak ditemukan!');
        return;
    }
    
    try {
        const modal = new bootstrap.Modal(modalElement);
        const input = document.getElementById('no_label_input');
        const error = document.getElementById('noLabelError');
        
        if (input) {
            input.value = '';
            input.classList.remove('is-invalid');
        }
        if (error) error.style.display = 'none';
        
        modal.show();
        setTimeout(() => input?.focus(), 500);
        
    } catch (e) {
        // console.error('Error menampilkan modal:', e);
        alert('Terjadi kesalahan saat menampilkan modal.');
    }
};

// ==================== CEK FLASH DATA ====================

window.checkFlashData = function() {
    const showModal = document.querySelector('meta[name="show-no-label-modal"]')?.content;
    const calibrationId = document.querySelector('meta[name="calibration-id"]')?.content;
    const formType = document.querySelector('meta[name="form-type"]')?.content;
    
    if (showModal === 'true' && calibrationId) {
        // console.log('📌 Flash data detected:', { calibrationId, formType });
        
        const idInput = document.getElementById('calibration_id_no_label');
        if (idInput) idInput.value = calibrationId;
        
        const form = document.getElementById('noLabelForm');
        if (form) form.action = '/calibrations/' + calibrationId + '/update-label';
        
        setTimeout(() => window.showNoLabelModal(), 100);
    }
};

// ==================== FUNGSI GENERATE BARCODE ====================

function generateBarcodeImage(data) {
    const canvas = document.createElement('canvas');
    canvas.width = 340;
    canvas.height = 60;
    const ctx = canvas.getContext('2d');
    
    // Background putih
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Cek apakah library JsBarcode tersedia
    if (window.JsBarcode) {
        try {
            const tempCanvas = document.createElement('canvas');
            JsBarcode(tempCanvas, data.toString(), {
                format: "CODE128",
                width: 2,
                height: 50,
                displayValue: true,
                fontSize: 14,
                margin: 5
            });
            return tempCanvas;
        } catch (e) {
            // console.warn('JsBarcode error, fallback manual', e);
        }
    }
    
    // Fallback manual - gambar barcode sederhana
    ctx.fillStyle = '#000000';
    ctx.font = 'bold 14px Arial';
    ctx.fillText(data.toString(), 10, 25);
    
    // Gambar garis-garis seperti barcode
    for (let i = 0; i < 30; i++) {
        const x = 10 + (i * 11);
        const height = 30 + (i % 15);
        ctx.fillRect(x, 35, 3, height);
    }
    
    return canvas;
}

// ==================== FUNGSI LOAD LOGO ====================

async function loadLogo() {
    return new Promise((resolve) => {
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.src = '/img/logo_pas.png';
        
        img.onload = () => resolve(img);
        img.onerror = () => {
            // console.warn('Logo tidak ditemukan, menggunakan teks');
            resolve(null);
        };
    });
}

// ==================== FUNGSI GENERATE LABEL CANVAS ====================

// ==================== FUNGSI GENERATE LABEL TANPA LOGO (UNTUK TESTING) ====================

async function generateLabelCanvas(calibrationId, noLabel, tanggal) {
    // Ukuran label 50x30mm = 384x240 pixel
    const canvas = document.createElement('canvas');
    canvas.width = 384;
    canvas.height = 240;

    // 🔥 Tambahin metadata buat TEXT ONLY print
    canvas.calibrationId = calibrationId;
    canvas.noLabel = noLabel;
    canvas.tanggal = tanggal;

    const ctx = canvas.getContext('2d');
    
    // Background putih
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // ===== 1. HEADER TEKS (TANPA LOGO) =====
    ctx.fillStyle = '#000000';
    ctx.font = 'bold 14px Arial';
    ctx.fillText('PT. PANANJUNG ANUGRAH SOLUTION', 10, 25);
    ctx.font = '12px Arial';
    ctx.fillText('LABORATORIUM KALIBRASI', 10, 45);
    
    // Garis pembatas
    ctx.beginPath();
    ctx.moveTo(10, 55);
    ctx.lineTo(374, 55);
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 1;
    ctx.stroke();
    
    // ===== 2. NO LABEL (BESAR & JELAS) =====
    ctx.font = 'bold 14px Arial';
    ctx.fillText('No. Label:', 10, 85);
    ctx.font = 'bold 24px Arial';
    ctx.fillStyle = '#000000';
    ctx.fillText(noLabel, 10, 120);
    
    // ===== 3. ID KALIBRASI =====
    ctx.font = 'bold 12px Arial';
    ctx.fillText('ID Kalibrasi:', 10, 150);
    ctx.font = '12px Arial';
    ctx.fillText(calibrationId.toString(), 10, 170);
    
    // ===== 4. TANGGAL KALIBRASI =====
    ctx.font = 'bold 12px Arial';
    ctx.fillText('Tgl Kalibrasi:', 10, 200);
    ctx.font = '12px Arial';
    ctx.fillText(tanggal, 10, 220);
    
    // ===== 5. FOOTER =====
    ctx.font = '10px Arial';
    ctx.fillStyle = '#666666';
    ctx.fillText('PAS-LABORATORIUM', 250, 235);
    
    // console.log('✅ Label canvas siap (tanpa logo)');
    return canvas;
}

// ==================== FUNGSI PRINT LABEL (PAKAI printCanvas) ====================

window.printLabel = async function(calibrationId, noLabel, tanggal) {
    // console.log('🖨️ Mencoba print label:', { calibrationId, noLabel, tanggal });
    
    // VALIDASI: No label harus ada
    if (!noLabel) {
        // console.error('❌ No label tidak boleh kosong!');
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No label tidak boleh kosong!',
                timer: 2000
            });
        }
        return false;
    }
    
    // Cek apakah printer library tersedia
    if (!window.niimbot) {
        // console.warn('⚠️ Library NIIMBOT tidak tersedia');
        return false;
    }
    
    // Cek status koneksi printer
    if (!window.niimbot.isConnected()) {
        // console.warn('⚠️ Printer tidak terhubung');
        
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'warning',
                title: 'Printer Tidak Terhubung',
                text: 'Label tidak dapat dicetak. Silakan hubungkan printer terlebih dahulu.',
                timer: 3000,
                showConfirmButton: true
            });
        }
        return false;
    }
    
    try {
        // Tampilkan loading di UI printer
        const indicator = document.getElementById('printerStatusIndicator');
        const loadingAlert = document.getElementById('printerLoadingAlert');
        const loadingText = document.getElementById('printerLoadingText');
        
        if (indicator) indicator.style.display = 'block';
        if (loadingAlert) {
            loadingAlert.style.display = 'block';
            if (loadingText) loadingText.innerHTML = `Mencetak label ${noLabel}...`;
        }
        
        // Generate canvas dengan semua elemen
        const canvas = await generateLabelCanvas(calibrationId, noLabel, tanggal);
        
        // ===== PAKAI METHOD printCanvas YANG SUDAH ADA =====
        const result = await window.niimbot.printCanvas(canvas);
        
        if (result) {
            // console.log('✅ Print sukses!', noLabel);
            
            // Sembunyikan loading, tampilkan sukses
            if (loadingAlert) loadingAlert.style.display = 'none';
            
            const successAlert = document.getElementById('printerSuccessAlert');
            const statusText = document.getElementById('printerStatusText');
            
            if (successAlert) {
                successAlert.style.display = 'block';
                successAlert.classList.remove('alert-danger');
                successAlert.classList.add('alert-success');
                if (statusText) statusText.innerHTML = `✅ Label ${noLabel} berhasil dicetak!`;
                
                // Auto hide setelah 3 detik
                setTimeout(() => {
                    if (indicator) indicator.style.display = 'none';
                }, 3000);
            }
            
            return true;
        } else {
            throw new Error('Gagal mencetak');
        }
        
    } catch (error) {
        // console.error('❌ Print error:', error);
        
        // Tampilkan error
        const indicator = document.getElementById('printerStatusIndicator');
        const successAlert = document.getElementById('printerSuccessAlert');
        const statusText = document.getElementById('printerStatusText');
        const loadingAlert = document.getElementById('printerLoadingAlert');
        
        if (loadingAlert) loadingAlert.style.display = 'none';
        if (successAlert) {
            successAlert.style.display = 'block';
            successAlert.classList.remove('alert-success');
            successAlert.classList.add('alert-danger');
            if (statusText) statusText.innerHTML = '❌ ' + error.message;
        }
        if (indicator) indicator.style.display = 'block';
        
        setTimeout(() => {
            if (indicator) indicator.style.display = 'none';
        }, 5000);
        
        return false;
    }
};

// ==================== INTERCEPT FORM SUBMIT ====================

window.interceptFormSubmit = function(formId, formType) {
    const form = document.getElementById(formId);
    if (!form) return;
    
    form.addEventListener('submit', async function(e) {
        // Cek apakah ini submit pertama (no_label kosong)
        const noLabelInput = form.querySelector('input[name="no_label"]');
        const isFirstSubmit = !noLabelInput?.value;
        
        if (!isFirstSubmit) return; // Submit kedua, biarkan normal
        
        e.preventDefault();
        
        // Validasi form
        if (typeof window.validateForm === 'function' && !window.validateForm()) {
            return;
        }
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        try {
            // 1. Submit data
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            const formData = new FormData(form);
            formData.delete('no_label');
            
            const response = await fetch('/calibrations', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (!data.success) {
                throw new Error(data.message || 'Gagal menyimpan data');
            }
            
            // 2. Generate no label sementara
            const noLabelSementara = 'PAS-' + data.calibration_id.toString().padStart(5, '0');
            const tanggal = new Date().toLocaleDateString('id-ID', {
                day: '2-digit', 
                month: '2-digit', 
                year: 'numeric'
            }).replace(/\//g, '/');
            
            // console.log('📝 Print data:', { 
            //     calibration_id: data.calibration_id, 
            //     no_label: noLabelSementara, 
            //     tanggal: tanggal 
            // });
            
            // 3. Redirect atau Handle Tab Mode
            if (window.isTabbedMode) {
                // console.log('🔄 Tab Mode Detected: Dispatching calibrationSaved event');
                document.dispatchEvent(new CustomEvent('calibrationSaved', { 
                    detail: { data: data, formType: formType } 
                }));
                return;
            }

            // Simpan data print di sessionStorage untuk diproses setelah redirect
            sessionStorage.setItem('pending_print', JSON.stringify({
                calibration_id: data.calibration_id,
                no_label: noLabelSementara,
                tanggal: tanggal
            }));
            
            // 4. Redirect ke form dengan flash data
            // Hapus draft sebelum redirect karena data sudah berhasil disimpan
            if (typeof window.clearAllDraft === 'function') {
                window.clearAllDraft();
            } else {
                // Gunakan key unik per user jika tersedia
                const draftKey = window.DRAFT_KEY || 'calibration_draft_state';
                localStorage.removeItem(draftKey);
                // Coba hapus server draft juga
                try {
                    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    if (csrfMeta) {
                        fetch('/api/calibration-draft/clear', {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfMeta.getAttribute('content'), 'Accept': 'application/json' }
                        }).catch(() => {});
                    }
                } catch(e) {}
            }
            window.location.href = `/get-form-html/${formType}?success=1&calibration_id=${data.calibration_id}`;
            
        } catch (error) {
            // console.error('❌ Error:', error);
            alert('Gagal: ' + error.message);
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
};

// ==================== CEK PENDING PRINT SETELAH REDIRECT ====================

// CEK PENDING PRINT - DIPISAHKAN DARI DOMContentLoaded
function checkPendingPrint() {
    // console.log('🔍 [PENDING] Memeriksa pending print di sessionStorage...');
    
    const pendingPrint = sessionStorage.getItem('pending_print');
    
    if (!pendingPrint) {
        // console.log('ℹ️ [PENDING] Tidak ada pending print');
        return;
    }
    
    // console.log('📋 [PENDING] Ditemukan data pending print:', pendingPrint);
    
    try {
        const printData = JSON.parse(pendingPrint);
        // console.log('✅ [PENDING] Data parsed successfully:', printData);
        
        // Validasi data
        if (!printData.calibration_id || !printData.no_label || !printData.tanggal) {
            // console.error('❌ [PENDING] Data tidak lengkap:', printData);
            sessionStorage.removeItem('pending_print');
            return;
        }
        
        // Hapus dari sessionStorage
        sessionStorage.removeItem('pending_print');
        // console.log('✅ [PENDING] Pending print dihapus dari sessionStorage');
        
        // Tunggu sebentar lalu print
        // console.log('⏳ [PENDING] Menunggu 2 detik sebelum print...');
        setTimeout(() => {
            // console.log('🚀 [PENDING] Memanggil window.printLabel dengan data:', printData);
            
            // Cek apakah fungsi printLabel tersedia
            if (typeof window.printLabel !== 'function') {
                // console.error('❌ [PENDING] Fungsi window.printLabel tidak ditemukan!');
                return;
            }
            
            // Cek status printer
            if (!window.niimbot) {
                // console.error('❌ [PENDING] Library niimbot tidak tersedia');
                return;
            }
            
            // console.log('📊 [PENDING] Status printer:', { 
            //     connected: window.niimbot.isConnected ? window.niimbot.isConnected() : 'unknown',
            //     printer: !!window.niimbot.printer
            // });
            
            // Panggil print
            window.printLabel(
                printData.calibration_id,
                printData.no_label,
                printData.tanggal
            ).then(result => {
                if (result) {
                    // console.log('✅ [PENDING] Print sukses!');
                } else {
                    // console.error('❌ [PENDING] Print gagal');
                }
            }).catch(error => {
                // console.error('❌ [PENDING] Error saat print:', error);
            });
            
        }, 2000);
        
    } catch (e) {
        // console.error('❌ [PENDING] Error parsing pending print:', e);
        // console.error('   Raw data:', pendingPrint);
        sessionStorage.removeItem('pending_print');
    }
}

// ==================== FUNGSI PRINT LABEL DENGAN LOG ====================

window.printLabel = async function(calibrationId, noLabel, tanggal) {
    // console.log('='.repeat(60));
    // console.log('🖨️ [PRINT] Memulai proses print label');
    // console.log('📊 [PRINT] Data:', { calibrationId, noLabel, tanggal });
    // console.log('='.repeat(60));
    
    // VALIDASI: No label harus ada
    if (!noLabel) {
        // console.error('❌ [PRINT] No label tidak boleh kosong!');
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No label tidak boleh kosong!',
                timer: 2000
            });
        }
        return false;
    }
    
    // Cek apakah printer library tersedia
    // console.log('🔍 [PRINT] Cek window.niimbot:', window.niimbot ? '✅ Ada' : '❌ Tidak ada');
    if (!window.niimbot) {
        // console.error('❌ [PRINT] Library NIIMBOT tidak tersedia');
        // console.log('   Window keys:', Object.keys(window).filter(k => k.includes('niimbot')));
        return false;
    }
    
    // Cek status koneksi printer
    const isConnected = window.niimbot.isConnected ? window.niimbot.isConnected() : false;
    // console.log('🔌 [PRINT] Status koneksi:', isConnected ? '✅ Terhubung' : '❌ Tidak terhubung');
    
    if (!isConnected) {
        // console.warn('⚠️ [PRINT] Printer tidak terhubung');
        
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'warning',
                title: 'Printer Tidak Terhubung',
                text: 'Label tidak dapat dicetak. Silakan hubungkan printer terlebih dahulu.',
                timer: 3000,
                showConfirmButton: true
            });
        }
        return false;
    }
    
    // Cek objek printer
    // console.log('🖨️ [PRINT] Cek window.niimbot.printer:', window.niimbot.printer ? '✅ Ada' : '❌ Tidak ada');
    
    try {
        // Tampilkan loading di UI printer
        const indicator = document.getElementById('printerStatusIndicator');
        const loadingAlert = document.getElementById('printerLoadingAlert');
        const loadingText = document.getElementById('printerLoadingText');
        
        // console.log('🖥️ [PRINT] Update UI - tampilkan loading');
        if (indicator) indicator.style.display = 'block';
        if (loadingAlert) {
            loadingAlert.style.display = 'block';
            if (loadingText) loadingText.innerHTML = `Mencetak label ${noLabel}...`;
        }
        
        // Generate canvas dengan semua elemen
        // console.log('🎨 [PRINT] Membuat canvas label...');
        // console.time('generateCanvas');
        const canvas = await generateLabelCanvas(calibrationId, noLabel, tanggal);
        // console.timeEnd('generateCanvas');
        // console.log('✅ [PRINT] Canvas selesai, ukuran:', canvas.width, 'x', canvas.height);
        
        // Cek apakah method printCanvas tersedia
        if (typeof window.niimbot.printCanvas !== 'function') {
            // console.error('❌ [PRINT] Method window.niimbot.printCanvas tidak ditemukan!');
            // console.log('📋 Available methods:', Object.keys(window.niimbot));
            throw new Error('Method printCanvas tidak tersedia');
        }
        
        // Panggil print
        // console.log('🚀 [PRINT] Memanggil window.niimbot.printCanvas...');
        // console.time('printDuration');
        const result = await window.niimbot.printCanvas(canvas);
        // console.timeEnd('printDuration');
        
        if (result) {
            // console.log('✅ [PRINT] Print sukses!', noLabel);
            
            // Sembunyikan loading, tampilkan sukses
            if (loadingAlert) loadingAlert.style.display = 'none';
            
            const successAlert = document.getElementById('printerSuccessAlert');
            const statusText = document.getElementById('printerStatusText');
            
            if (successAlert) {
                successAlert.style.display = 'block';
                successAlert.classList.remove('alert-danger');
                successAlert.classList.add('alert-success');
                if (statusText) statusText.innerHTML = `✅ Label ${noLabel} berhasil dicetak!`;
                
                // Auto hide setelah 3 detik
                setTimeout(() => {
                    if (indicator) indicator.style.display = 'none';
                }, 3000);
            }
            
            // console.log('='.repeat(60));
            return true;
        } else {
            throw new Error('Fungsi printCanvas mengembalikan false');
        }
        
    } catch (error) {
        // console.error('❌ [PRINT] Error:', error);
        // console.error('   Stack:', error.stack);
        
        // Tampilkan error
        const indicator = document.getElementById('printerStatusIndicator');
        const successAlert = document.getElementById('printerSuccessAlert');
        const statusText = document.getElementById('printerStatusText');
        const loadingAlert = document.getElementById('printerLoadingAlert');
        
        if (loadingAlert) loadingAlert.style.display = 'none';
        if (successAlert) {
            successAlert.style.display = 'block';
            successAlert.classList.remove('alert-success');
            successAlert.classList.add('alert-danger');
            if (statusText) statusText.innerHTML = '❌ ' + error.message;
        }
        if (indicator) indicator.style.display = 'block';
        
        setTimeout(() => {
            if (indicator) indicator.style.display = 'none';
        }, 5000);
        
        // console.log('='.repeat(60));
        return false;
    }
};

// ==================== INTERCEPT FORM SUBMIT DENGAN PRINT ====================
// ==================== INTERCEPT FORM SUBMIT (PAKAI PYTHON PRINT) ====================

window.interceptFormSubmit = function(formId, formType) {
    const form = document.getElementById(formId);
    if (!form) return;
    
    form.addEventListener('submit', async function(e) {
        // Cek apakah ini submit pertama (no_label kosong)
        const noLabelInput = form.querySelector('input[name="no_label"]');
        const isFirstSubmit = !noLabelInput?.value;
        
        if (!isFirstSubmit) return;
        
        e.preventDefault();
        
        // Validasi form
        if (typeof window.validateForm === 'function' && !window.validateForm()) {
            return;
        }
        
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        try {
            // Cek apakah printer sudah terhubung
            if (!window.niimbot || !window.niimbot.hasPrinter()) {
                if (!confirm('Printer belum terhubung. Lanjutkan tanpa print?')) {
                    return;
                }
            }
            
            // 1. Submit data
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            const formData = new FormData(form);
            formData.delete('no_label');
            
            // Tambahkan printer address dari localStorage
            const printerInfo = window.niimbot?.getPrinterInfo();
            if (printerInfo?.address) {
                formData.append('printer_address', printerInfo.address);
                formData.append('printer_name', printerInfo.name);
            }
            
            const response = await fetch('/calibrations', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (!data.success) {
                throw new Error(data.message || 'Gagal menyimpan data');
            }
            
            // 2. Generate no label sementara
            const noLabelSementara = 'PAS-' + data.calibration_id.toString().padStart(5, '0');
            const tanggal = new Date().toLocaleDateString('id-ID', {
                day: '2-digit', 
                month: '2-digit', 
                year: 'numeric'
            }).replace(/\//g, '/');
            
            // console.log('📝 Print data:', { 
            //     calibration_id: data.calibration_id, 
            //     no_label: noLabelSementara, 
            //     tanggal: tanggal 
            // });
            
            // 3. Print via Python (otomatis)
            if (window.niimbot && window.niimbot.printViaPython) {
                // Jangan await, biar jalan di background
                window.niimbot.printViaPython(data.calibration_id, noLabelSementara, tanggal)
                    .then(result => {
                        if (result.success) {
                            // console.log('✅ Print sukses via Python');
                        } else {
                            // console.warn('⚠️ Print gagal:', result.error);
                        }
                    });
            }
            
            // 3. Redirect atau Handle Tab Mode (AGAR TIDAK REFRESH HALAMAN DI MULTI-TAB)
            if (window.isTabbedMode) {
                // console.log('🔄 Tab Mode Detected: Dispatching calibrationSaved event (Python-Printer Mode)');
                document.dispatchEvent(new CustomEvent('calibrationSaved', { 
                    detail: { data: data, formType: formType } 
                }));
                return;
            }

            // 4. Redirect ke form dengan flash data
            window.location.href = `/get-form-html/${formType}?success=1&calibration_id=${data.calibration_id}`;
            
        } catch (error) {
            // console.error('❌ Error:', error);
            alert('Gagal: ' + error.message);
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
};

// ==================== INITIALIZATION DENGAN LOG ====================

document.addEventListener('DOMContentLoaded', function() {
    // console.log('='.repeat(60));
    // console.log('🚀 [INIT] Global Form JS loaded - ' + document.title);
    // console.log('📅 [INIT] Waktu:', new Date().toLocaleString());
    // console.log('='.repeat(60));
    
    // Event listener untuk input no label
    const noLabelInput = document.getElementById('no_label_input');
    if (noLabelInput) {
        // console.log('✅ [INIT] Input no label ditemukan');
        
        noLabelInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                // console.log('↩️ [INPUT] Enter ditekan, submit form no label');
                document.getElementById('noLabelForm')?.submit();
            }
        });
        
        noLabelInput.addEventListener('input', function() {
            const noLabelError = document.getElementById('noLabelError');
            if (this.value.trim()) {
                if (noLabelError) noLabelError.style.display = 'none';
                this.classList.remove('is-invalid');
            }
        });
    } else {
        // console.warn('⚠️ [INIT] Input no label tidak ditemukan');
    }
    
    // Cek flash data
    // console.log('🔍 [INIT] Memeriksa flash data...');
    window.checkFlashData();
    
    // Cek pending print
    // console.log('🔍 [INIT] Memeriksa pending print...');
    checkPendingPrint();
    
    // Auto intercept form berdasarkan halaman
    const path = window.location.pathname;
    // console.log('📁 [INIT] Current path:', path);
    
    const formIntercepts = [
        { path: 'inside_micrometer', type: 'inside_micrometer' },
        { path: 'outside_micrometer', type: 'outside_micrometer' },
        { path: 'caliper', type: 'caliper' },
        { path: 'depth_micrometer', type: 'depth_micrometer' },
        { path: 'thermometer', type: 'thermometer' },
        { path: 'dial_indicator', type: 'dial_indicator' }
    ];
    
    let intercepted = false;
    for (let item of formIntercepts) {
        if (path.includes(item.path)) {
            // console.log(`🎯 [INIT] Mendeteksi form ${item.type}, memasang intercept...`);
            window.interceptFormSubmit('kalibrasiForm', item.type);
            intercepted = true;
            break;
        }
    }
    
    if (!intercepted) {
        // console.log('ℹ️ [INIT] Tidak ada form yang cocok untuk intercept');
    }
    
    // console.log('='.repeat(60));
});

// ==================== FUNGSI TEST PRINT ====================

// window.testPrint = async function() {
//     console.log('='.repeat(60));
//     console.log('🧪 TEST PRINT FUNCTION');
//     console.log('='.repeat(60));
    
//     // Data dummy
//     const calibrationId = 9999;
//     const noLabel = 'TEST-' + new Date().getTime().toString().slice(-6);
//     const tanggal = new Date().toLocaleDateString('id-ID', {
//         day: '2-digit',
//         month: '2-digit',
//         year: 'numeric'
//     }).replace(/\//g, '/');
    
//     console.log('📋 Test data:', { calibrationId, noLabel, tanggal });
    
//     // Cek library
//     if (!window.niimbot) {
//         console.error('❌ Library NIIMBOT tidak ditemukan');
//         return false;
//     }
    
//     // Cek koneksi
//     if (!window.niimbot.isConnected()) {
//         console.log('⏳ Printer tidak terhubung, mencoba connect...');
//         const connected = await window.niimbot.connect();
//         if (!connected) {
//             console.error('❌ Gagal connect printer');
//             return false;
//         }
//     }
    
//     // Panggil print
//     return await window.printLabel(calibrationId, noLabel, tanggal);
// };

// // Untuk test cepat di console
// window.testPrintNow = function() {
//     window.testPrint().then(result => {
//         console.log('Test selesai, hasil:', result);
//     });
// };