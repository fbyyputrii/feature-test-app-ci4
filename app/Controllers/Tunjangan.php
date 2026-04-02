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
            'km' => 'required|numeric|greater_than[0]',
            'hari_kerja' => 'required|numeric|greater_than[0]',
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

        // Cek status pegawai
        if (in_array($pegawai['status_karyawan'], ['kontrak', 'magang'])) {
            return redirect()->back()->with('error', 'Pegawai kontrak atau magang tidak dapat tunjangan');
        }

        $setting = $this->settingModel->first();
        if (!$setting) {
            return redirect()->back()->with('error', 'Setting tunjangan belum diatur');
        }

        $km = (float) $this->request->getPost('km');
        $hari_kerja = (int) $this->request->getPost('hari_kerja');

        // Batas km
        if ($km < 5) {
            return redirect()->back()->with('error', 'Km kurang dari 5, tunjangan tidak dihitung');
        }
        if ($km > 25) {
            $km = 25;
        }

        // Batas hari kerja
        if ($hari_kerja < 19) {
            return redirect()->back()->with('error', 'Hari kerja kurang dari 19, tunjangan tidak dihitung');
        }
        if ($hari_kerja > 25) {
            $hari_kerja = 25;
        }

        // Hitung total
        $total = $setting['base_fare'] * $km * $hari_kerja;

        // Pembulatan: kurang dari 0.5 ke bawah, >=0.5 ke atas
        $total = floor($total) + (($total - floor($total)) >= 0.5 ? 1 : 0);

        // Simpan ke database
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
