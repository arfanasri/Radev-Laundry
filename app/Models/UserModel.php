<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends BaseModel
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_user',
        'nama_user',
        'password',
        'role',
    ];

    // Validation
    protected $validationRules = [
        'id_user' => 'required',
        'nama_user' => 'required',
        'password' => 'required',
    ];

    protected $beforeUpdate = ['hashPassword'];
    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password']))
            return $data;

        $password = $data['data']['password'];
        $data['data']['password'] = password_hash($password, PASSWORD_DEFAULT);

        return $data;
    }

    public function login($id, $pass)
    {
        $admin = $this->ambilData($id);
        if ($admin) {
            return password_verify($pass, $admin['password']);
        } else {
            return false;
        }
    }
}