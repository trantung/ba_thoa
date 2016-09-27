<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create([
			'user_name'=> 'trantung',
			'email' => 'trantunghn196@gmail.com',
			'password' => Hash::make('123456'),
			'role_id' => 1,
			'full_name' => 'tran thanh tung',
			'status' => 1
		]);
		User::create([
			'user_name'=> 'ketoan',
			'email' => 'ketoan@gmail.com',
			'password' => Hash::make('123456'),
			'role_id' => 2,
			'full_name' => 'tran thanh tung',
			'status' => 1
		]);
	}
}