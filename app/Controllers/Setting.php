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
            "namaLaundry" => $model->ambilData("nama_laundry"),
            "alamatLaundry" => $model->ambilData("alamat_laundry"),
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
                "nilai_setting" => $data->nama_laundry,
            ],
            [
                "nama_setting" => "alamat_laundry",
                "nilai_setting" => $data->alamat_laundry,
            ],
        ];
        foreach ($simpan as $sm) {
            $model->save($sm);
        }

        return redirect()->to("setting")->withInput()->with("pberhasil", "Pengaturan berhasil disimpan");
    }
}