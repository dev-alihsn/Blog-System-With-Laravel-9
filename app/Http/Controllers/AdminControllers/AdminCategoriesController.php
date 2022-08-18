<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_dashboard.categories.index',[
            'categories' => Category::withCount('posts')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|min:3|max:30',
            'slug' => 'required|unique:categories,slug'
        ]);

        $validated['user_id'] = auth()->user()->id;
        Category::create($validated);

        return redirect()->route('admin.categories.create')->with('success','The Category has created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin_dashboard.categories.show',[
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin_dashboard.categories.update',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:30',
            'slug' => ['required',Rule::unique('categories')->ignore($category)]
        ]);

       // $validated['user_id'] = auth()->user()->id;
        $category->update($validated);
        return redirect(route('admin.categories.edit',$category))->with('success','The Category has updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $id = Category::where('name','uncategorized')->first()->id;
        $category->posts()->update(['category_id' => $id]);
        if($category->name === 'uncategorized'){
            abort(404);
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success','The Category has deleted successfuly');
    }
}
