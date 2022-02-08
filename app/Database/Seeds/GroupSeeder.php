<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Groups;

class GroupSeeder extends Seeder
{
    public function run()
	{
		$group_object = new Groups();

		$group_object->insertBatch([
			[
				"name" => "SuperRoot",
				"is_root" => "1",
				"is_active" => "1"
				
			],
			[
				"name" => "RiskOwner",
				"is_root" => "0",
				"is_active" => "1"
			]
		]);
	}
}
