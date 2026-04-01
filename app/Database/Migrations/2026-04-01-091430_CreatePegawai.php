<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePegawai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nip' => ['type' => 'VARCHAR', 'constraint' => 20],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'alamat' => ['type' => 'TEXT'],
            'tanggal_lahir' => ['type' => 'DATE'],
            'tanggal_masuk' => ['type' => 'DATE'],
            'jabatan' => ['type' => 'VARCHAR', 'constraint' => 50],
            'departemen' => ['type' => 'VARCHAR', 'constraint' => 50],
            'status_karyawan' => ['type' => 'ENUM', 'constraint' => ['tetap', 'kontrak', 'magang']],
            'is_active' => ['type' => 'BOOLEAN', 'default' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pegawai');
    }

    public function down()
    {
        $this->forge->dropTable('pegawai', true);
    }
}
