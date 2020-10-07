<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPeriodeProgram extends Model
{
    public $table = 'p_detail_periode_programs';

    public static function countPrograms($id)
    {
        return DetailPeriodeProgram::where('id_periode',$id)->count();
    }
}
