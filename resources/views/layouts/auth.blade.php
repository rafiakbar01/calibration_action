{{-- resources/views/layouts/auth.blade.php --}}
<!DOCTYPE html>
<html lang="en" x-data x-init="$store.darkMode.init()" :class="{ 'dark': $store.darkMode.enabled }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
 <!-- Light Mode Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo/logo_pas_basic.png') }}" id="light-favicon">
  <!-- Tailwind via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            brand: { 600: '#2563eb', 700: '#1e40af' },
            emerald: { 500: '#10b981' }
          }
        }
      }
    }
  </script>

  <!-- Alpine -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="min-h-screen bg-gray-50 dark:bg-gray-900 flex items-center justify-center p-4">

  <!-- Tombol Dark Mode -->
  <button @click="$store.darkMode.toggle()" class="fixed top-6 right-6 z-50 p-2 rounded-lg bg-white dark:bg-gray-800 shadow-lg">
    <svg x-show="!$store.darkMode.enabled" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
    </svg>
    <svg x-show="$store.darkMode.enabled" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
    </svg>
  </button>

  @yield('content')

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('darkMode', {
        enabled: localStorage.getItem('darkMode') === 'true',
        init() { this.enabled = JSON.parse(localStorage.getItem('darkMode') || 'false'); this.apply(); },
        toggle() { this.enabled = !this.enabled; localStorage.setItem('darkMode', this.enabled); this.apply(); },
        apply() { document.documentElement.classList.toggle('dark', this.enabled); }
      });
    });
  </script>
</body>
</html>