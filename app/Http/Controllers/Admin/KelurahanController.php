<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Kelurahan;
use App\DetailUsers;
use App\User;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        $kel = Kelurahan::join('kecamatans', 'kecamatans.id_kec', '=', 'kelurahans.id_kec')
            ->select('kelurahans.id', 'kelurahans.name', 'kecamatans.name as kec_name', 'kelurahans.is_active')
            ->get();
        return DataTables::of($kel)->make(true);
    }
    public function index()
    {
        // $kel = Kelurahan::all();
        // // dd($kel);
        // return response()->json($kel);
        return view('admin.kel.index');
        // return view('admin.kel.index', compact('kel'));
    }

    public function reportMember($id)
    {
        $title = Kelurahan::find($id);

        $report = User::join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('kecamatans', 'detail_users.kecamatan', '=', 'kecamatans.id_kec')
                ->join('provinsis', 'detail_users.provinsi', '=', 'provinsis.id_prov')
                ->join('kabupatens', 'detail_users.kabupaten', '=', 'kabupatens.id_kab')
                ->join('kelurahans', 'detail_users.kelurahan', '=', 'kelurahans.id_kel')
                ->selectRaw('detail_users.userid ,provinsis.zona_waktu as provid ,
                        kecamatans.id as kecid ,detail_users.no_member ,
                        users.name ,detail_users.nik ,detail_users.no_hp ,
                        users.email ,users.created_at ,
                        users.is_active ,detail_users.status_korlap, provinsis.name as provname,
                        kabupatens.name as kabname, kecamatans.name as kecname,kelurahans.name as kelname')
                ->where('role_user.role_id', 3);
        if(isset($id)) {
            $report->where('kelurahans.id', $id);
        }
        $report = $report->get();

        return view('admin.kel.report', compact('report', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
