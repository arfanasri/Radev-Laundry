<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
use CodeIgniter\API\ResponseTrait;

class Pembayaran extends BaseController
{

    use ResponseTrait;

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function get($idTransaksi)
    {
        $model = new PembayaranModel();
        $respon = ["pembayaran" => $model->where("id_transaksi", $idTransaksi)->ambilSemua()];
        return $this->respond($respon, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($idTransaksi, $id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new PembayaranModel();

        $respon = ["pembayaran" => $model->ambilData($id)];

        return $this->respond($respon, 200);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new($idTransaksi)
    {
        // 
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create($idTransaksi)
    {
        $model = new PembayaranModel();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getVar();

        $respon = ["pembayaran" => $model->tambahData($data)];

        return $this->respondCreated($respon);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($idTransaksi, $id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new PembayaranModel();

        $respon = [
            "pembayaran" => $model->ambilData($id),
        ];
        return $this->respond($respon, 200);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($idTransaksi, $id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new PembayaranModel();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJsonVar();

        $respon = ["pembayaran" => $model->ubahData($id, $data)];

        return $this->respondUpdated($respon);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($idTransaksi, $id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new PembayaranModel();

        $respon = ["pembayaran" => $model->hapusData($id)];

        return $this->respondDeleted($respon);
    }
}