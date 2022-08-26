<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_dashboard.roles.index',[
            'roles' => Role::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.roles.create',[
            'permissions' => Permission::all()
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
        $validated = $request->validate(['name' => 'required|unique:roles,name']);
        $permissions = $request->permissions;
        $role = Role::create($validated);
        $role->permissions()->sync($permissions);
        return redirect()->route('admin.roles.create')->with('success','Role has been created successfly');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin_dashboard.roles.update',[
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required',Rule::unique('roles')->ignore($role)]]);
        $permissions = $request->permissions;
        $role->update($validated);
        $role->permissions()->sync($permissions);
        return redirect()->route('admin.roles.edit',$role)->with('success','Role has been updated successfly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success','Role has been deleted successfly');
    }
}
