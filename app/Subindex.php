<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subindex extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'seq', 'order', 'score', 'description', 'index_id', 'departments',
	];

	public function index() {
		return $this->belongsTo('App\Index', 'index_id', 'id');
	}
}
