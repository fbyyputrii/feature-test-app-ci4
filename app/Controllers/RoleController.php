<?php

namespace App\Controllers;

use App\Models\RoleModel;

class RoleController extends BaseController
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        $allowedPermissions = ['role.manage'];

        if (!canAny($allowedPermissions)) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }
        $roles = $this->roleModel->findAll();
        return view('roles/index', compact('roles'));
    }

    public function create()
    {
        return view('roles/create');
    }

    public function store()
    {
        $this->roleModel->save([
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to('/roles');
    }

    public function edit($id)
    {
        $role = $this->roleModel->find($id);
        return view('roles/edit', compact('role'));
    }

    public function update($id)
    {
        $this->roleModel->update($id, [
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to('/roles');
    }
    public function delete($id)
    {
        $allowedPermissions = ['role.manage'];

        if (!canAny($allowedPermissions)) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $user = model('UserModel')->where('role_id', $id)->first();

        if ($user) {
            return back()->with('error', 'Role sedang digunakan');
        }

        $this->roleModel->delete($id);

        return redirect()->to('/roles')->with('success', 'Role dihapus');
    }
}
