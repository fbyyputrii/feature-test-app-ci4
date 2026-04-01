<?php

namespace App\Models;

use CodeIgniter\Model;

class TunjanganModel extends Model
{
    protected $table = 'tunjangan_transport';
    protected $allowedFields = [
        'pegawai_id',
        'km',
        'hari_kerja',
        'total',
        'created_at'
    ];
}
