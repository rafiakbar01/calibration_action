/**
 * Google Apps Script — Pemantau Folder Google Drive Realtime
 * PT PANANJUNG ANUGRAH SOLUTION
 * 
 * CARA SETUP:
 * 1. Paste script ini ke script.google.com
 * 2. Jalankan setupTrigger() SATU KALI untuk pasang trigger otomatis
 * 3. Selesai! Script akan otomatis cek setiap 1 menit
 */

// ============================================================================
// KONFIGURASI — Sesuaikan di sini
// ============================================================================
var CONFIG = {
  // URL endpoint server Anda (tidak perlu diubah)
  webhookUrl: 'https://pascalibration.com/gdrive_trigger.php',
  
  // Secret key pengaman
  secretKey: 'pas_gdrive_trigger_2026',
  
  // Cek file yang dibuat dalam berapa menit terakhir
  // (aman untuk trigger setiap 1 menit)
  recentMinutes: 3
};

// ============================================================================
// FUNGSI UTAMA — Dipanggil otomatis setiap 1 menit oleh trigger
// ============================================================================
function checkNewFilesAndNotify() {
  var now = new Date();
  var threshold = new Date(now.getTime() - (CONFIG.recentMinutes * 60 * 1000));
  
  // Dapatkan semua folder yang terdaftar dari server
  try {
    var response = UrlFetchApp.fetch(CONFIG.webhookUrl + '?action=get_folders&key=' + CONFIG.secretKey, {
      method: 'get',
      muteHttpExceptions: true,
      followRedirects: true,
      timeout: 10
    });
    
    var data = JSON.parse(response.getContentText());
    if (!data.success || !data.folders || data.folders.length === 0) {
      Logger.log('Tidak ada folder yang terdaftar atau gagal ambil daftar folder.');
      return;
    }
    
    var newFiles = [];
    
    // Periksa setiap folder
    for (var i = 0; i < data.folders.length; i++) {
      var folderId = data.folders[i];
      
      try {
        var folder = DriveApp.getFolderById(folderId);
        var files = folder.getFiles();
        
        while (files.hasNext()) {
          var file = files.next();
          var created = file.getDateCreated();
          
          // Hanya ambil file yang dibuat setelah threshold
          if (created >= threshold) {
            newFiles.push({
              fileId:    file.getId(),
              fileName:  file.getName(),
              folderId:  folderId,
              folderName: folder.getName(),
              createdAt: created.toISOString()
            });
            Logger.log('File baru ditemukan: ' + file.getName() + ' di folder: ' + folder.getName());
          }
        }
      } catch (folderErr) {
        Logger.log('Error akses folder ' + folderId + ': ' + folderErr.toString());
      }
    }
    
    // Kirim notifikasi ke server jika ada file baru
    if (newFiles.length > 0) {
      Logger.log('Total file baru: ' + newFiles.length + ' — mengirim notifikasi ke server...');
      
      var postResponse = UrlFetchApp.fetch(CONFIG.webhookUrl, {
        method: 'post',
        contentType: 'application/json',
        payload: JSON.stringify({
          key: CONFIG.secretKey,
          action: 'notify',
          files: newFiles,
          timestamp: now.toISOString()
        }),
        muteHttpExceptions: true,
        timeout: 30
      });
      
      Logger.log('Response server: ' + postResponse.getContentText());
    } else {
      Logger.log('Tidak ada file baru dalam ' + CONFIG.recentMinutes + ' menit terakhir.');
    }
    
  } catch (err) {
    Logger.log('Error: ' + err.toString());
  }
}

// ============================================================================
// SETUP TRIGGER — Jalankan fungsi ini SATU KALI saja dari menu Run
// ============================================================================
function setupTrigger() {
  // Hapus semua trigger lama untuk script ini
  var triggers = ScriptApp.getProjectTriggers();
  for (var i = 0; i < triggers.length; i++) {
    if (triggers[i].getHandlerFunction() === 'checkNewFilesAndNotify') {
      ScriptApp.deleteTrigger(triggers[i]);
    }
  }
  
  // Buat trigger baru setiap 1 menit
  ScriptApp.newTrigger('checkNewFilesAndNotify')
    .timeBased()
    .everyMinutes(1)
    .create();
  
  Logger.log('✅ Trigger berhasil dipasang! Script akan otomatis cek setiap 1 menit.');
  Logger.log('Test pertama berjalan dalam 1 menit...');
}

// ============================================================================
// TEST MANUAL — Jalankan untuk tes langsung tanpa menunggu trigger
// ============================================================================
function testManual() {
  Logger.log('Menjalankan pengecekan manual...');
  checkNewFilesAndNotify();
  Logger.log('Selesai!');
}
