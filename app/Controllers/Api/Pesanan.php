<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\LayananModel;
use App\Models\PesananModel;
use CodeIgniter\API\ResponseTrait;

class Pesanan extends BaseController
{

    use ResponseTrait;

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function get($idTransaksi)
    {
        $model = new PesananModel();
        $respon = ["pesanan" => $model->where("id_transaksi", $idTransaksi)->ambilSemua()];
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

        $model = new PesananModel();

        $respon = ["pesanan" => $model->ambilData($id)];

        return $this->respond($respon, 200);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new($idTransaksi)
    {
        $layananModel = new LayananModel();

        $respon = [
            "layanan" => $layananModel->ambilSemua(),
        ];

        return $this->respond($respon, 200);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create($idTransaksi)
    {
        $model = new PesananModel();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getVar();

        $respon = ["pesanan" => $model->tambahData($data)];

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

        $model = new PesananModel();
        $layananModel = new LayananModel();

        $respon = [
            "pesanan" => $model->ambilData($id),
            "layanan" => $layananModel->ambilSemua()
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

        $model = new PesananModel();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJsonVar();

        $respon = ["pesanan" => $model->ubahData($id, $data)];

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

        $model = new PesananModel();

        $respon = ["pesanan" => $model->hapusData($id)];

        return $this->respondDeleted($respon);
    }
}