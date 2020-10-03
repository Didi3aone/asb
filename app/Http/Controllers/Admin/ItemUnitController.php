<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemUnitRequest;
use App\Http\Requests\StoreItemUnitRequest;
use App\Http\Requests\UpdateItemUnitRequest;
use App\ItemUnit;

class ItemUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('item_unit_access'), 403);

        $itemUnit = ItemUnit::all();

        return view('admin.item.unit.index', compact('itemUnit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('item_unit_create'), 403);
        
        return view('admin.item.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemUnitRequest $request)
    {
        ItemUnit::create($request->all());

        return \redirect()->route('admin.item-unit.index')->with('success',\trans('notif.notification.save_data.success'));
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
        abort_unless(\Gate::allows('item_unit_edit'), 403);
        $itemUnit = ItemUnit::find($id);

        return view('admin.item.unit.edit', compact('itemUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemUnitRequest $request, $id)
    {
        $ItemUnit = ItemUnit::find($id);
        $ItemUnit->update($request->all());

        return \redirect()->route('admin.item-unit.index')->with('success',\trans('notif.notification.update_data.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(\Gate::allows('item_unit_delete'), 403);
        $gudang = ItemUnit::find($id);
        $gudang->is_active  = ItemUnit::NotActive;
        $gudang->deleted_at = \Carbon\Carbon::now();
        $gudang->deleted_by = \Auth::user()->id;
        $gudang->update();

        return \redirect()->route('admin.item-unit.index')->with('success',\trans('notif.notification.delete_data.success'));
    }
}
