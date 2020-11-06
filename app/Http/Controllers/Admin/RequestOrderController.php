<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRORequest;
use App\Http\Requests\StoreRORequest;
use App\Http\Requests\UpdateRORequest;
use App\Request as Req;
use App\PeriodeProgram;
use App\MstGudang;
use App\User;
use App\Item;

class RequestOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ro = Req::join('periode_programs', 'requests.program_id','=', 'periode_programs.id')
            ->join('users', 'requests.created_by', '=', 'users.id')
            ->select('requests.id','requests.no_request', 'requests.created_at', 'users.name as fullname', 'periode_programs.name')
            ->get();
        
        return view('admin.ro.index', compact('ro')); 
    }

    public function countRO($id)
    {
        $ro = Req::where('no_request', $id)
            ->selectRaw('count(id) as jml')
            ->first();
        
        return $ro;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('transaction_create'), 403);
        
        $program= PeriodeProgram::all()->pluck('name', 'id');
        $member = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->where('role_user.role_id', 3)->pluck('name', 'id');
        $item   = Item::all()->pluck('nama','id');

        return view('admin.ro.create', compact('program', 'member', 'item'));
    }

    public function reportRO(Request $request)
    {
        if($request->type == 1){
            $title = 'Status Pengajuan';
        } elseif ($request->type == 2) {
            $title = 'Status Pengiriman';
        } elseif ($request->type == 3) {
            $title = 'Status Telah Diterima';
        } else {
            $title = 'Semua Status';
        }

        $detail = Req::join('periode_programs', 'requests.program_id', '=', 'periode_programs.id')
                ->join('r_detail_requests', 'r_detail_requests.no_req', '=', 'requests.no_request')
                ->leftJoin('users', 'r_detail_requests.receiver_id', '=', 'users.id')
                ->selectRaw('requests.no_request , periode_programs.name, users.name as member,
                    CASE 
                        when r_detail_requests.status_penerima = 1 then "Diajukan"
                        when r_detail_requests.status_penerima = 2 then "Dikirim"
                        else "Diterima"
                    end as status, r_detail_requests.status_penerima'
                );
        if(isset($request->type)) {
            $detail->where('r_detail_requests.status_penerima', $request->type);
        }
        if(isset($request->start) && isset($request->end))
        {
            $detail->where('periode_programs.start_date', '>=', $request->start);
            $detail->where('periode_programs.end_date', '<=', $request->end);
        }
        $report = $detail->get();

        return view('admin.ro.report', compact('report', 'title')); 
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
        $ro = Req::join('periode_programs', 'requests.program_id','=', 'periode_programs.id')
            ->join('users', 'requests.created_by', '=', 'users.id')
            ->where('periode_programs.id', $id)
            ->first();
        
        return view('admin.ro.show', compact('ro')); 
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
