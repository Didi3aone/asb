<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    public static function getKec($value)
    {
        return Kecamatan::where('id_kec', $value)->select('name')->first();
    }
}
