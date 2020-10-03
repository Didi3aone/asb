<?php

namespace App\Http\Requests;

use App\ItemCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemUnitRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('item_unit_edit');
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
