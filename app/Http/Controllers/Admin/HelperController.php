<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelurahan;
use App\Kecamatan;
use App\Kabupaten;

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
}
