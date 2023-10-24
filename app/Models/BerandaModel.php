<?php

namespace App\Models;

use CodeIgniter\Model;

class BerandaModel extends Model
{
    public function banyakLayanan(): int
    {
        return $this->builder("layanan")->where("deleted_at")->countAllResults();
    }

    public function banyakPelanggan(): int
    {
        return $this->builder("pelanggan")->where("deleted_at")->countAllResults();
    }

    public function banyakTransaksi(): int
    {
        return $this->builder("transaksi")->where("deleted_at")->countAllResults();
    }

    public function banyakTransaksiTerakhirHari(int $banyakHari): array
    {
        $hariIni = date("Y-m-d");
        $kembali = [];
        for ($i = 0; $i < $banyakHari; $i++) {
            $kembali[] = [
                "banyak" => $this->builder("transaksi")->where("deleted_at")->like("tanggal_transaksi", $hariIni)->countAllResults(),
                "tanggal" => $hariIni
            ];

            $hariIni = date("Y-m-d", strtotime("-1 day", strtotime($hariIni)));
        }
        return $kembali;
    }
}
