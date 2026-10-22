@extends('errors.layout')
@section('error_title', '403 - Akses Ditolak')
@section('error_content')
<div class="badge"><span class="dot" style="background:#f59e0b"></span>HTTP 403</div>
<div class="ecode">403</div>
<span class="eicon">&#x1F512;</span>
<h1 class="etitle">Akses Ditolak</h1>
<p class="edesc">
    Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.<br>
    Hubungi administrator jika Anda yakin ini adalah kesalahan.
</p>
<div class="divider"></div>
<div class="btns">
    <a href="javascript:history.back()" class="btn btn-g"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
@endsection
