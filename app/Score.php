<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'department_id', 'marker_id', 'index_id', 'subindex_id', 'score', 'year',
	];

	public function department() {
		return $this->belongsTo('App\Department', 'department_id', 'id');
	}

	public function marker() {
		return $this->belongsTo('App\Marker', 'marker_id', 'id');
	}

	public function index() {
		return $this->belongsTo('App\Index', 'index_id', 'id');
	}

	public function subindex() {
		return $this->belongsTo('App\Subindex', 'subindex_id', 'id');
	}
}
