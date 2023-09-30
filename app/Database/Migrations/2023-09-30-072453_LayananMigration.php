<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LayananMigration extends Migration
{
    public function up()
    {
        $fields = [
            'id_layanan' => [
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_layanan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'satuan' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
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

        $this->forge->addPrimaryKey("id_layanan");

        $this->forge->createTable("layanan");
    }

    public function down()
    {
        $this->forge->dropTable("layanan");
    }
}