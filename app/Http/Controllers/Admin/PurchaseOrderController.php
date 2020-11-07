<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPORequest;
use App\Http\Requests\StorePORequest;
use App\Http\Requests\UpdatePORequest;
use App\PurchaseOrder;
use App\MstGudang;
use App\StokBarang;
use App\LogStokBarang;
use App\Item;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $po = PurchaseOrder::all();
        
        return view('admin.po.index', compact('po'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('transaction_create'), 403);
        
        $gudang = MstGudang::all()->pluck('nama_gudang','id');
        $item   = Item::all()->pluck('nama','id');

        return view('admin.po.create',\compact('gudang','item'));
    }

    public function reportPO(Request $request)
    {
        abort_unless(\Gate::allows('transaction_create'), 503);
        /* if($request->type == 1){
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
            $detail->where('periode_programs.start_date', '>=', $request->start.'00:00:00');
            $detail->where('periode_programs.end_date', '<=', $request->end.'24:00:00');
        }
        $report = $detail->get(); */

        // return view('admin.po.report', compact('report', 'title')); 
        return view('admin.po.report'); 
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
