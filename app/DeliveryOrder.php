<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryOrder extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = 'delivery_orders';
    protected $keyType = 'string';    

    protected $fillable = [
        'id',
        'sk',
        'custid',
        'send_date',
        'receive_date',
        'is_active',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
