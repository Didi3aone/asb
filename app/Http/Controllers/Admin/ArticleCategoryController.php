<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Information;
use App\ArticleCategory as Category;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('category_access'), 403);

        $category = Category::orderBy('created_at', 'DESC')
                    ->get();
        // dd($program);
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('category_create'), 403);
        
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            $pict = $request->file('thumbnail');
            $pict_name = time() . $pict->getClientOriginalName();
            // $path = $pict->storeAs('thumbnail', $pict_name);
            // $path = $pict->storeAs(public_path(). '/images/thumbnail/', $pict_name);
            $pict->move(public_path() . '/images/thumbnail/', $pict_name);
        } else {
            $pict_name = 'noimage.jpg';
        }
        
        $category = Category::create([
            'name'      => $request->nama,
            'thumbnail' => $pict_name,
            'created_by'=> \Auth::user()->id,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        return \redirect()->route('admin.category.index')->with('success',\trans('notif.notification.save_data.success'));
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
        abort_unless(\Gate::allows('category_edit'), 403);
        $category = Category::find($id);
        
        return view('admin.category.edit', compact('category'));
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
        if ($request->hasFile('thumbnail')) {
            $pict = $request->file('thumbnail');
            $pict_name = time() . $pict->getClientOriginalName();
            // $path = $pict->storeAs('thumbnail', $pict_name);
            // $path = $pict->storeAs(public_path(). '/images/thumbnail/', $pict_name);
            $pict->move(public_path() . '/images/thumbnail/', $pict_name);
        } 
        
        $category = Category::find($id);
        $category->name          = $request->name;
        if ($request->hasFile('thumbnail')) {
            $category->thumbnail     = $pict_name;
        }
        $category->updated_by    = \Auth::user()->id;
        $category->updated_at    = date('Y-m-d H:i:s');
        $category->update();

        return \redirect()->route('admin.category.index')->with('success',\trans('notif.notification.update_data.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id);
        $data->is_active  = 0;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->updated_by = \Auth::user()->id;
        $data->update();

        return \redirect()->route('admin.category.index')->with('success',\trans('notif.notification.delete_data.success'));
    }
}
