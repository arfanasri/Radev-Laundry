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

    public function index(): string
    {
        $model = new LayananModel();
        $banyakData = $model->countAllResults();
        $banyakHalaman = ceil($banyakData / 50);
        $data = ["banyakHalaman" => $banyakHalaman];
        return $this->tampil("layanan/index", $data);
    }

    public function data(): string
    {
        $model = new LayananModel();

        $data = [
            "layanan" => $model->ambilSemua(),
        ];

        $json = view('layanan/data', $data);
        return $json;
    }

    public function cari($cari): string
    {
        $model = new LayananModel();
        $layanan = $model
            ->like("nama_layanan", $cari)
            ->orLike("harga", $cari)
            ->orLike("satuan", $cari)
            ->ambilSemua();

        $data = [
            "layanan" => $layanan,
        ];

        $json = view('layanan/data', $data);
        return $json;
    }

    public function halaman($laman, $tampil = 50): string
    {
        $model = new LayananModel();

        $limit = $tampil;
        $offset = ($laman - 1) * $limit;

        $data = [
            "layanan" => $model->ambilSemua($limit, $offset),
        ];

        $json = view('layanan/data', $data);
        return $json;
    }

    public function tambah(): string
    {
        $data = [];
        $json = view('layanan/tambah', $data);
        return $json;
    }

    public function ubah($id): string
    {
        $model = new LayananModel();
        $data = ["data" => $model->ambilData($id)];
        $json = view('layanan/ubah', $data);
        return $json;
    }
}