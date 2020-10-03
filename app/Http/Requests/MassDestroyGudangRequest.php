<?php

namespace App\Http\Requests;

use App\MstGudang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyGudangRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('gudang_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mst_gudang,id',
        ];
    }
}
