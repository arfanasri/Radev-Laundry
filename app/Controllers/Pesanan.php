<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PesananModel;

class Pelanggan extends Base
{
    public function __construct()
    {
        $this->header = "Pesanan";
        $this->menu = "pesanan";
        $this->bc = [["/", "Beranda"], "Pesanan"];
    }

    public function transaksi($idTransaksi): string
    {
        $data = ["idTransaksi" => $idTransaksi];
        return $this->tampil("pesanan/index", $data);
    }

    public function data($idTransaksi): string
    {
        $model = new PesananModel();

        $data = [
            "pesanan" => $model->where("pesanan.id_transaksi", $idTransaksi)->ambilSemua(),
        ];

        $json = view('pesanan/data', $data);
        return $json;
    }

    public function dataLayanan(): string
    {
        $layananModel = new LayananModel();

        $data = [
            "layanan" => $layananModel->ambilSemua(),
        ];

        $json = view('pelanggan/data_layanan', $data);
        return $json;
    }

    public function cari($cari): string
    {
        $model = new PesananModel();
        $pesanan = $model
            ->like("layanan.nama_layanan", $cari)
            ->ambilSemua();

        $data = [
            "pesanan" => $pesanan,
        ];

        $json = view('pesanan/data', $data);
        return $json;
    }

    public function cariLayanan($cari): string
    {
        $model = new LayananModel();
        $layanan = $model
            ->like("nama_layanan", $cari)
            ->ambilSemua();

        $data = [
            "layanan" => $layanan,
        ];

        $json = view('pesanan/data_layanan', $data);
        return $json;
    }

    public function tambah($idLayanan): string
    {
        $layananModel = new LayananModel();
        $data = [
            "layanan" => $layananModel->ambilData($idLayanan)
        ];
        $json = view('pesanan/tambah', $data);
        return $json;
    }

    public function ubah($id): string
    {
        $model = new PesananModel();
        $layananModel = new LayananModel();
        $pesanan = $model->ambilData($id);
        $layanan = $layananModel->ambilData($pesanan["id_layanan"]);
        $data = [
            "data" => $pesanan,
            "layanan" => $layanan,
        ];
        $json = view('pesanan/ubah', $data);
        return $json;
    }
}