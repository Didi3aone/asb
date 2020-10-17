<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodeProgram extends Model
{
    use SoftDeletes;
    public $table = 'periode_programs';
}
