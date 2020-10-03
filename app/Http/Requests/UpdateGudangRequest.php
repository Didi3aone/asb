<?php

namespace App\Http\Requests;

use App\Permission;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGudangRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('gudang_edit');
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
