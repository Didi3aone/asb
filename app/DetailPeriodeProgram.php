<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPeriodeProgram extends Model
{
    use SoftDeletes;
    public $table = 'p_detail_periode_programs';

    public static function countPrograms($id)
    {
        return DetailPeriodeProgram::where('id_periode',$id)->count();
    }
}
