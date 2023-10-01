<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembayaranMigration extends Migration
{
    public function up()
    {
        $fields = [
            'id_pembayaran' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type' => 'VARCHAR',
                'constraint' => 8,
            ],
            'banyak' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => null,
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

        $this->forge->addPrimaryKey("id_pembayaran");

        $this->forge->addForeignKey("id_transaksi", "transaksi", "id_transaksi", 'CASCADE', 'CASCADE');

        $this->forge->createTable("pembayaran");
    }

    public function down()
    {
        $this->forge->dropTable("pembayaran");
    }
}