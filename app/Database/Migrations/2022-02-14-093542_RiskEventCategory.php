<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RiskEventCategory extends Migration
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
			'id_risk_event'       => [
                'type'              => 'INT',
                'constraint'        => '11',
            ],
            'id_risk_category'       => [
                'type'              => 'INT',
                'constraint'        => '11',
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
        $this->forge->createTable('risk_event_categories', true);
    }

    public function down()
    {
        $this->forge->dropTable('risk_event_categories');
    }
}
