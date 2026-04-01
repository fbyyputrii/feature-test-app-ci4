<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'superadmin'],
            ['name' => 'manager'],
            ['name' => 'admin'],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
