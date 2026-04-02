<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class PegawaiApi extends ResourceController
{
    protected $modelName = 'App\Models\PegawaiModel';
    protected $format    = 'json';

    // GET: list semua pegawai
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond(['status' => 'success', 'data' => $data]);
    }

    // GET: detail pegawai
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        return $this->respond(['status' => 'success', 'data' => $data]);
    }

    // POST: create pegawai baru
    public function create()
    {
        $data = $this->request->getJSON(true);

        $rules = [
            'nama'  => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[pegawai.email]',
            'phone' => 'required|min_length[10]|max_length[15]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        try {
            $this->model->insert($data);
            return $this->respondCreated([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // PUT: update pegawai
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $rules = [
            'nama'  => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[pegawai.email,id,{$id}]",
            'phone' => 'required|min_length[10]|max_length[15]'
        ];

        foreach ($rules as $key => $rule) {
            $rules[$key] = str_replace('{id}', $id, $rule);
        }

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        try {
            $this->model->update($id, $data);
            return $this->respond([
                'status' => 'success',
                'message' => 'Data berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    // DELETE: hapus pegawai
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        try {
            $this->model->delete($id);
            return $this->respondDeleted([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
