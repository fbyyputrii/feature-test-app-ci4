<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nip' => '12345678',
                'nama' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'phone' => '08123456789',
                'alamat' => 'Yogyakarta',
                'tanggal_lahir' => '2000-01-01',
                'tanggal_masuk' => '2020-01-01',
                'jabatan' => 'Manager',
                'departemen' => 'HRD',
                'status_karyawan' => 'tetap',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('pegawai')->insertBatch($data);
    }
}
