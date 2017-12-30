<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller {

	private $upload = 'files';

	public function getList() {
		$departments = Department::all();

		return view('department.list', compact('departments'));
	}

	public function getCreate() {
		return view('department.create');
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'name'       => 'required',
			'is_college' => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$department = new Department();
			$department->fill($inputs);

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file             = $request->file('file');
				$filename         = time() . '.' . $file->getClientOriginalExtension();
				$department->path = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			if ($department->save()) {
				$request->session()->flash('success', '部门新增成功');
			} else {
				$request->session()->flash('danger', '部门新增失败');
			}

			return redirect()->route('department.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$department = Department::find($id);

		return view('department.edit', compact('department'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'name'       => 'required',
			'is_college' => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$department = Department::find($id);
			$department->fill($inputs);

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file             = $request->file('file');
				$filename         = time() . '.' . $file->getClientOriginalExtension();
				$department->path = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			if ($department->save()) {
				$request->session()->flash('success', '部门更新成功');
			} else {
				$request->session()->flash('danger', '部门更新失败');
			}

			return redirect()->route('department.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$department = Department::find($id);

			if (is_null($department)) {
				$request->session()->flash('danger', '该部门不存在');

				return back();
			} elseif ($department->delete()) {
				$request->session()->flash('success', '部门' . $department->id . '删除成功');
			} else {
				$request->session()->flash('danger', '' . $department->id . '删除失败');
			}

			return redirect()->route('department.list');
		}

		return back()->withErrors();
	}
}
