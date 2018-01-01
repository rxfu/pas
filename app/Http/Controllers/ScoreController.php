<?php

namespace App\Http\Controllers;

class ScoreController extends Controller {

	public function getMark() {
		return view('score.mark');
	}
}
