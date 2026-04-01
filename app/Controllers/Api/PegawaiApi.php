<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class PegawaiApi extends ResourceController
{
    protected $modelName = 'App\Models\PegawaiModel';
    protected $format    = 'json';

    // ✅ GET (list)
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    // ✅ GET (detail)
    public function show($id = null)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        return $this->respond($data);
    }

    // ✅ POST (create)
    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->insert($data)) {
            return $this->fail($this->model->errors());
        }

        return $this->respondCreated([
            'message' => 'Data berhasil ditambahkan'
        ]);
    }

    // ✅ PUT (update)
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $this->model->update($id, $data);

        return $this->respond([
            'message' => 'Data berhasil diupdate'
        ]);
    }

    // ✅ DELETE
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}