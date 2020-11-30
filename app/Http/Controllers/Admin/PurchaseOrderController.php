<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPORequest;
use App\Http\Requests\StorePORequest;
use App\Http\Requests\UpdatePORequest;
use App\PurchaseOrder;
use App\DetailPurchase;
use App\MstGudang;
use App\MstSupplier;
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
        
        $supplier = MstSupplier::all()->pluck('nama', 'id');
        $gudang = MstGudang::all()->pluck('nama_gudang','id');
        $item   = Item::all()->pluck('nama','id');
        // dd($supplier);
        return view('admin.po.create', compact('supplier', 'gudang', 'item'));
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
            $po = PurchaseOrder::create([
                'no_po'             => $request->nomor_ijin,
                'supplier_id'       => $request->supplier_id,
                'transaction_date'  => $request->transaction_date
            ]);

            $i=0;
            if(isset($request->barang_id[$i])) {
                for($count = 0;$count < count($request->barang_id); $count++) {
                    $total = $request->qty[$count] * $this->clean($request->price[$count]);
                    
                    $data = array(
                        'purchase_id'   => $po->id,
                        'id_barang'     => $request->barang_id[$count],
                        'qty'           => $request->qty[$count],
                        'price'         => $this->clean($request->price[$count]),
                        'ppn'           => $request->ppn[$count],
                        'total'         => $total,
                        'is_active'     => 1,
                        'created_at'    => date('Y-m-d H:i:s')
                    );
                    $insert_detail[] = $data;
                }
                DetailPurchase::insert($insert_detail);
            }
            
            \DB::commit();
            return \redirect()->route('admin.po.index')->with('success',\trans('notif.notification.save_data.success'));
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
    }

    public function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public function reportPO(Request $request)
    {
        abort_unless(\Gate::allows('transaction_create'), 503);
        if($request->type == 1){
            $title = 'Status Pengajuan';
        } elseif ($request->type == 2) {
            $title = 'Status Pengiriman';
        } elseif ($request->type == 3) {
            $title = 'Status Telah Diterima';
        } else {
            $title = 'Semua Status';
        }
        
        $po = PurchaseOrder::get();
        if(isset($request->start) && isset($request->end))
        {
            $po = PurchaseOrder::get();
            $po->where('created_at', '>=', $request->start);
            $po->where('created_at', '<=', $request->end);
        } else {
            $po = PurchaseOrder::get();
        }

        $dt = DetailPurchase::selectRaw('SUM(qty) as totqty,SUM(price) as totprice, SUM(total) as grandtot');
        if(isset($request->start) && isset($request->end))
        {
            $dt->where('created_at', '>=', $request->start);
            $dt->where('created_at', '<=', $request->end);
        } 

        $detail = $dt->first();

        // dd($detail);
        return view('admin.po.report', compact('po', 'detail')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $po     = PurchaseOrder::find($id);
        $detail = DetailPurchase::where('purchase_id', $id)
                ->get();

        return view('admin.po.show', compact('po', 'detail'));
    }

    public function updatePayment(Request $request, $id)
    {
        \DB::beginTransaction();
        try {
            $detail = PurchaseOrder::find($id);
            $detail->status_payment = $request->status;
            $detail->updated_at     = date('Y-m-d H:i:s');
            $detail->updated_by     = \Auth::user()->id;
            $detail->update();

            \DB::commit();
            return \redirect()->route('admin.po.index')->with('success',\trans('notif.notification.update_data.success'));
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(\Gate::allows('transaction_edit'), 403);
        
        $po = PurchaseOrder::find($id);
        $detail = DetailPurchase::where('purchase_id', $id)
                ->get();
        $supplier = MstSupplier::all()->pluck('nama', 'id');
        $gudang = MstGudang::all()->pluck('nama_gudang','id');
        $item   = Item::all()->pluck('nama','id');
        // dd($supplier);
        return view('admin.po.edit', compact('po', 'detail', 'supplier', 'gudang', 'item'));
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
        \DB::beginTransaction();
        try {
            $po = PurchaseOrder::find($id);
            $po->no_po              = $request->nomor_ijin;
            $po->supplier_id        = $request->supplier_id;
            $po->updated_by         = \Auth::user()->id;
            $po->transaction_date   = $request->transaction_date;
            $po->update();
            
            $i=0;
            if(isset($request->barang_id[$i])) {
                for($count = 0;$count < count($request->barang_id); $count++) {
                    $total = $request->qty[$count] * $this->clean($request->price[$count]);

                    $findDetail = DetailPurchase::where('purchase_id', $id)
                            ->where('id_barang', $request->barang_id[$count])
                            ->first();
                
                    if($findDetail) {
                        $detail = DetailPurchase::find($findDetail->id)
                            ->delete();
                    }
                    
                    $data = array(
                        'purchase_id'   => $po->id,
                        'id_barang'     => $request->barang_id[$count],
                        'qty'           => $request->qty[$count],
                        'price'         => $this->clean($request->price[$count]),
                        'ppn'           => $request->ppn[$count],
                        'total'         => $total,
                        'is_active'     => 1,
                        'updated_at'    => date('Y-m-d H:i:s')
                    );
                    $insert_detail[] = $data;
                }
                DetailPurchase::insert($insert_detail);
            }
            
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
        return \redirect()->route('admin.po.index')->with('success',\trans('notif.notification.update_data.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PurchaseOrder::find($id);
        // dd($id);
        $data->is_active  = 0;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->updated_by = \Auth::user()->id;
        $data->update();

        // $dt = DetailPurchase::where('purchase_id', $id);
        // $dt->is_active  = 0;
        // $dt->deleted_at = date('Y-m-d H:i:s');
        // $dt->update();

        return \redirect()->route('admin.po.index')->with('success',\trans('notif.notification.delete_data.success'));
    }
}
