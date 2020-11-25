<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PurchaseOrder;
use App\DetailPurchase;
use App\MstGudang;
use App\MstSupplier;
use App\StokBarang;
use App\LogStokBarang;
use App\Item;

class PurchaseOrderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $po = PurchaseOrder::all();

        return response([
            'success'   => true,
            'message'   => 'List Semua Purchase Order',
            'data'      => $po
        ], 200);
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
            $validator = Validator::make($request->all(), [
                'no_po'   => 'required',
                'supplier_id'   => 'required', 
                'transaction_date'   => 'required', 
            ],
            [
                'no_po.required'     => 'Masukkan no request!',
                'supplier_id.required'     => 'Masukkan supplier!',
                'transaction_date.required'     => 'Masukkan tanggal transaksi!'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'silahkan isi kolom yang kosong',
                    'data'      => $validator->errors()
                ], 400);
            } else {
                $po = PurchaseOrder::create([
                    'no_po'             => $request->input('no_po'),
                    'supplier_id'       => $request->input('supplier_id'),
                    'transaction_date'  => $request->input('transaction_date')
                ]);

                $i=0;
                if(isset($request->barang_id[$i])) {
                    for($count = 0;$count < count($request->barang_id); $count++) {
                        $total = $request->qty[$count] * $this->clean($request->price[$count]);
                        
                        $data = array(
                            'purchase_id'   => $po->input('id'),
                            'id_barang'     => $request->input('barang_id')[$count],
                            'qty'           => $request->input('qty')[$count],
                            'price'         => $request->input('price')[$count],
                            'ppn'           => $request->input('ppn')[$count],
                            'total'         => $total,
                            'is_active'     => 1,
                            'created_at'    => date('Y-m-d H:i:s')
                        );
                        $insert_detail[] = $data;
                    }
                    DetailPurchase::insert($insert_detail);
                }
            }
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Purchase Order Berhasil Disimpan!',
            ], 200);
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Purchase Order Gagal Disimpan!',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $po     = PurchaseOrder::find($id);
        $detail = DetailPurchase::where('purchase_id', $id)
                ->get();

        if ($ro) {
            return response()->json([
                'success'   => true,
                'message'   => ' Purchase Order!',
                'PurchaseOrder'   => $po,
                'detail'    => $detail,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Purchase order Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
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
        //
    }
}
