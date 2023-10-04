<?php

namespace App\Controllers;

class Home extends Base
{
    public function index(): string
    {
        $this->setHeader("Beranda");
        $this->setMenu("beranda");
        $this->setBc(["Beranda"]);
        return $this->tampil('contoh_isi', []);
    }
}