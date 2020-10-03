<?php

namespace App\Http\Requests;

use App\MstGudang;
use Illuminate\Foundation\Http\FormRequest;

class StoreGudangRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('gudang_create');
    }

    public function rules()
    {
        return [
            'nama_gudang' => [
                'required',
            ],
        ];
    }
}
