<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Sistem Akademik' }}</title>
    @vite('resources/css/app.css') {{-- jika pakai vite --}}
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">
    {{ $slot }}

    @livewireScripts
    @vite('resources/js/app.js') {{-- jika pakai vite --}}
</body>
</html>
