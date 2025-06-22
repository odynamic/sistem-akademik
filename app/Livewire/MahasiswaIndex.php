<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MahasiswaIndex extends Component
{
    public $nim, $nama, $semester, $prodi_id, $mahasiswaId;
    public $updateMode = false;
    public $formKey;
    public $prodis;

    public function mount()
    {
        $this->prodis = \App\Models\Prodi::all();
        $this->formKey = Str::random();
    }

    public function render()
    {
        return view('livewire.mahasiswa-index', [
            'mahasiswas' => Mahasiswa::with('prodi')->get(),
        ]);
    }

    public function save()
    {
        $data = Validator::make([
            'nim' => $this->nim,
            'nama' => $this->nama,
            'semester' => $this->semester,
            'prodi_id' => $this->prodi_id,
        ], [
            'nim' => 'required',
            'nama' => 'required',
            'semester' => 'required|integer',
            'prodi_id' => 'required|exists:prodis,id',
        ])->validate();

        if (!$this->updateMode && Mahasiswa::where('nim', $this->nim)->exists()) {
            session()->flash('error', 'NIM sudah digunakan.');
            return;
        }

        if ($this->updateMode) {
            $this->updateMahasiswa($data);
        } else {
            Mahasiswa::create($data);
        }

        $this->resetInput();
        $this->updateMode = false;
        session()->flash('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $m = Mahasiswa::findOrFail($id);
        $this->mahasiswaId = $m->id;
        $this->nim = $m->nim;
        $this->nama = $m->nama;
        $this->semester = $m->semester;
        $this->prodi_id = $m->prodi_id;
        $this->updateMode = true;
        $this->formKey = Str::random();
    }

    public function updateMahasiswa($data)
    {
        Mahasiswa::findOrFail($this->mahasiswaId)->update($data);
    }

    public function delete($id)
    {
        Mahasiswa::findOrFail($id)->delete();
    }

    public function cancelEdit()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->reset(['nim', 'nama', 'semester', 'prodi_id', 'mahasiswaId', 'updateMode']);
        $this->formKey = Str::random();
    }
}
