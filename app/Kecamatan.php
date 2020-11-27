<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use softDeletes;
    public $table = 'kecamatans';
    
    public static function getKec($value)
    {
        return Kecamatan::where('id_kec', $value)->select('name')->first();
    }
}
