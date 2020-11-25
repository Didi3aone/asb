<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;
    public $table = 'purchase_orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'no_po',
        'supplier_id',
        'is_active',
        'transaction_date',
        'created_by',
        'updated_by',
    ];

    public static function rupiah($val){
	
	    $rp = "Rp " . number_format($val);
        
        return $rp;
        
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user              = \Auth::user();
            $model->is_active  = 1;
            $model->created_by = $user->id ?? '9999';
            $model->updated_by = $user->id ?? '9999';
        });
        static::updating(function ($model) {
            $user              = \Auth::user();
            $model->updated_by = $user->id ?? '9999';
        });
        static::deleting(function ($model) {
            $user              = \Auth::user();
            $model->deleted_at = date('Y-m-d H:i:s');
            $model->deleted_by = $user->id ?? '';
        });
    }
}
