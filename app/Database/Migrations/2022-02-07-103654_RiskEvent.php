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
            'risk_event'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '500',
            ],
            'year'       => [
                'type'              => 'VARCHAR',
                'constraint'        => '4',
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
