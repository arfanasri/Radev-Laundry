<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends BaseModel
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'nama_pelanggan',
        'alamat',
    ];

    // Validation
    protected $validationRules = [
        'nama_pelanggan' => 'required',
        'alamat' => 'required',
    ];
}