<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\RiskCategories;

class RiskCategorySeeder extends Seeder
{
    public function run()
	{
		$group_object = new RiskCategories();

		$group_object->insertBatch([
			[
				"name" => "Risiko Keuangan",
				"description" => "Risiko yang diakibatkan ketidaktepatan dalam pengelolaan aset dan kewajiban perusahaan yang berdampak terhadap laba yang lebih rendah dan/atau mengalami kesulitan dalam memenuhi kewajiban keuangan.",
				"is_active" => "1"
				
			],
			[
				"name" => "Risiko Operasional",
				"description" => "Risiko yang diakibatkan oleh kegagalan proses internal yang kurang memadai, kesalahan manusia, kegagalan dalam mengelola standar minimum keselamatan, kesehatan, standar minimum lingkungan, nilai-nilai kemasyarakatan, kegagalan sistem, dan/atau adanya kejadian-kejadian eksternal yang mempengaruhi operasional Perusahaan.",
				"is_active" => "1"
				
			],
			[
				"name" => "Risiko Keuangan",
				"description" => "Risiko yang diakibatkan ketidaktepatan dalam pengelolaan aset dan kewajiban perusahaan yang berdampak terhadap laba yang lebih rendah dan/atau mengalami kesulitan dalam memenuhi kewajiban keuangan.",
				"is_active" => "1"
				
			],
			[
				"name" => "Risiko Strategis",
				"description" => "Risiko yang terkait akibat ketidaktepatan dalam pengambilan dan/atau pelaksanaan suatu keputusan stratejik serta kegagalan dalam mengantisipasi perubahan lingkungan bisnis.",
				"is_active" => "1"
				
			],
			[
				"name" => "Risiko Pasar",
				"description" => "Risiko yang diakibatkan oleh perubahan kondisi pasar antara lain perubahan nilai tukar, perubahan suku bunga, perubahan harga komoditas, terganggunya suplai dan permintaan.",
				"is_active" => "1"
				
			],
			[
				"name" => "Risiko Hukum & Kepatuhan",
				"description" => "Risiko yang disebabkan sebagai akibat tuntutan hukum dan/atau kelemahan aspek yuridis, serta akibat tidak mematuhinya peraturan perundang-undangan dan ketentuan yang berlaku.",
				"is_active" => "1"
				
			],
			[
				"name" => "Risiko Reputasi",
				"description" => "Risiko yang diakibatkan  menurunnya tingkat kepercayaan stakeholder yang bersumber dari persepsi negatif terhadap Perusahaan.",
				"is_active" => "1"
				
			],
		]);
	}
}
