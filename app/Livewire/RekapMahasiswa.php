<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Fakultas;

class RekapMahasiswa extends Component
{
    public $filterFakultas = '';
    public $filterSemester = '';
    public $mahasiswas = [];
    public $fakultasList = [];

    public function mount()
    {
        $this->fakultasList = Fakultas::all();
        $this->loadData();
    }

    public function applyFilter()
    {
        $this->loadData();
    }

    public function resetFilter()
    {
        $this->filterFakultas = '';
        $this->filterSemester = '';
        $this->loadData();
    }

    private function loadData()
    {
        $query = Mahasiswa::with(['prodi.fakultas', 'matakuliahs']);

        if ($this->filterFakultas) {
            $query->whereHas('prodi.fakultas', function ($q) {
                $q->where('id', $this->filterFakultas);
            });
        }

        if ($this->filterSemester) {
            $query->where('semester', $this->filterSemester);
        }

        $this->mahasiswas = $query->get()->map(function ($mhs) {
            $mhs->total_sks = $mhs->matakuliahs->sum('sks');
            return $mhs;
        });
    }

    public function render()
    {
        return view('livewire.rekap-mahasiswa', [
            'mahasiswas' => $this->mahasiswas,
            'fakultasList' => $this->fakultasList,
        ]);
    }
}