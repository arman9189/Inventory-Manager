<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use Auth;

class UsersController extends Controller
{
    // return the create view
    public function create()
    {
      return view('users.create');
    }

    public function store(Request $request)
    {
      // validate
      $this->validate($request, [
        'name' => 'required|min:3|max:150',
        'email' => 'required|email|min:3|max:150|unique:users',
        'password' => 'required|min:8|max:150',
      ]);

      // new instance of the model
      $user = new User;

      // set attributes
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = bcrypt($request->input('password'));

      // save the new model
      $user->save();

      // redirect
      return redirect('/users')->with('success', 'User has been created succesfully!');
    }

    public function index()
    {
      // get users
      $users = User::all();

      // return view with users
      return view('users.index')->with('users', $users);
    }

    public function edit($user_id)
    {
      // get user to edit
      $user = User::find($user_id);

      // return view with user
      return view('users.edit')->with('user', $user);
    }

    public function update(Request $request, $user_id)
    {
      // validate
      $this->validate($request, [
        'name' => 'required|min:3|max:150',
        'email' => 'required|email|min:3|max:150|unique:users,email,'.$user_id, // <--- exclude current user from unique email validation
        'password' => 'nullable|min:8|max:150',
      ]);

      // get user and save old password
      $user = User::find($user_id);
      $old_password = $user->password;

      // check if password was sent
      if(!Input::has('password')) {
        $user->password = $old_password;
      } else {
        $user->password = bcrypt($request->input('password'));
      }

      // set attributes
      $user->name = $request->input('name');
      $user->email = $request->input('email');

      // save
      $user->save();

      // redirect
      return redirect('/users')->with('success', 'User has been updated and changes were saved!');
    }

    public function destroy($user_id)
    {
      // check for auth, should always be true be since the view requires it
      if(!Auth::check()) {
        return redirect('/users')->with('error', 'This error should never be thrown! (Not-authenticated in authenticated view)');
      }

      // check if user wants to delete themselves
      if($user_id == auth()->user()->id) {
        return redirect('/users')->with('error', 'You cannot delete yourself!');
      }

      // get the user
      $user = User::find($user_id);

      // delete the user
      $user->delete();

      // redirect
      return redirect('/users')->with('success', 'User has been deleted successfully!');
    }

}
