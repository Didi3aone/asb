<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Information;
use App\ArticleCategory as Category;

class InformationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = Information::all();

        return response([
            'success'   => true,
            'message'   => 'List Semua Artikel',
            'data'      => $info
        ], 200);
    }

    public function indexLatest()
    {
        $info = Information::orderBy('created_at', 'DESC')
                ->get();

        return response([
            'success'   => true,
            'message'   => 'List Semua Artikel',
            'data'      => $info
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
                'nama'          => 'required',
                'content'       => 'required',
                'kategori_id'   => 'required',
                'foto'          => 'mimes:jpeg,jpg,png,gif|required|max:2000'
            ],
            [
                'nama.required'     => 'Masukkan nama Artikel !',
                'content.required'  => 'Masukkan elin',
                'foto.required'     => 'Masukkan file photo',
            ]);
            
            if($validator->fails()) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'silahkan isi kolom yang kosong',
                    'data'      => $validator->errors()
                ], 400);
            } else {
                
                if ($request->file('foto')) {
                    $pict = $request->file('foto');
                    $pict_name = time() . $pict->getClientOriginalName();
                    $pict->move(public_path() . '/images/articles', $pict_name);
                } else {
                    $pict_name = 'noimage.jpg';
                }

                $info = Information::create([
                    'kategori_id'   => $request->input('kategori_id'),
                    'name'          => $request->input('nama'),
                    'content'       => $request->input('content'),
                    'gambar'        => $pict_name,
                    'created_by'    => Auth::user()->id,
                    'created_at'    => date('Y-m-d H:i:s')
                ]);
            }
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Artikel Berhasil Disimpan!',
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Artikel Gagal Disimpan!',
            ], 400);
        }
    }

    public function findArticleByCategory(Request $request)
    {
        $category = Information::where('kategori_id', $request->input('val'))
                ->get();
        
        if ($category) {
            return response()->json([
                'success'   => true,
                'message'   => ' list Artikel!',
                'category'   => $category
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Artikel Tidak Ditemukan!',
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
         \DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nama'          => 'required',
                'content'       => 'required',
                'kategori_id'   => 'required',
                'foto'          => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'nama.required'     => 'Masukkan nama Artikel !',
                'content.required'  => 'Masukkan elin',
                'foto.required'     => 'Masukkan file photo',
            ]);
            
            if($validator->fails()) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'silahkan isi kolom yang kosong',
                    'data'      => $validator->errors()
                ], 400);
            } else {
                
                if ($request->file('foto')) {
                    $pict = $request->file('foto');
                    $pict_name = time() . $pict->getClientOriginalName();
                    $pict->move(public_path() . '/images/articles', $pict_name);
                } else {
                    $pict_name = 'noimage.jpg';
                }

                $info = Information::find($request->input('id'));
                $info->kategori_id   = $request->input('kategori_id');
                $info->name          = $request->input('nama');
                $info->content       = $request->input('content');
                if ($request->file('foto')) {
                    $info->gambar    = $pict_name;
                }
                $info->updated_by    = Auth::user()->id;
                $info->updated_at    = date('Y-m-d H:i:s');
                $info->update();
            }
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Artikel Berhasil Di Update!',
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Artikel Gagal Disimpan!',
            ], 400);
        }
    }

    public function updateArtikel(Request $request)
    {
        \DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'nama'          => 'required',
                'content'       => 'required',
                'kategori_id'   => 'required',
                'foto'          => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'nama.required'     => 'Masukkan nama Artikel !',
                'content.required'  => 'Masukkan Konten',
                'foto.required'     => 'Masukkan file photo',
            ]);
            
            if($validator->fails()) {
                return response()->json([
                    'success'   => false,
                    'message'   => 'silahkan isi kolom yang kosong',
                    'data'      => $validator->errors()
                ], 400);
            } else {
                
                if ($request->file('foto')) {
                    $pict = $request->file('foto');
                    $pict_name = time() . $pict->getClientOriginalName();
                    // $path = $pict->storeAs('articles', $pict_name);
                    $pict->move(public_path() . '/images/articles', $pict_name);
                } else {
                    $pict_name = 'noimage.jpg';
                }

                $info = Information::find($request->input('id'));
                $info->kategori_id   = $request->input('kategori_id');
                $info->name          = $request->input('nama');
                $info->content       = $request->input('content');
                if ($request->file('foto')) {
                    $info->gambar    = $pict_name;
                }
                $info->updated_by    = Auth::user()->id;
                $info->updated_at    = date('Y-m-d H:i:s');
                $info->update();
            }
            \DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Artikel Berhasil Di Update!',
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Artikel Gagal Disimpan!',
            ], 400);
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
        //
    }
}
