<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Module;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::all();
        return view('backend.roles.form', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required|string|unique:roles',
           'permissions' => 'required|array',
           'permissions.*' => 'integer'
        ]);

        Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ])->permissions()->sync($request->input('permissions'),[]);
        notify()->success('New Role Created.', 'Success');
        return redirect()->route('app.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $modules = Module::all();
        return view('backend.roles.form', compact('modules', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request,[
            'name' => 'required|string|unique:roles,name,'.$role->id,
            'permissions' => 'required|array',
            'permissions.*' => 'integer'
        ]);

        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->input('permissions', []));
        notify()->success('Role Updated.', 'Success');
        return redirect()->route('app.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->deletable == true) {
            $role->delete();
            notify()->success('Role Deleted.', 'Success');
        } else {
            notify()->error('You can\'t delete system role.', 'Error');
        }

        return back();
    }
}