<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table  ='ruangan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function instalasi()
    {
        return $this->belongsTo(Instalasi::class, 'instalasi_id');
    }
    
    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'ruangan_id');
    }

    public function karuangan()
    {
        return $this->hasOne(Pegawai::class, 'id', 'karu');
    }
}
