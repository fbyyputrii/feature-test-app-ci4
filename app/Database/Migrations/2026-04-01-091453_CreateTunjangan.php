<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTunjangan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'pegawai_id' => ['type' => 'INT'],
            'km' => ['type' => 'FLOAT'],
            'hari_kerja' => ['type' => 'INT'],
            'total' => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pegawai_id', 'pegawai', 'id');
        $this->forge->createTable('tunjangan_transport');
    }

    public function down()
    {
        $this->forge->dropTable('tunjangan_transport', true);
    }
}
