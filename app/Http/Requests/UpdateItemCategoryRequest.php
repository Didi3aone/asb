<?php

namespace App\Http\Requests;

use App\ItemCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('item_category_edit');
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
