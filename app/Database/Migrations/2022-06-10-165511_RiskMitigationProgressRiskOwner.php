<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RiskMitigationProgressRiskOwner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_risk_event'   => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'id_division'   => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'probability_level_residual'       => [
                'type'              => 'ENUM',
                'constraint'        => "'1','2','3','4','5'",
            ],
			'impact_level_residual'       => [
                'type'              => 'ENUM',
                'constraint'        => "'1','2','3','4','5'",
            ],
			'final_level_residual'       => [
                'type'              => 'INT',
                'constraint'        => '10',
            ],
			'risk_analysis_residual'       => [
                'type'              => 'ENUM',
                'constraint'        => "'R','M','T','E'",
                'null' => true,
            ],
			'risk_impact_quantitative'       => [
                'type'           => 'LONGTEXT',
            ],
			'description'       => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('risk_mitigation_progress_risk_owners', true);
    }

    public function down()
    {
        $this->forge->dropTable('risk_mitigation_progress_risk_owners');
    }
}
