<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'pegawai_id',
        'username',
        'email',
        'phone',
        'password',
        'remember_token',
        'role_id',
        'is_active',
        'created_at',
        'updated_at'
    ];
}
