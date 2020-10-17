<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kabupaten extends Model
{
    use SoftDeletes;
    public $table = 'kabupatens';

    public static function getKab($value)
    {
        return Kabupaten::where('id_kab', $value)->select('name')->first();
    }
}
