<?php

namespace App\Http\Controllers\Admin;
use App\Item;
use App\MstGudang;
use App\MstCustomer;
use App\MstSupplier;
use App\ItemCategory;
use App\RoleUser;

class HomeController
{
    public function index()
    {
        $item       = Item::count();
        $warehouse  = MstGudang::count();
        $customer   = MstCustomer::count();
        $supplier   = MstSupplier::count();
        // $stock      = Item::getStockHabis();
        $cekLevel = RoleUser::where('user_id', \Auth::user()->id)->first();

        if ($cekLevel->role_id == 3) {
            $name = \Auth::user()->name;

            return view('member', compact('name'));
        } else {
            $stock      = Item::join('kategori_barang', 'barang.kategori_id', '=', 'kategori_barang.id')
                    ->join('unit_barang', 'unit_barang.id', '=', 'barang.unit_id')
                    ->leftJoin('stok_barang', 'stok_barang.barang_id', '=', 'barang.id')
                    ->leftJoin('mst_gudang', 'mst_gudang.id', '=', 'stok_barang.gudang_id')
                    ->select('barang.nama',
                            'kategori_barang.nama as kategori',
                            'unit_barang.nama as unit',
                            'stok_barang.stock',
                            'mst_gudang.nama_gudang'        
                    )->get();

            return view('home',\compact('item','warehouse','customer','supplier','stock'));
        }
    }
}
