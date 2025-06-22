<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Akademik')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-blue-700 text-white px-6 py-3">
        <div class="container mx-auto flex justify-between items-center">
            <div class="font-bold text-lg">Sistem Akademik</div>
            <ul class="flex gap-4 text-sm">
                <li><a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a></li>
                <li><a href="{{ route('livewire.mahasiswa-index') }}" class="hover:underline">Mahasiswa</a></li>
                <li><a href="{{ route('livewire.prodi-index') }}" class="hover:underline">Prodi</a></li>
                <li><a href="{{ route('fakultas') }}" class="hover:underline">Fakultas</a></li>
                <li><a href="{{ route('livewire.matakuliah') }}" class="hover:underline">Matakuliah</a></li>
                <li><a href="{{ route('livewire.krs-index') }}" class="hover:underline">KRS</a></li>
                <li><a href="{{ route('livewire.rekap-mahasiswa') }}" class="hover:underline">Rekap</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:underline">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    {{-- Konten Halaman --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>
