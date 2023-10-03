<?php

namespace App\Controllers;

class Layanan extends Base
{
    public function __construct()
    {
        $this->header = "";
        $this->menu = "";
        $this->bc = "";
    }

    public function index(): string
    {
        $data = [];
        return $this->tampil("layanan/index", $data);
    }
}