<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kadinkes extends Model
{
    use HasFactory;
    protected $table  ='kadinkes';
    protected $guarded = ['id'];
    public $timestamps = false;
}
