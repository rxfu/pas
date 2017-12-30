<?php

use App\Subindex;
use Illuminate\Database\Seeder;

class SubindicesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Subindex::create([
			'name'        => '专业知识',
			'seq'         => '1',
			'order'       => 0,
			'score'       => 4,
			'description' => '熟悉工作所需要的专业基本知识、法律法规、政策等',
			'index_id'    => 1,
		]);
		Subindex::create([
			'name'        => '工作效率',
			'seq'         => '2',
			'order'       => 1,
			'score'       => 10,
			'description' => '（1）熟悉岗位业务，履责认真，工作有条理，办事流程公开，无失职、推诿现象。
（2）与本部门其他同事有效沟通合作，同事之间关系融洽。
（3）与校内外其他部门有效地沟通，主动配合其他部门工作，同事之间关系融洽。
（4）校党委常委会、校长办公会、校领导工作协调会等会议精神以及学校督查、督办事项落实到位。
（5）学校教代会提案办理和答复情况良好，积极采纳合理化建议，无工作推诿现象。评估整改工作完成情况。
',
			'index_id'    => 1,
		]);
		Subindex::create([
			'name'        => '服务质量',
			'seq'         => '3',
			'order'       => 2,
			'score'       => 6,
			'description' => '（1）服务意识好，热心、细心、耐心服务，服务对象满意度高。
（2）形象良好，言行端庄，办公室干净整洁。
（3）遵守服务承诺制、首问负责制，及时回复，限时办结。
（4）服务对象的满意情况。
',
			'index_id'    => 1,
		]);
	}
}
