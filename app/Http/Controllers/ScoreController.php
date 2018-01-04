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
/*		$scores = DB::table('scores')
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
 */
		$totals      = [];
		$departments = Department::whereIsCollege(false)->get();
		foreach ($departments as $department) {
			/*$scores = Score::whereDepartmentId($department->id)
				->where('year', '=', date('Y'))
				->get();*/
			$scores = DB::table('scores')
				->select(DB::raw('marker_id, department_id, name, index_id,SUM(score) AS score'))
				->join('departments', 'departments.id', '=', 'department_id')
				->groupBy('marker_id', 'department_id', 'name', 'index_id')
				->where('year', '=', date('Y'))
				->where('department_id', '=', $department->id)
				->get();

			$totals[$department->id] = [
				'name' => $department->name,
			];

			$indices = [];
			foreach ($scores as $score) {
				$indices[$score->index_id][] = $score->score;
			}

			$values = [];
			foreach ($indices as $key => $value) {
				$index = Index::find($key);
				if ($index->is_manager) {
					$values[$key] = array_sum($value) / count($value);
				} else {
					if (2 < count($value)) {
						$values[$key] = (array_sum($value) - min($value) - max($value)) / (count($value) - 2);
					} else {
						$values[$key] = array_sum($value) / count($value);
					}
				}
			}

			$totals[$department->id]['total'] = array_sum($values);
		}

		usort($totals, function ($a, $b) {
			return ($a['total'] > $b['total']) ? -1 : 1;
		});

		return view('score.statistics', compact('totals'));
	}
}
