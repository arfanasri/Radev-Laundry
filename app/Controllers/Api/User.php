<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    use ResponseTrait;

    /**
     * Mengambil semua data user
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function index()
    {
        $model = new UserModel();

        $respon = ['user' => $model->ambilSemua()];

        return $this->respond($respon, 200);
    }

    /**
     * Mengambil data user yang dicari
     * @param mixed $cari Daya yang ingin dicari
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function search($cari)
    {
        $model = new UserModel();

        $user = $model
            ->like("id_user", $cari)
            ->orLike("nama_user", $cari)
            ->ambilSemua();

        $respon = [
            "user" => $user
        ];
        return $this->respond($respon, 200);
    }

    /**
     * Mengembalikan data user berdasarkan halaman
     * @param mixed $laman Nomor halaman
     * @param mixed $tampil Banyak data yang ingin ditampilkan
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function page($laman, $tampil = 50)
    {
        $model = new UserModel();
        $limit = $tampil;
        $offset = ($laman - 1) * $limit;
        $respon = [
            "user" => $model->ambilSemua($limit, $offset)
        ];
        return $this->respond($respon, 200);
    }

    /**
     * Menampilkan satu data user
     * @param mixed $id ID User
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function show($id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new UserModel();

        $respon = ['user' => $model->ambilData($id)];

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
     * Menambahkan data user ke database
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function create()
    {
        $model = new UserModel();

        $data = $this->request->getVar();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $respon = ['user' => $model->tambahData($data)];

        return $this->respondCreated($respon);
    }

    /**
     * Mengirim data user yang ingin diubah
     * @param mixed $id ID User
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function edit($id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new UserModel();

        $respon = ['user' => $model->ambilData($id)];

        return $this->respond($respon, 200);
    }

    /**
     * Memperbarui data user
     * @param mixed $id ID User
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function update($id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new UserModel();

        if (!$this->validate($model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJsonVar();

        $respon = ['user' => $model->ubahData($id, $data)];

        return $this->respondUpdated($respon);
    }

    /**
     * Menghapus data user
     * @param mixed $id ID User
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function delete($id = null)
    {
        if (is_null($id)) {
            return $this->fail("ID tidak ditemukan");
        }

        $model = new UserModel();

        $respon = ['user' => $model->hapusData($id)];

        return $this->respondDeleted($respon);
    }
}