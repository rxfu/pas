<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Department::create([
			'name'       => '文学院/新闻与传播学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '历史文化与旅游学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '马克思主义学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '法学院/政治与公共管理学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '经济管理学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '教育学部',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '外国语学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '美术学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '音乐学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '数学与统计学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '物理科学与技术学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '化学与药学学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '生命科学学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '环境与资源学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '计算机科学与信息工程学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '体育学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '电子工程学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '职业技术师范学院/健康管理学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '设计学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '国际文化教育学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '党委办公室（统战部、督查督办办公室）',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '纪委办公室（监察处）',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '组织部',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '宣传部',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '学生工作部（处）',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '校工会',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '校团委',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '校长办公室（发展规划办公室）',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '教务处（教师发展中心）',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '科学技术处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '社会科学研究处（广西文科中心）',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '人事处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '研究生学院',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '财务处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '国际交流处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '保卫处（武装部）',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '审计处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '资产管理处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '离退休人员工作处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '后勤基建处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '基础教育管理与合作办公室',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '校友总会秘书处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '图书馆',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '档案馆',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '学报编辑部',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '网络信息中心',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '创新创业学院',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '广西高校师资培训中心',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '继续教育学院',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '校医院',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '干部教育培训学院（党校）',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '校领导',
			'is_college' => false,
		]);
	}
}
