<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Information;
use App\ArticleCategory as Category;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('information_access'), 403);

        $info = Information::all();
        // dd($program);
        return view('admin.info.index', compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('information_create'), 403);
        $category = Category::where('is_active', 1)->pluck('name', 'id');
        
        return view('admin.info.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $pict = $request->file('foto');
            $pict_name = time() . $pict->getClientOriginalName();
            $pict->move(public_path() . '/images/', $pict_name);
        } else {
            $pict_name = 'noimage.jpg';
        }

        // if($file = $request->hasFile('fotos')) {
        //     $file = $request->file('fotos') ;
        //     $name = time() . $file->getClientOriginalName();
        //     $file->move(public_path() . '/images/item/', $name);
        //     $request->merge(['foto' => serialize($name)]);
        // } else {
        //     $pict_name = 'noimage.jpg';
        // }

        $info = Information::create([
            'kategori_id'   => $request->kategori_id,
            'name'          => $request->nama,
            'content'       => $request->content,
            'gambar'        => $pict_name,
            'created_by'    => \Auth::user()->id,
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        return \redirect()->route('admin.info.index')->with('success',\trans('notif.notification.save_data.success'));
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
