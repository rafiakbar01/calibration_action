<?php
// app/Helpers/LogHelper.php

if (!function_exists('buat_log_kalibrasi')) {
    /**
     * Fungsi helper untuk membuat log kalibrasi
     */
    function buat_log_kalibrasi($kalibrasi_id, $aksi, $deskripsi = null, $data_lama = null, $data_baru = null)
    {
        $user = auth()->user();
        
        $log = new \App\Models\LogKalibrasi();
        
        $log->kalibrasi_id = $kalibrasi_id;
        $log->aksi = $aksi;
        $log->deskripsi = $deskripsi;
        $log->data_lama = $data_lama;
        $log->data_baru = $data_baru;
        $log->alamat_ip = request()->ip();
        $log->user_agent = request()->userAgent();
        $log->user_id = $user ? $user->id : null;
        
        return $log->save();
    }
}