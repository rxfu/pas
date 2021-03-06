<?php

namespace App\Http\Controllers;

use App\Department;
use App\Index;
use Illuminate\Http\Request;

class IndexController extends Controller {

	public function getList() {
		$indices = Index::all();

		return view('index.list', compact('indices'));
	}

	public function getCreate() {
		$departments = Department::orderBy('is_college')->get();

		return view('index.create', compact('departments'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'name'  => 'required',
			'seq'   => 'required',
			'order' => 'required',
			'score' => 'required|numeric',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			if (isset($inputs['departments'])) {
				$inputs['departments'] = implode(',', $inputs['departments']);
			}

			$index = new Index();
			$index->fill($inputs);

			if ($index->save()) {
				$request->session()->flash('success', '一级指标新增成功');
			} else {
				$request->session()->flash('danger', '一级指标新增失败');
			}

			return redirect()->route('index.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$index       = Index::find($id);
		$departments = Department::orderBy('is_college')->get();
		$managers    = explode(',', $index->departments);

		return view('index.edit', compact('index', 'departments', 'managers'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'name'  => 'required',
			'seq'   => 'required',
			'order' => 'required',
			'score' => 'required|numeric',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			if (isset($inputs['departments'])) {
				$inputs['departments'] = implode(',', $inputs['departments']);
			}

			$index = Index::find($id);
			$index->fill($inputs);

			if ($index->save()) {
				$request->session()->flash('success', '一级指标更新成功');
			} else {
				$request->session()->flash('danger', '一级指标更新失败');
			}

			return redirect()->route('index.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$index = Index::find($id);

			if (is_null($index)) {
				$request->session()->flash('danger', '该一级指标不存在');

				return back();
			} elseif ($index->delete()) {
				$request->session()->flash('success', '一级指标' . $index->id . '删除成功');
			} else {
				$request->session()->flash('danger', '' . $index->id . '删除失败');
			}

			return redirect()->route('index.list');
		}

		return back()->withErrors();
	}
}
