<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTunjanganSettings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'base_fare' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tunjangan_transport_settings');
    }

    public function down()
    {
        $this->forge->dropTable('tunjangan_transport_settings', true);
    }
}
