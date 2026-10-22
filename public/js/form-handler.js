// public/js/form-handler.js

// Fungsi untuk toggle input manual dan sync nilai
function toggleManualInput(selectedValue) {
    console.log('📝 toggleManualInput called with:', selectedValue);
    
    const manualInputContainer = document.getElementById('manualInputContainer');
    const manualInput = document.getElementById('nama_alat_manual');
    const namaAlatFinalInput = document.getElementById('nama_alat_final');
    
    if (selectedValue === 'MANUAL_INPUT') {
        // Tampilkan input manual
        if (manualInputContainer) {
            manualInputContainer.style.display = 'block';
            console.log('📋 Manual input container shown');
        }
        if (manualInput) {
            manualInput.value = ''; // Kosongkan
            manualInput.focus(); // Focus ke input manual
            manualInput.required = true; // Wajib diisi
        }
        if (namaAlatFinalInput) {
            namaAlatFinalInput.value = ''; // Kosongkan dulu
        }
    } else {
        // Sembunyikan input manual
        if (manualInputContainer) {
            manualInputContainer.style.display = 'none';
            console.log('📋 Manual input container hidden');
        }
        if (manualInput) {
            manualInput.value = ''; // Kosongkan
            manualInput.required = false; // Tidak wajib
        }
        if (namaAlatFinalInput) {
            namaAlatFinalInput.value = selectedValue; // Simpan nilai dropdown
            console.log('💾 nama_alat_final set to:', selectedValue);
        }
    }
}

// Fungsi untuk sync nilai dari input manual ke hidden input
function syncNamaAlat() {
    const manualInput = document.getElementById('nama_alat_manual');
    const namaAlatFinalInput = document.getElementById('nama_alat_final');
    const selectElement = document.getElementById('nama_alat_select');
    
    if (manualInput && namaAlatFinalInput && selectElement) {
        if (selectElement.value === 'MANUAL_INPUT' && manualInput.value.trim() !== '') {
            namaAlatFinalInput.value = manualInput.value.trim();
            console.log('🔄 nama_alat_final synced:', namaAlatFinalInput.value);
        }
    }
}

// Setup saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Form handler initialized');
    
    // Cek elemen yang diperlukan
    const selectElement = document.getElementById('nama_alat_select');
    const manualInput = document.getElementById('nama_alat_manual');
    const namaAlatFinalInput = document.getElementById('nama_alat_final');
    const form = document.querySelector('form');
    
    // Pastikan hidden input untuk nama_alat_final ada
    if (!namaAlatFinalInput) {
        console.warn('⚠️ nama_alat_final input not found, creating...');
        
        // Buat hidden input jika belum ada
        const newHiddenInput = document.createElement('input');
        newHiddenInput.type = 'hidden';
        newHiddenInput.name = 'nama_alat_final';
        newHiddenInput.id = 'nama_alat_final';
        newHiddenInput.value = '';
        
        // Temukan form dan tambahkan
        if (form) {
            form.appendChild(newHiddenInput);
            console.log('➕ Created nama_alat_final hidden input');
        }
    }
    
    // Setup event listeners untuk input manual
    if (manualInput) {
        manualInput.addEventListener('input', syncNamaAlat);
        manualInput.addEventListener('blur', syncNamaAlat);
        console.log('✅ Added event listeners to manual input');
    }
    
    // Setup event listener untuk dropdown
    if (selectElement) {
        selectElement.addEventListener('change', function() {
            toggleManualInput(this.value);
        });
        console.log('✅ Added event listener to select element');
        
        // Initialize berdasarkan nilai awal
        if (selectElement.value) {
            console.log('🎯 Initializing with existing value:', selectElement.value);
            toggleManualInput(selectElement.value);
        }
    }
    
    // Handle form submission
    if (form) {
        console.log('✅ Form found, setting up submit handler');
        
        form.addEventListener('submit', function(e) {
            console.log('📤 Form submission started');
            
            const selectElement = document.getElementById('nama_alat_select');
            const manualInput = document.getElementById('nama_alat_manual');
            const namaAlatFinalInput = document.getElementById('nama_alat_final');
            
            // Validasi form
            let isValid = true;
            let errorMessage = '';
            
            // Validasi dropdown
            if (!selectElement || selectElement.value === '') {
                isValid = false;
                errorMessage = 'Silakan pilih jenis alat volumetrik dari dropdown!';
                console.warn('❌ Dropdown validation failed');
            }
            
            // Validasi input manual jika dipilih
            if (selectElement && selectElement.value === 'MANUAL_INPUT') {
                console.log('🔧 Manual input selected');
                
                if (!manualInput || manualInput.value.trim() === '') {
                    isValid = false;
                    errorMessage = 'Silakan isi nama alat volumetrik secara manual!';
                    console.warn('❌ Manual input validation failed');
                } else {
                    // Pastikan nama_alat_final sudah terisi
                    if (namaAlatFinalInput) {
                        namaAlatFinalInput.value = manualInput.value.trim();
                        console.log('💾 Final nama alat set to:', namaAlatFinalInput.value);
                    }
                }
            }
            
            // Tampilkan error jika ada
            if (!isValid) {
                e.preventDefault();
                alert(errorMessage);
                
                // Focus ke field yang error
                if (selectElement && selectElement.value === '') {
                    selectElement.focus();
                } else if (selectElement && selectElement.value === 'MANUAL_INPUT' && manualInput) {
                    manualInput.focus();
                }
                
                return false;
            }
            
            // Pastikan nama_alat_final terisi untuk kasus dropdown biasa
            if (selectElement && selectElement.value !== 'MANUAL_INPUT' && namaAlatFinalInput) {
                namaAlatFinalInput.value = selectElement.value;
                console.log('💾 Final nama alat (dropdown):', namaAlatFinalInput.value);
            }
            
            // Pastikan form_type selalu 'volumetrik'
            let formTypeInput = document.getElementById('form_type_input');
            if (!formTypeInput) {
                formTypeInput = document.createElement('input');
                formTypeInput.type = 'hidden';
                formTypeInput.name = 'form_type';
                formTypeInput.id = 'form_type_input';
                formTypeInput.value = 'volumetrik';
                this.appendChild(formTypeInput);
                console.log('➕ Created form_type hidden input');
            }
            
            // Log data sebelum submit
            console.log('📋 Data to be submitted:', {
                'nama_alat_select': selectElement ? selectElement.value : 'N/A',
                'nama_alat_manual': manualInput ? manualInput.value : 'N/A',
                'nama_alat_final': namaAlatFinalInput ? namaAlatFinalInput.value : 'N/A',
                'form_type': 'volumetrik'
            });
            
            console.log('✅ Form validation passed, submitting...');
            return true;
        });
    } else {
        console.warn('⚠️ Form element not found');
    }
    
    // Helper function untuk update form type (jika masih digunakan di tempat lain)
    window.updateFormType = function(selectedAlat) {
        console.log('📝 updateFormType called with:', selectedAlat);
        
        // Update hidden input - SEMUA alat menggunakan form volumetrik
        const formTypeInput = document.getElementById('form_type_input');
        if (formTypeInput) {
            formTypeInput.value = 'volumetrik';
            console.log('✅ Form type set to: volumetrik');
        }
        
        // Juga panggil toggleManualInput untuk konsistensi
        toggleManualInput(selectedAlat);
    };
});

// Function untuk di-call dari inline onchange (jika masih ada)
function updateFormType(selectedValue) {
    if (typeof window.updateFormType === 'function') {
        window.updateFormType(selectedValue);
    } else {
        // Fallback jika function belum tersedia
        console.log('🔄 updateFormType fallback called');
        const manualInputContainer = document.getElementById('manualInputContainer');
        const manualInput = document.querySelector('input[name="nama_alat_manual"]');
        
        if (selectedValue === 'MANUAL_INPUT') {
            if (manualInputContainer) manualInputContainer.style.display = 'block';
            if (manualInput) {
                manualInput.value = '';
                manualInput.focus();
                manualInput.required = true;
            }
        } else {
            if (manualInputContainer) manualInputContainer.style.display = 'none';
            if (manualInput) {
                manualInput.value = '';
                manualInput.required = false;
            }
        }
    }
}