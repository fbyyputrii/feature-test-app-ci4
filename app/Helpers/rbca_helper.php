<?php

function can($permission)
{
    $role = session()->get('role');

     $permissions = [
        'superadmin' => [
            'role.manage',
            'user.manage',
            'pegawai.none',
            'tunjangan.none',
            'setting.none',
            'logs.manage'
        ],
        'manager' => [
            'role.none',
            'user.read',
            'user.update',
            'pegawai.read',
            'tunjangan.read',
            'setting.none',
            'logs.none'
        ],
        'admin' => [
            'role.none',
            'user.read',
            'user.update',
            'pegawai.manage',
            'tunjangan.read',
            'setting.manage'
        ]
     ];

    return in_array($permission, $permissions[$role] ?? []);
}

function canAny(array $permissionsToCheck)
{
    foreach ($permissionsToCheck as $perm) {
        if (can($perm)) {
            return true; // cukup satu ada
        }
    }
    return false;
}