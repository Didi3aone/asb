<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogInvoice extends Model
{
    // use SoftDeletes;
    protected $table = 'log_invoices';

    protected $fillable = [
        'id',
        'invoice_id',
        'invoice_dt',
        'product_id',
        'qty',
        'price',
        'disc',
        'amount',
        'notes',
        'created_by',
        'updated_by',
        'created_at',
    ];
}
