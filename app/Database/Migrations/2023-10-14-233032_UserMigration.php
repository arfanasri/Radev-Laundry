<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMigration extends Migration
{
    public function up()
    {
        $fields = [
            'id_user' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_user' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin'],
                'default' => 'admin',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => NULL
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'default' => NULL
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'default' => NULL
            ],
        ];

        $this->forge->addField($fields);

        $this->forge->addPrimaryKey("id_user");

        $this->forge->createTable("user");
    }

    public function down()
    {
        $this->forge->dropTable("user");
    }
}