<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class InvoiceDetail extends Model
{
    // use SoftDeletes;
    public $incrementing = false;
    protected $table = 'invoice_details';

    protected $fillable = [
        'id',
        'invoice_id',
        'product_id',
        'qty',
        'price',
        'disc',
        'amount',
        'notes',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
