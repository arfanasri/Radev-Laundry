<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends BaseModel
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_transaksi',
        'id_layanan',
        'banyak',
        'harga',
        'harga_subtotal',
    ];

    // Validation
    protected $validationRules = [
        'id_transaksi' => 'required',
        'id_layanan' => 'required',
        'banyak' => 'required',
        'harga' => 'required',
        'harga_subtotal' => 'required',
    ];

    public function ambilSemua($limit = 0, $offset = 0)
    {
        return $this->select("pesanan.*, layanan.nama_layanan")
            ->join("layanan", "pesanan.id_layanan = layanan.id_layanan", "LEFT")
            ->findAll($limit, $offset);
    }

    public function ambilData($id = null)
    {
        return $this->select("pesanan.*, layanan.nama_layanan")
            ->join("layanan", "pesanan.id_layanan = layanan.id_layanan", "LEFT")
            ->where("pesanan.id_pesanan", $id)
            ->first();
    }
}