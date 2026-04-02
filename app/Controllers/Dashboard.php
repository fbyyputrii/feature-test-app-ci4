<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Models\PegawaiModel;

class Dashboard extends BaseController
{
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $role = session()->get('role_id');
        $username = session()->get('username');

        $data = [
            'username' => $username,
            'role' => $this->getRoleName()
        ];

        // khusus manager
        if ($data['role'] == 'manager') {
            $data['total_pegawai'] = $this->pegawaiModel->countAll();
            $data['total_kontrak'] = $this->pegawaiModel->where('status_karyawan', 'kontrak')->countAllResults();
            $data['total_tetap'] = $this->pegawaiModel->where('status_karyawan', 'tetap')->countAllResults();
            $data['total_magang'] = $this->pegawaiModel->where('status_karyawan', 'magang')->countAllResults();

            $data['pegawai_baru'] = $this->pegawaiModel
                ->where('status_karyawan', 'kontrak')
                ->orderBy('tanggal_masuk', 'DESC')
                ->findAll(5);
        }

        return view('dashboard/index', $data);
    }

    private function getRoleName()
    {
        $db = \Config\Database::connect();

        $role = $db->table('roles')
            ->where('id', session()->get('role_id'))
            ->get()
            ->getRow();

        return $role ? $role->name : '';
    }

    public function logs()
    {
        $allowedPermissions = ['logs.manage'];

        if (!canAny($allowedPermissions)) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $db = \Config\Database::connect();

        $logs = $db->table('logs')
            ->select('logs.*, users.username')
            ->join('users', 'users.id = logs.user_id')
            ->orderBy('logs.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('logs/index', ['logs' => $logs]);
    }
}
