<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Divisions;

class DivisionSeeder extends Seeder
{
    public function run()
	{
		$division_object = new Divisions();

		$division_object->insertBatch([
			[
				"name" => "Divisi Keuangan",
				"division_code" => "KEU",
				"is_active" => "1"
				
			],
			[
				"name" => "Divisi Operasional",
				"division_code" => "OPR",
				"is_active" => "1"
			]
		]);
	}
}
