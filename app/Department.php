<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'path', 'is_college',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_college' => 'boolean',
	];

}
