<?php

// app/Livewire/ProdiIndex.php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Support\Str;

class ProdiIndex extends Component
{
    public $prodiId, $nama, $fakultas_id;
    public $updateMode = false;
    public $formKey;
    

    public function mount()
    {
        $this->formKey = Str::random();
    }

    public function render()
    {
        return view('livewire.prodi-index', [
            'prodis' => Prodi::with('fakultas')->get(),
            'fakultasList' => Fakultas::all(),
        ]);
    }

    public function save()
    {
        $data = $this->validate([
            'nama' => 'required|string|max:255',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        if ($this->updateMode) {
            Prodi::findOrFail($this->prodiId)->update($data);
            session()->flash('success', 'Prodi berhasil diperbarui.');
        } else {
            Prodi::create($data);
            session()->flash('success', 'Prodi berhasil ditambahkan.');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $this->prodiId = $prodi->id;
        $this->nama = $prodi->nama;
        $this->fakultas_id = $prodi->fakultas_id;
        $this->updateMode = true;
        $this->formKey = Str::random(); // untuk reset key form
    }

    public function delete($id)
    {
        Prodi::findOrFail($id)->delete();
        session()->flash('success', 'Prodi berhasil dihapus.');
        $this->resetForm();
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['prodiId', 'nama', 'fakultas_id', 'updateMode']);
        $this->formKey = Str::random(); // biar input reset juga di UI
    }
}
