// ============================================
// FORM HELPER FUNCTIONS
// ============================================

console.log('=== FORM HELPER SCRIPT LOADED ===');

// Format input number with decimal
function formatInputNumber(input) {
    let value = input.value;
    // Remove non-numeric characters except decimal point
    value = value.replace(/[^\d.]/g, '');
    
    // Ensure only one decimal point
    const parts = value.split('.');
    if (parts.length > 2) {
        value = parts[0] + '.' + parts.slice(1).join('');
    }
    
    // Limit to 2 decimal places
    if (parts.length === 2) {
        value = parts[0] + '.' + parts[1].substring(0, 2);
    }
    
    input.value = value;
}

// Format Type Alat
function formatTypeAlat(input) {
    input.value = input.value.toUpperCase();
}

// Format No. Seri
function formatNoSeri(input) {
    input.value = input.value.replace(/\s+/g, '').toUpperCase();
}

// Update kapasitas automatically
function updateKapasitas() {
    const maxInput = document.getElementById('rentang_ukur_max');
    const kapasitasInput = document.getElementById('kapasitas');
    
    if (maxInput && kapasitasInput && maxInput.value) {
        kapasitasInput.value = maxInput.value;
    }
}

// Form validation
function setupFormValidation() {
    const form = document.getElementById('kalibrasiForm');
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        const requiredInputs = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Harap lengkapi semua field yang wajib diisi!');
        }
    });
    
    // Reset form
    const resetBtn = document.querySelector('button[type="reset"]');
    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            if (confirm('Apakah Anda yakin ingin mereset form? Semua data akan hilang.')) {
                // Form akan direset otomatis oleh browser
                console.log('Form reset initiated');
            } else {
                e.preventDefault();
            }
        });
    }
    
    // Set default dates
    const today = new Date().toISOString().split('T')[0];
    const tanggalMasuk = document.querySelector('input[name="tanggal_alat_masuk"]');
    const tanggalKalibrasi = document.querySelector('input[name="tanggal_kalibrasi"]');
    
    if (tanggalMasuk) tanggalMasuk.value = today;
    if (tanggalKalibrasi) tanggalKalibrasi.value = today;
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('Form helpers initializing...');
    setupFormValidation();
    
    // Attach event listeners to relevant inputs
    document.querySelectorAll('input[oninput*="formatInputNumber"]').forEach(input => {
        input.addEventListener('input', function() {
            formatInputNumber(this);
        });
    });
    
    document.querySelectorAll('input[oninput*="formatTypeAlat"]').forEach(input => {
        input.addEventListener('input', function() {
            formatTypeAlat(this);
        });
    });
    
    document.querySelectorAll('input[oninput*="formatNoSeri"]').forEach(input => {
        input.addEventListener('input', function() {
            formatNoSeri(this);
        });
    });
    
    document.querySelectorAll('input[oninput*="updateKapasitas"]').forEach(input => {
        input.addEventListener('input', function() {
            updateKapasitas();
        });
    });
    
    console.log('Form helpers initialized');
});

// Make functions available globally
window.formatInputNumber = formatInputNumber;
window.formatTypeAlat = formatTypeAlat;
window.formatNoSeri = formatNoSeri;
window.updateKapasitas = updateKapasitas;