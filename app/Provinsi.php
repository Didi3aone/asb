<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    public static function getProv($value)
    {
        return Provinsi::where('id_prov', $value)->select('name')->first();
    }
}
