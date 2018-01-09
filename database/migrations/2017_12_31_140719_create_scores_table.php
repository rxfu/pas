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
			$table->integer('department_id')->unsigned();
			$table->string('marker_id');
			$table->integer('index_id')->unsigned()->nullable();
			$table->integer('subindex_id')->unsigned()->nullable();
			$table->decimal('score', 5, 2);
			$table->string('year');
			$table->timestamps();

			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('index_id')->references('id')->on('indices')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('subindex_id')->references('id')->on('subindices')->onUpdate('cascade')->onDelete('cascade');

			$table->unique(['year', 'department_id', 'marker_id', 'index_id', 'subindex_id']);
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
