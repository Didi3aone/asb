<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('item_access'), 403);

        $item = Item::all();

        return view('admin.item.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('item_create'), 403);

        $kategori = \App\ItemCategory::all()->pluck('nama','id');
        $unit = \App\ItemUnit::all()->pluck('nama','id');

        return view('admin.item.create',\compact('kategori','unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        if($file = $request->hasFile('fotos')) {
            $file = $request->file('fotos') ;
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/images/item/', $name);
            $request->merge(['foto' => serialize($name)]);
        }

        Item::create($request->all());

        return \redirect()->route('admin.item.index')->with('success',\trans('notif.notification.save_data.success'));
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
        abort_unless(\Gate::allows('item_edit'), 403);

        $item = Item::find($id);
        $kategori = \App\ItemCategory::all()->pluck('nama','id');
        $unit = \App\ItemUnit::all()->pluck('nama','id');

        return view('admin.item.edit',\compact('item','kategori','unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, $id)
    {
        $item = Item::find($id);
        if($file = $request->hasFile('fotos')) {
            $file = $request->file('fotos') ;
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/images/item/', $name);
            $request->merge(['foto' => serialize($name)]);
        }
        $item->update($request->all());

        return \redirect()->route('admin.item.index')->with('success',\trans('notif.notification.update_data.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(\Gate::allows('item_delete'), 403);

        $gudang = Item::find($id);
        $gudang->is_active  = Item::NotActive;
        $gudang->deleted_at = \Carbon\Carbon::now();
        $gudang->deleted_by = \Auth::user()->id;
        $gudang->update();

        return \redirect()->route('admin.item.index')->with('success',\trans('notif.notification.delete_data.success'));
    }
}
