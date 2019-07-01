<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Topic;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use \Response;
use Auth;

class UserController extends Controller
{
	public function profile()
	{
		$user = Auth::user();
		return view('profile', compact('user', $user));
	}

	public function update_avatar(Request $request)
	{
		$request->validate([
			'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		$user = Auth::user();

		$avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

		$request->avatar->storeAs('avatars', $avatarName);

		$user->avatar = $avatarName;
		$user->save();

		return back()
			->with('success', 'You have successfully uploaded an image');

	}
}