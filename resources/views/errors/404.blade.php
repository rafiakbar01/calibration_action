@extends('errors.layout')
@section('error_title', '404 - Halaman Tidak Ditemukan')
@section('error_content')
<div class="badge"><span class="dot" style="background:#3b82f6"></span>HTTP 404</div>
<div class="ecode">404</div>
<span class="eicon">&#x1F50D;</span>
<h1 class="etitle">Halaman Tidak Ditemukan</h1>
<p class="edesc">
    Halaman yang Anda cari tidak ada atau telah dipindahkan.<br>
    Periksa kembali URL atau kembali ke beranda.
</p>
<div class="divider"></div>
<div class="btns">
    <a href="javascript:history.back()" class="btn btn-g"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
@endsection
