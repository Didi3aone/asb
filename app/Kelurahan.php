<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use SoftDeletes;
    public $table = 'kelurahans';

    public static function getKel($value)
    {
        return Kelurahan::where('id_kel', $value)->select('name')->first();
    }
}
