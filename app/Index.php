<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'seq', 'order', 'score', 'description', 'departments',
	];

	public function subindices() {
		return $this->hasMany('App\Subindex', 'index_id', 'id');
	}
}
