<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProgramRequest;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\PeriodeProgram as Program;
use App\DetailPeriodeProgram;
use App\MstGudang;
use App\Item;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('customer_access'), 403);

        $program = Program::all();
        $prog = Program::all()->pluck('name', 'id');
        // dd($program);
        return view('admin.program.index', compact('program', 'prog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('customer_create'), 403);
        $gudang = MstGudang::all()->pluck('nama_gudang','id');
        $item   = Item::all()->pluck('nama','id');

        return view('admin.program.create', compact('gudang', 'item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $program = Program::create([
            'name'          => $request->nama,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'description'   => $request->desc,
            'created_by'    => \Auth::user()->id,
            'created_at'    => date('Y-m-d H:i:s'),   
        ]);

        $i=0;
        if(isset($request->barang_id[$i])) {
            for($count = 0;$count < count($request->barang_id); $count++) {
                $data = array(
                    'id_periode'    => $program->id,
                    'id_barang'     => $request->barang_id[$count],
                    'created_at'    => date('Y-m-d H:i:s')
                );
                $insert_detail[] = $data;
            }
            DetailPeriodeProgram::insert($insert_detail);
        }
        return \redirect()->route('admin.program.index')->with('success',\trans('notif.notification.save_data.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::find($id);
        $detail = DetailPeriodeProgram::where('id_periode', $id)
                ->get();
        
        return view('admin.program.show', compact('program', 'detail')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(\Gate::allows('customer_create'), 403);

        $program = Program::find($id);
        $detail = DetailPeriodeProgram::where('id_periode', $id)
                ->get();
        $gudang = MstGudang::all()->pluck('nama_gudang','id');
        $item   = Item::all()->pluck('nama','id');

        return view('admin.program.edit', compact('program', 'detail','gudang', 'item'));
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
