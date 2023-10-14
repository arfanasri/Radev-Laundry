<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PesananModel;

class Pesanan extends Base
{
    public function __construct()
    {
        $this->header = "Pesanan";
        $this->menu = "pesanan";
        $this->bc = [["/", "Beranda"], "Pesanan"];
    }

    /**
     * Tampilan utama pesanan
     * @param mixed $idTransaksi ID Transaksi
     * @return string
     */
    public function transaksi($idTransaksi): string
    {
        $this->setBc([["/", "Beranda"], ["transaksi", "Transaksi"], "Pesanan $idTransaksi"]);
        $this->setHeader("Transaksi " . $idTransaksi);
        $data = ["idTransaksi" => $idTransaksi];
        return $this->tampil("pesanan/index", $data);
    }

    /**
     * Tampilan data pesanan berdasarkan transaksi
     * @param mixed $idTransaksi ID Transaksi
     * @return string
     */
    public function data($idTransaksi): string
    {
        $model = new PesananModel();

        $data = [
            "pesanan" => $model->where("pesanan.id_transaksi", $idTransaksi)->ambilSemua(),
        ];

        $json = view('pesanan/data', $data);
        return $json;
    }

    /**
     * Tampilan data layanan
     * @return string
     */
    public function dataLayanan(): string
    {
        $layananModel = new LayananModel();

        $data = [
            "layanan" => $layananModel->ambilSemua(),
        ];

        $json = view('pesanan/data_layanan', $data);
        return $json;
    }

    /**
     * Tampilan cari data pesanan berdasarkan trans
     * @param mixed $idTransaksi ID Transaksi
     * @param mixed $cari Keyword yang ingin dicari
     * @return string
     */
    public function cari($idTransaksi, $cari): string
    {
        $model = new PesananModel();
        $pesanan = $model
            ->like("layanan.nama_layanan", $cari)
            ->like("pesanan.id_transaksi", $idTransaksi)
            ->ambilSemua();

        $data = [
            "pesanan" => $pesanan,
        ];


        $json = view('pesanan/data', $data);
        return $json;
    }

    /**
     * Tampilan cari data layanan
     * @param mixed $cari Keyword yang ingin dicari
     * @return string
     */
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

    /**
     * Form tambah pesanan
     * @param mixed $idTransaksi ID Transaksi
     * @param mixed $idLayanan ID Layanan
     * @return string
     */
    public function tambah($idTransaksi, $idLayanan): string
    {
        $layananModel = new LayananModel();
        $data = [
            "layanan" => $layananModel->ambilData($idLayanan),
            "idTransaksi" => $idTransaksi,
        ];
        $json = view('pesanan/tambah', $data);
        return $json;
    }

    /**
     * Form ubah pesanan
     * @param mixed $id ID Pesanan
     * @return string
     */
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