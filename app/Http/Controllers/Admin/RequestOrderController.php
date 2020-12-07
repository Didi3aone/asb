<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRORequest;
use App\Http\Requests\StoreRORequest;
use App\Http\Requests\UpdateRORequest;
use App\Request as Req;
use App\PeriodeProgram;
use App\DetailRequest;
use App\MstGudang;
use App\RoleUser;
use App\User;
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
            ->leftJoin('detail_users', 'users.id', '=', 'detail_users.userid')
            ->select('requests.id','requests.no_request', 'requests.created_at','detail_users.kecamatan', 'users.name as fullname', 'periode_programs.name')
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
        
        $program= PeriodeProgram::all()->pluck('name', 'id');
        $cekLevel = RoleUser::where('user_id', \Auth::user()->id)->first();
        if ($cekLevel->role_id == 3) {
            $findKec = DetailUsers::where('userid', \Auth::user()->id)->first();
            $member = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->where('role_user.role_id', 3)
                ->where('detail_users.kecamatan', $findKec->kecamatan)
                ->whereRaw('users.id != ?', \Auth::user()->id)
                ->select('users.name', 'users.id')
                ->get();
                // ->pluck('users.name', 'users.id');
        } else {
            $member = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->where('role_user.role_id', 3)
                ->whereRaw('users.id != ?', \Auth::user()->id)
                ->select('users.name', 'users.id')
                ->get();
                // ->pluck('name', 'id');
        }
        $item   = Item::all()->pluck('nama','id');

        return view('admin.ro.create', compact('program', 'member', 'item'));
    }

    public function reportRO(Request $request)
    {
        if($request->type == 1){
            $title = 'Status Pengajuan';
        } elseif ($request->type == 2) {
            $title = 'Status Pengiriman';
        } elseif ($request->type == 3) {
            $title = 'Status Telah Diterima';
        } else {
            $title = 'Semua Status';
        }

        $req = Req::join('periode_programs', 'requests.program_id', '=', 'periode_programs.id')
            ->selectRaw('requests.id, requests.no_request, periode_programs.name');
            if(isset($request->start) && isset($request->end))
            {
                $req->where('requests.created_at', '>=', $request->start);
                $req->where('requests.created_at', '<=', $request->end);
            }
        $report = $req->get();

        return view('admin.ro.report', compact('report', 'title')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $req = Req::insertGetId([
                'no_request'    => $request->no_req,
                'program_id'    => $request->program_id,
                'created_by'    => \Auth::user()->id,
                'created_at'    => date('Y-m-d H:i:s'),
                'status'        => 0,
            ]);
            
            $i=0;
            if(isset($request->chkbox[$i])) {
                for($count = 0;$count < count($request->chkbox); $count++) {
                    $data = array(
                        'req_id'        => $req,
                        'receiver_id'   => $request->chkbox[$count],
                        'created_at'    => date('Y-m-d H:i:s'),
                        'status_penerima' => 0
                    );
                    $insert_detail[] = $data;
                }
                DetailRequest::insert($insert_detail);
            }
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
        return \redirect()->route('admin.ro.index')->with('success',\trans('notif.notification.update_data.success'));
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
            ->where('requests.id', $id)
            ->first();
        // dd($ro); 
        $detail = DetailRequest::leftJoin('detail_users', 'r_detail_requests.receiver_id', '=', 'detail_users.userid')
                ->leftJoin('users', 'detail_users.userid', '=', 'users.id')
                ->where('req_id', $id)
                ->get();
        
        return view('admin.ro.show', compact('ro', 'detail')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(\Gate::allows('transaction_edit'), 403);

        $ro = Req::find($id);
        $program= PeriodeProgram::all()->pluck('name', 'id');
        $cekLevel = RoleUser::where('user_id', \Auth::user()->id)->first();
        if ($cekLevel->role_id == 3) {
            $findKec = DetailUsers::where('userid', \Auth::user()->id)->first();
            $member = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->where('role_user.role_id', 3)
                ->where('detail_users.kecamatan', $findKec->kecamatan)
                ->select('users.name', 'users.id')
                ->get();
                // ->pluck('users.name', 'users.id');
        } else {
            $member = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                ->where('role_user.role_id', 3)
                ->select('users.name', 'users.id')
                ->get();
                // ->pluck('name', 'id');
        }
        $item   = Item::all()->pluck('nama','id');

        return view('admin.ro.edit', compact('ro', 'program', 'member', 'item'));
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
        \DB::beginTransaction();
        try {
            $ro = Req::find($id);
            $ro->no_request = $request->no_request;
            $ro->program_id = $request->program_id;
            $ro->updated_by = \Auth::user()->id;
            $ro->status     = 1;
            $ro->update();

            $i=0;
            if(isset($request->chkbox[$i])) {
                for($count = 0;$count < count($request->chkbox); $count++) {
                    $data = array(
                        'req_id'        => $id,
                        'receiver_id'   => $request->chkbox[$count],
                        'updated_at'    => date('Y-m-d H:i:s'),
                        'tanggal_terima' => date('Y-m-d H:i:s'),
                        'status_penerima'=> 1,
                    );
                    $insert_detail[] = $data;
                }
                DetailRequest::insert($insert_detail);
            }
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Req::find($id);
        // $data->is_active  = 0;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->updated_by = \Auth::user()->id;
        $data->update();

        return \redirect()->route('admin.ro.index')->with('success',\trans('notif.notification.delete_data.success'));
    }
}
