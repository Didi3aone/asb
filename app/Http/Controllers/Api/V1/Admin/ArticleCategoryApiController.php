<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Information;
use App\ArticleCategory as Category;

class ArticleCategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();

        return response([
            'success'   => true,
            'message'   => 'List Semua program',
            'data'      => $category
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
            $validator = Validator::make($request->all(), [
                'name'          => 'required'
            ],
            [
                'name.required'         => 'Masukkan nama kategori !'                
            ]);
            if($validator->fails()) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'silahkan isi kolom yang kosong',
                    'data'      => $validator->errors()
                ], 400);
            } else {

                if ($request->file('thumbnail')) {
                    $pict = $request->file('thumbnail');
                    $pict_name = time() . $pict->getClientOriginalName();
                    // $path = $pict->storeAs('thumbnail', $pict_name);
                    $pict->move(public_path() . '/images/thumbnail/', $pict_name);
                } else {
                    $pict_name = 'noimage.jpg';
                }

                $category = Category::create([
                    'name'          => $request->name,
                    'thumbnail'     => $pict_name,
                    'created_by'    => Auth::user()->id,
                    'created_at'    => date('Y-m-d H:i:s'),
                ]);
            }
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Kategori Berhasil Disimpan!',
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Kategori Gagal Disimpan!',
            ], 400);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArticle(Request $request)
    {
        \DB::beginTransaction();
        // dd($request);
        try {
            if ($request->file('thumbnail')) {
                $pict = $request->file('thumbnail');
                $pict_name = time() . $pict->getClientOriginalName();
                // $path = $pict->storeAs(public_path(). '/images/thumbnail/', $pict_name);
                $pict->move(public_path() . '/images/thumbnail/', $pict_name);
            } else {
                $pict_name = 'noimage.jpg';
            }
            $category = Category::find($request->input('id'));
            $category->name          = $request->input('kategoriname');
            if ($request->file('thumbnail')) {
                $category->thumbnail     = $pict_name;
            }
            $category->updated_by    = Auth::user()->id;
            $category->updated_at    = date('Y-m-d H:i:s');
            $category->update();

            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Artikel Kategori Berhasil Diupdate!',
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Artikel Kategori Gagal Disimpan!',
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        
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
