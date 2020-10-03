<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGudangRequest;
use App\Http\Requests\StoreGudangRequest;
use App\Http\Requests\UpdateGudangRequest;
use App\MstGudang;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('gudang_access'), 403);

        $gudang = MstGudang::all();

        return view('admin.gudang.index', compact('gudang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('gudang_create'), 403);
        
        return view('admin.gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGudangRequest $request)
    {
        MstGudang::create($request->all());

        return \redirect()->route('admin.gudang.index')->with('success',\trans('notif.notification.save_data.success'));
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
        abort_unless(\Gate::allows('gudang_edit'), 403);
        $gudang = MstGudang::find($id);

        return view('admin.gudang.edit', compact('gudang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGudangRequest $request, $id)
    {
        $mstgudang = MstGudang::find($id);
        $mstgudang->update($request->all());

        return \redirect()->route('admin.gudang.index')->with('success',\trans('notif.notification.update_data.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gudang = MstGudang::find($id);
        $gudang->is_active  = MstGudang::NotActive;
        $gudang->deleted_at = \Carbon\Carbon::now();
        $gudang->deleted_by = \Auth::user()->id;
        $gudang->update();

        return \redirect()->route('admin.gudang.index')->with('success',\trans('notif.notification.delete_data.success'));
    }
}
