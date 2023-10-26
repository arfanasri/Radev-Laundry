<?php

namespace App\Controllers;

use App\Models\BerandaModel;

class Home extends Base
{
    public function index(): string
    {
        $this->setHeader("Beranda");
        $this->setMenu("beranda");
        $this->setBc(["Beranda"]);

        $berandaTerakhir = (!(session("app_beranda_waktu"))) ? "kosong" : session("app_beranda_waktu");

        if ($berandaTerakhir == "kosong") {
            $this->setBeranda();
        } else {
            $sekarang = new \Datetime();
            $terakhir = new \Datetime($berandaTerakhir);

            $selisih = $terakhir->diff($sekarang);

            $selisihMenit = $selisih->h * 60 + $selisih->i;

            if ($selisihMenit >= 10) {
                $this->setBeranda();
            }
        }

        return $this->tampil('contoh_isi', []);
    }

    private function setBeranda()
    {
        $model = new BerandaModel();

        $banyakLayanan = $model->banyakLayanan();
        $banyakPelanggan = $model->banyakPelanggan();
        $banyakTransaksi = $model->banyakTransaksi();
        $banyakTransaksiHarian = $model->banyakTransaksiTerakhirHari(30);

        $transaksiHarianTanggal = [];
        $transaksiHarianBanyak = [];

        foreach ($banyakTransaksiHarian as $data) {
            $transaksiHarianTanggal[] = $data["tanggal"];
            $transaksiHarianBanyak[] = $data["banyak"];
        }

        $session = [
            "app_beranda_waktu" => date("Y-m-d H:i:s"),
            "app_beranda_banyak_layanan" => $banyakLayanan,
            "app_beranda_banyak_pelanggan" => $banyakPelanggan,
            "app_beranda_banyak_transaksi" => $banyakTransaksi,
            "app_beranda_banyak_transaksi_harian_tanggal" => array_reverse($transaksiHarianTanggal),
            "app_beranda_banyak_transaksi_harian_banyak" => array_reverse($transaksiHarianBanyak),
        ];

        session()->set($session);
    }

    public function test()
    {

    }
}