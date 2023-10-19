<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class Pelanggan extends Base
{
    public function __construct()
    {
        $this->header = "Pelanggan";
        $this->menu = "pelanggan";
        $this->bc = [["/", "Beranda"], "Pelanggan"];
    }

    /**
     * Tampilan utama Pelanggan
     * @return string
     */
    public function index(): string
    {
        $model = new PelangganModel();
        $banyakData = $model->countAllResults();
        $banyakHalaman = ceil($banyakData / 50);
        $data = ["banyakHalaman" => $banyakHalaman];
        return $this->tampil("pelanggan/index", $data);
    }

    /**
     * Tampilan data Pelanggan
     * @return string
     */
    public function data(): string
    {
        $model = new PelangganModel();

        $data = [
            "pelanggan" => $model->ambilSemua(),
        ];

        $json = view('pelanggan/data', $data);
        return $json;
    }

    /**
     * Tampilan cari data pelanggan
     * @param mixed $cari Kata kunci yang ingin dicari
     * @return string
     */
    public function cari($cari, $laman, $tampil = 5): string
    {
        $model = new PelangganModel();

        $query = $model
            ->like("nama_pelanggan", $cari)
            ->orLike("alamat", $cari);


        $banyakData = $query->countAllResults(false);
        $banyakHalaman = ceil($banyakData / $tampil);

        $limit = $tampil;
        $offset = ($laman - 1) * $limit;

        $pelanggan = $query->ambilSemua($limit, $offset);

        $data = [
            "mode" => "cari",
            "cari" => $cari,
            "pelanggan" => $pelanggan,
            "halaman" => $laman,
            "offset" => $offset,
            "limit" => $limit,
            "banyakHalaman" => $banyakHalaman,
        ];

        $json = view('pelanggan/data', $data);
        return $json;
    }

    /**
     * Tampilan halaman data pelanggan
     * @param int $laman Nomor halaman
     * @param int $tampil Banyak data yang tampil
     * @return string
     */
    public function halaman(int $laman, int $tampil = 5): string
    {
        $model = new PelangganModel();

        $banyakData = $model->countAllResults();
        $banyakHalaman = ceil($banyakData / $tampil);

        $limit = $tampil;
        $offset = ($laman - 1) * $limit;

        $data = [
            "mode" => "halaman",
            "pelanggan" => $model->ambilSemua($limit, $offset),
            "halaman" => $laman,
            "offset" => $offset,
            "limit" => $limit,
            "banyakHalaman" => $banyakHalaman,
        ];

        $json = view('pelanggan/data', $data);
        return $json;
    }

    /**
     * Tampilan form tambah pelanggan
     * @return string
     */
    public function tambah(): string
    {
        $data = [];
        $json = view('pelanggan/tambah', $data);
        return $json;
    }

    /**
     * Tampilan form ubah pelanggan
     * @param mixed $id ID Pelanggan
     * @return string
     */
    public function ubah($id): string
    {
        $model = new PelangganModel();
        $data = ["data" => $model->ambilData($id)];
        $json = view('pelanggan/ubah', $data);
        return $json;
    }
}