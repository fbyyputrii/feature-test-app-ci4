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
            'logs.read'
        ],

        'manager' => [
            'user.read',
            'user.update_own',
            'pegawai.read',
            'tunjangan.read',
        ],

        'admin' => [
            'user.read',
            'user.update_own',
            'pegawai.create',
            'pegawai.read',
            'pegawai.update',
            'tunjangan.read',
            'setting.manage'
        ],
    ];

    return in_array($permission, $permissions[$role] ?? []);
}