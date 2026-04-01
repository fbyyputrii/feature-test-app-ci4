<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'tunjangan_transport_settings';
    protected $primaryKey = 'id';

    protected $allowedFields = ['base_fare'];

    protected $useTimestamps = true;
}