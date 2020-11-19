<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTransaction extends Model
{
    public $table = 'log_transactions';
    
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'detail_id',
        'transaksi_id',
        'type',
        'barang_id',
        'qty',
        'nomor_sparepart',
    ];
}
