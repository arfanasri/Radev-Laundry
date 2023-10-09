<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PembayaranModel;
use App\Models\TransaksiModel;

class Pembayaran extends Base
{
    public function __construct()
    {
        $this->header = "Pembayaran";
        $this->menu = "pembayaran";
        $this->bc = [["/", "Beranda"], "Pembayaran"];
    }

    public function transaksi($idTransaksi): string
    {
        $this->setBc([["/", "Beranda"], ["transaksi", "Transaksi"], "Pembayaran $idTransaksi"]);
        $this->setHeader("Transaksi " . $idTransaksi);
        $data = ["idTransaksi" => $idTransaksi];
        return $this->tampil("pesanan/index", $data);
    }

    public function data($idTransaksi): string
    {
        $model = new PembayaranModel();

        $data = [
            "pembayaraan" => $model->where("id_transaksi", $idTransaksi)->ambilSemua(),
        ];

        $json = view('pembayaraan/data', $data);
        return $json;
    }

    public function dataTransaksi($idTransaksi): string
    {
        $transaksiModel = new TransaksiModel();

        $data = [
            "transaksi" => $transaksiModel->ambilData($idTransaksi),
        ];

        $json = view('pembayaran/data_transaksi', $data);
        return $json;
    }

    public function tambah($idTransaksi): string
    {
        $data = [
            "idTransaksi" => $idTransaksi,
        ];
        $json = view('pembayaran/tambah', $data);
        return $json;
    }

    public function ubah($id): string
    {
        $model = new PembayaranModel();
        $pembayaran = $model->ambilData($id);
        $data = [
            "data" => $pembayaran,
        ];
        $json = view('pembayaran/ubah', $data);
        return $json;
    }
}