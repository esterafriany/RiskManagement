<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RiskEvent extends Migration
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
			'id_kpi'       => [
                'type'              => 'INT',
                'constraint'        => '11',
            ],
            'risk_number'       => [
                'type'           => 'INT',
                'constraint'     => '4',
            ],
            'risk_number_manual'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '4',
            ],
            'risk_number_residual'       => [
                'type'           => 'INT',
                'constraint'     => '4',
            ],
            'risk_number_target'       => [
                'type'           => 'INT',
                'constraint'     => '4',
            ],
            'risk_event'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
            ],
            'year'       => [
                'type'              => 'VARCHAR',
                'constraint'        => '4',
            ],
            'objective'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
            ],
            'existing_control_1'       => [
                'type'              => 'ENUM',
                'constraint'        => "'Ada','Tidak Ada'",
            ],
            'existing_control_2'       => [
                'type'              => 'ENUM',
                'constraint'        => "'Memadai','Belum Memadai'",
            ],
            'existing_control_3'       => [
                'type'              => 'ENUM',
                'constraint'        => "'Dijalankan 100%','Belum Dijalankan 100%'",
            ],
            'probability_level'       => [
                'type'              => 'ENUM',
                'constraint'        => "'1','2','3','4','5'",
            ],
            'target_probability_level'       => [
                'type'              => 'ENUM',
                'constraint'        => "'1','2','3','4','5'",
            ],
            'impact_level'       => [
                'type'              => 'ENUM',
                'constraint'        => "'1','2','3','4','5'",
            ],
            'target_impact_level'       => [
                'type'              => 'ENUM',
                'constraint'        => "'1','2','3','4','5'",
            ],
            'final_level'       => [
                'type'              => 'INT',
                'constraint'        => '10',
            ],
            'target_final_level'       => [
                'type'              => 'INT',
                'constraint'        => '10',
            ],
			'risk_analysis'       => [
                'type'              => 'ENUM',
                'constraint'        => "'R','M','T','E'",
                'null' => true,
            ],
            'target_risk_analysis'       => [
                'type'              => 'ENUM',
                'constraint'        => "'R','M','T','E'",
                'null' => true,
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
                'type'           => 'VARCHAR',
                'constraint'     => '500',
            ],
            'is_active'       => [
                'type'              => 'ENUM',
                'constraint'        => "'0','1'",
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
        $this->forge->createTable('risk_events', true);
    }

    public function down()
    {
        $this->forge->dropTable('risk_events');
    }
}
