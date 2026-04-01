<?php

namespace App\Models;

use CodeIgniter\Model;

class TunjanganSettingModel extends Model
{
    protected $table = 'tunjangan_transport_settings';

    protected $allowedFields = [
        'base_fare',
        'created_at',
        'updated_at'
    ];
}
