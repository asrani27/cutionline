<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratSakit extends Model
{
    use HasFactory;
    protected $table ='surat_sakit';
    protected $guarded = ['id'];
}
