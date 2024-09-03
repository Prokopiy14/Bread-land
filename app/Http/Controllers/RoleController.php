<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id','asc')->where('name', '!=', 'Admin')->get();

        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name','asc')->get();
        return view('roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','max:255'],
            'permissions.*' => ['required','integer','exists:permissions,id'],
        ]);

        $newRole = Role::create([
            'name' => $request->title,
        ]);

        $permissions = Permission::whereIn('id',$request->permissions)->get();
        $newRole->syncPermissions($permissions);
        alert('Роль '.$request->title.' добавлена');
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role = Role::where('name', '!=', 'Admin')->findOrFail($role->id);
        $permissions = Permission::orderBy('name','asc')->get();
        return view('roles.edit',compact(['permissions','role']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'title' => ['required','max:255'],
            'permissions' => ['required'],
            'permissions.*' => ['required','integer','exists:permissions,id'],
        ]);

        $role = Role::where('name', '!=', 'Admin')->findOrFail($role->id);
        $role->update([
            'name' => $request->title,
        ]);
        $permissions = Permission::whereIn('id',$request->permissions)->get();
        $role->syncPermissions($permissions);
        alert('Роль '.$request->title.' была обновлена' );
        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $roleDestroy = Role::findById($role->id);
        if ($roleDestroy)
        {
            $roleDestroy->delete();
        }
        alert('Роль '.$role->name.' удалена');
        return redirect()->back();
    }
}
