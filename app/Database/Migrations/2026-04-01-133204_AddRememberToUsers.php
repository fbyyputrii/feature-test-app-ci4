<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRememberToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'remember_token' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'password' 
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'remember_token');
    }
}
