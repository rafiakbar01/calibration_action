@extends('errors.layout')
@section('error_title', '500 - Server Error')
@section('error_content')
<div class="badge"><span class="dot" style="background:#ef4444"></span>HTTP 500</div>
<div class="ecode">500</div>
<span class="eicon">&#x1F4A5;</span>
<h1 class="etitle">Kesalahan Server</h1>
<p class="edesc">
    Terjadi kesalahan di server kami. Tim teknis kami sedang memperbaikinya.<br>
    Silakan coba beberapa saat lagi.
</p>
<div class="divider"></div>
<div class="btns">
    <a href="javascript:location.reload()" class="btn btn-g"><i class="fas fa-redo"></i> Coba Lagi</a>
</div>
@endsection
