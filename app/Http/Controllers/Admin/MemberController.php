<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMemberRequest;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Hash;
use App\Member;
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

        $member = Member::all();
        // dd($program);
        return view('admin.member.index', compact('member'));
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
        $job = Job::where('status', 1)->pluck('name', 'id');
        
        return view('admin.member.create', compact('marital', 'provinsi', 'job'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = Member::count();
        $no_member = str_pad($count+1,12,"0",STR_PAD_LEFT);
        
        if ($request->file('foto_kk')) {
            $kk = $request->file('foto_kk');
            $kk_name = time() . $kk->getClientOriginalName();
            $kk->move(public_path() . '/images/kk/', $kk_name);
        } else {
            $kk_name = 'noimage.jpg';
        }
        if ($request->file('foto_ktp')) {
            $ktp = $request->file('foto_ktp');
            $ktp_name = time() . $ktp->getClientOriginalName();
            $ktp->move(public_path() . '/images/ktp/', $ktp_name);
        } else {
            $ktp_name = 'noimage.jpg';
        }

        $member = Member::create([
            'no_member'     => $no_member,
            'nama'          => $request->name,
            'nik'           => $request->nik,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'no_telp'       => $request->no_telp,
            'no_hp'         => $request->no_hp,
            'gender'        => $request->gender,
            'status_kawin'  => $request->marital,
            'pekerjaan'     => $request->job,
            'status_korlap' => $request->level,
            'alamat'        => $request->address,
            'provinsi'      => $request->provinsi,
            'kabupaten'     => $request->kabupaten,
            'kecamatan'     => $request->kecamatan,
            'kelurahan'     => $request->kelurahan,
            'created_by'    => \Auth::user()->id,
            'foto_ktp'      => $ktp_name,
            'foto_kk'       => $kk_name,
        ]);

        return \redirect()->route('admin.master-member.index')->with('success',\trans('notif.notification.save_data.success'));
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

        $member = Member::find($id);
        return view('admin.member.show', compact('member'));
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

        $member = Member::find($id);
        $marital = MaritalStatus::where('status', 1)->pluck('name', 'id');
        $provinsi = Provinsi::where('status', 1)->pluck('name', 'id_prov');
        $kabupaten = Kabupaten::where('id_prov', $member->provinsi)
                    ->pluck('name', 'id_kab');
        $kecamatan = Kecamatan::where('id_kab', $member->kabupaten)
                    ->pluck('name', 'id_kec');
        $kelurahan = Kelurahan::where('id_kec', $member->kecamatan)
                    ->pluck('name', 'id_kel');
        $job = Job::where('status', 1)->pluck('name', 'id');

        return view('admin.member.edit', compact(
            'member', 
            'marital', 
            'provinsi', 
            'kabupaten', 
            'kecamatan', 
            'kelurahan', 
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
    public function update(Request $request, $id)
    {
        
        if ($request->file('foto_kk')) {
            $kk = $request->file('foto_kk');
            $kk_name = time() . $kk->getClientOriginalName();
            $kk->move(public_path() . '/images/kk/', $kk_name);
        } 

        if ($request->file('foto_ktp')) {
            $ktp = $request->file('foto_ktp');
            $ktp_name = time() . $ktp->getClientOriginalName();
            $ktp->move(public_path() . '/images/ktp/', $ktp_name);
        }

        $member = Member::find($id);
        $member->nama          = $request->name;
        $member->nik           = $request->nik;
        $member->email         = $request->email;
        $member->password      = Hash::make($request->password);
        $member->no_telp       = $request->no_telp;
        $member->no_hp         = $request->no_hp;
        $member->gender        = $request->gender;
        $member->status_kawin  = $request->marital;
        $member->pekerjaan     = $request->job;
        $member->status_korlap = $request->level;
        $member->alamat        = $request->address;
        $member->provinsi      = $request->provinsi;
        $member->kabupaten     = $request->kabupaten;
        $member->kecamatan     = $request->kecamatan;
        $member->kelurahan     = $request->kelurahan;
        $member->updated_by    = \Auth::user()->id;
        $member->updated_at    = date('Y-m-d H:i:s');
        if ($request->file('foto_kk')) {
            $member->foto_kk       = $kk_name;
        }
        if ($request->file('foto_ktp')) {
            $member->foto_ktp      = $ktp_name;
        }
        $member->update();
        return \redirect()->route('admin.master-member.index')->with('success',\trans('notif.notification.update_data.success'));
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
