<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function getChangePassword() {
		return view('user.change');
	}

	public function putChangePassword(Request $request) {
		$this->validate($request, [
			'old_password' => 'required|string',
			'password'     => 'required|string|confirmed|min:6',
		]);

		if ($request->isMethod('put')) {
			$credentials = [
				'username' => Auth::user()->username,
				'password' => $request->input('old_password'),
			];

			if (Auth::attempt($credentials)) {
				$user           = Auth::user();
				$user->password = $request->input('password');

				if ($user->save()) {
					$request->session()->flash('success', '用户密码修改成功');
				} else {
					$request->session()->flash('danger', '用户密码修改失败');
				}

				return redirect()->route('user.chgpwd');
			}
		}

		return back()->withErrors();
	}
}
