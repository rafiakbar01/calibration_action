@extends('errors.layout')
@section('error_title', '429 - Terlalu Banyak Permintaan')
@section('error_content')
<div class="badge"><span class="dot" style="background:#ef4444"></span>HTTP 429</div>
<div class="ecode">429</div>
<span class="eicon">&#x26A1;</span>
<h1 class="etitle">Terlalu Banyak Permintaan</h1>
<p class="edesc">
    Anda terlalu sering mengakses halaman ini.<br>
    Tunggu beberapa saat sebelum mencoba lagi.
</p>
<div class="divider"></div>
<div class="btns">
    <a href="javascript:history.back()" class="btn btn-p"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
@endsection
