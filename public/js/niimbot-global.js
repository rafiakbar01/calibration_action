// // public/js/niimbot-global.js - Menggunakan @mmote/niimbluelib dengan CDN yang benar
// console.log('🚀 NIIMBOT: Menggunakan @mmote/niimbluelib');

// // Fungsi untuk load library
// function loadLibrary() {
//     return new Promise((resolve, reject) => {
//         // Cek apakah sudah terload
//         if (window.niimbluelib) {
//             console.log('✅ Library already loaded');
//             resolve(window.niimbluelib);
//             return;
//         }

//         // Load script dari CDN yang benar - gunakan jsdelivr dengan format umd
//         const script = document.createElement('script');
//         script.src = 'https://cdn.jsdelivr.net/npm/@mmote/niimbluelib@latest/dist/index.umd.js';
        
//         script.onload = () => {
//             console.log('✅ Library loaded from CDN');
//             // Library akan tersedia di window.niimbluelib
//             setTimeout(() => {
//                 if (window.niimbluelib) {
//                     console.log('📦 Library siap digunakan');
//                     resolve(window.niimbluelib);
//                 } else {
//                     reject('Library loaded but namespace not found');
//                 }
//             }, 500);
//         };
        
//         script.onerror = (error) => {
//             console.error('❌ Failed to load library:', error);
//             reject('Gagal load library');
//         };
        
//         document.head.appendChild(script);
        
//         setTimeout(() => reject('Timeout loading library'), 10000);
//     });
// }

// // Inisialisasi
// (async function() {
//     try {
//         console.log('⏳ Menunggu library...');
//         const lib = await loadLibrary();
//         console.log('✅ Library siap digunakan');
        
//         // Setup window.niimbot dengan library
//         window.niimbot = {
//             lib: lib,
//             client: null,
//             isConnected: false,
//             printerInfo: null,

//             hasPrinter() {
//                 return localStorage.getItem('niimbot_printer') !== null;
//             },

//             getPrinterInfo() {
//                 const saved = localStorage.getItem('niimbot_printer');
//                 return saved ? JSON.parse(saved) : null;
//             },

//             savePrinterInfo(name) {
//                 localStorage.setItem('niimbot_printer', JSON.stringify({
//                     name: name,
//                     timestamp: Date.now()
//                 }));
//             },

//             clearPrinterInfo() {
//                 localStorage.removeItem('niimbot_printer');
//             },

//             async connect() {
//                 try {
//                     console.log('🔍 Inisialisasi client NIIMBOT...');
                    
//                     // Cek ketersediaan class
//                     if (!this.lib.NiimbotWebBluetoothClient) {
//                         console.error('Class tidak ditemukan. Yang tersedia:', Object.keys(this.lib));
//                         throw new Error('NiimbotWebBluetoothClient tidak ditemukan');
//                     }
                    
//                     // Buat client Bluetooth Web
//                     this.client = new this.lib.NiimbotWebBluetoothClient();
                    
//                     // Event listeners
//                     this.client.on('connected', () => {
//                         console.log('✅ Printer connected');
//                         this.isConnected = true;
//                     });
                    
//                     this.client.on('disconnected', () => {
//                         console.log('🔌 Printer disconnected');
//                         this.isConnected = false;
//                         this.printerInfo = null;
//                         this.clearPrinterInfo();
//                     });
                    
//                     this.client.on('error', (error) => {
//                         console.error('❌ Printer error:', error);
//                     });
                    
//                     // Connect ke printer
//                     console.log('📡 Mencari printer...');
//                     await this.client.connect();
                    
//                     // Ambil informasi printer
//                     try {
//                         this.printerInfo = await this.client.fetchPrinterInfo();
//                         console.log('📋 Printer info:', this.printerInfo);
//                     } catch (e) {
//                         console.log('Info printer tidak tersedia');
//                     }
                    
//                     this.savePrinterInfo(this.client.deviceName || 'NIIMBOT Printer');
                    
//                     console.log('✅ Printer siap digunakan');
//                     return { success: true, deviceName: this.client.deviceName || 'NIIMBOT Printer' };
                    
//                 } catch (error) {
//                     console.error('❌ Gagal connect:', error);
                    
//                     if (error.message && error.message.includes('cancel')) {
//                         return { success: false, error: 'cancelled' };
//                     }
                    
//                     return { success: false, error: error.message };
//                 }
//             },

//             async testPrint() {
//                 if (!this.client || !this.isConnected) {
//                     throw new Error('Printer belum connect');
//                 }

//                 try {
//                     console.log('🖨️ Test print dengan library...');
                    
//                     // Buat canvas
//                     const canvas = document.createElement('canvas');
//                     canvas.width = 240;
//                     canvas.height = 400;
//                     const ctx = canvas.getContext('2d');
                    
//                     // Background putih
//                     ctx.fillStyle = '#FFFFFF';
//                     ctx.fillRect(0, 0, canvas.width, canvas.height);
                    
//                     // Gambar pola test
//                     ctx.fillStyle = '#000000';
//                     ctx.fillRect(50, 50, 140, 100);
//                     ctx.fillRect(100, 200, 40, 40);
                    
//                     // Garis horizontal
//                     for (let i = 0; i < 10; i++) {
//                         ctx.fillRect(20, 300 + i*10, 200, 2);
//                     }
                    
//                     // Teks
//                     ctx.font = '24px Arial';
//                     ctx.fillStyle = '#000000';
//                     ctx.textAlign = 'center';
//                     ctx.fillText('TEST PRINT', canvas.width/2, 380);
                    
//                     console.log('📤 Mengkonversi image...');
                    
//                     // Gunakan LabelUtils untuk konversi
//                     if (!this.lib.LabelUtils) {
//                         throw new Error('LabelUtils tidak ditemukan');
//                     }
                    
//                     const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
//                     const label = this.lib.LabelUtils.imageDataToLabel(imageData, {
//                         threshold: 128,
//                         density: 3
//                     });
                    
//                     // Print
//                     console.log('📤 Mengirim ke printer...');
//                     await this.client.printLabel(label);
                    
//                     console.log('✅ Test print selesai!');
//                     return { success: true };
                    
//                 } catch (error) {
//                     console.error('❌ Gagal print:', error);
//                     return { success: false, error: error.message };
//                 }
//             },

//             disconnect() {
//                 if (this.client) {
//                     this.client.disconnect();
//                     this.client = null;
//                     this.isConnected = false;
//                     this.clearPrinterInfo();
//                     console.log('🔌 Printer disconnected');
//                 }
//             },

//             isConnected() {
//                 return this.isConnected && this.client !== null;
//             },

//             getPrinterName() {
//                 return this.client?.deviceName || null;
//             }
//         };

//         console.log('✅ NIIMBOT Library Ready!');
//         console.log('   await window.niimbot.connect()');
//         console.log('   await window.niimbot.testPrint()');
        
//     } catch (error) {
//         console.error('❌ Gagal init library:', error);
//         window.niimbot = {
//             hasPrinter: () => false,
//             getPrinterInfo: () => null,
//             connect: async () => ({ success: false, error: 'Library gagal dimuat' }),
//             testPrint: async () => ({ success: false, error: 'Library gagal dimuat' }),
//             disconnect: () => {},
//             isConnected: () => false,
//             getPrinterName: () => null
//         };
//     }
// })();