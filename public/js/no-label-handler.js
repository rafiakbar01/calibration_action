// public/js/no-label-handler.js

document.addEventListener('DOMContentLoaded', function() {
    // Cek parameter di URL
    const urlParams = new URLSearchParams(window.location.search);
    const saveSuccess = urlParams.get('save_success');
    const calibrationId = urlParams.get('calibration_id');
    
    if (saveSuccess === 'true' && calibrationId) {
        // Tampilkan modal input no label
        showNoLabelModal(calibrationId);
        
        // Bersihkan URL (hapus parameter)
        const newUrl = window.location.pathname;
        window.history.replaceState({}, document.title, newUrl);
    }
});

function showNoLabelModal(calibrationId) {
    // Set calibration_id ke hidden input
    const idInput = document.getElementById('calibration_id_no_label');
    if (idInput) {
        idInput.value = calibrationId;
    }
    
    // Tampilkan modal
    try {
        const modalElement = document.getElementById('noLabelModal');
        const modal = new bootstrap.Modal(modalElement);
        
        // Reset input
        const noLabelInput = document.getElementById('no_label_input');
        const noLabelError = document.getElementById('noLabelError');
        
        if (noLabelInput) {
            noLabelInput.value = '';
            noLabelInput.classList.remove('is-invalid');
        }
        if (noLabelError) {
            noLabelError.style.display = 'none';
        }
        
        modal.show();
        
        // Focus otomatis
        setTimeout(() => {
            if (noLabelInput) {
                noLabelInput.focus();
            }
        }, 500);
    } catch (e) {
        console.error('Error showing modal:', e);
        alert('Terjadi kesalahan. Silakan refresh halaman.');
    }
}

// Fungsi untuk submit no label
window.submitNoLabel = function() {
    const noLabelInput = document.getElementById('no_label_input');
    const noLabelError = document.getElementById('noLabelError');
    const noLabelValue = noLabelInput ? noLabelInput.value.trim() : '';
    
    if (!noLabelValue) {
        if (noLabelError) {
            noLabelError.style.display = 'block';
        }
        if (noLabelInput) {
            noLabelInput.classList.add('is-invalid');
            noLabelInput.focus();
        }
        return;
    }
    
    // Set nilai no_label ke hidden input
    const noLabelHidden = document.getElementById('no_label_hidden');
    if (noLabelHidden) {
        noLabelHidden.value = noLabelValue;
    }
    
    // Submit form untuk update no_label
    const form = document.getElementById('noLabelForm');
    const submitBtn = document.querySelector('#noLabelModal .btn-primary');
    
    // Loading state
    if (submitBtn) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    }
    
    form.submit();
}

// Event listener untuk input no label
document.addEventListener('DOMContentLoaded', function() {
    const noLabelInput = document.getElementById('no_label_input');
    if (noLabelInput) {
        noLabelInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                window.submitNoLabel();
            }
        });
        
        noLabelInput.addEventListener('input', function() {
            const noLabelError = document.getElementById('noLabelError');
            if (this.value.trim()) {
                if (noLabelError) {
                    noLabelError.style.display = 'none';
                }
                this.classList.remove('is-invalid');
            }
        });
    }
});