<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends BaseModel
{
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'nama_layanan',
        'harga',
        'satuan',
    ];

    // Validation
    protected $validationRules = [
        'nama_layanan' => 'required',
        'harga' => 'required',
        'satuan' => 'required',
    ];
}