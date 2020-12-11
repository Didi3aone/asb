<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryDetailLog extends Model
{
    public $incrementing = false;
    protected $table = 'delivery_detail_logs';
    protected $keyType = 'string';    

    protected $fillable = [
        'id',
        'do_id',
        'dt_id',
        'product_id',
        'qty',
        'status',
        'created_at',
        'updated_at',
    ];
}
