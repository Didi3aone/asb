<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRORequest;
use App\Http\Requests\StoreRORequest;
use App\Http\Requests\UpdateRORequest;
use App\Request as Req;
use App\PeriodeProgram;
use App\MstGudang;
use App\Member;
use App\Item;

class RequestOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ro = Req::join('periode_programs', 'requests.program_id','=', 'periode_programs.id')
            ->join('users', 'requests.created_by', '=', 'users.id')
            ->select('requests.id','requests.no_request', 'requests.created_at', 'users.name as fullname', 'periode_programs.name')
            ->get();
        
        return view('admin.ro.index', compact('ro')); 
    }

    public function countRO($id)
    {
        $ro = Req::where('no_request', $id)
            ->selectRaw('count(id) as jml')
            ->first();
        
        return $ro;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('transaction_create'), 403);
        $program = PeriodeProgram::all()->pluck('name', 'id');
        $member = Member::all()->pluck('nama', 'id');
        $item   = Item::all()->pluck('nama','id');

        return view('admin.ro.create', compact('program', 'member', 'item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ro = Req::join('periode_programs', 'requests.program_id','=', 'periode_programs.id')
            ->join('users', 'requests.created_by', '=', 'users.id')
            ->where('periode_programs.id', $id)
            ->first();
        
        return view('admin.ro.show', compact('ro')); 
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
