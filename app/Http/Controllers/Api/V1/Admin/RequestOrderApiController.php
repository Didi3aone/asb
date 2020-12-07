<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Request as Req;
use App\RoleUser;
use App\DetailRequest;
use App\MstGudang;
use App\Member;
use App\Item;

class RequestOrderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cekLevel = RoleUser::where('user_id', Auth::user()->id)->first();
        
        if ($cekLevel->role_id == 3) {
            $ro = Req::join('periode_programs', 'requests.program_id','=', 'periode_programs.id')
            ->join('users', 'requests.created_by', '=', 'users.id')
            ->select('requests.id','requests.no_request', 'requests.created_at', 'users.name as fullname', 'periode_programs.name')
            ->where('requests.created_by', Auth::user()->id)
            ->get();
        } elseif ($cekLevel->role_id == 1) {
            $ro = Req::join('periode_programs', 'requests.program_id','=', 'periode_programs.id')
            ->join('users', 'requests.created_by', '=', 'users.id')
            ->select('requests.id','requests.no_request', 'requests.created_at', 'users.name as fullname', 'periode_programs.name')
            ->get();
        }

        return response([
            'success'   => true,
            'message'   => 'List Semua Request Order',
            'data'      => $ro
        ], 200);
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
            $count = Req::count();
            $no = str_pad($count+1,4,"0",STR_PAD_LEFT);
            $noreq = "RO/".date('d/m/y')."-".$no;

            $validator = Validator::make($request->all(), [
                'program_id'   => 'required', 
            ],
            [
                'program_id.required'     => 'Masukkan program!'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'silahkan isi kolom yang kosong',
                    'data'      => $validator->errors()
                ], 400);
            } else {
                $req = Req::insertGetId([
                    'no_request'    => $noreq,
                    'program_id'    => $request->input('program_id'),
                    'created_by'    => Auth::user()->id,
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s'),
                ]);

                $i=0;
                if(isset($request->member[$i])) {
                    for($count = 0;$count < count($request->member); $count++) {
                        $data = array(
                            'req_id'        => $req,
                            'status_penerima'=> 0,
                            'receiver_id'   => $request->input('member')[$count],
                            'created_at'    => date('Y-m-d H:i:s')
                        );
                        $insert_detail[] = $data;
                    }
                    DetailRequest::insert($insert_detail);
                }
            }
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Request Order Berhasil Disimpan!',
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Request Order Gagal Disimpan!',
            ], 400);
        }
    }

    public function getProgram()
    {
        $ro = Req::join('periode_programs', 'requests.program_id','=', 'periode_programs.id')
            ->join('r_detail_requests', 'r_detail_requests.req_id', '=', 'requests.id')
            ->select('periode_programs.name')
            ->where('r_detail_requests.receiver_id', Auth::user()->id)
            ->get();
        
        if ($ro) {
            return response()->json([
                'success'   => true,
                'message'   => ' list Program!',
                'program'   => $ro
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Detail program Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
        
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
        $detail = DetailRequest::join('users', 'r_detail_requests.receiver_id', '=', 'users.id')
                ->selectRaw('r_detail_requests.id as detail_id ,r_detail_requests.receiver_id as member, users.name ,
                        r_detail_requests.status_penerima ,r_detail_requests.tanggal_terima')
                ->where('req_id', $id)
                ->get();
        
        if ($ro) {
            return response()->json([
                'success'   => true,
                'message'   => ' Request Order!',
                'RequestOrder'   => $ro,
                'detail'    => $detail,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Detail program Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateRO(Request $request)
    {
        \DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'program_id'   => 'required',
            ],
            [
                'program_id.required'     => 'Masukkan program!'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'silahkan isi kolom yang kosong',
                    'data'      => $validator->errors()
                ], 400);
            } else {
                $req = Req::find($request->input('id'));
                $req->program_id    = $request->input('program_id');
                $req->updated_by    = Auth::user()->id;
                $req->status        = 1;
                $req->updated_at    = date('Y-m-d H:i:s');

                $i=0;
                if(isset($request->member[$i])) {
                    for($count = 0;$count < count($request->member); $count++) {
                        if(isset($request->input('detail_id')[$count])) {
                            $dt = DetailRequest::find($request->input('detail_id')[$count]);
                            $dt->req_id         = $request->input('id');
                            $dt->receiver_id    = $request->input('member')[$count];
                            $dt->status_penerima= 1;
                            $dt->tanggal_terima = $request->input('tgl_terima')[$count] ?? date('Y-m-d H:i:s');
                            $dt->updated_at     = date('Y-m-d H:i:s');
                            $dt->update();
                        } else {
                            $data = array(
                                'req_id'            => $request->input('id'),
                                'receiver_id'       => $request->input('member')[$count],
                                'created_at'        => date('Y-m-d H:i:s'),
                                'status_penerima'   => 1,
                                'tanggal_terima'    => $request->input('tgl_terima')[$count] ?? date('Y-m-d H:i:s'),
                                'updated_at'        => date('Y-m-d H:i:s'),
                            );
                            $insert_detail[] = $data;
                            DetailRequest::insert($insert_detail);
                        }
                    }
                }
            }
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Request Order Berhasil Di update!',
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Request Order Gagal Disimpan!',
            ], 400);
        }
    }
    
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
