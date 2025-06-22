<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Krs;
use Illuminate\Support\Str;

class KrsIndex extends Component
{
    public $mahasiswa_id;
    public $selectedMatakuliahs = [];
    public $formKey;
    public $krsList = [];

    public function mount()
    {
        $this->formKey = Str::random();
    }

    public function updatedMahasiswaId()
    {
        $this->selectedMatakuliahs = [];
        $this->loadKrs();
        $this->formKey = Str::random();
    }

    public function loadKrs()
    {
        $this->krsList = Matakuliah::select('matakuliahs.*')
            ->join('krs', 'krs.matakuliah_id', '=', 'matakuliahs.id')
            ->where('krs.mahasiswa_id', $this->mahasiswa_id)
            ->get();

        $this->selectedMatakuliahs = $this->krsList->pluck('id')->toArray();
    }

    public function save()
    {
        $this->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'selectedMatakuliahs' => 'required|array|min:1',
        ]);

        $totalSks = Matakuliah::whereIn('id', $this->selectedMatakuliahs)->sum('sks');
        if ($totalSks > 24) {
            session()->flash('error', 'Total SKS melebihi batas maksimum (24 SKS).');
            return;
        }

        // Hapus data KRS lama
        Krs::where('mahasiswa_id', $this->mahasiswa_id)->delete();

        foreach ($this->selectedMatakuliahs as $mkId) {
            Krs::create([
                'mahasiswa_id' => $this->mahasiswa_id,
                'matakuliah_id' => $mkId,
                'semester' => Mahasiswa::find($this->mahasiswa_id)?->semester ?? 1,
            ]);
        }

        session()->flash('success', 'KRS berhasil disimpan.');
        $this->loadKrs();
        $this->formKey = Str::random();
    }

    public function deleteKrs($matakuliah_id)
    {
        Krs::where('mahasiswa_id', $this->mahasiswa_id)
            ->where('matakuliah_id', $matakuliah_id)
            ->delete();

        session()->flash('success', 'Matakuliah berhasil dihapus dari KRS.');
        $this->loadKrs();
    }

    public function render()
    {
        return view('livewire.krs-index', [
            'mahasiswas' => Mahasiswa::all(),
            'matakuliahs' => Matakuliah::all(),
            'krsList' => $this->krsList,
        ]);
    }
}
