<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_cuti extends Model
{
    use HasFactory;
    protected $table  ='jenis_cuti';
    protected $guarded = ['id'];
    public $timestamps = false;
}
