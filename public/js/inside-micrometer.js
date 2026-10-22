// public/js/inside-micrometer-format.js - KHUSUS INSIDE MICROMETER

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Inside Micrometer Format JS loaded');
    
    // Inisialisasi fungsi update kapasitas
    window.updateKapasitas = function() {
        const maxInput = document.getElementById('rentang_ukur_max');
        const kapasitasInput = document.getElementById('kapasitas');
        
        if (maxInput && kapasitasInput) {
            const maxValue = parseFloat(maxInput.value);
            if (!isNaN(maxValue)) {
                kapasitasInput.value = maxValue.toFixed(1);
            } else {
                kapasitasInput.value = '';
            }
        }
    };
    
    // Fungsi format input number
    window.formatNumberInput = function(input) {
        let value = input.value;
        value = value.replace(',', '.');
        
        const dotCount = (value.match(/\./g) || []).length;
        if (dotCount > 1) {
            const firstPart = value.substring(0, value.indexOf('.') + 1);
            const lastPart = value.substring(value.lastIndexOf('.') + 1);
            value = firstPart + lastPart.replace(/\./g, '');
        }
        
        if (value !== input.value) {
            input.value = value;
        }
    };
    
    // Fungsi format Type Alat
    window.formatTypeAlat = function(input) {
        const regex = /[^A-Za-z0-9\s.,\-\/()"'&]/g;
        if (regex.test(input.value)) {
            input.value = input.value.replace(regex, '');
        }
    };
    
    // Fungsi format No. Seri
    window.formatNoSeri = function(input) {
        const regex = /[^A-Za-z0-9.,\-\/]/g;
        if (regex.test(input.value)) {
            input.value = input.value.replace(regex, '');
        }
    };
    
    // Fungsi validasi form
    window.validateForm = function() {
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
                // Skip
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
            return false;
        }

        if (!isValid) {
            alert('Harap isi semua field yang wajib diisi!');
            if (firstInvalidField) {
                firstInvalidField.focus();
            }
            return false;
        }

        return true;
    };
    
    // Inisialisasi
    window.updateKapasitas();
    
    // Event listener untuk rentang ukur max
    const maxInput = document.getElementById('rentang_ukur_max');
    if (maxInput) {
        maxInput.addEventListener('input', window.updateKapasitas);
        maxInput.addEventListener('paste', function(e) {
            setTimeout(window.updateKapasitas, 10);
        });
    }
    
    // Event listener untuk semua input number
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach(input => {
        input.addEventListener('paste', function(e) {
            setTimeout(() => window.formatNumberInput(this), 10);
        });
        input.addEventListener('input', function(e) {
            window.formatNumberInput(this);
        });
    });
    
    // Event listener untuk format Type Alat
    const typeAlatInput = document.querySelector('input[name="type_alat"]');
    if (typeAlatInput) {
        typeAlatInput.addEventListener('input', function() {
            window.formatTypeAlat(this);
        });
    }
    
    // Event listener untuk format No Seri
    const noSeriInput = document.querySelector('input[name="no_seri"]');
    if (noSeriInput) {
        noSeriInput.addEventListener('input', function() {
            window.formatNoSeri(this);
        });
    }
});