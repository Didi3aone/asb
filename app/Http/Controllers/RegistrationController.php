<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Mail;
use Auth;
use Crypt;
use Hash;
use App\User;
use App\DetailUsers;
use App\MaritalStatus;
use App\Job;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;


class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marital = MaritalStatus::where('status', 1)->pluck('name', 'id');
        $provinsi = Provinsi::where('status', 1)->pluck('name', 'id_prov');
        $kabupaten =  Kabupaten::where('status', 1)->pluck('name', 'id_kab');
        $job = Job::where('status', 1)->pluck('name', 'id');

        // return view('admin.registration.create', compact('marital','provinsi', 'job'));
        return view('layouts.reg', compact('marital','provinsi', 'kabupaten', 'job'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function getKelurahan(Request $request)
    {
        $data = Kelurahan::where('id_kec', $request->val)
            ->get();

        return \Response::json($data);
    }

    public function getKecamatan(Request $request)
    {
        $data = Kecamatan::where('id_kab', $request->val)
            ->get();

        return \Response::json($data);
    }

    public function getKabupaten(Request $request)
    {
        $data = Kabupaten::where('id_prov', $request->val)
            ->get();

        return \Response::json($data);
    }

    public function checkEmail($email)
    {
        $check = User::where('email', $email)
                ->first();
        
        return $check;
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
            $no_member = str_pad($count+1,12,"0",STR_PAD_LEFT);
            
            //validation email & nomor ktp
            $check = User::where('email', $request->emailaddress)
                    ->select('id')
                    ->first();

            $checkNik = DetailUsers::where('nik', $request->nik)
                    ->select('id')
                    ->first();
                    
            if(isset($check->id)) {
                $message['is_error'] = true;
                $message['error_msg'] = "Email Sudah Ada";
            } elseif (isset($checkNik->id)) {
                $message['is_error'] = true;
                $message['error_msg'] = "nomor KTP sudah terdaftar";
            } else {
                if ($request->file('foto_kk')) {
                    $kk = $request->file('foto_kk');
                    $size=$request->file('foto_kk')->getSize();
                    $kk_name = time() . $kk->getClientOriginalName();
                    $kk->move(public_path() . '/images/kk/', $kk_name);
                } else {
                    $kk_name = 'noimage.jpg';
                }
                if ($request->file('foto_ktp')) {
                    $ktp = $request->file('foto_ktp');
                    $size=$request->file('foto_ktp')->getSize();
                    $ktp_name = time() . $ktp->getClientOriginalName();
                    $ktp->move(public_path() . '/images/ktp/', $ktp_name);
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
                    'foto_ktp'          => $ktp_name,
                    'foto_kk'           => $kk_name,
                    'status_korlap'     => 0,
                    'created_at'        => date('Y-m-d H:i:s')
                );
                $detail = DetailUsers::insert($data);
                Mail::to($users->email)->send(new VerifyEmail($users));

                \DB::commit();
                
                // send email verification
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

    public function successReg()
    {
        return view('layouts.success');
    }

    public function verify()
    {
        if (empty(request('token'))) {
            // if token is not provided
            return redirect()->route('daftar.index');
        }

        // descrypt token as email
        $decryptedEmail = Crypt::decrypt(request('token'));

        // find user by email
        $user = User::whereEmail($decryptedEmail)->first();

        if ($user->is_verified == 'verified') {
            Auth::loginUsingId($user->id);

            return redirect('/admin');
        } else {
            // otherwise change user status to "activated"
            $user->is_verified = 'verified';
            $user->save();
            
            //save verify
            $dt = DetailUsers::where('userid', $user->id)->first();
            $dt->is_verify = 1;
            $dt->save();
            // autologin
            Auth::loginUsingId($user->id);

            return redirect('/admin');
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
