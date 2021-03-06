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
		'id', 'department_id', 'is_manager', 'last_login_at',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_manager' => 'boolean',
	];

	protected $primaryKey = 'id';

	public $incrementing = false;

	public function department() {
		return $this->belongsTo('App\Department', 'department_id', 'id');
	}

	public function scores() {
		return $this->hasMany('App\Score', 'marker_id', 'id');
	}
}
