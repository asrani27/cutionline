<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    
    protected $table  ='jabatan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function atasan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
    
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function bawahan()
    {
        return $this->hasMany(Jabatan::class, 'jabatan_id');
    }
}
