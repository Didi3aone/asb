<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelurahan;
use App\Kecamatan;
use App\Kabupaten;
use App\User;
use App\Item;
use App\RakGudang;

class HelperController extends Controller
{
    public function getKelurahan(Request $request)
    {
        $data = Kelurahan::where('id_kec', $request->val)
            ->get();

        return \Response::json($data);
    }

    public function getKecamatan(Request $request)
    {
        $data = Kecamatan::where('id_kab', $request->val)
            ->get();

        return \Response::json($data);
    }

    public function getKabupaten(Request $request)
    {
        $data = Kabupaten::where('id_prov', $request->val)
            ->get();

        return \Response::json($data);
    }

    public function getMember(Request $request)
    {
        $data = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->where('role_user.role_id', 3)
                ->get();
                
        return \Response::json($data);
    }

    public function getRak(Request $request)
    {
        $data = RakGudang::where('gudang_id', $request->val)
                ->get();
                
        return \Response::json($data);
    }

    public function getProduct(Request $request)
    {
        $data = Item::select('id', 'name')
                ->get();
                
        return \Response::json($data);
    }
}
