<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KPI extends Migration
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
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
			'year'       => [
                'type'              => 'VARCHAR',
                'constraint'        => '4',
            ],
			'description'       => [
                'type'              => 'VARCHAR',
                'constraint'        => '500',
            ],
			'is_active'       => [
                'type'              => 'ENUM',
                'constraint'        => "'0','1'",
            ],
            'level'       => [
                'type'              => 'INT',
                'constraint'        => '11',
                'unique'         => true,
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
        $this->forge->createTable('kpis', true);
    }

    public function down()
    {
        $this->forge->dropTable('kpis');
    }
}
