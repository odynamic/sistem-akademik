<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Fakultas;
use Illuminate\Support\Str;

class FakultasIndex extends Component
{
    public $fakultasId = null;
    public $nama = '';
    public $editMode = false;
    public $formKey;

    public function mount()
    {
        $this->formKey = Str::random();
    }

    public function render()
    {
        return view('livewire.fakultas-index', [
            'fakultasList' => Fakultas::all()
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255'
        ]);

        Fakultas::create(['nama' => $this->nama]);

        session()->flash('success', 'Fakultas berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $this->fakultasId = $fakultas->id;
        $this->nama = $fakultas->nama;
        $this->editMode = true;

        $this->formKey = Str::random(); // update key agar input terisi ulang
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255'
        ]);

        Fakultas::findOrFail($this->fakultasId)->update([
            'nama' => $this->nama
        ]);

        session()->flash('success', 'Fakultas berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Fakultas::findOrFail($id)->delete();
        session()->flash('success', 'Fakultas berhasil dihapus.');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->nama = '';
        $this->fakultasId = null;
        $this->editMode = false;
        $this->formKey = Str::random(); // ubah agar input diforce reset
    }
}
