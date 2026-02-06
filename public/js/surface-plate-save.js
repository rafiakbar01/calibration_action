// ============================================
// SURFACE PLATE SAVE MODULE - ID VERSION
// ============================================

// console.log('💾 Surface Plate Save Module - ID Version');

// Variables
let saveModuleInitialized = false;

// ============================================
// CORE FUNCTIONS
// ============================================

function saveCanvasToInput() {
    // console.log('💾 Saving canvas to input...');
    
    const canvas = document.getElementById('drawCanvas');
    if (!canvas) {
        console.error('Canvas not found');
        return false;
    }
    
    try {
        // PERBAIKAN: Gunakan PNG dengan background putih eksplisit
        // 1. Buat canvas temporary dengan background putih
        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = canvas.width;
        tempCanvas.height = canvas.height;
        const tempCtx = tempCanvas.getContext('2d');
        
        // 2. Fill background putih
        tempCtx.fillStyle = '#FFFFFF';
        tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
        
        // 3. Draw original canvas content
        tempCtx.drawImage(canvas, 0, 0);
        
        // 4. Convert ke PNG dengan kualitas baik
        const imageData = tempCanvas.toDataURL('image/png', 1.0); // Quality 1.0 (max)
        
        // 5. Simpan ke input
        const input = document.getElementById('keterangan');
        
        if (input) {
            input.value = imageData;
            const sizeKB = Math.round(imageData.length / 1024);
            
            
            
            return true;
        } else {
            console.error('❌ Keterangan input not found');
            return false;
        }
        
    } catch (error) {
        console.error('Save error:', error);
        return false;
    }
}

function isCanvasEmpty(canvas) {
    try {
        const ctx = canvas.getContext('2d');
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
        
        // Cek jika semua pixel putih
        for (let i = 0; i < imageData.length; i += 4) {
            if (imageData[i] !== 255 || imageData[i+1] !== 255 || imageData[i+2] !== 255) {
                return false;
            }
        }
        return true;
    } catch (error) {
        return true;
    }
}

// ============================================
// MAIN SAVE BUTTON HANDLER (UNTUK #savebutton)
// ============================================

function setupSaveButtonHandler() {
    // console.log('🎯 Setting up save button handler for #savebutton');
    
    // Cari tombol dengan ID savebutton
    const saveButton = document.getElementById('savebutton');
    
    if (!saveButton) {
        console.error('❌ Save button with ID #savebutton not found!');
        return false;
    }
    
    // console.log('✅ Found save button:', saveButton.textContent.trim());
    
    // Clone tombol untuk clear event listeners lama
    const newButton = saveButton.cloneNode(true);
    saveButton.parentNode.replaceChild(newButton, saveButton);
    
    // Tambah event listener baru
    newButton.addEventListener('click', function(event) {
        // console.log('🖱️ SAVE BUTTON CLICKED! ID: #savebutton');
        
        // 1. Cegah form submit sementara
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        
        // 2. Simpan canvas terlebih dahulu
        // console.log('💾 Saving canvas before submit...');
        const saved = saveCanvasToInput();
        
        if (!saved) {
            console.warn('⚠️ Canvas save failed or canvas empty');
        }
        
        // 3. Debug: cek input setelah save
        const input = document.getElementById('keterangan');
        if (input && input.value) {
            const sizeKB = Math.round(input.value.length / 1024);
            // console.log('🔍 Input setelah save:', {
            //     size: sizeKB + ' KB',
            //     isImage: input.value.startsWith('data:image'),
            //     first50: input.value.substring(0, 50) + '...'
            // });
        }
        
        // 4. Ubah teks tombol untuk feedback
        const originalHTML = newButton.innerHTML;
        newButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        newButton.disabled = true;
        
        // 5. Submit form setelah 300ms (biarkan data tersimpan)
        setTimeout(() => {
            // console.log('🚀 Submitting form...');
            
            if (saved) {
                console.log('✅ Form submitted WITH canvas image');
            } else {
                console.log('⚠️ Form submitted WITHOUT canvas image');
            }
            
            // Submit form
            newButton.form.submit();
        }, 300);
        
        return false;
    });
    
    // console.log('✅ Save button handler setup complete!');
    return true;
}

// ============================================
// BUTTON SETUP - HIDE TEST BUTTONS
// ============================================

function setupButtons() {
    // console.log('🔧 Setting up buttons...');
    
    // Hide tombol test (tapi tetap ada fungsi-nya untuk backup)
    const testBtn = document.getElementById('testSaveBtn');
    const checkBtn = document.getElementById('checkInputBtn');
    
    if (testBtn) {
        testBtn.style.display = 'none';
        console.log('✅ Hidden testSaveBtn');
    }
    
    if (checkBtn) {
        checkBtn.style.display = 'none';
        console.log('✅ Hidden checkInputBtn');
    }
}

function setupButton(buttonId, clickHandler, buttonName) {
    const button = document.getElementById(buttonId);
    if (!button) {
        console.log(`❌ ${buttonName} button not found: #${buttonId}`);
        return;
    }
    
    // Clone untuk clear event listeners
    const newButton = button.cloneNode(true);
    button.parentNode.replaceChild(newButton, button);
    
    // Add fresh event listener
    newButton.addEventListener('click', function(e) {
        e.preventDefault();
        console.log(`🖱️ ${buttonName} button clicked`);
        clickHandler();
    });
    
    console.log(`✅ ${buttonName} button setup done`);
}

// ============================================
// BACKUP FORM SUBMIT HANDLER
// ============================================

function setupFormSubmitHandler() {
    const form = document.querySelector('form');
    if (!form) {
        console.warn('❌ Form not found');
        return;
    }
    
    console.log('✅ Setting up backup form submit handler');
    
    form.addEventListener('submit', function(e) {
        console.log('📤 Backup form submit triggered');
        
        // Simpan canvas sebelum submit (backup)
        saveCanvasToInput();
        
        // Biarkan form submit berjalan normal
        return true;
    });
}

// ============================================
// INITIALIZATION
// ============================================

function initializeSaveModule() {
    if (saveModuleInitialized) {
        console.log('⏹️ Save module already initialized');
        return;
    }
    
    // console.log('🚀 Initializing save module...');
    
    // Cek semua element yang diperlukan
    const canvas = document.getElementById('drawCanvas');
    const keteranganInput = document.getElementById('keterangan');
    const saveButton = document.getElementById('savebutton');
    
    if (!canvas) {
        // console.log('⏳ Canvas not found, retrying...');
        setTimeout(initializeSaveModule, 1000);
        return;
    }
    
    if (!keteranganInput) {
        // console.error('❌ Keterangan input (#keterangan) not found!');
        return;
    }
    
    if (!saveButton) {
        // console.error('❌ Save button (#savebutton) not found!');
        return;
    }
    
    // console.log('✅ All required elements found!');
    
    // Setup save button handler (UTAMA)
    const buttonSetup = setupSaveButtonHandler();
    
    // Setup backup handlers
    setupFormSubmitHandler();
    setupButtons();
    
    // Setup test buttons (hidden but functional)
    setupButton('testSaveBtn', testSaveCanvas, 'Test Save');
    setupButton('checkInputBtn', checkKeteranganInput, 'Check Input');
    
    saveModuleInitialized = true;
    // console.log('✅ Save module INITIALIZED');
}

// ============================================
// DEBUG & UTILITY FUNCTIONS
// ============================================

// Fungsi test save (untuk debugging)
function testSaveCanvas() {
    // console.log('🧪 TEST SAVE button clicked!');
    
    try {
        const canvas = document.getElementById('drawCanvas');
        if (!canvas) {
            alert('❌ Canvas not found!');
            return;
        }
        
        const ctx = canvas.getContext('2d');
        
        // Draw test jika canvas kosong
        if (isCanvasEmpty(canvas)) {
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            ctx.fillStyle = '#007bff';
            ctx.fillRect(20, 20, 50, 50);
            
            ctx.strokeStyle = '#dc3545';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(50, 50);
            ctx.lineTo(150, 150);
            ctx.stroke();
            
            // console.log('✅ Test drawing created');
        }
        
        // Simpan ke input
        saveCanvasToInput();
        
    } catch (error) {
        console.error('Error:', error);
        alert('Error: ' + error.message);
    }
}

function checkKeteranganInput() {
    // console.log('🔍 CHECK INPUT button clicked!');
    
    const input = document.getElementById('keterangan');
    if (!input) {
        alert('❌ Input #keterangan not found!');
        return;
    }
    
    const sizeKB = Math.round(input.value.length / 1024);
    const isImage = input.value.startsWith('data:image');
    
    alert(`Input Info:\n\n` +
          `ID: ${input.id}\n` +
          `Name: ${input.name}\n` +
          `Value Length: ${input.value.length} chars\n` +
          `Size: ${sizeKB} KB\n` +
          `Is Image: ${isImage ? '✅ YES' : '❌ NO'}\n` +
          `First 50 chars: ${input.value.substring(0, 50)}...`);
}

window.forceSaveCanvas = function() {
    // console.log('💪 FORCE SAVING canvas...');
    const saved = saveCanvasToInput();
    if (saved) {
        alert('✅ Canvas force saved!');
    } else {
        alert('❌ Force save failed!');
    }
};

window.debugCanvasInfo = function() {
    // console.log('🔍 DEBUG CANVAS INFO:');
    
    const canvas = document.getElementById('drawCanvas');
    const input = document.getElementById('keterangan');
    
    if (canvas) {
        // console.log('Canvas:', {
        //     width: canvas.width,
        //     height: canvas.height,
        //     isEmpty: isCanvasEmpty(canvas)
        // });
    }
    
    if (input) {
        const sizeKB = Math.round(input.value.length / 1024);
        // console.log('Input:', {
        //     id: input.id,
        //     name: input.name,
        //     valueLength: input.value.length,
        //     sizeKB: sizeKB,
        //     isImage: input.value.startsWith('data:image')
        // });
    }
    
    // Test save langsung
    saveCanvasToInput();
};

// ============================================
// STARTUP
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // console.log('📄 DOM loaded, starting save module...');
    
    // Tunggu 1.5 detik untuk pastikan canvas script loaded
    setTimeout(() => {
        initializeSaveModule();
    }, 1500);
});

// Export functions
window.saveCanvasToInput = saveCanvasToInput;
window.testSaveCanvas = testSaveCanvas;
window.checkKeteranganInput = checkKeteranganInput;

// console.log('✅ Surface Plate Save Module loaded');