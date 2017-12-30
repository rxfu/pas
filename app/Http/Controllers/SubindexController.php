<?php

namespace App\Http\Controllers;

use App\Index;
use App\Subindex;
use Illuminate\Http\Request;

class SubindexController extends Controller {

	public function getList() {
		$subindices = Subindex::all();

		return view('subindex.list', compact('subindices'));
	}

	public function getCreate() {
		$indices = Index::orderBy('order')->get();

		return view('subindex.create', compact('indices'));
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
			$subindex = new Subindex();
			$subindex->fill($inputs);

			if ($subindex->save()) {
				$request->session()->flash('success', '二级指标新增成功');
			} else {
				$request->session()->flash('danger', '二级指标新增失败');
			}

			return redirect()->route('subindex.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$subindex = Subindex::find($id);
		$indices  = Index::orderBy('order')->get();

		return view('subindex.edit', compact('subindex', 'indices'));
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
			$subindex = Subindex::find($id);
			$subindex->fill($inputs);

			if ($subindex->save()) {
				$request->session()->flash('success', '二级指标更新成功');
			} else {
				$request->session()->flash('danger', '二级指标更新失败');
			}

			return redirect()->route('subindex.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$subindex = Subindex::find($id);

			if (is_null($subindex)) {
				$request->session()->flash('danger', '该二级指标不存在');

				return back();
			} elseif ($subindex->delete()) {
				$request->session()->flash('success', '二级指标' . $subindex->id . '删除成功');
			} else {
				$request->session()->flash('danger', '' . $subindex->id . '删除失败');
			}

			return redirect()->route('subindex.list');
		}

		return back()->withErrors();
	}
}
