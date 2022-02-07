<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
			'id_group'       => [
				'type'           => 'INT',
				'constraint'     => 5
			],
            
			'id_division'       => [
				'type'           => 'INT',
				'constraint'     => 5
			],
			'email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'password'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
            'username'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
			'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'gender'       => [
                'type'              => 'ENUM',
                'constraint'        => "'pria','wanita'",
            ],
            'no_telp' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'alamat' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
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
		//$this->forge->addForeignKey('id_group', 'groups', 'id');
		//$this->forge->addForeignKey('id_division', 'divisions', 'id');
        $this->forge->createTable('users', true);
    }

	public function down()
    {
        $this->forge->dropTable('users');
    }
}
