<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PelangganMigration extends Migration
{
    public function up()
    {
        $fields = [
            'id_pelanggan' => [
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_pelanggan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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

        $this->forge->addPrimaryKey("id_pelanggan");

        $this->forge->createTable("pelanggan");
    }

    public function down()
    {
        $this->forge->dropTable("pelanggan");
    }
}