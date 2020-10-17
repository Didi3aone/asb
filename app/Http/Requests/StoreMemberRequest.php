<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreMemberRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'name'     => [
                'required',
            ],
            'nik'     => [
                'required',
            ],
            'email'    => [
                'required, unique:member, email_address',
            ],
            'password' => [
                'required',
            ],
            'no_telp'  => [
                'required',
            ],
            'no_hp'  => [
                'required',
            ],
            'gender'  => [
                'required',
            ],
            'marital'  => [
                'required',
            ],
            'job'  => [
                'required',
            ],
            'level'  => [
                'required',
            ],
            'address'  => [
                'required',
            ],
            'provinsi'  => [
                'required',
            ],
            'kabupaten'  => [
                'required',
            ],
            'kecamatan'  => [
                'required',
            ],
            'kelurahan'  => [
                'required',
            ],
            'foto_ktp'  => [
                'required,image',
            ],
            'foto_kk'  => [
                'required,image',
            ],
        ];
    }
}
