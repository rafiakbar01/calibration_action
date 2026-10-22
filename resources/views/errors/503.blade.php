@extends('errors.layout')
@section('error_title', '503 - Layanan Tidak Tersedia')
@push('error_styles')
<style>
    .progress-bar-wrap{background:#dbeafe;border-radius:100px;height:6px;overflow:hidden;margin:1.5rem 0}
    .progress-bar-fill{height:100%;background:linear-gradient(90deg,#3b82f6,#60a5fa);border-radius:100px;animation:prog 30s linear forwards}
    @keyframes prog{from{width:0%}to{width:100%}}
</style>
@endpush
@section('error_content')
<div class="badge"><span class="dot" style="background:#f59e0b"></span>HTTP 503</div>
<div class="ecode">503</div>
<span class="eicon">&#x1F6E0;</span>
<h1 class="etitle">Sedang Pemeliharaan</h1>
<p class="edesc">
    Sistem sedang dalam pemeliharaan terjadwal.<br>
    Kami akan kembali segera. Terima kasih atas kesabaran Anda.
</p>
<div class="progress-bar-wrap"><div class="progress-bar-fill"></div></div>
<div class="btns">
    <a href="javascript:location.reload()" class="btn btn-p"><i class="fas fa-sync-alt"></i> Coba Lagi</a>
</div>
@endsection
