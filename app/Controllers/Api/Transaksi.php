<?php

namespace App\Controllers\Api;

use App\Models\PelangganModel;
use App\Models\TransaksiModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Transaksi extends ResourceController
{

    use ResponseTrait;

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $model = new TransaksiModel();
        $respon = ["transaksi" => $model->ambilSemua()];
        return $this->respond($respon, 200);
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function search($cari)
    {
        $model = new TransaksiModel();

        $transaksi = $model
            ->like("transaksi.id_transaksi", $cari)
            ->orLike("pelanggan.nama_pelanggan", $cari)
            ->orLike("transaksi.tanggal_transaksi", $cari)
            ->orLike("transaksi.harga_total", $cari)
            ->ambilSemua();

        $respon = [
            "transaksi" => $transaksi
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
        $model = new TransaksiModel();
        $limit = $tampil;
        $offset = ($laman - 1) * $limit;
        $respon = [
            "transaksi" => $model->ambilSemua($limit, $offset)
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

        $model = new TransaksiModel();

        $respon = ["transaksi" => $model->ambilData($id)];

        return $this->respond($respon, 200);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $pelangganModel = new PelangganModel();

        $respon = [
            "pelanggan" => $pelangganModel->ambilSemua(),
        ];

        return $this->respond($respon, 200);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $model = new TransaksiModel();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getVar();

        $respon = ["transaksi" => $model->tambahData($data)];

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

        $model = new TransaksiModel();
        $pelangganModel = new PelangganModel();

        $respon = [
            "transaksi" => $model->ambilData($id),
            "pelanggan" => $pelangganModel->ambilSemua()
        ];
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

        $model = new TransaksiModel();

        // if (!$this->validate($model->validationRules)) {
        //     return $this->failValidationErrors($this->validator->getErrors());
        // }

        $data = $this->request->getJsonVar();

        $respon = ["transaksi" => $model->ubahData($id, $data)];

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

        $model = new TransaksiModel();

        $respon = ["transaksi" => $model->hapusData($id)];

        return $this->respondDeleted($respon);
    }

    public function status($id = null, $status = null)
    {
        if (is_null($id) || is_null($status)) {
            return $this->fail("ID atau Status Tidak terisi");
        }

        $model = new TransaksiModel();

        $data = ["status" => $status];

        $respon = ["transaksi" => $model->ubahData($id, $data)];

        return $this->respondUpdated($respon);
    }
}