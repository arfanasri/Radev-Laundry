<?php

namespace App\Controllers\Api;

use App\Models\PelangganModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Pelanggan extends ResourceController
{
    use ResponseTrait;

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new PelangganModel();

        $respon = ['pelanggan' => $model->ambilSemua()];

        return $this->respond($respon, 200);
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function search($cari)
    {
        $model = new PelangganModel();

        $pelanggan = $model
            ->like("nama_pelanggan", $cari)
            ->orLike("alamat", $cari)
            ->ambilSemua();

        $respon = [
            "pelanggan" => $pelanggan
        ];
        return $this->respond($respon, 200);
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function page($laman, $tampil = 50)
    {
        $model = new PelangganModel();
        $limit = $tampil;
        $offset = ($laman - 1) * $limit;
        $respon = [
            "pelanggan" => $model->ambilSemua($limit, $offset)
        ];
        return $this->respond($respon, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new PelangganModel();

        $respon = ['pelanggan' => $model->ambilData($id)];

        return $this->respond($respon, 200);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $model = new PelangganModel();

        $data = $this->request->getVar();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $respon = ['pelanggan' => $model->tambahData($data)];

        return $this->respondCreated($respon);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new PelangganModel();

        $respon = ['pelanggan' => $model->ambilData($id)];

        return $this->respond($respon, 200);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new PelangganModel();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJsonVar();

        $respon = ['pelanggan' => $model->ubahData($id, $data)];

        return $this->respondUpdated($model->ubahData($id, $data));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new PelangganModel();

        $respon = ['pelanggan' => $model->hapusData($id)];

        return $this->respondDeleted($respon);
    }
}