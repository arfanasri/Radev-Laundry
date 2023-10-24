<?php

namespace App\Controllers;

use App\Models\SettingModel;

class Setting extends Base
{
    public function __construct()
    {
        $this->header = "Setting";
        $this->menu = "setting";
        $this->bc = [["/", "Beranda"], "Setting"];
    }

    /**
     * Tampilan utama Setting
     * @return string
     */
    public function index(): string
    {
        $model = new SettingModel();
        $data = [
            "namaLaundry" => $model->ambilData("nama_laundry")->nilai_setting,
            "alamatLaundry" => $model->ambilData("alamat_laundry")->nilai_setting,
        ];
        return $this->tampil("setting/index", $data);
    }

    /**
     * Simpan pengaturan
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function simpan()
    {
        $model = new SettingModel();
        $data = $this->request->getVar();
        $simpan = [
            [
                "nama_setting" => "nama_laundry",
                "nilai_setting" => $data['nama_laundry'],
            ],
            [
                "nama_setting" => "alamat_laundry",
                "nilai_setting" => $data['alamat_laundry'],
            ],
        ];

        foreach ($simpan as $sm) {
            $model->save($sm);
        }

        session()->set('app_laundry_nama', $data["nama_laundry"]);
        session()->set('app_laundry_alamat', $data["alamat_laundry"]);

        return redirect()->to("setting")->withInput()->with("pberhasil", "Pengaturan berhasil disimpan");
    }
}