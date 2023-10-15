<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends Base
{
    public function __construct()
    {
        $this->header = "User";
        $this->menu = "user";
        $this->bc = [["/", "Beranda"], "user"];
    }

    /**
     * Tampilan utama User
     * @return string
     */
    public function index(): string
    {
        $model = new UserModel();
        $banyakData = $model->countAllResults();
        $banyakHalaman = ceil($banyakData / 50);
        $data = ["banyakHalaman" => $banyakHalaman];
        return $this->tampil("user/index", $data);
    }

    /**
     * Tampilan data User
     * @return string
     */
    public function data(): string
    {
        $model = new UserModel();

        $data = [
            "user" => $model->ambilSemua(),
        ];

        $json = view('user/data', $data);
        return $json;
    }

    /**
     * Tampilan cari data user
     * @param mixed $cari Kata kunci yang ingin dicari
     * @return string
     */
    public function cari($cari): string
    {
        $model = new UserModel();
        $user = $model
            ->like("id_user", $cari)
            ->orLike("nama_user", $cari)
            ->ambilSemua();

        $data = [
            "user" => $user,
        ];

        $json = view('user/data', $data);
        return $json;
    }

    /**
     * Tampilan halaman data user
     * @param int $laman Nomor halaman
     * @param int $tampil Banyak data yang tampil
     * @return string
     */
    public function halaman(int $laman, int $tampil = 50): string
    {
        $model = new UserModel();

        $limit = $tampil;
        $offset = ($laman - 1) * $limit;

        $data = [
            "user" => $model->ambilSemua($limit, $offset),
            "halaman" => $laman,
            "offset" => $offset,
        ];

        $json = view('user/data', $data);
        return $json;
    }

    /**
     * Tampilan form tambah user
     * @return string
     */
    public function tambah(): string
    {
        $data = [];
        $json = view('user/tambah', $data);
        return $json;
    }

    /**
     * Tampilan form ubah user
     * @param mixed $id ID User
     * @return string
     */
    public function ubah($id): string
    {
        $model = new UserModel();
        $data = ["data" => $model->ambilData($id)];
        $json = view('user/ubah', $data);
        return $json;
    }
}