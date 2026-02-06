
@extends('layouts.auth')

@section('title', config('app.name'))
@push('head')
    <!-- Favicon khusus untuk halaman login -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/logo_pas_basic.png') }}">
@endpush
@section('content')
<div class="w-full max-w-md">
  <!-- Card Login (Modal Style) -->
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 border border-gray-200 dark:border-gray-700">
    
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('logo/logo_pas_basic.png') }}" alt="Logo" class="h-12" x-show="!$store.darkMode.enabled">
      <img src="{{ asset('logo/logo_pas_basic_dark.png') }}" alt="Logo" class="h-12" x-show="$store.darkMode.enabled">
    </div>
    <p class="text-center text-gray-600 dark:text-gray-400 text-sm mb-6">Login To System</p>

    <!-- Error Alert -->
    @if ($errors->any())
      <div class="mb-5 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-sm text-red-700 dark:text-red-300">
        <ul class="space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach

        </ul>
      </div>
    @endif


    <!-- Form -->

   <form method="POST" action="{{ route('login.post') }}">
    @csrf

    <!-- nik -->
    <div class="mb-5">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            NIK <span class="text-red-500">*</span>
        </label>
        <input type="text" name="nik" value="{{ old('nik') }}" placeholder="Enter NIK"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all"
            required />
    </div>

    <!-- Password -->
    <div class="mb-5" x-data="{ show: false }">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Password <span class="text-red-500">*</span>
        </label>
        <div class="relative">
            <input :type="show ? 'text' : 'password'" name="password" placeholder="Enter password"
                class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all"
                required />
            <button type="button" @click="show = !show"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <!-- Eye icon for show password -->
                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <!-- Eye slash icon for hide password -->
                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" x-cloak>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Role Dropdown -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Role <span class="text-red-500">*</span>
        </label>
        <select name="role"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all"
            required>
            <option value="">-- Pilih Role --</option>
            <option value="super admin" {{ old('role') == 'super admin' ? 'selected' : '' }}>Super Admin</option>
            <option value="teknisi" {{ old('role') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
            <option value="checker" {{ old('role') == 'checker' ? 'selected' : '' }}>Checker</option>
            <option value="approver" {{ old('role') == 'approver' ? 'selected' : '' }}>Approver</option>
        </select>
    </div>

    <!-- Remember & Forgot -->
    <div class="flex items-center justify-between mb-6 text-sm">
        <label class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
            <input type="checkbox" name="remember"
                class="rounded border-gray-300 text-brand-600 focus:ring-brand-500">
            Remember me
        </label>
        <a href="#" class="text-brand-600 hover:underline">Forgot password?</a>
    </div>

    <!-- Submit Button -->
    <button type="submit"
        class="w-full py-3 bg-gradient-to-r from-brand-600 to-brand-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
        </svg>
        Sign In
    </button>
</form>

    <!-- Sign Up Link -->
  
  </div>
</div>
@endsection