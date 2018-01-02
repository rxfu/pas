<?php

namespace App\Http\Controllers;

use App\Department;
use App\Index;
use App\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller {

	public function getMark() {
		$departments = Department::orderBy('id')->whereIsCollege(false)->get();
		$indices     = Index::with('subindices')->orderBy('order')->get();

		$rows = 0;
		foreach ($indices as $index) {
			$count = $index->subindices->count();
			$rows += $count ? $count : 1;
		}

		$objects = Score::whereMarkerId(session('marker'))
			->where('year', '=', date('Y'))
			->get();
		$scores = [];
		foreach ($objects as $obj) {
			$subindex = empty($obj->subindex_id) ? 0 : $obj->subindex_id;

			$scores[$obj->department_id][$obj->marker_id][$obj->index_id][$subindex] = $obj->score;
		}

		return view('score.mark', compact('departments', 'indices', 'scores', 'rows'));
	}

	public function postMark(Request $request) {
		if ($request->isMethod('post')) {
			$inputs = $request->all();
			array_pull($inputs, '_token');

			foreach ($inputs as $key => $value) {
				list($name, $department, $index, $subindex) = explode('_', $key);

				$obj = Score::whereDepartmentId($department)
					->whereMarkerId($request->session()->get('marker'))
					->whereIndexId($index)
					->where('year', '=', date('Y'));

				if ($subindex != 0) {
					$obj = $obj->whereSubindexId($subindex);
				}

				if ($obj->exists()) {
					$score = $obj->first();
				} else {
					$score = new Score;
				}

				$score->department_id = $department;
				$score->marker_id     = $request->session()->get('marker');
				$score->index_id      = $index;
				$score->year          = date('Y');
				$score->score         = is_null($value) ? 0 : $value;

				if ($subindex != 0) {
					$score->subindex_id = $subindex;
				}

				$score->save();
			}

			return redirect()->route('score.mark');
		}
	}
}
