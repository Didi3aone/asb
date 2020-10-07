<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    public static function getKab($value)
    {
        return Kabupaten::where('id_kab', $value)->select('name')->first();
    }
}
