<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provinsi;
use App\DetailUsers;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prov = Provinsi::all();
        // dd($kel);
        return view('admin.prov.index', compact('prov'));
    }

    public function reportMember(Request $request)
    {
        $report = DetailUsers::join('provinsis', 'detail_users.provinsi', '=', 'provinsis.id_prov')
                ->selectRaw('provinsis.name , count(detail_users.id) as count')
                ->groupBy('provinsis.name');
                if(isset($request->start) && isset($request->end))
                {
                    $report->where('detail_users.created_at', '>=', $request->start .'00:00:00');
                    $report->where('detail_users.created_at', '<=', $request->end .'23:00:00');
                }
        $report = $report->get();

        if(isset($request->start) && isset($request->end))
        {
            $reportCount = DetailUsers::where('detail_users.created_at', '>=', $request->start .'00:00:00')
                        ->where('detail_users.created_at', '<=', $request->end .'23:00:00')
                        ->count('id');
        } else {
            $reportCount = DetailUsers::count('id');
        }
        
        return view('admin.prov.report', compact('report', 'reportCount'));
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
