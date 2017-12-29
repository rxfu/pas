<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('scores', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('department_id');
			$table->integer('marker_id');
			$table->decimal('score', 5, 2);
			$table->string('year');
			$table->timestamps();

			$table->foreign('department_id')->references('id')->on('departments');
			$table->foreign('marker_id')->references('id')->on('markers');

			$table->unique(['year', 'department_id', 'marker_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('scores');
	}
}
