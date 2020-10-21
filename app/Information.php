<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use SoftDeletes;

    public $table = 'information';

    protected $fillable = [
        'id',
        'kategori_id',
        'name',
        'content' ,
        'gambar' ,
        'is_active' ,
        'created_by' ,
        'updated_by' ,
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
