<?php

namespace App\Controllers;

use App\Models\UserModel;

class Akun extends Base
{
    public function __construct()
    {
        $this->header = "Akun";
        $this->menu = "akun";
        $this->bc = [["/", "Beranda"], "Akun"];
    }

    public function index()
    {
        return $this->tampil("akun/index");
    }

    public function simpan()
    {
        $model = new UserModel();
        $data = $this->request->getVar();
        $model->ubahData(session("app_user_id"), $data);
        $session = [
            "app_user_id" => $data["id_user"],
            "app_user_nama" => $data["nama_user"],
        ];
        session()->set($session);
        return redirect()->to("akun")->with("pberhasil", "Akun anda berhasil diperbaharui")->withInput();
    }

}
