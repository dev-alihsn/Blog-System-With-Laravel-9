<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PostsController extends Controller
{
    public function show(Post $post){
        $recent_posts = Post::latest()->take(5)->get();
        $catgories = Category::withCount('posts')->orderBy('posts_count','desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();
        return view('posts.show',['post' => $post,'recent_posts' => $recent_posts,'categories' => $catgories,'tags' => $tags]);
    }

    public function addComment(Post $post){
        $attrbuits = request()->validate([
            'the_comment' => 'required|min:10|max:300'
        ]);

        $attrbuits['user_id'] = auth()->id();

        $comment  = $post->comments()->create($attrbuits);

        return redirect(route('posts.show',$post) . '#comment_' . $comment->id)->with('success','success the comment has been added successfly');
    }
}
