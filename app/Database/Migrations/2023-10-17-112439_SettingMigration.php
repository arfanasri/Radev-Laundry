<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SettingMigration extends Migration
{
    public function up()
    {

        $fields = [
            'nama_setting' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nilai_setting' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ];

        $this->forge->addField($fields);

        $this->forge->addPrimaryKey("nama_setting");

        $this->forge->createTable("_setting");
    }

    public function down()
    {
        $this->forge->dropTable("_setting");
    }
}