<?php

namespace App\Http\Controllers;

use App\Department;
use App\Index;
use App\Score;
use DB;
use Illuminate\Http\Request;

class ScoreController extends Controller {

	public function getIndices() {
		$department = Department::find(session('department'))->name;
		$indices    = Index::with('subindices')->orderBy('order')->get();

		$items = [];
		foreach ($indices as $index) {
			if ($index->subindices->count()) {
				$subindices = [];

				foreach ($index->subindices as $subindex) {
					if (($subindex->is_manager && session('is_manager') && in_array(session('department'), explode(',', $subindex->departments))) || (!$subindex->is_manager)) {
						$subindices[$subindex->id] = [
							'seq'         => $subindex->seq,
							'name'        => $subindex->name,
							'score'       => $subindex->score,
							'description' => $subindex->description,
						];
					}
				}

				if (!empty($subindices)) {
					$items[$index->id] = [
						'seq'         => $index->seq,
						'name'        => $index->name,
						'score'       => $index->score,
						'description' => $index->description,
						'subindices'  => $subindices,
					];
				}
			} else {
				if (($index->is_manager && session('is_manager') && in_array(session('department'), explode(',', $index->departments))) || (!$index->is_manager)) {
					$items[$index->id] = [
						'seq'         => $index->seq,
						'name'        => $index->name,
						'score'       => $index->score,
						'description' => $index->description,
					];
				}
			}
		}

		return view('score.indices', compact('department', 'items'));
	}

	public function getMark(Request $request, $index, $subindex = null) {
		$departments = Department::orderBy('id')
			->whereIsCollege(false)
			->where('id', '<>', session('department'))
			->get();
		$indices = Index::with('subindices')->orderBy('order')->get();

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

	public function getList() {
		$scores = Score::with('department', 'index', 'subindex')
			->orderBy('marker_id')
			->get();

		return view('score.list', compact('scores'));
	}

	public function getStatistics() {
		$scores = DB::table('scores')
			->select(DB::raw('marker_id, department_id, name, SUM(score) AS total'))
			->join('departments', 'departments.id', '=', 'department_id')
			->groupBy('marker_id', 'department_id', 'name')
			->get();

		$totals = [];
		foreach ($scores->groupBy('department_id') as $key => $value) {
			$totals[$key]['marker_id']     = $value[0]->marker_id;
			$totals[$key]['department_id'] = $value[0]->department_id;
			$totals[$key]['name']          = $value[0]->name;

			if (1 == count($value)) {
				$totals[$key]['total'] = $value[0]->total;
			} elseif (2 == count($value)) {
				$totals[$key]['total'] = $value->avg('total');
			} else {
				$totals[$key]['total'] = ($value->sum('total') - $value->min('total') - $value->max('total')) / ($value->count() - 2);
			}
		}

		usort($totals, function ($a, $b) {
			return ($a['total'] > $b['total']) ? -1 : 1;
		});

		return view('score.statistics', compact('totals'));
	}
}
