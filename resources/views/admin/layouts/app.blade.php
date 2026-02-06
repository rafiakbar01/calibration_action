<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ config('app.name','Laravel') }} Admin</title>
    <link rel="icon" href="{{ asset('admin/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script defer src="{{ asset('admin/js/index.js') }}"></script>
</head>
<body x-data="{ page: 'ecommerce', loaded: true, darkMode: JSON.parse(localStorage.getItem('darkMode')) || false, stickyMenu: false, sidebarToggle: false, scrollTop: false }" x-init="$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark bg-gray-900': darkMode === true}">
    <div class="flex h-screen overflow-hidden">
        @include('admin.partials.sidebar')
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            @include('admin.partials.header')
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>