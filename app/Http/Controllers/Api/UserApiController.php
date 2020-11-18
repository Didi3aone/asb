<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\VerifyEmail;
use Mail;
use JWTAuth;
use Auth;
use App\User;
use App\DetailUsers;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
                $detail = '';
            } else {
                $detail = DetailUsers::where('userid', Auth::user()->id)->first();
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
            $detail = '';
        }

        
        return response()->json([
            'token' => $token,
            'data' => $detail
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'password'  => $request->get('password'),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function daftar(Request $request)
    {
        \DB::beginTransaction();
        try {
            $count = DetailUsers::count();
            $no_member = str_pad($count+1,12,"0",STR_PAD_LEFT);

            $validator = Validator::make($request->all(), [
                'name'              => 'required',
                'emailaddress'      => 'required|email|unique:users,email',
                'password'          => 'required',
                'nickname'          => 'required',
                'no_ktp'            => 'required|numeric',
                'no_kk'             => 'required|numeric',
                'gender'            => 'required',
                'tgl_lahir'         => 'required',
                'birth_place'       => 'required',
                'status_kawin'      => 'required',
                'pekerjaan'         => 'required',
                'no_hp'             => 'required|numeric',
                'alamat'            => 'required',
                'provinsi'          => 'required',
                'kabupaten'         => 'required',
                'kecamatan'         => 'required',
                'kelurahan'         => 'required',
                'alamat_domisili'   => 'required',
                'provinsi_domisili' => 'required',
                'kabupaten_domisili'=> 'required',
                'kecamatan_domisili'=> 'required',
                'kelurahan_domisili'=> 'required',
                'foto_kk'           => 'required|mimes:jpeg,jpg,png,gif|required|max:2048',
                'foto_ktp'          => 'required|mimes:jpeg,jpg,png,gif|required|max:2048',
            ],
            [
                'name.required'             => 'Masukkan nama !',
                'emailaddress.required'     => 'Masukkan email yg Valid !',
                'password.required'         => 'Masukkan password !',
                'nickname.required'         => 'Masukkan nama panggilan !',
                'no_ktp.required'           => 'Masukkan no ktp / harus nomor !',
                'no_kk.required'            => 'Masukkan no kk / harus nomor !',
                'gender.required'           => 'Masukkan Gender !',
                'tgl_lahir.required'        => 'Masukkan tanggal lahir !',
                'birth_place.required'      => 'Masukkan tempat lahir !',
                'pekerjaan.required'        => 'Masukkan Pekerjaan !',
                'no_hp.required'            => 'Masukkan nomor HP !',
                'foto_ktp.required'         => 'Masukkan foto KTP !',
                'foto_kk.required'          => 'Masukkan Foto KK !',
                'alamat.required'           => 'Masukkan Alamat !',
                'provinsi.required'         => 'Masukkan provinsi !',
                'kabupaten.required'        => 'Masukkan kabupaten !',
                'kecamatan.required'        => 'Masukkan kecamatan !',
                'kelurahan.required'        => 'Masukkan kelurahan !',
                'alamat_domisili.required'  => 'Masukkan alamat domisili !',
                'provinsi_domisili.required'=> 'Masukkan provinsi domisili !',
                'kabupaten_domisili.required'=> 'Masukkan kabupaten domisili !',
                'kecamatan_domisili.required'=> 'Masukkan kecamatan domisili !',
                'kelurahan_domisili.required'=> 'Masukkan kelurahan domisili !',
            ]);
            
            if($validator->fails()) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'silahkan isi kolom yang kosong',
                    'data'      => $validator->errors()
                ], 400);
            } else {
                if ($request->file('avatar')) {
                    $avatar = $request->file('avatar');
                    $size=$request->file('avatar')->getSize();
                    $avatar_name = time() . $avatar->getClientOriginalName();
                    $path = $avatar->storeAs('avatar', $avatar_name);
                    // $avatar->move(public_path() . '/images/avatar/', $avatar_name);
                } else {
                    $avatar_name = 'noimage.jpg';
                }
                if ($request->file('foto_kk')) {
                    $kk = $request->file('foto_kk');
                    $size=$request->file('foto_kk')->getSize();
                    $kk_name = time() . $kk->getClientOriginalName();
                    $path = $kk->storeAs('kk', $kk_name);
                    // $kk->move(public_path() . '/images/kk/', $kk_name);
                } else {
                    $kk_name = 'noimage.jpg';
                }
                if ($request->file('foto_ktp')) {
                    $ktp = $request->file('foto_ktp');
                    $size=$request->file('foto_ktp')->getSize();
                    $ktp_name = time() . $ktp->getClientOriginalName();
                    $path = $ktp->storeAs('ktp', $ktp_name);
                    // $ktp->move(public_path() . '/images/ktp/', $ktp_name);
                } else {
                    $ktp_name = 'noimage.jpg';
                }

                $users = User::create([
                    'name'          => $request->input('name'),
                    'email'         => $request->input('emailaddress'),
                    'password'      => $request->input('password'),
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
                    'nickname'          => $request->input('nickname'),
                    'nik'               => $request->input('no_ktp'),
                    'no_kk'             => $request->input('no_kk'),
                    'gender'            => $request->input('gender'),
                    'tgl_lahir'         => $request->input('tgl_lahir'),
                    'birth_place'       => $request->input('birth_place'),
                    'status_kawin'      => $request->input('status_kawin'),
                    'pekerjaan'         => $request->input('pekerjaan'),
                    'no_hp'             => $request->input('no_hp'),
                    'alamat'            => $request->input('alamat'),
                    'provinsi'          => $request->input('provinsi'),
                    'kabupaten'         => $request->input('kabupaten'),
                    'kecamatan'         => $request->input('kecamatan'),
                    'kelurahan'         => $request->input('kelurahan'),
                    'alamat_domisili'   => $request->input('alamat_domisili'),
                    'provinsi_domisili' => $request->input('provinsi_domisili'),
                    'kabupaten_domisili'=> $request->input('kabupaten_domisili'),
                    'kecamatan_domisili'=> $request->input('kecamatan_domisili'),
                    'kelurahan_domisili'=> $request->input('kelurahan_domisili'),
                    'activation_code'   => Str::random(40).$request->input('email'),
                    'avatar'            => $avatar_name,
                    'foto_ktp'          => $ktp_name,
                    'foto_kk'           => $kk_name,
                    'status_korlap'     => 1,
                    'created_at'        => date('Y-m-d H:i:s')
                );
                $detail = DetailUsers::insert($data);
                Mail::to($users->email)->send(new VerifyEmail($users));
            }
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data Anggota Berhasil Disimpan!',
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Data Anggota Gagal Disimpan!',
            ], 400);
        }
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}
