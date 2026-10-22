{{-- resources/views/layouts/auth.blade.php --}}
<!DOCTYPE html>
<html lang="en" x-data x-init="$store.darkMode.init()" :class="{ 'dark': $store.darkMode.enabled }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calibration In Action</title>
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