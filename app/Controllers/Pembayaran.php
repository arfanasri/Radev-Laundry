<?php

namespace App\Controllers;

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

    /**
     * Tampilan utama Pembayaran
     * @param mixed $idTransaksi ID Transaksi
     * @return string
     */
    public function transaksi($idTransaksi): string
    {
        $this->setBc([["/", "Beranda"], ["transaksi", "Transaksi"], "Pembayaran $idTransaksi"]);
        $this->setHeader("Transaksi " . $idTransaksi);
        $data = ["idTransaksi" => $idTransaksi];
        return $this->tampil("pembayaran/index", $data);
    }

    /**
     * Tampilan data pembayaran berdasarkan transaksi
     * @param mixed $idTransaksi ID Transaksi
     * @return string
     */
    public function data($idTransaksi): string
    {
        $model = new PembayaranModel();

        $data = [
            "pembayaran" => $model->where("id_transaksi", $idTransaksi)->ambilSemua(),
        ];

        $json = view('pembayaran/data', $data);
        return $json;
    }

    /**
     * Tampilan data transaksi
     * @param mixed $idTransaksi ID Transaksi
     * @return string
     */
    public function dataTransaksi($idTransaksi): string
    {
        $transaksiModel = new TransaksiModel();
        $model = new PembayaranModel();

        $transaksi = $transaksiModel->ambilData($idTransaksi);
        $totalPembayaran = $transaksi["harga_total"];
        $sudahBayar = $model->sudahBayar($idTransaksi);
        $sisaBayar = $totalPembayaran - $sudahBayar;

        $data = [
            "transaksi" => $transaksi,
            "sudahBayar" => $sudahBayar,
            "sisaBayar" => $sisaBayar,
        ];

        $json = view('pembayaran/data_transaksi', $data);
        return $json;
    }

    /**
     * Tampilan form tambah pembayaran
     * @param mixed $idTransaksi ID Transaksi
     * @return string
     */
    public function tambah($idTransaksi): string
    {
        $data = [
            "idTransaksi" => $idTransaksi,
        ];
        $json = view('pembayaran/tambah', $data);
        return $json;
    }

    /**
     * Tampilan form ubah pembayaran
     * @param mixed $id ID Pembayaran
     * @return string
     */
    public function ubah($id): string
    {
        $model = new PembayaranModel();
        $pembayaran = $model->ambilData($id);
        $data = [
            "data" => $pembayaran,
            "idTransaksi" => $pembayaran["id_transaksi"],
        ];
        $json = view('pembayaran/ubah', $data);
        return $json;
    }
}