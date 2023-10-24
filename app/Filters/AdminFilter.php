<?php

namespace App\Filters;

use App\Models\SettingModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $model = new SettingModel();
        $belumLogin = (!(session("app_user_level"))) ? true : false;
        $level = (!(session("app_user_level"))) ? "guest" : session("app_user_level");
        $id = (!(session("app_user_id"))) ? "guest" : session("app_user_id");
        $nama = (!(session("app_user_nama"))) ? "guest" : session("app_user_nama");
        $namaLaundry = (!(session("app_laundry_nama"))) ? $model->ambilData("nama_laundry")->nilai_setting : session("app_laundry_nama");
        $alamatLaundry = (!(session("app_laundry_alamat"))) ? $model->ambilData("alamat_laundry")->nilai_setting : session("app_laundry_alamat");
        $session = [
            "app_user_level" => $level,
            "app_user_id" => $id,
            "app_user_nama" => $nama,
            "app_laundry_nama" => $namaLaundry,
            "app_laundry_alamat" => $alamatLaundry,
        ];

        session()->set($session);

        if ($belumLogin) {
            return redirect()->to("login");
        }
        if ($level === "guest") {
            return redirect()->to("login")->with("pgagal", "Anda tidak dapat mengakses data ini silahkan login $level");
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}