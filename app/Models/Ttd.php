<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ttd extends Model
{
    use HasFactory;

    protected $table ='ttd';
    protected $guarded = ['id'];
    public $timestamps = false;
}
