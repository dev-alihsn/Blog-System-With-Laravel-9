<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminPostsController extends Controller
{
    public $rules = [
        'title' => 'required|max:200',
        'slug' => 'required|max:200',
        'excerpt' => 'required|max:200',
        'thumbnail' => 'required|mimes:jpeg,png,jpg|dimensions:max_width=300,min_height=227',
        'body' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->paginate(10);
        return view('admin_dashboard.posts.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.posts.create',[
            'categories' => Category::pluck('name','id'),
            'tags' => Tag::pluck('name','id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->user()->id;
        $validated['category_id'] = $request->category;
        $post = Post::create($validated);

        if($request->has('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images','public');
            $post->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }

        $tags = explode(',',$request->input('tags'));
        $tags_ids = [];
        foreach($tags as $tag){
            $tag_ob = Tag::create(['name' => $tag]);
            $tags_ids[] = $tag_ob->id;
        }

        if(count($tags_ids) > 0){
            $post->tags()->sync($tags_ids);
        }

        return redirect(route('admin.posts.create'))->With('success','The Post has created successfuly');
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
    public function edit(Post $post)
    {
        $tags = '';
        foreach($post->tags as $key => $tag){
            if($key === count($post->tags) - 1){
                $tags .= $tag->name;
            }else {
                $tags .= $tag->name . ', ';
            }
        }
        return view('admin_dashboard.posts.update',[
            'post' => Post::find($post->id),
            'categories' => Category::pluck('name','id'),
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $this->rules['thumbnail'] = 'nullable|mimes:jpeg,png,jpg|dimensions:max_width=300,min_height=227';
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->user()->id;
        $validated['category_id'] = $request->category;
        $post->update($validated);

        if($request->has('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images','public');
            $post->image()->update([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }

        $tags = explode(',',$request->input('tags'));
        $tags_ids = [];
        foreach($tags as $tag){
            $tag_exists = $post->tags()->where('name',$tag)->first();
            if($tag_exists === null){
                $tag_g = Tag::where('name',$tag)->first();
                if($tag_g === null){
                    $tag_ob = Tag::create(['name' => $tag]);
                    $tags_ids[] = $tag_ob->id;
                }else {
                    $tags_ids[] = $tag_g->id;
                }
            }else {$tags_ids[] = $post->tags()->where('name',$tag)->first()->id;}
            
        }

        if(count($tags_ids) > 0){
            $post->tags()->sync($tags_ids);
        }

        return redirect(route('admin.posts.edit',$post))->With('success','The Post has updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success','The post has been deleted successfuly');
    }
}
