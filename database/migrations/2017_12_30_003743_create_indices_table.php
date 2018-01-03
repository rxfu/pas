<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('indices', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('seq');
			$table->integer('order')->default(0);
			$table->decimal('score', 5, 2);
			$table->text('description')->nullable();
			$table->boolean('is_manager')->default(true);
			$table->string('departments')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('indices');
	}
}
