<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Matakuliah;
use App\Models\Prodi;
use Illuminate\Support\Str;

class MatakuliahIndex extends Component
{
    public $kode, $nama, $sks, $prodi_id, $matakuliahId;
    public $editMode = false;
    public $formKey;

    public function mount()
    {
        $this->generateFormKey();
    }

    public function render()
    {
        return view('livewire.matakuliah-index', [
            'matakuliahs' => Matakuliah::with('prodi')->get(),
            'prodis' => Prodi::all(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'kode' => 'required',
            'nama' => 'required',
            'sks' => 'required|integer',
            'prodi_id' => 'required|exists:prodis,id'
        ]);

        Matakuliah::create([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'sks' => $this->sks,
            'prodi_id' => $this->prodi_id,
        ]);

        session()->flash('success', 'Mata kuliah berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $m = Matakuliah::findOrFail($id);
        $this->matakuliahId = $m->id;
        $this->kode = $m->kode;
        $this->nama = $m->nama;
        $this->sks = $m->sks;
        $this->prodi_id = $m->prodi_id;
        $this->editMode = true;
        $this->generateFormKey(); // update key supaya input berubah
    }

    public function update()
    {
        $this->validate([
            'kode' => 'required',
            'nama' => 'required',
            'sks' => 'required|integer',
            'prodi_id' => 'required|exists:prodis,id'
        ]);

        Matakuliah::findOrFail($this->matakuliahId)->update([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'sks' => $this->sks,
            'prodi_id' => $this->prodi_id,
        ]);

        session()->flash('success', 'Mata kuliah berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Matakuliah::findOrFail($id)->delete();
        session()->flash('success', 'Mata kuliah berhasil dihapus.');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['kode', 'nama', 'sks', 'prodi_id', 'matakuliahId', 'editMode']);
        $this->generateFormKey();
    }

    private function generateFormKey()
    {
        $this->formKey = Str::random(10);
    }
}
