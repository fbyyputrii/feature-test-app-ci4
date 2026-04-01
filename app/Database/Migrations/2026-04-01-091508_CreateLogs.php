<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'user_id' => ['type' => 'INT'],
            'action' => ['type' => 'VARCHAR', 'constraint' => 50],
            'module' => ['type' => 'VARCHAR', 'constraint' => 50],
            'description' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('logs');
    }

    public function down()
    {
        $this->forge->dropTable('logs', true);
    }
}
