<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Prodi.php
class Prodi extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'fakultas_id'];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

     public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
