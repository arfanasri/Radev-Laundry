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

    public function index(): string
    {
        $model = new PelangganModel();
        $banyakData = $model->countAllResults();
        $banyakHalaman = ceil($banyakData / 50);
        $data = ["banyakHalaman" => $banyakHalaman];
        return $this->tampil("pelanggan/index", $data);
    }

    public function data(): string
    {
        $model = new PelangganModel();

        $data = [
            "pelanggan" => $model->ambilSemua(),
        ];

        $json = view('pelanggan/data', $data);
        return $json;
    }

    public function cari($cari): string
    {
        $model = new PelangganModel();
        $pelanggan = $model
            ->like("nama_pelanggan", $cari)
            ->orLike("alamat", $cari)
            ->ambilSemua();

        $data = [
            "pelanggan" => $pelanggan,
        ];

        $json = view('pelanggan/data', $data);
        return $json;
    }

    public function halaman($laman, $tampil = 50): string
    {
        $model = new PelangganModel();

        $limit = $tampil;
        $offset = ($laman - 1) * $limit;

        $data = [
            "pelanggan" => $model->ambilSemua($limit, $offset),
            "halaman" => $laman,
            "offset" => $offset,
        ];

        $json = view('pelanggan/data', $data);
        return $json;
    }

    public function tambah(): string
    {
        $data = [];
        $json = view('pelanggan/tambah', $data);
        return $json;
    }

    public function ubah($id): string
    {
        $model = new PelangganModel();
        $data = ["data" => $model->ambilData($id)];
        $json = view('pelanggan/ubah', $data);
        return $json;
    }
}