<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends Model
{
    use SoftDeletes;
    public $table = 'provinsis';
    
    public static function getProv($value)
    {
        return Provinsi::where('id_prov', $value)->select('name')->first();
    }
}
