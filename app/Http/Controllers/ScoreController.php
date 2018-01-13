<?php

namespace App\Http\Controllers;

use App\Department;
use App\Index;
use App\Score;
use App\Subindex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller {

	public function getIndices() {
		$department = Department::find(session('department'))->name;
		$indices    = Index::with('subindices')->orderBy('order')->get();

		$items = [];
		foreach ($indices as $index) {
			if ($index->subindices->count()) {
				$subindices = [];

				foreach ($index->subindices as $subindex) {
					if (in_array(session('department'), explode(',', $subindex->departments))) {
						if (($subindex->id == 17 || $subindex->id == 18 || $subindex->id == 19) && session('is_manager')) {
							continue;
						}

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
				if (in_array(session('department'), explode(',', $index->departments))) {
					$isCollege = Department::find(session('department'))->is_college;

					if (($index->id == 8) && $isCollege && (!session('is_manager'))) {
						continue;
					}

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

	public function getMark(Request $request, $index, $subindex) {
		$departments = Department::whereIsCollege(false)
			->orderBy('id')
			->get();

		$objects = Score::whereMarkerId($request->session()->get('marker'))
			->whereIndexId($index)
			->where('year', '=', date('Y'));

		if (!empty($subindex)) {
			$objects = $objects->whereSubindexId($subindex);
		}

		$objects = $objects->get();

		$scores = [];
		foreach ($objects as $obj) {
			$scores[$obj->department_id] = $obj->score;
		}

		$index    = Index::find($index);
		$subindex = $subindex ? Subindex::find($subindex) : null;

		return view('score.mark', compact('departments', 'index', 'subindex', 'scores'));
	}

	public function postMark(Request $request) {
		if ($request->isMethod('post')) {
			$inputs = $request->all();
			array_pull($inputs, '_token');
			$index    = array_pull($inputs, 'index_id');
			$subindex = array_pull($inputs, 'subindex_id');

			foreach ($inputs as $key => $value) {
				list($name, $department) = explode('_', $key);

				$obj = Score::whereDepartmentId($department)
					->whereMarkerId($request->session()->get('marker'))
					->whereIndexId($index)
					->where('year', '=', date('Y'));

				if (!empty($subindex)) {
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

				if (!empty($subindex)) {
					$score->subindex_id = $subindex;
				}

				$score->save();
			}

			return redirect()->route('score.indices');
		}
	}

	public function getList() {
		$scores = Score::with('department', 'index', 'subindex')
			->orderBy('marker_id')
			->get();

		return view('score.list', compact('scores'));
	}

	public function getStatistics() {
		$totals      = [];
		$departments = Department::whereIsCollege(false)->get();
		foreach ($departments as $department) {
			$totals[$department->id] = [
				'name'  => $department->name,
				'total' => 0,
			];

			$indices = Index::all();
			foreach ($indices as $index) {
				if ($index->subindices->count()) {
					foreach ($index->subindices as $subindex) {
						$scores = Score::whereDepartmentId($department->id)
							->whereIndexId($index->id)
							->whereSubindexId($subindex->id)
							->where('year', '=', date('Y'))
							->get();

						if (count($scores)) {
							if (count(explode(',', $subindex->departments)) < 15) {
								$totals[$department->id]['total'] += $scores->avg('score');
							} else {
								$scores = DB::table('scores')
									->select(DB::raw('marker_id, department_id, index_id, SUM(score) AS score'))
									->groupBy('marker_id', 'department_id', 'index_id')
									->where('year', '=', date('Y'))
									->where('department_id', '=', $department->id)
									->whereIndexId($index->id)
									->get();

								if (2 < $scores->count()) {
									$val = ($scores->sum('score') - $scores->min('score') - $scores->max('score')) / ($scores->count() - 2);
									$totals[$department->id]['total'] += $val;
								} else {
									$totals[$department->id]['total'] += $scores->avg('score');
								}

								break;
							}
						}
					}
				} else {
					$scores = Score::whereDepartmentId($department->id)
						->whereIndexId($index->id)
						->where('year', '=', date('Y'))
						->get();

					if (count($scores)) {
						if (count(explode(',', $index->departments)) < 15) {
							$totals[$department->id]['total'] += $scores->avg('score');
						} else {
							if (2 < $scores->count()) {
								$val = ($scores->sum('score') - $scores->min('score') - $scores->max('score')) / ($scores->count() - 2);
								$totals[$department->id]['total'] += $val;
							} else {
								$totals[$department->id]['total'] += $scores->avg('score');
							}
						}
					}
				}
			}
		}

		usort($totals, function ($a, $b) {
			return ($a['total'] > $b['total']) ? -1 : 1;
		});

		return view('score.statistics', compact('totals'));
	}

	public function getDepartment($id) {
		$department = Department::findOrFail($id)->name;
		$indices    = Index::with('subindices')->orderBy('order')->get();
		$scores     = Score::whereDepartmentId($id)->get();

		$items = [];
		foreach ($indices as $index) {
			if ($index->subindices->count()) {
				$subindices = [];

				foreach ($index->subindices as $subindex) {
					$scores = Score::whereDepartmentId($id)
						->whereIndexId($index->id)
						->whereSubindexId($subindex->id)
						->where('year', '=', date('Y'))
						->get();

					if (count($scores)) {
						if (count(explode(',', $subindex->departments)) < 15) {
							$val = $scores->avg('score');
						} else {
							$scores = DB::table('scores')
								->select(DB::raw('marker_id, department_id, index_id, SUM(score) AS score'))
								->groupBy('marker_id', 'department_id', 'index_id')
								->where('year', '=', date('Y'))
								->where('department_id', '=', $department->id)
								->whereIndexId($index->id)
								->get();

							if (2 < $scores->count()) {
								$val = ($scores->sum('score') - $scores->min('score') - $scores->max('score')) / ($scores->count() - 2);
							} else {
								$val = $scores->avg('score');
							}

							break;
						}
					}

					$subindices[$subindex->id] = [
						'seq'         => $subindex->seq,
						'name'        => $subindex->name,
						'score'       => $subindex->score,
						'description' => $subindex->description,
						'value'       => $val,
					];
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
				if (in_array(session('department'), explode(',', $index->departments))) {
					$isCollege = Department::find(session('department'))->is_college;

					if (($index->id == 8) && $isCollege && (!session('is_manager'))) {
						continue;
					}

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
}
