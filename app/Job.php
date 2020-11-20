<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
    public $table = 'jobs';

    public static function getName($value)
    {
        return Job::where('id', $value)->select('name')->first();
    }
}
