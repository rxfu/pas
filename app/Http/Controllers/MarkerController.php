<?php

namespace App\Http\Controllers;

use App\Marker;
use Illuminate\Http\Request;

class MarkerController extends Controller {

	public function getList() {
		$markers = Marker::with('department')->get();

		return view('user.list', compact('markers'));
	}

	public function getCreate() {
	}

	public function postSave(Request $request) {
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
}
