<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUpload extends Model
{
    use HasFactory;
    protected $table ='kategori_upload';
    protected $guarded = ['id'];

    public function upload()
    {
        return $this->hasMany(Upload::class, 'kategori_upload_id');
    }
}
