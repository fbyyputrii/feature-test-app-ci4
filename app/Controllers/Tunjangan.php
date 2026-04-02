<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TunjanganModel;
use App\Models\TunjanganSettingModel;
use App\Models\PegawaiModel;

class Tunjangan extends BaseController
{
    protected $tunjanganModel;
    protected $settingModel;
    protected $pegawaiModel;

    public function __construct()
    {
        $this->tunjanganModel = new TunjanganModel();
        $this->settingModel = new TunjanganSettingModel();
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $allowedPermissions = ['tunjangan.manage', 'tunjangan.read'];

        if (!canAny($allowedPermissions)) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $data['tunjangan'] = $this->tunjanganModel
            ->select('tunjangan_transport.*, pegawai.nama')
            ->join('pegawai', 'pegawai.id = tunjangan_transport.pegawai_id')
            ->findAll();

        return view('tunjangan/index', $data);
    }

    public function create()
    {
        $allowedPermissions = ['tunjangan.manage'];

        if (!canAny($allowedPermissions)) {
            return redirect()->to('/tunjangan')->with('error', 'Akses ditolak');
        }

        return view('tunjangan/create', [
            'pegawai' => $this->pegawaiModel->findAll()
        ]);
    }

    public function store()
    {
        $allowedPermissions = ['tunjangan.manage'];

        if (!canAny($allowedPermissions)) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $rules = [
            'pegawai_id' => 'required',
            'km' => 'required|numeric|greater_than[0]|less_than_equal_to[200]',
            'hari_kerja' => 'required|numeric|greater_than[0]|less_than_equal_to[31]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $pegawai_id = $this->request->getPost('pegawai_id');

        $pegawai = $this->pegawaiModel->find($pegawai_id);
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan');
        }

        $setting = $this->settingModel->first();
        if (!$setting) {
            return redirect()->back()->with('error', 'Setting tunjangan belum diatur');
        }

        $km = $this->request->getPost('km');
        $hari_kerja = $this->request->getPost('hari_kerja');

        $total = $km * $hari_kerja * $setting['base_fare'];

        $this->tunjanganModel->save([
            'pegawai_id' => $pegawai_id,
            'km' => $km,
            'hari_kerja' => $hari_kerja,
            'total' => $total,
        ]);

        log_activity('create', 'tunjangan', 'Hitung tunjangan pegawai ID: ' . $pegawai_id);

        return redirect()->to('/tunjangan')->with('success', 'Tunjangan berhasil dihitung');
    }
}
