<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $fillable = ['kode', 'nama', 'sks', 'prodi_id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'krs');
    }
}
