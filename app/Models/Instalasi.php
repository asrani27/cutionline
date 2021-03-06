<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalasi extends Model
{
    use HasFactory;

    protected $table  ='instalasi';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class, 'instalasi_id');
    }

    public function kainstalasi()
    {
        return $this->hasOne(Pegawai::class, 'id', 'kai');
    }

    public function atasanlangsung()
    {
        return $this->belongsTo(Jabatan::class, 'atasan', 'id');
    }
}
