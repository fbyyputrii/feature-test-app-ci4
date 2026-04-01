<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $pegawai = $this->db->table('pegawai')->get()->getRow();

        if (!$pegawai) {
            throw new \Exception('Data pegawai kosong!');
        }

        $data = [
            'pegawai_id' => $pegawai->id,
            'username' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'phone' => '081234567890',
            'password' => password_hash('Admin123!', PASSWORD_DEFAULT),
            'role_id' => 1,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);
    }
}
