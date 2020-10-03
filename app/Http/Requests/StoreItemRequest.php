<?php

namespace App\Http\Requests;

use App\MstGudang;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('item_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'required',
            ],
        ];
    }
}
