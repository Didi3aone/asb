<?php

namespace App\Http\Requests;

use App\MstSupplier;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('transaction_create');
    }

    public function rules()
    {
        return [
            'nomor_ijin'    => [
                'required',
            ],
            'gudang_id'    => [
                'required',
            ],
        ];
    }
}
