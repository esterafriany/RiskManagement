<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RiskMitigationDetail extends Migration
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
			'id_risk_mitigation'       => [
                'type'              => 'INT',
                'constraint'        => '11',
            ],
            'risk_mitigation_detail'       => [
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
        $this->forge->createTable('risk_mitigation_details', true);
    }

    public function down()
    {
        $this->forge->dropTable('risk_mitigation_details');
    }
}
