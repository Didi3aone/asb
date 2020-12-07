<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTheme extends Model
{
    use SoftDeletes;

    public $table = 'master_themes';
    
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
