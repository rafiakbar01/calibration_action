@extends('layouts.auth')

@section('title', 'Registrasi | ' . config('app.name'))

@section('content')
<div class="w-full max-w-md">
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 border border-gray-200 dark:border-gray-700">

    <div class="flex justify-center mb-6">
      <img src="{{ asset('admin/images/logo/logo_pas_basic.png') }}" alt="Logo" class="h-12">
    </div>

    <h2 class="text-center text-gray-700 dark:text-gray-300 font-semibold mb-6">Registrasi User</h2>

    @if ($errors->any())
      <div class="mb-5 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-sm text-red-700 dark:text-red-300">
        <ul class="space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('status'))
      <div class="mb-5 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-sm text-green-700 dark:text-green-300">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
      @csrf

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username<span class="text-red-500">*</span></label>
        <input type="text" name="username" value="{{ old('username') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all" required />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama</label>
        <input type="text" name="nama" value="{{ old('nama') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all" />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">NIK</label>
        <input type="text" name="nik" value="{{ old('nik') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all" />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role<span class="text-red-500">*</span></label>
        <select name="role" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all" required>
          <option value="">-- Pilih Role --</option>
          <option value="super admin" {{ old('role') == 'super admin' ? 'selected' : '' }}>Super Admin</option>
          <option value="teknisi"      {{ old('role') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
          <option value="checker"      {{ old('role') == 'checker' ? 'selected' : '' }}>Checker</option>
          <option value="approver"     {{ old('role') == 'approver' ? 'selected' : '' }}>Approver</option>
          <option value="ppic"         {{ old('role') == 'ppic' ? 'selected' : '' }}>PPIC</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password<span class="text-red-500">*</span></label>
        <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all" required />
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Password<span class="text-red-500">*</span></label>
        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all" required />
      </div>

      <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-600 to-brand-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
        Registrasi
      </button>

      <p class="mt-4 text-sm text-center text-gray-500 dark:text-gray-400">
        Sudah punya akun? <a class="text-brand-600 hover:underline" href="{{ route('login') }}">Login</a>
      </p>
    </form>
  </div>
</div>
@endsection