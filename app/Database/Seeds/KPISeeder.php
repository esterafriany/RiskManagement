<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Kpis;

class KPISeeder extends Seeder
{
    public function run()
	{
		$user_object = new Kpis();

		$user_object->insertBatch([
			[
				"id_group" => "1",
				"name" => "EBITDA",
				"year" => "2022",
				"description" => "EBITDA, Cash From Operation,  dan Laba (rugi) tahun berjalan",
				"is_active" => "1",
				"level" => "1"
			],
			[
				"id_group" => "1",
				"name" => "ROIC-WACC",
				"year" => "2022",
				"description" => "ROIC dengan tingkat jangka panjang  ROIC ≥ WACC",
				"is_active" => "1",
				"level" => "2"
			],
			[
				"id_group" => "1",
				"name" => "IBD to EBITDA",
				"year" => "2022",
				"description" => "Interest Bearing Debt to Equity dalam rentang kisaran rasio investment grade rated companies",
				"is_active" => "1",
				"level" => "3"
			]
		]);

		
		
	}
}
