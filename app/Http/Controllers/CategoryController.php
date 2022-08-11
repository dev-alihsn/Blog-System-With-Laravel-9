<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // view all categories
    public function index(){
        $categories = Category::withcount('posts')->orderBy('posts_count','DESC')->paginate(100);
        return view('categories.index',[
            'categories' => $categories
        ]);
    }

    public function show(Category $category){
        $recent_posts = Post::latest()->take(5)->get();
        $catgories = Category::withCount('posts')->orderBy('posts_count','desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();

        return view('categories.show',
            ['category' => $category,
            'posts' => $category->posts()->paginate(10),
            'recent_posts' => $recent_posts,
            'categories' => $catgories,
            'tags' => $tags]
        );
    }
}
