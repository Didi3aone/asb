<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransaksiRequest;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\TransaksiStok;
use App\TransaksiStokDetail;
use App\StokBarang;
use App\LogStokBarang;
use App\Item;
use App\MstGudang;
use App\RakGudang;
use App\LogTransaction;


class TransaksiStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('transaction_access'), 403);

        $transaction = TransaksiStok::all();
        // dd($transaction);
        return view('admin.transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createIn()
    {
        abort_unless(\Gate::allows('transaction_create'), 403);
        $gudang = MstGudang::all()->pluck('nama_gudang','id');
        $item   = Item::all()->pluck('nama','id');

        return view('admin.transaction.create-in',\compact('gudang','item'));
    }

    public function reportTransaksi(Request $request)
    {
        $trx = TransaksiStok::join('mst_gudang', 'mst_gudang.id', '=', 'transaksi_stoks.gudang_id')
            ->selectRaw('transaksi_stoks.nomor_ijin,transaksi_stoks.id,transaksi_stoks.tanggal_transaksi,
                        mst_gudang.nama_gudang, transaksi_stoks.rak_id,transaksi_stoks.tipe ');
        if(isset($request->start) && isset($request->end))
        {
            $trx->where('transaksi_stoks.tanggal_transaksi', '>=', $request->start);
            $trx->where('transaksi_stoks.tanggal_transaksi', '<=', $request->end);
        }
        $report = $trx->get();

        $In = TransaksiStok::join('transaksi_stok_details', 'transaksi_stok_details.transaksi_id', '=', 'transaksi_stoks.id')
                ->where('transaksi_stoks.tipe', 1)
                ->selectRaw('sum(transaksi_stok_details.qty) as income');
        if(isset($request->start) && isset($request->end))
        {
            $In->where('transaksi_stoks.tanggal_transaksi', '>=', $request->start);
            $In->where('transaksi_stoks.tanggal_transaksi', '<=', $request->end);
        }
        $sumIn = $In->first();

        $Out = TransaksiStok::join('transaksi_stok_details', 'transaksi_stok_details.transaksi_id', '=', 'transaksi_stoks.id')
                ->where('transaksi_stoks.tipe', 2)
                ->selectRaw('sum(transaksi_stok_details.qty) as outcome');
        if(isset($request->start) && isset($request->end))
        {
            $Out->where('transaksi_stoks.tanggal_transaksi', '>=', $request->start);
            $Out->where('transaksi_stoks.tanggal_transaksi', '<=', $request->end);
        }
        $sumOut = $Out->first();
        
        return view('admin.transaction.report', compact('report', 'sumIn', 'sumOut'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOut()
    {
        abort_unless(\Gate::allows('transaction_create'), 403);
        $gudang = MstGudang::all()->pluck('nama_gudang','id');
        $item   = Item::all()->pluck('nama','id');
        
        return view('admin.transaction.create-out',\compact('gudang','item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiRequest $request)
    {
        \DB::beginTransaction();
        try {
            if(!isset($request->rak_id)) {
                $request->merge(['rak_id' => 0]);
            }
            
            $header = TransaksiStok::create([
                'nomor_transaksi'   => time(),
                'tipe'              => $request->tipe,
                'nomor_ijin'        => $request->nomor_ijin,
                'rak_id'            => $request->rak_id ?? 0,
                'gudang_id'         => $request->gudang_id,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'created_by'        => \Auth::user()->id
            ]);
            
            if( $request->has('barang_id') ) {
                foreach( $request->barang_id as $key => $detail ) {
                    $detail = TransaksiStokDetail::create([
                        'transaksi_id'      => $header->id,
                        'barang_id'         => $request->barang_id[$key],
                        'qty'               => $request->qty[$key] ?? 0,
                    ]);
                    
                    LogTransaction::create([
                        'detail_id'     => $detail->id,
                        'transaksi_id'  => $header->id,
                        'type'          => 1,
                        'barang_id'     => $request->barang_id[$key],
                        'qty'           => $request->qty[$key] ?? 0,
                    ]);
                    
                    $qty = $request->qty[$key];
                    
                    //update last stock
                    Item::where('id', $detail)
                        ->update([
                            'stok_akhir' => \DB::raw("stok_akhir + $qty")
                        ]);
        
                    //insert stock
                    $check = StokBarang::where('gudang_id', $request->gudang_id)
                            ->where('barang_id', $detail)
                            ->first();
        
                    if( null == $check ) { 
                        $stock = [
                            'gudang_id' => $request->gudang_id,
                            'barang_id' => $request->barang_id[$key],
                            'stock'     => $request->qty[$key]
                        ];
                        $stockId = StokBarang::create($stock);
                        $stockAwal = $check->stock ?? 0;
                        
                        LogStokBarang::create([
                            'id'                => \uniqid(),
                            'stock_barang_id'   => $stockId->id,
                            'barang_id'         => $request->barang_id[$key],
                            'log_type'          => LogStokBarang::BarangMasuk,
                            'qty_before'        => $stockAwal ?? 0,
                            'qty_after'         => $stockAwal + $request->qty[$key],
                            'created_by'        => \Auth::user()->id,
                            'transaksi_id'      => $header->id
                        ]);
                    } else {
                        $stock = [
                            'gudang_id' => $request->gudang_id,
                            'barang_id' => $request->barang_id[$key],
                            'stock'     => \DB::raw("stock + $qty")
                        ];
                        $stockId = StokBarang::where('barang_id', $request->barang_id[$key])
                                ->where('gudang_id', $request->gudang_id)
                                ->update($stock);
        
                        LogStokBarang::create([
                            'id'             => \uniqid(),
                            'stock_barang_id' => $stockId,
                            'barang_id'      => $request->barang_id[$key],
                            'log_type'       => LogStokBarang::BarangMasuk,
                            'qty_before'     => $check->stock ?? 0,
                            'qty_after'      => $check->stock + $request->qty[$key],
                            'created_by'     => \Auth::user()->id,
                            'transaksi_id'   => $header->id
                        ]);
                    }
                }
            }
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
        return \redirect()->route('admin.transaksi.index')->with('success',\trans('notif.notification.save_data.success'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOut(StoreTransaksiRequest $request)
    {
        \DB::beginTransaction();
        try {
            $header = TransaksiStok::create([
                'nomor_transaksi'   => time(),
                'tipe'              => $request->tipe,
                'nomor_ijin'        => $request->nomor_ijin,
                'gudang_id'         => $request->gudang_id,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'created_by'        => \Auth::user()->id
            ]);
                
            foreach( $request->barang_id as $key => $detail ) {
                $detail = TransaksiStokDetail::create([
                    'transaksi_id'      => $header->id,
                    'barang_id'         => $request->barang_id[$key],
                    'qty'               => $request->qty[$key],
                ]);

                LogTransaction::create([
                    'detail_id'     => $detail->id,
                    'transaksi_id'  => $header->id,
                    'type'          => 2,
                    'barang_id'     => $request->barang_id[$key],
                    'qty'           => $request->qty[$key] ?? 0,
                ]);

                $qty = $request->qty[$key];

                //update last stock
                Item::where('id', $request->barang_id[$key])
                    ->update([
                        'stok_akhir' => \DB::raw("stok_akhir - $qty")
                    ]);

                //insert stock
                $check = StokBarang::where('gudang_id', $request->gudang_id)
                        ->where('barang_id', $request->barang_id)
                        ->first();

                if( null != $check ) { 
                    $stock = [
                        'gudang_id' => $request->gudang_id,
                        'barang_id' => $request->barang_id[$key],
                        'stock'     => \DB::raw("stock - $qty")
                    ];

                    LogStokBarang::create([
                        'id'                => \uniqid(),
                        'stock_barang_id'   => $check->id,
                        'barang_id'         => $request->barang_id[$key],
                        'log_type'          => LogStokBarang::BarangKeluar,
                        'qty_before'        => $check->stock ?? 0,
                        'qty_after'         => $check->stock - $request->qty[$key],
                        'created_by'        => \Auth::user()->id,
                        'transaksi_id'      => $header->id
                    ]);
                    
                    $stockId = StokBarang::where('gudang_id',$request->gudang_id)
                        ->where('barang_id', $request->barang_id)
                        ->update($stock);
                        
                } else {
                    echo "kesini";die;
                }
            }
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
        return \redirect()->route('admin.transaksi.index')->with('success',\trans('notif.notification.save_data.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = TransaksiStok::find($id);
        $detail = TransaksiStokDetail::where('transaksi_id', $id)->get();

        return view('admin.transaction.show', compact('transaksi', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = TransaksiStok::find($id);
        $detail = TransaksiStokDetail::where('transaksi_id', $id)->get();
        $gudang = MstGudang::all()->pluck('nama_gudang','id');
        $rak = RakGudang::where('gudang_id', $transaksi->gudang_id)->pluck('name', 'id');
        $item   = Item::all()->pluck('nama','id');

        return view('admin.transaction.edit', compact('transaksi','detail', 'gudang', 'item', 'rak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $transaksi = TransaksiStok::find($id);
            $transaksi->nomor_transaksi = time();
            $transaksi->tipe            = $request->tipe;
            $transaksi->nomor_ijin      = $request->nomor_ijin;
            $transaksi->gudang_id       = $request->gudang_id;
            $transaksi->tanggal_transaksi= $request->tanggal_transaksi;
            $transaksi->updated_by      = \Auth::user()->id;
            $transaksi->update();

            foreach( $request->barang_id as $key => $detail ) {
                if($request->detail_id[$key]) {
                    $lastVal = LogTransaction::where('transaksi_id', $id)
                        ->where('detail_id', $request->detail_id[$key])
                        ->select('qty')
                        ->first();
                }
                
                if(isset($lastVal->qty)) {
                    $lastVal = $lastVal->qty;
                } else {
                    $lastVal = 0;
                }

                $findDetail = TransaksiStokDetail::where('transaksi_id', $id)
                            ->where('barang_id', $request->barang_id[$key])
                            ->first();
                
                if($findDetail) {
                    $detail = TransaksiStokDetail::find($findDetail->id)
                        ->delete();
                }

                $detail = TransaksiStokDetail::create([
                    'transaksi_id'      => $id,
                    'barang_id'         => $request->barang_id[$key],
                    'qty'               => $request->qty[$key],
                ]);

                LogTransaction::create([
                    'detail_id'     => $detail->id,
                    'transaksi_id'  => $id,
                    'type'          => $request->tipe,
                    'barang_id'     => $request->barang_id[$key],
                    'qty'           => $request->qty[$key] ?? 0,
                ]);

                $qty = $request->qty[$key];

                //update last stock
                if($request->tipe == 1) {
                    $calc = Item::where('id', $request->barang_id[$key])
                            ->select('stok_akhir')
                            ->first();
                    
                    // value stok terakhir
                    if($calc->stok_akhir > 0) {
                        $val = $calc->stok_akhir - $lastVal ?? 0;
                    } else {
                        $val = 0;
                    }

                    Item::where('id', $request->barang_id[$key])
                        ->update([
                            'stok_akhir' => \DB::raw("$val + $qty")
                        ]);
                    
                    //insert stock
                    $check = StokBarang::where('gudang_id', $request->gudang_id)
                            ->where('barang_id', $request->barang_id[$key])
                            ->first();
                            
                    if( null == $check ) { 
                        
                        $stock = [
                            'gudang_id' => $request->gudang_id,
                            'barang_id' => $request->barang_id[$key],
                            'stock'     => $request->qty[$key]
                        ];
                        $stockId = StokBarang::create($stock);
                        $stockAwal = $check->stock ?? 0;
                        LogStokBarang::create([
                            'id'                => \uniqid(),
                            'stock_barang_id'   => $stockId->id,
                            'barang_id'         => $request->barang_id[$key],
                            'log_type'          => LogStokBarang::BarangMasuk,
                            'qty_before'        => $stockAwal ?? 0,
                            'qty_after'         => $stockAwal + $request->qty[$key],
                            'created_by'        => \Auth::user()->id,
                            'transaksi_id'      => $id
                        ]);
                    } else {
                        // echo "ada data";exit;
                        $valStock = StokBarang::where('barang_id', $request->barang_id)
                                    ->where('gudang_id', $request->gudang_id)
                                    ->select('stock')
                                    ->first();
                        $val = $valStock->stock - $lastVal;
                        $stock = [
                            'gudang_id' => $request->gudang_id,
                            'barang_id' => $request->barang_id[$key],
                            'stock'     => \DB::raw("$val + $qty")
                        ];
                        $stockId = StokBarang::where('barang_id',$request->barang_id)
                                ->where('gudang_id', $request->gudang_id)
                                ->update($stock);
        
                        LogStokBarang::create([
                            'id'             => \uniqid(),
                            'stock_barang_id'=> $stockId,
                            'barang_id'      => $request->barang_id[$key],
                            'log_type'       => LogStokBarang::BarangMasuk,
                            'qty_before'     => $check->stock ?? 0,
                            'qty_after'      => $check->stock + $request->qty[$key],
                            'created_by'     => \Auth::user()->id,
                            'transaksi_id'   => $id
                        ]);
                    }
                } elseif ($request->tipe == 2) {
                    $calc = Item::where('id', $request->barang_id[$key])
                            ->select('stok_akhir')
                            ->first();
                    // value stok terakhir
                    $val = $calc->stok_akhir + $lastVal;
                    
                    Item::where('id', $request->barang_id[$key])
                    ->update([
                        'stok_akhir' => \DB::raw("$val - $qty")
                    ]);

                    //insert stock
                    $check = StokBarang::where('gudang_id', $request->gudang_id)
                            ->where('barang_id', $request->barang_id[$key])
                            ->first();

                    if( null != $check ) {
                        
                        $valStock = StokBarang::where('barang_id', $request->barang_id)
                                    ->where('gudang_id', $request->gudang_id)
                                    ->select('stock')
                                    ->first();
                        $val = $valStock->stock + $lastVal;

                        $stock = [
                            'gudang_id' => $request->gudang_id,
                            'barang_id' => $request->barang_id[$key],
                            'stock'     => \DB::raw("$val - $qty")
                        ];

                        LogStokBarang::create([
                            'id'                => \uniqid(),
                            'stock_barang_id'   => $check->id,
                            'barang_id'         => $request->barang_id[$key],
                            'log_type'          => LogStokBarang::BarangKeluar,
                            'qty_before'        => $check->stock ?? 0,
                            'qty_after'         => $check->stock - $request->qty[$key],
                            'created_by'        => \Auth::user()->id,
                            'transaksi_id'      => $id
                        ]);
                        
                        $stockId = StokBarang::where('gudang_id',$request->gudang_id)
                            ->where('barang_id', $request->barang_id[$key])
                            ->update($stock);
                            
                    } else {
                        echo "kesini";die;
                    }
                }
            }
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
        return \redirect()->route('admin.transaksi.index')->with('success',\trans('notif.notification.update_data.success'));
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
