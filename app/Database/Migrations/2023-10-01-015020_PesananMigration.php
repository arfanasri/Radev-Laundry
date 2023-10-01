<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PesananMigration extends Migration
{
    public function up()
    {

        $fields = [
            'id_pesanan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type' => 'VARCHAR',
                'constraint' => 8,
            ],
            'id_layanan' => [
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => true,
            ],
            'banyak' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'harga_subtotal' => [
                'type' => 'INT',
                'constraint' => 11,
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

        $this->forge->addPrimaryKey("id_pesanan");

        $this->forge->addForeignKey("id_layanan", "layanan", "id_layanan", 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey("id_transaksi", "transaksi", "id_transaksi", 'CASCADE', 'CASCADE');

        $this->forge->createTable("pesanan");
    }

    public function down()
    {
        $this->forge->dropTable("pesanan");
    }
}