<?php

namespace App\Http\Requests;

use App\MstSupplier;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('customer_edit');
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
