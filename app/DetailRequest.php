<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailRequest extends Model
{
    use SoftDeletes;
    public $table = 'r_detail_requests';

    public static function countRO($id)
    {
        return DetailRequest::where('no_req',$id)->count();
    }
}
