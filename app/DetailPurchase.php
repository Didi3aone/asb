<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPurchase extends Model
{
    // use SoftDeletes;
    
    public $table = 'r_detail_purchases';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'purchase_id',
        'id_barang',
        'qty',
        'price',
        'ppn',
        'total',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public static function countPO($id)
    {
        return DetailPurchase::where('purchase_id',$id)->count();
    }

    public static function sumPO($id)
    {
        return DetailPurchase::where('purchase_id',$id)->sum('total');
    }

    public static function dt($id)
    {
        return DetailPurchase::where('purchase_id', $id)->get();
    }

    public static function rupiah($val){
	    $rp = "Rp " . number_format($val, 0, ',', '.');
        
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
