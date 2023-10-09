<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends BaseModel
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_transaksi',
        'tanggal_pembayaran',
        'banyak',
        'keterangan',
    ];

    // Validation
    protected $validationRules = [
        'id_transaksi' => 'required',
        'tanggal_pembayaran' => 'required',
        'banyak' => 'required',
    ];
}