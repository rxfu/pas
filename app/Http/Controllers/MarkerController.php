<?php

namespace App\Http\Controllers;

use App\Department;
use App\Marker;
use Illuminate\Http\Request;

class MarkerController extends Controller {

	public function getList() {
		$markers = Marker::with('department')->orderBy('department_id')->get();

		return view('user.list', compact('markers'));
	}

	public function getCreate() {
		return view('user.create');
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'count' => 'required|numeric',
		]);

		if ($request->isMethod('post')) {
			$inputs = $request->all();
			$count  = $inputs['count'];

			$departments = Department::all();
			$codes       = array_random(range(1000, 9999), $departments->count() * $count);
			shuffle($codes);

			foreach ($departments as $department) {
				for ($i = 0; $i < $count; ++$i) {
					$marker                = new Marker;
					$marker->id            = array_pop($codes);
					$marker->department_id = $department->id;
					$marker->save();
				}
			}

			return redirect()->route('user.list');
		}
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
}
