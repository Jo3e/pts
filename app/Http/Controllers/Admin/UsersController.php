<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit')->with(['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // use a user instance and call the roles() method in Roles model
        // And sync the changes back to the model using (sync) method
        $user->roles()->sync($request->roles);

        if ($user->save()) {
            $request->session()->flash('success', $user->name . ' successfully updated');
        } else {
            $request->session()->flash('error', 'There was an error updating '. $user->name);
        }


        // return
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user = User::find($user);
        //
        if(Gate::denies('delete-users'))
        {
            return redirect(route('admin.users.index'))->with('success', 'Please contact admin');
        }
        // first separate roles from user
        $user->roles()->detach();

        // delete the user
        $user->delete();

        // redirect the user to another page
        return redirect(route('admin.users.index'))->with('success', 'User successfully deleted.');
    }
}
