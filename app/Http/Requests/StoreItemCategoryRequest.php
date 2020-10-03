<?php

namespace App\Http\Requests;

use App\MstGudang;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('item_category_create');
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
