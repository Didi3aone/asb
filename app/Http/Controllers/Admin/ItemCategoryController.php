<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemCategoryRequest;
use App\Http\Requests\StoreItemCategoryRequest;
use App\Http\Requests\UpdateItemCategoryRequest;
use App\ItemCategory;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('item_category_access'), 403);

        $itemCategory = ItemCategory::all();

        return view('admin.item.category.index', compact('itemCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('item_category_create'), 403);
        
        return view('admin.item.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemCategoryRequest $request)
    {
        ItemCategory::create($request->all());

        return \redirect()->route('admin.item-category.index')->with('success',\trans('notif.notification.save_data.success'));
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
        abort_unless(\Gate::allows('item_category_edit'), 403);
        $itemCategory = ItemCategory::find($id);

        return view('admin.item.category.edit', compact('itemCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemCategoryRequest $request, $id)
    {
        $itemCategory = ItemCategory::find($id);
        $itemCategory->update($request->all());

        return \redirect()->route('admin.item-category.index')->with('success',\trans('notif.notification.update_data.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(\Gate::allows('item_category_delete'), 403);

        $gudang = ItemCategory::find($id);
        $gudang->is_active  = ItemCategory::NotActive;
        $gudang->deleted_at = \Carbon\Carbon::now();
        $gudang->deleted_by = \Auth::user()->id;
        $gudang->update();

        return \redirect()->route('admin.item-category.index')->with('success',\trans('notif.notification.delete_data.success'));
    }
}
