<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MasterColor extends Model
{

    public $table = 'master_colors';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'status',
        'created_by',
        'updated_by',
        'deleted_at',
        'created_at',
        'updated_at',
        'file'
    ];
}
