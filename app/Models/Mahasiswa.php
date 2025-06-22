<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Tambahkan ini agar mass assignment bisa jalan
    protected $fillable = ['nim', 'nama', 'semester', 'prodi_id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

public function matakuliahs()
{
    return $this->belongsToMany(Matakuliah::class, 'krs');
}


}
