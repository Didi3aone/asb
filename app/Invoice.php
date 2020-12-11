<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = 'invoices';
    protected $keyType = 'string';    

    protected $fillable = [
        'id',
        'no_transaksi',
        'transaction_date',
        'type',
        'is_active',
        'custid',
        'ppn',
        'disc',
        'subtotal',
        'grandtotal',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
