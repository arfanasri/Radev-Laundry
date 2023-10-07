<?php

namespace App\Controllers\Api;

use App\Models\LayananModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Layanan extends ResourceController
{
    use ResponseTrait;

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new LayananModel();
        $respon = [
            "layanan" => $model->ambilSemua()
        ];
        return $this->respond($respon, 200);
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function search($cari)
    {
        $model = new LayananModel();

        $layanan = $model
            ->like("nama_layanan", $cari)
            ->orLike("harga", $cari)
            ->orLike("satuan", $cari)
            ->ambilSemua();

        $respon = [
            "layanan" => $layanan
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
        $model = new LayananModel();
        $limit = $tampil;
        $offset = ($laman - 1) * $limit;
        $respon = [
            "layanan" => $model->ambilSemua($limit, $offset)
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

        $model = new LayananModel();
        $respon = [
            "layanan" => $model->ambilData($id),
        ];
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
        $model = new LayananModel();

        $data = $this->request->getVar();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $respon = [
            "layanan" => $model->tambahData($data)
        ];

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

        $model = new LayananModel();
        $respon = ["layanan" => $model->ambilData($id)];
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

        $model = new LayananModel();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJsonVar();

        $respon = ["layanan" => $model->ubahData($id, $data)];

        return $this->respondUpdated($respon);
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

        $model = new LayananModel();

        $respon = ["layanan" => $model->hapusData($id)];

        return $this->respondDeleted($respon);
    }
}