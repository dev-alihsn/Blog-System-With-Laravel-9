<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTagsController extends Controller
{
    public function index(){
        return view('admin_dashboard.tags.index',[
            'tags' => Tag::withCount('posts')->with('posts')->paginate(10),
        ]);
    }

    public function show(Tag $tag){
        return view('admin_dashboard.tags.show',[
            'tag' => $tag
        ]);
    }

    public function destroy(Tag $tag){
        $tag->posts()->detach();
        $tag->delete();
        return redirect(route('admin.tags.index'))->with('success','The tag has deleted successfly');
    }
}
