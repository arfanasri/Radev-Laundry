<?php

namespace App\Database\Seeds;

use App\Models\LayananModel;
use App\Models\PelangganModel;
use CodeIgniter\Database\Seeder;

class StartSeeder extends Seeder
{
    public function run()
    {
        $layananModel = new LayananModel();
        $pelangganModel = new PelangganModel();

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
        for ($i = 0; $i < 20; $i++) {
            $faker = \Faker\Factory::create("id_ID");
            $dataPelanggan[] = [
                "nama_pelanggan" => $faker->name(),
                "alamat" => $faker->address()
            ];
        }

        $banyakPelanggan = count($dataPelanggan);

        foreach ($dataPelanggan as $pelanggan) {
            $pelangganModel->tambahData($pelanggan);
        }
    }
}