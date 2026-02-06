<aside class="w-64 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 min-h-screen">
  <nav class="p-4 space-y-1">
    <a href="{{ url('/') }}" class="block px-3 py-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-800">Dashboard</a>
    <a href="#" class="block px-3 py-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-800">Menu 1</a>
    <a href="#" class="block px-3 py-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-800">Menu 2</a>
    <!-- --- ADD: Registrasi User menu --- -->
    <a href="{{ route('register.show') }}" class="block px-3 py-2 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-800">Registrasi User</a>
    <!-- --- END ADD --- -->
  </nav>
</aside>