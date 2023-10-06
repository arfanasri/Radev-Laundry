<?php

namespace App\Controllers;

use App\Models\LayananModel;

class Layanan extends Base
{
    public function __construct()
    {
        $this->header = "Layanan";
        $this->menu = "layanan";
        $this->bc = [["/", "Beranda"], "Layanan"];
    }

    public function index(): string
    {
        return $this->tampil("layanan/index", []);
    }

    public function data(): string
    {
        $model = new LayananModel();

        $data = [
            "layanan" => $model->ambilSemua(),
        ];

        $json = view('layanan/data', $data);
        return $json;
    }

    public function tambah(): string
    {
        $data = [];
        $json = view('layanan/tambah', $data);
        return $json;
    }
}