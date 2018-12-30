<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
		public function index()
		{
			return view('settings.index');
		}

		public function edit()
		{
			return view('settings.edit');
		}

    public function update(Request $request)
		{
			$userId = $request->input('userid');

			if(auth()->user()->id != $userId) {
				return view('settings.index')->with('error', 'This error should NEVER occur, contact your administrator (Ref: User ID mismatch).');
			}

			$this->validate($request, [
				'name' => 'required|min:3|max:100',
				'email' => 'required|email|max:190|unique:users,email,'.$userId,
			]);

			if(Auth::user()->name != $request->input('name')) {
				Auth::user()->name = $request->input('name');
			}

			if(Auth::user()->email != $request->input('email')) {
				Auth::user()->email = $request->input('email');
			}

			Auth::user()->save();

			return redirect('/settings')->with('success', 'Settings have been updated!');
		}

}
