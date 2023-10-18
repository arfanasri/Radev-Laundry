<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view("auth/login");
    }

    public function loginproses()
    {
        $userModel = new UserModel();

        $id = $this->request->getVar("id");
        $password = $this->request->getVar("password");

        if (($id == "") || ($password == "")) {
            return redirect()->to("login")->with("pgagal", "ID dan Password harap diisi")->withInput();
        }

        if ($userModel->login($id, $password)) {
            $user = $userModel->ambilData($id);
            $session = [
                "app_user_id" => $user["id_user"],
                "app_user_nama" => $user["nama_user"],
                "app_user_level" => $user["role"],
            ];
            session()->set($session);
            return redirect()->to("/")->with("pberhasil", "Selamat datang " . $user["nama_user"]);
        } else {
            return redirect()->to("login")->with("pgagal", "ID dan Password tidak cocok")->withInput();
        }
    }

    public function logout()
    {
        $session = [
            "app_user_id" => "guest",
            "app_user_nama" => "Guest",
            "app_user_level" => "guest",
        ];

        session()->set($session);
        return redirect()->to("login")->with("pberhasil", "Anda berhasil logout");
    }

    public function destroy()
    {
        session()->destroy();
        return redirect()->to("/");
    }
}