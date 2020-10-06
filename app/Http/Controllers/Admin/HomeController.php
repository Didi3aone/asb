<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        $item       = \App\Item::count();
        $warehouse  = \App\MstGudang::count();
        $customer   = \App\MstCustomer::count();
        $supplier   = \App\MstSupplier::count();
        $stock      = \App\Item::getStockHabis();

        return view('home',\compact('item','warehouse','customer','supplier','stock'));
    }
}
