<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiMigration extends Migration
{
    public function up()
    {
        $fields = [
            'id_transaksi' => [
                'type' => 'VARCHAR',
                'constraint' => 8,
            ],
            'id_pelanggan' => [
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => true,
            ],
            'tanggal_transaksi' => [
                'type' => 'DATETIME',
            ],
            'harga_total' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => '0',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pencatatan', 'antrian', 'proses', 'siap_diambil', 'batal', 'selesai'],
                'default' => 'pencatatan',
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

        $this->forge->addPrimaryKey("id_transaksi");

        $this->forge->addForeignKey("id_pelanggan", "pelanggan", "id_pelanggan", 'CASCADE', 'CASCADE');

        $this->forge->createTable("transaksi");
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}