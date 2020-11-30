<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUsers extends Model
{
    use SoftDeletes;

    public $table = 'detail_users';
	
    protected $fillable = [
        'id',
        'userid',
        'no_member',
        'nickname',
        'nik',
        'avatar',
        'no_kk',
        'gender',
        'birth_place',
        'tgl_lahir',
        'status_kawin',
        'pekerjaan',
        'no_hp',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'alamat_domisili',
        'kelurahan_domisili',
        'kecamatan_domisili',
        'kabupaten_domisili',
        'provinsi_domisili',
        'foto_ktp',
        'foto_kk',
        'status_korlap',
        'activation_code',
        'is_verify',
        'created_by',
        'updated_by',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public const Active = 1;
    public const NotActive = 0;
    public const TypeStatus = [
        0 => 'Not Active',
        1 => 'Active'
    ];
    
    public const typeVerif = [
        0 => 'Unverify',
        1 => 'Verified'
    ];

    public static function countMember($value)
    {
        return DetailUsers::where('kecamatan', $value)->selectRaw('COUNT(id) as tot')->first();
    }
}
