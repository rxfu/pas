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
			'name'       => '文学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '历史文化与旅游学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '政治与公共管理学院',
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
			'name'       => '体育学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '环境与资源学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '外国语学院（公共课）',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '公体部',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '马克思主义学院（公共课）',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '公共艺术教学部',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '国际文化教育学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '职业技术学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '图书馆',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '学工部',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '现代教育技术中心',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '音乐学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '计算机科学与信息工程学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '经济管理学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '法学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '应用科学学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '电子工程学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '教务处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '研究生学院',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '漓江学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '职业技术师范学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '成人教育学院',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '设计学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '马克思主义学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '健康管理学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '广西民族大学预科部',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '高师培训中心',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '校团委',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '宣传部',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '后勤服务集团',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '人事处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '大学书店',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '职业技术学院true',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '组织部',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '教师教育学院',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '档案馆',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '武装部',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '创新创业学院',
			'is_college' => true,
		]);
		Department::create([
			'name'       => '离退处',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '党办校办',
			'is_college' => false,
		]);
		Department::create([
			'name'       => '校友总会',
			'is_college' => false,
		]);
	}
}
