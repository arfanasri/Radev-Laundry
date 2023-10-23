<?php

namespace App\Database\Seeds;

use App\Models\SettingModel;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class BlankSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $settingModel = new SettingModel();

        $dataUser = [
            "id_user" => "admin",
            "nama_user" => "Admin",
            "password" => "admin",
            "role" => "superadmin",
        ];

        $userModel->tambahData($dataUser);

        $dataSetting = [
            [
                "nama_setting" => "nama_laundry",
                "nilai_setting" => "Radev Laundry"
            ],
            [
                "nama_setting" => "alamat_laundry",
                "nilai_setting" => "Alamat Radev Laundry"
            ],
        ];

        foreach ($dataSetting as $setting) {
            $settingModel->tambahData($setting);
        }
    }
}