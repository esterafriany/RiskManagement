<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Group extends Migration
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
			'is_root'       => [
                'type'              => 'ENUM',
                'constraint'        => "'0','1'",
            ],
            'is_need_credential'       => [
                'type'              => 'ENUM',
                'constraint'        => "'0','1'",
            ],
			'can_approval_job'       => [
                'type'              => 'ENUM',
                'constraint'        => "'0','1'",
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
        $this->forge->createTable('groups', true);
    }

    public function down()
    {
        $this->forge->dropTable('groups');
    }
}
