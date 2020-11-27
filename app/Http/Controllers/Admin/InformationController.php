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
        // $path = \Image::make(storage_path() . '/app/articles/1605601994banjir.jpg');
        $info = Information::all();
        // dd($path);
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
            // $path = $pict->storeAs('articles', $pict_name);
            $pict->move(public_path() . '/images/articles', $pict_name);
        } else {
            $pict_name = 'noimage.jpg';
        }

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
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(\Gate::allows('information_edit'), 403);

        $info = Information::find($id);
        $category = Category::where('is_active', 1)->pluck('name', 'id');
        
        return view('admin.info.edit', compact('info', 'category'));
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
        if ($request->hasFile('foto')) {
            $pict = $request->file('foto');
            $pict_name = time() . $pict->getClientOriginalName();
            // $path = $pict->storeAs('articles', $pict_name);
            $pict->move(public_path() . '/images/articles', $pict_name);
        } else {
            $pict_name = 'noimage.jpg';
        }

        $info = Information::find($id);
        $info->name         = $request->nama;
        $info->kategori_id  = $request->kategori_id;
        if ($request->hasFile('foto')) {
            $info->gambar     = $pict_name;
        }
        $info->content      = $request->content;
        $info->update();
        
        return \redirect()->route('admin.info.index')->with('success',\trans('notif.notification.update_data.success'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = Information::find($id);
        $info->is_active  = 0;
        $info->deleted_at = date('Y-m-d H:i:s');
        $info->updated_by = \Auth::user()->id;
        $info->update();

        return \redirect()->route('admin.info.index')->with('success',\trans('notif.notification.delete_data.success'));
    }
}
