<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id', 'department_id', 'last_login_at',
	];

	public function department() {
		return $this->belongsTo('App\Department', 'department_id', 'id');
	}
}
