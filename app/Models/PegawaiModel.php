<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nip',
        'nama',
        'email',
        'phone',
        'alamat',
        'tanggal_lahir',
        'tanggal_masuk',
        'jabatan',
        'departemen',
        'status_karyawan',
        'is_active'
    ];
}
