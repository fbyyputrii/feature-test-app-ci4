<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class Setting extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }


    public function index()
    {
        $allowedPermissions = ['setting.manage'];

        if (!canAny($allowedPermissions)) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }
        $setting = $this->settingModel->first();

        return view('setting/index', [
            'setting' => $setting
        ]);
    }

    public function update()
    {
        $allowedPermissions = ['setting.manage'];

        if (!canAny($allowedPermissions)) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }
        $rules = [
            'base_fare' => 'required|numeric|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'base_fare' => $this->request->getPost('base_fare')
        ];

        $setting = $this->settingModel->first();

        if ($setting) {
            $this->settingModel->update($setting['id'], $data);
        } else {
            $this->settingModel->insert($data);
        }

        return redirect()->back()->with('success', 'Setting berhasil disimpan');
    }
}
