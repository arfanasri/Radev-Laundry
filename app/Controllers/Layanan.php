<?php

namespace App\Controllers;

use App\Models\LayananModel;

class Layanan extends Base
{
    public function __construct()
    {
        $this->header = "Layanan";
        $this->menu = "layanan";
        $this->bc = [["/", "Beranda"], "Layanan"];
    }

    /**
     * Tampilan utama Layanan
     * @return string
     */
    public function index(): string
    {
        $model = new LayananModel();
        $banyakData = $model->countAllResults();
        $banyakHalaman = ceil($banyakData / 50);
        $data = ["banyakHalaman" => $banyakHalaman];
        return $this->tampil("layanan/index", $data);
    }

    /**
     * Tampilan data layanan
     * @return string
     */
    public function data(): string
    {
        $model = new LayananModel();

        $data = [
            "layanan" => $model->ambilSemua(),
        ];

        $json = view('layanan/data', $data);
        return $json;
    }

    /**
     * Tampilan cari data layanan
     * @param string $cari Teks yang ingin dicari
     * @return string
     */
    public function cari(string $cari, int $laman, int $tampil = 5): string
    {
        $model = new LayananModel();

        $query = $model
            ->like("nama_layanan", $cari)
            ->orLike("harga", $cari)
            ->orLike("satuan", $cari);


        $banyakData = $query->countAllResults(false);
        $banyakHalaman = ceil($banyakData / $tampil);

        $limit = $tampil;
        $offset = ($laman - 1) * $limit;

        $layanan = $query->ambilSemua($limit, $offset);

        $data = [
            "mode" => "cari",
            "cari" => $cari,
            "layanan" => $layanan,
            "halaman" => $laman,
            "offset" => $offset,
            "limit" => $limit,
            "banyakHalaman" => $banyakHalaman,
        ];

        $json = view('layanan/data', $data);
        return $json;
    }

    /**
     * Tampilan halaman data layanan
     * @param int $laman Nomor Halaman
     * @param int $tampil Berapa banyak yang tampil
     * @return string
     */
    public function halaman(int $laman, int $tampil = 5): string
    {
        $model = new LayananModel();

        $banyakData = $model->countAllResults();
        $banyakHalaman = ceil($banyakData / $tampil);

        $limit = $tampil;
        $offset = ($laman - 1) * $limit;

        $data = [
            "mode" => "halaman",
            "layanan" => $model->ambilSemua($limit, $offset),
            "halaman" => $laman,
            "offset" => $offset,
            "limit" => $limit,
            "banyakHalaman" => $banyakHalaman,
        ];

        $json = view('layanan/data', $data);
        return $json;
    }

    /**
     * Tampilan form tambah layanan
     * @return string
     */
    public function tambah(): string
    {
        $data = [];
        $json = view('layanan/tambah', $data);
        return $json;
    }

    /**
     * Tammpilan form ubah layanan
     * @param mixed $id ID Layanan
     * @return string
     */
    public function ubah($id): string
    {
        $model = new LayananModel();
        $data = ["data" => $model->ambilData($id)];
        $json = view('layanan/ubah', $data);
        return $json;
    }
}