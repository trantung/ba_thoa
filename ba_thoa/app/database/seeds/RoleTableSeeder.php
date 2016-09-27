<?php

class RoleTableSeeder extends Seeder {

	public function run()
	{
		Role::create([
			'role_name'=> 'admin',
			'description' => 'quyền cao nhất',
		]);
		Role::create([
			'role_name'=> 'ketoan',
			'description' => 'kế toán chỉ thêm',
		]);
	}
}