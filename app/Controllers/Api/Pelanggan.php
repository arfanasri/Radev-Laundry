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
        return $this->respond($model->ambilSemua(), 200);
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
        return $this->respond($model->ambilData($id), 200);
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

        return $this->respondCreated($model->tambahData($data));
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
        return $this->respond($model->ambilData($id), 200);
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

        return $this->respondDeleted($model->hapusData($id));
    }
}