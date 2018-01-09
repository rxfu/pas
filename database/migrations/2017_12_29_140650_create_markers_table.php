<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('markers', function (Blueprint $table) {
			$table->string('id');
			$table->integer('department_id')->unsigned();
			$table->boolean('is_manager')->default(false);
			$table->timestamp('last_login_at')->nullable();
			$table->timestamps();

			$table->primary('id');
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('markers');
	}
}
