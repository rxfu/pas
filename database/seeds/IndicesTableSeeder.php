<?php

use App\Index;
use Illuminate\Database\Seeder;

class IndicesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Index::create([
			'name'  => '工作效能',
			'seq'   => '四',
			'order' => 0,
			'score' => 20,
		]);
		Index::create([
			'name'        => '各部门的配合',
			'seq'         => '八',
			'order'       => 1,
			'score'       => 10,
			'description' => '1、围绕学校中心工作，机关、业务部门与各学院相互协同的效果。
2、围绕学校中心工作，机关、业务部门之间相互配合工作的效果。
',
		]);
	}
}
