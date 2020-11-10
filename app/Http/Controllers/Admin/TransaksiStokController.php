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
            $header = TransaksiStok::create([
                'nomor_transaksi'   => time(),
                'tipe'              => $request->tipe,
                'nomor_ijin'        => $request->nomor_ijin,
                'gudang_id'         => $request->gudang_id,
                'tanggal_transaksi' => $request->tanggal_transaksi,
            ]);
            
            if( $request->has('barang_id') ) {
                foreach( $request->barang_id as $key => $detail ) {
                    TransaksiStokDetail::create([
                        'transaksi_id'      => $header->id,
                        'barang_id'         => $detail,
                        'qty'               => $request->qty[$key] ?? '',
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
                            'barang_id' => $detail,
                            'stock'     => $request->qty[$key]
                        ];
                        $stockId = StokBarang::create($stock);
                        $stockAwal = $check->stock ?? 0;
                        LogStokBarang::create([
                            'id'                => \uniqid(),
                            'stock_barang_id'   => $stockId->id,
                            'barang_id'         => $detail,
                            'log_type'          => LogStokBarang::BarangMasuk,
                            'qty_before'        => $stockAwal ?? 0,
                            'qty_after'         => $stockAwal + $request->qty[$key],
                            'created_by'        => \Auth::user()->id,
                            'transaksi_id'      => $header->id
                        ]);
                    } else {
                        $stock = [
                            'gudang_id' => $request->gudang_id,
                            'barang_id' => $detail,
                            'stock'     => \DB::raw("stock + $qty")
                        ];
                        $stockId = StokBarang::where('barang_id',$request->barang_id)
                                ->where('gudang_id', $request->gudang_id)
                                ->update($stock);
        
                        LogStokBarang::create([
                            'id'             => \uniqid(),
                            'stock_barang_id' => $stockId,
                            'barang_id'      => $detail,
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
            ]);
                
            foreach( $request->barang_id as $key => $detail ) {
                TransaksiStokDetail::create([
                    'transaksi_id'      => $header->id,
                    'nomor_sparepart'   => $request->nomor_sparepart[$key],
                    'barang_id'         => $request->barang_id[$key],
                    'qty'               => $request->qty[$key],
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
    public function update(UpdateTransaksiRequest $request, $id)
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
