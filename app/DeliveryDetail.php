<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    
    public $incrementing = false;
    protected $table = 'delivery_details';
    protected $keyType = 'string';    

    protected $fillable = [
        'id',
        'do_id',
        'product_id',
        'qty',
        'status',
        'created_at',
        'updated_at',
    ];
}
