<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // view all tags
    public function index(){

    }

    public function show(Tag $tag){
        $recent_posts = Post::latest()->take(5)->get();
        $catgories = Category::withCount('posts')->orderBy('posts_count','desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();
        
        return view('tags.show',
            ['tag' => $tag,
            'posts' => $tag->posts()->paginate(10),
            'recent_posts' => $recent_posts,
            'categories' => $catgories,
            'tags' => $tags]
        );
    }
}
