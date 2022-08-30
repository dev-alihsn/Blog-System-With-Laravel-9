<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{

    private $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'image' => 'nullable|mimes:jpeg,png,jpg|dimensions:max_width=300,min_height=227',
        'password' => 'required|min:8',
        'role_id' => 'required|numeric'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_dashboard.users.index',[
            'users' => User::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.users.create',[
            'roles' => Role::pluck('name','id')
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
        $validated['password'] = Hash::make($request->input('password'));
        $user = User::create($validated);

        if($request->has('image')){
            $thumbnail = $request->file('image');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images','public');
            $user->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }

        return redirect(route('admin.users.create'))->With('success','The user has created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin_dashboard.users.show',[
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return  view('admin_dashboard.users.update',[
            'user' => $user,
            'roles' => Role::pluck('name','id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->rules['password'] = 'nullable|min:8';
        $this->rules['email'] = ['required','email',Rule::unique('users')->ignore($user)];
        $validated = $request->validate($this->rules);
        if(!empty($request->password))
            $validated['password'] = Hash::make($request->input('password'));
        else
            unset($validated['password']);

        $user->update($validated);

        if($request->has('image')){
            $thumbnail = $request->file('image');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images','public');
            $user->image()->update([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }

        return redirect(route('admin.users.edit',$user))->With('success','The user has updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id == auth()->user()->id)
            return redirect(route('admin.users.index'))->With('error','You can not delete yourself!');

        foreach($user->posts as $post){
            $post->update(['user_id' => auth()->user()->id]);
        }
        
        $user->delete();
        return redirect(route('admin.users.index'))->With('success','The user has deleted successfuly');
    }
}
