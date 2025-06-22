<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

use App\Livewire\MahasiswaIndex;
use App\Livewire\FakultasIndex;
use App\Livewire\ProdiIndex;
use App\Livewire\KrsIndex;
use App\Livewire\MatakuliahIndex;
use App\Livewire\RekapMahasiswa;

// Halaman Livewire
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/rekap', RekapMahasiswa::class)->name('livewire.rekap-mahasiswa');
    Route::get('/mahasiswa', MahasiswaIndex::class)->name('livewire.mahasiswa-index');
    Route::get('/krs', KrsIndex::class)->name('livewire.krs-index');
    Route::get('/matakuliah', MatakuliahIndex::class)->name('livewire.matakuliah');
    Route::get('/fakultas', FakultasIndex::class)->name('fakultas');
    Route::get('/prodi', ProdiIndex::class)->name('livewire.prodi-index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Default route arahkan ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

require __DIR__.'/auth.php';
