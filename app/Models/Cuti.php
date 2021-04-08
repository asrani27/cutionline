<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $table  ='cuti';
    protected $guarded = ['id'];
    
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function validasi()
    {
        return $this->belongsTo(Pegawai::class, 'validator','id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
    
    public function jenis_cuti()
    {
        return $this->belongsTo(Jenis_cuti::class, 'jenis_cuti_id');
    }
}
