<?php

namespace App\Http\Requests;

use App\MstSupplier;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('transaction_edit');
    }

    public function rules()
    {
        return [
            'nomor_ijin'         => [
                'required',
            ],
            'gudang_id' => [
                'required',
            ],
        ];
    }
}
