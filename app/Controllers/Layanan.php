<?php

namespace App\Controllers;

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
        $data = [];
        return $this->tampil("layanan/index", $data);
    }
}