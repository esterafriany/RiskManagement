<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Users;

class UserSeeder extends Seeder
{
    public function run()
	{
		$user_object = new Users();

		$user_object->insertBatch([
			[
				"id_group" => "1",
				"id_division" => "0",
				"email" => "psmr@perumppd.co.id",
				"password" =>md5("password"),
				"username" => "tes",
				"name" => "Rahul Sharma",
				"gender" => "wanita",
				"no_telp" => "7899654125",
				"alamat" => "jakarta",
				"is_active" => "1"
			],
			[
				"id_group" => "2",
				"id_division" => "1",
				"email" => "pic@perumppd.co.id",
				"password" =>md5("password"),
				"username" => "tes",
				"name" => "Sharma",
				"gender" => "pria",
				"no_telp" => "7899654125",
				"alamat" => "jakarta",
				"is_active" => "1"
			]
		]);

		
		
	}
}
