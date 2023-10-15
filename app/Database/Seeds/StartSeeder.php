<?php

namespace App\Database\Seeds;

use App\Models\LayananModel;
use App\Models\PelangganModel;
use App\Models\PembayaranModel;
use App\Models\PesananModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class StartSeeder extends Seeder
{
    public function run()
    {
        $layananModel = new LayananModel();
        $pelangganModel = new PelangganModel();
        $transaksiModel = new TransaksiModel();
        $pesananModel = new PesananModel();
        $pembayaranModel = new PembayaranModel();
        $userModel = new UserModel();

        $dataUser = [
            "id_user" => "admin",
            "nama_user" => "Admin",
            "password" => "admin",
        ];

        $userModel->tambahData($dataUser);

        $banyakTransaksi = 500;
        $banyakPelanggan = 50;

        $dataLayanan = [
            [
                'nama_layanan' => 'Laundry Kilat Pakaian Biasa',
                'harga' => '10000',
                'satuan' => 'kg'
            ],
            [
                'nama_layanan' => 'Laundry Kilat Pakaian Berat',
                'harga' => '20000',
                'satuan' => 'kg'
            ],
            [
                'nama_layanan' => 'Cuci Setrika Pakaian Biasa',
                'harga' => '15000',
                'satuan' => 'kg'
            ],
            [
                'nama_layanan' => 'Cuci Setrika Pakaian Berat',
                'harga' => '25000',
                'satuan' => 'kg'
            ],
            [
                'nama_layanan' => 'Cuci Kering Pakaian Formal',
                'harga' => '50000',
                'satuan' => 'item'
            ],
            [
                'nama_layanan' => 'Cuci Kering Gaun',
                'harga' => '60000',
                'satuan' => 'item'
            ],
            [
                'nama_layanan' => 'Cuci Sepatu Biasa',
                'harga' => '20000',
                'satuan' => 'pasang'
            ],
            [
                'nama_layanan' => 'Cuci Sepatu Olahraga',
                'harga' => '50000',
                'satuan' => 'pasang'
            ],
            [
                'nama_layanan' => 'Cuci Karpet Kecil',
                'harga' => '100000',
                'satuan' => 'karpet'
            ],
            [
                'nama_layanan' => 'Cuci Karpet Besar',
                'harga' => '300000',
                'satuan' => 'karpet'
            ],
        ];

        $banyakLayanan = count($dataLayanan);

        foreach ($dataLayanan as $layanan) {
            $layananModel->tambahData($layanan);
        }

        $dataPelanggan = [];
        for ($i = 0; $i < $banyakPelanggan; $i++) {
            $faker = \Faker\Factory::create("id_ID");
            $dataPelanggan[] = [
                "nama_pelanggan" => $faker->name(),
                "alamat" => $faker->address()
            ];
        }

        foreach ($dataPelanggan as $pelanggan) {
            $pelangganModel->tambahData($pelanggan);
        }

        $dataTransaksi = [];
        for ($i = 0; $i < $banyakTransaksi; $i++) {
            $faker = \Faker\Factory::create("id_ID");
            $tanggal = $faker->dateTimeBetween("-1 year");
            $dataTransaksi[] = [
                "tanggal_transaksi" => $tanggal->format("Y-m-d H:i:s"),
                "id_pelanggan" => $faker->numberBetween(1, $banyakPelanggan),
            ];
        }

        foreach ($dataTransaksi as $transaksi) {
            $idTransaksi = $transaksiModel->tambahData($transaksi);

            $faker = \Faker\Factory::create("id_ID");

            $banyakPesanan = $faker->numberBetween(1, 4);
            $totalPembayaran = 0;
            for ($i = 0; $i < $banyakPesanan; $i++) {
                $idLayanan = $faker->numberBetween(1, $banyakLayanan);
                $banyak = $faker->numberBetween(1, 10);
                $pesanan = [
                    "id_transaksi" => $idTransaksi,
                    "id_layanan" => $idLayanan,
                    "banyak" => $banyak,
                    "harga" => $dataLayanan[$idLayanan - 1]["harga"],
                    "harga_subtotal" => $dataLayanan[$idLayanan - 1]["harga"] * $banyak,
                ];
                $totalPembayaran += $pesanan["harga_subtotal"];
                $pesananModel->tambahData($pesanan);
            }

            $pembayaran = [
                "id_transaksi" => $idTransaksi,
                "tanggal_pembayaran" => $transaksi["tanggal_transaksi"],
                "banyak" => $totalPembayaran,
                "keterangan" => "Lunas",
            ];
            $pembayaranModel->tambahData($pembayaran);
        }
    }
}