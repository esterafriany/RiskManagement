<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RiskMitigationDetailOutput extends Migration
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
            'output'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
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
        $this->forge->createTable('risk_mitigation_detail_outputs', true);
    }

    public function down()
    {
        $this->forge->dropTable('risk_mitigation_detail_outputs');
    }
}
