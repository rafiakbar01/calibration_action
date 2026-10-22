@extends('errors.layout')
@section('error_title', '419 - Sesi Kedaluwarsa')
@section('error_content')
<div class="badge"><span class="dot" style="background:#8b5cf6"></span>HTTP 419</div>
<div class="ecode">419</div>
<span class="eicon">&#x23F0;</span>
<h1 class="etitle">Sesi Kedaluwarsa</h1>
<p class="edesc">
    Sesi Anda telah berakhir atau token CSRF tidak valid.<br>
    Silakan muat ulang halaman dan coba lagi.
</p>
<div class="divider"></div>
<div class="btns">
    <a href="{{ url()->previous() }}" class="btn btn-p"><i class="fas fa-sync-alt"></i> Muat Ulang</a>
</div>
@endsection
