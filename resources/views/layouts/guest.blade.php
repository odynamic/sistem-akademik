<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Aplikasi Akademik' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <main class="min-h-screen flex items-center justify-center">
        {{ $slot }}
    </main>
</body>
</html>
