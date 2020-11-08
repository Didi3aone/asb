<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGudangRequest;
use App\Http\Requests\StoreGudangRequest;
use App\Http\Requests\UpdateGudangRequest;
use App\MstGudang;
use App\RakGudang;

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
        \DB::beginTransaction();
        try {
            // dd($request);
            $gudang = MstGudang::create([
                'nama_gudang' => $request->nama_gudang
            ]);

            $i=0;

            if(isset($request->rak[$i])) {
                for($count = 0;$count < count($request->rak); $count++) {
                    $data = array(
                        'gudang_id' => $gudang->id,
                        'name'      => $request->rak[$count],
                        'created_by'=> \Auth::user()->id,
                        'created_at'=> date('Y-m-d H:i:s')
                    );
                    $insert_detail[] = $data;
                }
                RakGudang::insert($insert_detail);
            }

            \DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
        } 

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
        $rak    = RakGudang::where('gudang_id', $id)
                ->get();

        return view('admin.gudang.edit', compact('gudang', 'rak'));
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

    public function addRakPartials(Request $request)
    {
        \DB::beginTransaction();
        try {
            $message['is_error'] = true;
            $message['error_msg'] = "";

            $data = array(
                'gudang_id'     => $request->gudang_id,
                'name'          => $request->rak,
                'created_by'    => \Auth::user()->id,
                'created_at'    => date('Y-m-d H:i:s')
            );
            $mpp = RakGudang::insertGetId($data);
            \DB::commit();
            $message['is_error'] = false;
            $message['error_msg'] = 'Save Sukses';
        } catch (\Throwable $th) {
            throw $th;
            $message['is_error'] = true;
            $message['error_msg'] = "Save Failed";
        }
    }

    public function updateRakPartials(Request $request)
    {
        \DB::beginTransaction();
        try {
            $message['is_error'] = true;
            $message['error_msg'] = "";

            $rak = RakGudang::find($request->id);
            $rak->name          = $request->rak;
            $rak->updated_by   = \Auth::user()->id;
            $rak->updated_at   = date("Y-m-d H:i:s");
            $rak->update();

            \DB::commit();
            $message['is_error'] = false;
            $message['error_msg'] = 'Update Sukses';
        } catch (\Throwable $th) {
            throw $th;
            $message['is_error'] = true;
            $message['error_msg'] = "Update Failed";
        }
    }
}
