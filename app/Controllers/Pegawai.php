<?php

namespace App\Controllers;

use App\Models\PegawaiModel;

class Pegawai extends BaseController
{
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        if (!can('pegawai.view')) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }

        $pegawai = $this->pegawaiModel->paginate(5);

        return view('pegawai/index', [
            'pegawai' => $pegawai,
            'pager'   => $this->pegawaiModel->pager
        ]);
    }

    public function create()
    {
        if (!can('pegawai.create')) {
            return redirect()->to('/pegawai')->with('error', 'Akses ditolak');
        }
        return view('pegawai/create');
    }

    public function store()
    {
        if (!can('pegawai.create')) {
            return redirect()->to('/pegawai')->with('error', 'Akses ditolak');
        }
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[pegawai.email]',
            'phone' => 'required|is_unique[pegawai.phone]',
            'tanggal_lahir' => 'required',
            'tanggal_masuk' => 'required',
            'status_karyawan' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->pegawaiModel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'alamat' => $this->request->getPost('alamat'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'jabatan' => $this->request->getPost('jabatan'),
            'departemen' => $this->request->getPost('departemen'),
            'status_karyawan' => $this->request->getPost('status_karyawan'),
            'is_active' => 1
        ]);

        log_activity('create', 'pegawai', 'Tambah pegawai: ' . $this->request->getPost('nama'));
        return redirect()->to('/pegawai')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (!can('pegawai.update')) {
            return redirect()->to('/pegawai')->with('error', 'Akses ditolak');
        }
        $pegawai = $this->pegawaiModel->find($id);

        if (!$pegawai) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return view('pegawai/edit', ['pegawai' => $pegawai]);
    }

    public function update($id)
    {
        if (!can('pegawai.update')) {
            return redirect()->to('/pegawai')->with('error', 'Akses ditolak');
        }
        $pegawaiLama = $this->pegawaiModel->find($id);

        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[pegawai.email,id,' . $id . ']',
            'phone' => 'required|is_unique[pegawai.phone,id,' . $id . ']',
            'tanggal_lahir' => 'required',
            'tanggal_masuk' => 'required',
            'status_karyawan' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pegawaiModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'alamat' => $this->request->getPost('alamat'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'jabatan' => $this->request->getPost('jabatan'),
            'departemen' => $this->request->getPost('departemen'),
            'status_karyawan' => $this->request->getPost('status_karyawan'),
        ]);

        log_activity('update', 'pegawai', 'Edit pegawai ID: ' . $id);
        return redirect()->to('/pegawai')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        if (!can('pegawai.delete')) {
            return redirect()->to('/pegawai')->with('error', 'Akses ditolak');
        }
        $pegawai = $this->pegawaiModel->find($id);

        if (!$pegawai) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        $this->pegawaiModel->delete($id);
        log_activity('delete', 'pegawai', 'Hapus pegawai ID: ' . $id);

        return redirect()->to('/pegawai')->with('success', 'Data berhasil dihapus');
    }

    public function detail($id)
    {
        if (!can('pegawai.view')) {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak');
        }
        $pegawai = $this->pegawaiModel->find($id);

        if (!$pegawai) {
            return redirect()->to('/pegawai')->with('error', 'Data tidak ditemukan');
        }

        return view('pegawai/detail', [
            'pegawai' => $pegawai
        ]);
    }
}
