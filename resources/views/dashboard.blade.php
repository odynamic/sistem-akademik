@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Selamat Datang di Sistem Akademik</h1>

    <p class="text-gray-600 mb-6">Silakan pilih menu untuk mengelola data akademik:</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('livewire.mahasiswa-index') }}" class="block p-4 bg-white shadow rounded border hover:bg-gray-50 transition">
            <h2 class="font-semibold text-lg text-blue-700">Manajemen Mahasiswa</h2>
            <p class="text-gray-600 text-sm">Tambah, ubah, dan hapus data mahasiswa.</p>
        </a>

        <a href="{{ route('livewire.prodi') }}" class="block p-4 bg-white shadow rounded border hover:bg-gray-50 transition">
            <h2 class="font-semibold text-lg text-blue-700">Manajemen Prodi</h2>
            <p class="text-gray-600 text-sm">Kelola daftar program studi dan relasi fakultas.</p>
        </a>

        <a href="{{ route('livewire.matakuliah') }}" class="block p-4 bg-white shadow rounded border hover:bg-gray-50 transition">
            <h2 class="font-semibold text-lg text-blue-700">Manajemen Matakuliah</h2>
            <p class="text-gray-600 text-sm">Kelola matakuliah dan SKS.</p>
        </a>

        <a href="{{ route('livewire.krs-index') }}" class="block p-4 bg-white shadow rounded border hover:bg-gray-50 transition">
            <h2 class="font-semibold text-lg text-blue-700">Pengisian KRS</h2>
            <p class="text-gray-600 text-sm">Pilih matakuliah untuk mahasiswa.</p>
        </a>

        <a href="{{ route('livewire.rekap-mahasiswa') }}" class="block p-4 bg-white shadow rounded border hover:bg-gray-50 transition">
            <h2 class="font-semibold text-lg text-blue-700">Rekap SKS</h2>
            <p class="text-gray-600 text-sm">Lihat total SKS dan filter berdasarkan semester/fakultas.</p>
        </a>
    </div>
</div>
@endsection
