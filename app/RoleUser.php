<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    // use SoftDeletes;
    public $table =  'role_user';

    protected $fillable = [
        'user_id',
        'role_id'
    ];
}
