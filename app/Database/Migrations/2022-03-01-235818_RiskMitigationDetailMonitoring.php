<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RiskMitigationDetailMonitoring extends Migration
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
            'id_detail_mitigation'   => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'target_month'       => [
                'type'           => 'DATE',
            ],
			'monitoring_month'       => [
                'type'              => 'DATE',
            ],
			'notes'       => [
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
        $this->forge->createTable('risk_mitigation_detail_monitorings', true);
    }

    public function down()
    {
        $this->forge->dropTable('risk_mitigation_detail_monitorings');
    }
}
