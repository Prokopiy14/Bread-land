<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('name', '!=', 'Admin')->paginate(12);

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view('users.edit',compact(['user','roles']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required','max:255'],
            'role_id' => ['required','integer','exists:roles,id'],
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        $role = Role::find($request->role_id);
        $user->syncRoles([$role->name]);

        alert('Данные пользователя '.$request->name.' были обновлены' );
        return redirect('users');

    }
}
