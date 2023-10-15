<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use App\Models\PesananModel;
use App\Models\TransaksiModel;

class Transaksi extends Base
{
    public function __construct()
    {
        $this->header = "Transaksi";
        $this->menu = "transaksi";
        $this->bc = [["/", "Beranda"], "Transaksi"];
    }

    /**
     * Tampilan utama transaksi
     * @return string
     */
    public function index(): string
    {
        $model = new TransaksiModel();
        $banyakData = $model->countAllResults();
        $banyakHalaman = ceil($banyakData / 50);
        $data = ["banyakHalaman" => $banyakHalaman];
        return $this->tampil("transaksi/index", $data);
    }

    /**
     * Tampilan data transaksi
     * @return string
     */
    public function data(): string
    {
        $model = new TransaksiModel();

        $data = [
            "transaksi" => $model->ambilSemua(),
        ];

        $json = view('transaksi/data', $data);
        return $json;
    }

    /**
     * Tampilan data pesanan berdasarkan transaksi
     * @param mixed $idTransaksi ID Transaksi
     * @return string
     */
    public function pesanan($idTransaksi): string
    {
        $pesananModel = new PesananModel();

        $data = [
            "pesanan" => $pesananModel->where("id_transaksi", $idTransaksi)->ambilSemua(),
        ];

        $json = view('transaksi/data_pesanan', $data);
        return $json;
    }

    /**
     * Tampilan cari data transaksi
     * @param mixed $cari
     * @return string
     */
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

    /**
     * Tampilan halaman data transaksi
     * @param mixed $laman Nomor Halaman
     * @param mixed $tampil Banyak data yang tampil
     * @return string
     */
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

    /**
     * Tampilan form tambah transaksi
     * @return string
     */
    public function tambah(): string
    {
        $pelangganModel = new PelangganModel();
        $data = [
            "pelanggan" => $pelangganModel->ambilSemua(),
        ];
        $json = view('transaksi/tambah', $data);
        return $json;
    }

    public function nota($idTransaksi)
    {
        $model = new TransaksiModel();
        $pesananModel = new PesananModel();
        $pelangganModel = new PelangganModel();
        $transaksi = $model->ambilData($idTransaksi);
        $pesanan = $pesananModel->where("id_transaksi", $idTransaksi)->ambilSemua();
        if (count($pesanan) == 0) {
            return throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $pelanggan = $pelangganModel->ambilData($transaksi["id_pelanggan"]);
        $pdf = new \FPDF();
        $data = [
            "transaksi" => $transaksi,
            "pesanan" => $pesanan,
            "pelanggan" => $pelanggan,
            "pdf" => $pdf,
        ];

        return view("transaksi/nota", $data);
    }
}