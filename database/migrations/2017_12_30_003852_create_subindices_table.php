<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubindicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('subindices', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('seq');
			$table->integer('order')->default(0);
			$table->decimal('score', 5, 2);
			$table->text('description')->nullable();
			$table->integer('index_id')->unsigned();
			$table->string('departments');
			$table->timestamps();

			$table->foreign('index_id')->references('id')->on('indices');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('subindices');
	}
}
