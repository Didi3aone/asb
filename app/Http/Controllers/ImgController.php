<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImgController extends Controller
{
    public function displayAvatar($filename)
    {
        $path = storage_path('app/avatar/'. $filename);
        // dd($path);
        if (!File::exists($path)) {
             abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function displayArticles($filename)
    {
        $path = storage_path('app/articles/'. $filename);
        // print_r($path);
        if (!File::exists($path)) {
             abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function displayThumbnail($filename)
    {
        $path = storage_path('app/thumbnail/'. $filename);
        // print_r($path);
        if (!File::exists($path)) {
             abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
