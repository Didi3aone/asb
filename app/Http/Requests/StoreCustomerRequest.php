<?php

namespace App\Http\Requests;

use App\MstSupplier;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('customer_create');
    }

    public function rules()
    {
        return [
            'nama'         => [
                'required',
            ],
            'no_telp' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                'unique:mst_supplier'
            ],
            'pic' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ];
    }
}
