<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DeliveryOrder;
use App\DeliveryLog;
use App\DeliveryDetail;
use App\DeliveryDetailLog;
use App\Item;
use App\MstSupplier;
use Uuid;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $do = DeliveryOrder::all();

        return view('admin.do.index', compact('do'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('transaction_create'), 403);

        $count = DeliveryOrder::count();
        $no = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $no_trx = 'SK/'.date('d/m/y').'/'.$no;
        $supplier = MstSupplier::all()->pluck('nama', 'id');
        $item   = Item::all()->pluck('nama','id');

        return view('admin.do.create', compact('supplier','item','no_trx'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            // dd($request);
            $uuid = Uuid::generate();
            // echo $uuid; exit;
            $do = DeliveryOrder::create([
                'id'    => $uuid,
                'sk'  => $request->no_trx, 
                'send_date'  => $request->send_date, 
                'receive_date'  => $request->receive_date, 
                'is_active'  => 1, 
                'custid'  => $request->custid,
                'created_by'  => \Auth::user()->id,
                'created_at'  => date('Y-m-d H:i:s'), 
            ]);
            
            $doLog = DeliveryLog::create([
                'do_id'    => $uuid,
                'sk'  => $request->no_trx, 
                'send_date'  => $request->send_date, 
                'receive_date'  => $request->receive_date, 
                'is_active'  => 1, 
                'custid'  => $request->custid,
                'created_by'  => \Auth::user()->id,
                'created_at'  => date('Y-m-d H:i:s'), 
            ]);

            if( $request->has('barang_id') ) {
                foreach( $request->barang_id as $key => $detail ) {
                    $dt_uuid = Uuid::generate();

                    $dt = DeliveryDetail::create([
                        'id'    => $dt_uuid,
                        'do_id'    => $uuid,
                        'product_id' => $request->barang_id[$key],
                        'qty'   => $request->qty[$key] ?? 0,
                        'created_by'   => \Auth::user()->id,
                        'created_at'  => date('Y-m-d H:i:s'),
                    ]);

                    $log = DeliveryDetailLog::insert([
                        'dt_id'    => $dt_uuid,
                        'do_id'    => $uuid,
                        'product_id' => $request->barang_id[$key],
                        'qty'   => $request->qty[$key] ?? 0,
                        'created_at'  => date('Y-m-d H:i:s'),
                    ]);
                }
            }
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
        return \redirect()->route('admin.do.index')->with('success',\trans('notif.notification.save_data.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $do = DeliveryOrder::find($id);
        // dd($do);
        $dt = DeliveryDetail::where('do_id', $id)
            ->get();
        
        return view('admin.do.show', compact('do', 'dt'));
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
