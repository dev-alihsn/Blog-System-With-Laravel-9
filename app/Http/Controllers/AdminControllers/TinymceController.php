<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TinymceController extends Controller
{
    public function upload_tinymce_image(){
        $file = request()->file('file');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('tinymce_uploads',$filename,'public');
        return response()->json(['location' => "/storage/$path"]);
    }
}
