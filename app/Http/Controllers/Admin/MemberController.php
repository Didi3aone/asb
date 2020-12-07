<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMemberRequest;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Hash;
use App\User;
use App\RoleUser;
use App\DetailUsers;
use App\MaritalStatus;
use App\Job;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('member_access'), 403);

        $cekLevel = RoleUser::where('user_id', \Auth::user()->id)->first();

        if ($cekLevel->role_id == 3) {
            $findKec = DetailUsers::where('userid', \Auth::user()->id)->first();

            $member = User::join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('kecamatans', 'detail_users.kecamatan', '=', 'kecamatans.id_kec')
                ->join('provinsis', 'detail_users.provinsi', '=', 'provinsis.id_prov')
                ->selectRaw('detail_users.userid ,provinsis.zona_waktu as provid ,
                        kecamatans.id as kecid ,detail_users.no_member ,
                        users.name ,detail_users.nik ,detail_users.no_hp ,
                        users.email ,users.created_at ,
                        users.is_active ,detail_users.status_korlap')
                ->where('role_user.role_id', 3)
                ->where('detail_users.kecamatan', $findKec->kecamatan)
                ->get();
        } else {
            $member = User::join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('kecamatans', 'detail_users.kecamatan', '=', 'kecamatans.id_kec')
                ->join('provinsis', 'detail_users.provinsi', '=', 'provinsis.id_prov')
                ->selectRaw('detail_users.userid ,provinsis.zona_waktu as provid ,
                        kecamatans.id as kecid ,detail_users.no_member ,
                        users.name ,detail_users.nik ,detail_users.no_hp ,
                        users.email ,users.created_at ,
                        users.is_active ,detail_users.status_korlap')
                ->where('role_user.role_id', 3)
                ->get();
        }
        
        // dd($program);
        return view('admin.member.index', compact('member'));
    }

    public function indexVerified()
    {
        abort_unless(\Gate::allows('member_access'), 403);

        $cekLevel = RoleUser::where('user_id', \Auth::user()->id)->first();

        if ($cekLevel->role_id == 3) {
            $findKec = DetailUsers::where('userid', \Auth::user()->id)->first();
            
            $member = User::join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('kecamatans', 'detail_users.kecamatan', '=', 'kecamatans.id_kec')
                ->join('provinsis', 'detail_users.provinsi', '=', 'provinsis.id_prov')
                ->selectRaw('detail_users.userid ,provinsis.zona_waktu as provid ,
                        kecamatans.id as kecid ,detail_users.no_member ,
                        users.name ,detail_users.nik ,detail_users.no_hp ,
                        users.email ,users.created_at ,
                        users.is_active ,detail_users.status_korlap')
                ->where('role_user.role_id', 3)
                ->where('is_verified', 'verified')
                ->where('detail_users.kecamatan', $findKec->kecamatan)
                ->get();
        } else {
            $member = User::join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('kecamatans', 'detail_users.kecamatan', '=', 'kecamatans.id_kec')
                ->join('provinsis', 'detail_users.provinsi', '=', 'provinsis.id_prov')
                ->selectRaw('detail_users.userid ,provinsis.zona_waktu as provid ,
                        kecamatans.id as kecid ,detail_users.no_member ,
                        users.name ,detail_users.nik ,detail_users.no_hp ,
                        users.email ,users.created_at ,
                        users.is_active ,detail_users.status_korlap')
                ->where('role_user.role_id', 3)
                ->where('is_verified', 'verified')
                ->get();
        }
        
        return view('admin.member.verified.index', compact('member'));
    }

    public function indexPending()
    {
        abort_unless(\Gate::allows('member_access'), 403);

        $cekLevel = RoleUser::where('user_id', \Auth::user()->id)->first();

        if ($cekLevel->role_id == 3) {
            $findKec = DetailUsers::where('userid', \Auth::user()->id)->first();
            
            $member = User::join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('kecamatans', 'detail_users.kecamatan', '=', 'kecamatans.id_kec')
                ->join('provinsis', 'detail_users.provinsi', '=', 'provinsis.id_prov')
                ->selectRaw('detail_users.userid ,provinsis.zona_waktu as provid ,
                        kecamatans.id as kecid ,detail_users.no_member ,
                        users.name ,detail_users.nik ,detail_users.no_hp ,
                        users.email ,users.created_at ,
                        users.is_active ,detail_users.status_korlap')
                ->where('role_user.role_id', 3)
                ->where('is_verified', 'pending')
                ->where('detail_users.kecamatan', $findKec->kecamatan)
                ->get();
        } else {
            $member = User::join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('kecamatans', 'detail_users.kecamatan', '=', 'kecamatans.id_kec')
                ->join('provinsis', 'detail_users.provinsi', '=', 'provinsis.id_prov')
                ->selectRaw('detail_users.userid ,provinsis.zona_waktu as provid ,
                        kecamatans.id as kecid ,detail_users.no_member ,
                        users.name ,detail_users.nik ,detail_users.no_hp ,
                        users.email ,users.created_at ,
                        users.is_active ,detail_users.status_korlap')
                ->where('role_user.role_id', 3)
                ->where('is_verified', 'pending')
                ->get();
        }
        
        return view('admin.member.pending.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('member_create'), 403);

        $marital = MaritalStatus::where('status', 1)->pluck('name', 'id');
        $provinsi = Provinsi::where('status', 1)->pluck('name', 'id_prov');
        $kabupaten =  Kabupaten::where('status', 1)->pluck('name', 'id_kab');
        $job = Job::where('status', 1)->pluck('name', 'id');
        
        return view('admin.member.create', compact('marital', 'provinsi', 'kabupaten', 'job'));
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
            $message['is_error'] = true;
            $message['error_msg'] = "";
            $dob = date("Y-m-d", strtotime($request->tgl_lahir));
            $count = DetailUsers::count();
            $no_member = str_pad($count+1,7,"0",STR_PAD_LEFT);
            
            $check = User::where('email', $request->emailaddress)
                    ->select('id')
                    ->first();
            if(isset($check->id)) {
                $message['is_error'] = true;
                $message['error_msg'] = "Email Sudah Ada";
            } else {
                if ($request->file('avatar')) {
                    $avatar = $request->file('avatar');
                    $avatar_name = time() . $avatar->getClientOriginalName();
                    $path = $avatar->storeAs('avatar', $avatar_name);
                    // $avatar->move(public_path() . '/images/avatar/', $avatar_name);
                } else {
                    $kk_name = 'noimage.jpg';
                }
                if ($request->file('foto_kk')) {
                    $kk = $request->file('foto_kk');
                    $kk_name = time() . $kk->getClientOriginalName();
                    $path = $kk->storeAs('kk', $kk_name);
                    // $kk->move(public_path() . '/images/kk/', $kk_name);
                } else {
                    $kk_name = 'noimage.jpg';
                }
                if ($request->file('foto_ktp')) {
                    $ktp = $request->file('foto_ktp');
                    $ktp_name = time() . $ktp->getClientOriginalName();
                    $path = $ktp->storeAs('ktp', $ktp_name);
                    // $ktp->move(public_path() . '/images/ktp/', $ktp_name);
                } else {
                    $ktp_name = 'noimage.jpg';
                }

                $users = User::create([
                    'name'          => $request->name,
                    'email'         => $request->emailaddress,
                    'password'      => $request->password,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'theme_color'   => 1,
                    'is_active'     => 1,
                ]);

                $roles = \DB::table('role_user')
                        ->insert([
                            'user_id' => $users->id, 
                            'role_id' => 3
                ]);

                $data = array(
                    'userid'            => $users->id,
                    'no_member'         => $no_member,
                    'nickname'          => $request->nickname,
                    'nik'               => $request->nik,
                    'no_kk'             => $request->no_kk,
                    'gender'            => $request->gender,
                    'birth_place'       => $request->tempat_lahir,
                    'tgl_lahir'         => $dob,
                    'status_kawin'      => $request->marital,
                    'pekerjaan'         => $request->job,
                    'no_hp'             => $request->no_hp,
                    'alamat'            => $request->address,
                    'provinsi'          => $request->provinsi,
                    'kabupaten'         => $request->kabupaten,
                    'kecamatan'         => $request->kecamatan,
                    'kelurahan'         => $request->kelurahan,
                    'alamat_domisili'   => $request->alamat_domisili,
                    'provinsi_domisili' => $request->provinsi_domisili,
                    'kabupaten_domisili'=> $request->kabupaten_domisili,
                    'kecamatan_domisili'=> $request->kecamatan_domisili,
                    'kelurahan_domisili'=> $request->kelurahan_domisili,
                    'activation_code'   => Str::random(40).$request->input('email'),
                    'avatar'            => $avatar_name,
                    'foto_ktp'          => $ktp_name,
                    'foto_kk'           => $kk_name,
                    'created_by'        => \Auth::user()->id,
                    'status_korlap'     => 0,
                    'created_at'        => date('Y-m-d H:i:s')
                );
                $detail = DetailUsers::insert($data);
                \DB::commit();
                $message['is_error'] = false;
                $message['error_msg'] = "Pendaftaran Berhasil";
            }
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
            $message['is_error'] = true;
            $message['error_msg'] = "Pendaftaran Gagal";
        }
        
        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_unless(\Gate::allows('member_edit'), 403);

        $member = User::find($id);
        $detail = DetailUsers::where('userid', $id)
                ->first();

        if($detail->status_korlap == 1) {
            $show = User::join('detail_users', 'users.id', '=', 'detail_users.userid')
                ->where('detail_users.kecamatan', $detail->kecamatan)
                ->whereRaw('users.id != ?', $id)
                ->select('users.name', 'detail_users.*')
                ->get();
            
            return view('admin.member.show', compact('member', 'show', 'detail'));
        } else {
            return view('admin.member.show', compact('member', 'detail'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(\Gate::allows('member_edit'), 403);

        $member     = User::find($id);
        $detail     = DetailUsers::where('userid', $id)->first();
        $pob        = Kabupaten::all()->pluck('name', 'id_kab');

        $marital    = MaritalStatus::where('status', 1)->pluck('name', 'id');
        $provinsi   = Provinsi::where('status', 1)->pluck('name', 'id_prov');
        $kabupaten  = Kabupaten::where('id_prov', $detail->provinsi)
                    ->pluck('name', 'id_kab');
        $kecamatan  = Kecamatan::where('id_kab', $detail->kabupaten)
                    ->pluck('name', 'id_kec');
        $kelurahan  = Kelurahan::where('id_kec', $detail->kecamatan)
                    ->pluck('name', 'id_kel');
        $kabupatendomisili  = Kabupaten::where('id_prov', $detail->provinsi_domisili)
                    ->pluck('name', 'id_kab');
        $kecamatandomisili  = Kecamatan::where('id_kab', $detail->kabupaten_domisili)
                    ->pluck('name', 'id_kec');
        $kelurahandomisili  = Kelurahan::where('id_kec', $detail->kecamatan_domisili)
                    ->pluck('name', 'id_kel');
        $job        = Job::where('status', 1)->pluck('name', 'id');

        return view('admin.member.edit', compact(
            'member',
            'detail',
            'pob',
            'marital', 
            'provinsi', 
            'kabupaten', 
            'kecamatan', 
            'kelurahan', 
            'kabupatendomisili', 
            'kecamatandomisili', 
            'kelurahandomisili', 
            'job'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editKorlap($id)
    {
        abort_unless(\Gate::allows('member_edit'), 403);

        $member = User::find($id);
        $detail = DetailUsers::where('userid', $id)
                ->first();
        
        return view('admin.member.verified.update', compact('member', 'detail'));
    }

    public function updateKorlap(Request $request, $id)
    {
        $find = DetailUsers::where('userid', $id)->first();

        $detail = DetailUsers::find($find->id);
        $detail->status_korlap = $request->status;
        $detail->updated_at    = date('Y-m-d H:i:s');
        $detail->updated_by    = \Auth::user()->id;
        $detail->update();

        return \redirect()->route('admin.member-verified')->with('success',\trans('notif.notification.update_data.success'));
    }

    public function update(Request $request, $id)
    {
        \DB::beginTransaction();
        try {
            if ($request->file('foto_kk')) {
                $kk = $request->file('foto_kk');
                $kk_name = time() . $kk->getClientOriginalName();
                $path = $kk->storeAs('kk', $kk_name);
                // $kk->move(public_path() . '/images/kk/', $kk_name);
            } 

            if ($request->file('foto_ktp')) {
                $ktp = $request->file('foto_ktp');
                $ktp_name = time() . $ktp->getClientOriginalName();
                $path = $ktp->storeAs('ktp', $ktp_name);
                // $ktp->move(public_path() . '/images/ktp/', $ktp_name);
            }

            $member = User::find($id);
            $member->name          = $request->name;
            $member->email         = $request->email;
            $member->updated_at    = date('Y-m-d H:i:s');
            $member->update();
            
            $find = DetailUsers::where('userid', $id)->first();
            
            $detail = DetailUsers::find($find->id);
            $detail->nickname          = $request->nickname;
            $detail->nik               = $request->nik;
            $detail->no_kk             = $request->no_kk;
            $detail->gender            = $request->gender;
            $detail->birth_place       = $request->pob;
            $detail->tgl_lahir         = $request->dob;
            $detail->status_kawin      = $request->marital;
            $detail->pekerjaan         = $request->job;
            $detail->no_hp             = $request->no_hp;
            $detail->alamat            = $request->address;
            $detail->provinsi          = $request->provinsi;
            $detail->kabupaten         = $request->kabupaten;
            $detail->kecamatan         = $request->kecamatan;
            $detail->kelurahan         = $request->kelurahan;
            $detail->alamat_domisili   = $request->alamat_domisili;
            $detail->provinsi_domisili = $request->provinsi_domisili;
            $detail->kabupaten_domisili= $request->kabupaten_domisili;
            $detail->kecamatan_domisili= $request->kecamatan_domisili;
            $detail->kelurahan_domisili= $request->kelurahan_domisili;
            /* $detail->avatar            = $avatar_name;
            $detail->foto_ktp          = $ktp_name;
            $detail->foto_kk           = $kk_name; */
            $detail->updated_by        = \Auth::user()->id;
            $detail->updated_at        = date('Y-m-d H:i:s');
            $detail->update();

            \DB::commit();
            return \redirect()->route('admin.master-member.index')->with('success',\trans('notif.notification.update_data.success'));
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
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
        $user = User::find($id);
        $user->is_active  = 0;
        $user->deleted_at = date('Y-m-d H:i:s');
        $user->updated_by = \Auth::user()->id;
        $user->update();

        return \redirect()->route('admin.master-member.index')->with('success',\trans('notif.notification.delete_data.success'));
    }
}
