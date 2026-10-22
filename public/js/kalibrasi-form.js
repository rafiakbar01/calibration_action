// public/js/kalibrasi-form.js

// Fungsi untuk validasi form dan menampilkan modal no label
window.validateAndShowModal = function() {
    const form = document.getElementById('kalibrasiForm');
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    let firstInvalidField = null;
    
    // Reset style validation
    requiredFields.forEach(field => {
        if (field.type !== 'radio' && field.type !== 'checkbox') {
            field.style.borderColor = '#ced4da';
        }
    });

    // Validasi field required
    requiredFields.forEach(field => {
        if (field.type === 'radio') {
            const radioGroup = document.getElementsByName(field.name);
            let radioChecked = false;
            radioGroup.forEach(radio => {
                if (radio.checked) {
                    radioChecked = true;
                }
            });
            if (!radioChecked) {
                isValid = false;
            }
        } else if (field.type === 'checkbox') {
            // Skip checkbox karena kita validasi terpisah
        } else {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#dc3545';
                if (!firstInvalidField) firstInvalidField = field;
            }
        }
    });

    // Validasi alat standar
    const alatStandar = document.querySelectorAll('input[name="alat_standar[]"]:checked');
    if (alatStandar.length === 0) {
        isValid = false;
        alert('Pilih minimal 1 alat standar!');
        return;
    }

    if (!isValid) {
        alert('Harap isi semua field yang wajib diisi!');
        if (firstInvalidField) {
            firstInvalidField.focus();
        }
        return;
    }

    // Jika semua validasi lulus, tampilkan modal input no label
    try {
        const modalElement = document.getElementById('noLabelModal');
        const modal = new bootstrap.Modal(modalElement);
        
        // Reset input dan error
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
        
        // Focus pada input setelah modal ditampilkan
        setTimeout(() => {
            if (noLabelInput) {
                noLabelInput.focus();
            }
        }, 500);
    } catch (e) {
        console.error('Error showing modal:', e);
        alert('Terjadi kesalahan. Silakan refresh halaman.');
    }
};

// Fungsi untuk submit form dengan no label
window.submitWithNoLabel = function() {
    const noLabelInput = document.getElementById('no_label_input');
    const noLabelError = document.getElementById('noLabelError');
    const noLabelHidden = document.getElementById('no_label_hidden');
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
    if (noLabelHidden) {
        noLabelHidden.value = noLabelValue;
    }
    
    // Submit form
    const form = document.getElementById('kalibrasiForm');
    const submitBtn = document.querySelector('button[onclick="validateAndShowModal()"]');
    
    // Ganti ke button loading state
    if (submitBtn) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    }
    
    // Tutup modal
    try {
        const modalElement = document.getElementById('noLabelModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        }
    } catch (e) {
        console.error('Error closing modal:', e);
    }
    
    // Submit form
    form.submit();
};

// Event listener untuk input no label
document.addEventListener('DOMContentLoaded', function() {
    const noLabelInput = document.getElementById('no_label_input');
    if (noLabelInput) {
        noLabelInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                window.submitWithNoLabel();
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