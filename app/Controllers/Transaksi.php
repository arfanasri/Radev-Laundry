<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use App\Models\TransaksiModel;

class Transaksi extends Base
{
    public function __construct()
    {
        $this->header = "Transaksi";
        $this->menu = "transaksi";
        $this->bc = [["/", "Beranda"], "Transaksi"];
    }

    public function index(): string
    {
        $model = new TransaksiModel();
        $banyakData = $model->countAllResults();
        $banyakHalaman = ceil($banyakData / 50);
        $data = ["banyakHalaman" => $banyakHalaman];
        return $this->tampil("transaksi/index", $data);
    }

    public function data(): string
    {
        $model = new TransaksiModel();

        $data = [
            "transaksi" => $model->ambilSemua(),
        ];

        $json = view('transaksi/data', $data);
        return $json;
    }

    public function cari($cari): string
    {
        $model = new TransaksiModel();
        $transaksi = $model
            ->like("transaksi.id_transaksi", $cari)
            ->orLike("pelanggan.nama_pelanggan", $cari)
            ->orLike("transaksi.tanggal_transaksi", $cari)
            ->orLike("transaksi.harga_total", $cari)
            ->ambilSemua();

        $data = [
            "transaksi" => $transaksi,
        ];

        $json = view('transaksi/data', $data);
        return $json;
    }

    public function halaman($laman, $tampil = 50): string
    {
        $model = new TransaksiModel();

        $limit = $tampil;
        $offset = ($laman - 1) * $limit;

        $data = [
            "transaksi" => $model->ambilSemua($limit, $offset),
            "halaman" => $laman,
            "offset" => $offset,
        ];

        $json = view('transaksi/data', $data);
        return $json;
    }

    public function tambah(): string
    {
        $pelangganModel = new PelangganModel();
        $data = [
            "pelanggan" => $pelangganModel->ambilSemua(),
        ];
        $json = view('transaksi/tambah', $data);
        return $json;
    }
}