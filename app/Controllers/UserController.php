<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PegawaiModel;
use App\Models\RoleModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $pegawaiModel;
    protected $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->pegawaiModel = new PegawaiModel();
        $this->roleModel = new RoleModel();
        if (session()->get('role') != 'superadmin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }
    }

    public function index()
    {
        if (!can('user.manage')) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $users = $this->userModel
            ->select('users.*, pegawai.nama, roles.name as role')
            ->join('pegawai', 'pegawai.id = users.pegawai_id')
            ->join('roles', 'roles.id = users.role_id')
            ->findAll();

        return view('users/index', compact('users'));
    }

    public function create()
    {
        $pegawai = $this->pegawaiModel->findAll();
        $roles = $this->roleModel->findAll();

        return view('users/create', compact('pegawai', 'roles'));
    }
    public function store()
    {
        if (!can('user.manage')) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $password = 'User' . rand(1000, 9999) . '!A';

        $this->userModel->save([
            'pegawai_id' => $this->request->getPost('pegawai_id'),
            'role_id'    => $this->request->getPost('role_id'),
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'is_active'  => 1
        ]);

        return redirect()->to('/users')->with('success', 'Password: ' . $password);
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        $pegawai = $this->pegawaiModel->findAll();
        $roles = $this->roleModel->findAll();

        return view('users/edit', compact('user', 'pegawai', 'roles'));
    }

    public function update($id)
    {
        $this->userModel->update($id, [
            'pegawai_id' => $this->request->getPost('pegawai_id'),
            'role_id'    => $this->request->getPost('role_id'),
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'is_active'  => $this->request->getPost('is_active')
        ]);

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        if (!can('user.manage')) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $user = $this->userModel->find($id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        if ($id == session('user_id')) {
            return back()->with('error', 'Tidak bisa hapus diri sendiri');
        }

        $this->userModel->delete($id);

        return redirect()->to('/users')->with('success', 'User dihapus');
    }
}
