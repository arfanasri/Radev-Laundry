<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends BaseModel
{
    protected $table = '_setting';
    protected $primaryKey = 'nama_setting';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'nama_setting',
        'nilai_setting',
    ];

    protected $useTimestamps = false;
    protected $useSoftDeletes = false;

    // Validation
    protected $validationRules = [
        'nama_setting' => 'required',
        'nilai_setting' => 'required',
    ];
}