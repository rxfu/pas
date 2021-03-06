<?php

namespace App\Http\Controllers;

use App\Department;
use App\Marker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarkerController extends Controller {

	public function getList() {
		$markers = Marker::with('department')->orderBy('department_id')->get();

		return view('user.list', compact('markers'));
	}

	public function getCreate() {
		return view('user.create');
	}

	public function postSave(Request $request) {
		$departments = Department::all();

		foreach ($departments as $department) {
			if ($department->is_college) {
				$count = 6;
			} else {
				$count = 1;
			}

			// 校领导
			if (52 == $department->id) {
				$count = 11;
			}

			for ($i = 0; $i < $count; ++$i) {
				$marker                = new Marker;
				$marker->id            = str_random(6);
				$marker->department_id = $department->id;

				if ($department->is_college) {
					$marker->is_manager = (0 == $i);
				} else {
					$marker->is_manager = false;
				}

				$marker->save();
			}
		}

		return redirect()->route('user.list');
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$marker = Marker::find($id);

			if (is_null($marker)) {
				$request->session()->flash('error', '该用户不存在');

				return back();
			} elseif ($marker->delete()) {
				$request->session()->flash('success', '用户' . $marker->id . '删除成功');
			} else {
				$request->session()->flash('error', '用户' . $marker->id . '删除失败');
			}

			return redirect()->route('user.list');
		}

		return back()->withErrors();
	}

	public function deleteDestroy(Request $request) {
		if ($request->isMethod('delete')) {
			DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::statement('TRUNCATE markers');
			DB::statement('SET FOREIGN_KEY_CHECKS=1');

			$request->session->flash('success', '用户清空成功');

			return redirect()->route('user.list');
		}

		return back()->withErrors();
	}

	public function getLogin() {
		$departments = Department::orderBy('id')->get();

		return view('marker.login', compact('departments'));
	}

	public function postLogin(Request $request) {
		$this->validate($request, [
			'id' => 'required',
		]);

		if ($request->isMethod('post')) {
			$inputs = $request->all();

			$exists = Marker::whereId($inputs['id'])->whereDepartmentId($inputs['department_id'])->exists();

			if ($exists) {
				$request->session()->flash('success', '登录评分系统成功');
				$request->session()->put('marker', $inputs['id']);
				$request->session()->put('department', $inputs['department_id']);
				$request->session()->put('signed', 'true');

				$marker                = Marker::find($inputs['id']);
				$marker->last_login_at = Carbon::now();
				$marker->save();

				$request->session()->put('is_manager', $marker->is_manager);

				return redirect()->route('score.indices');
			} else {
				$request->session()->flash('danger', '验证码与部门不一致，登录评分系统失败');

				return back();
			}
		}
	}

	public function postLogout(Request $request) {
		if ($request->session()->has('signed') && $request->session()->get('signed')) {
			$request->session()->flush();

			return redirect()->route('marker.login');
		}
	}
}
