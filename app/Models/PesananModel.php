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

    public function tambahData($data = null, $returnID = true)
    {
        $data = (array) $data;
        $idTransaksi = $data["id_transaksi"];
        $semuaPesanan = $this->where("id_transaksi", $idTransaksi)->ambilSemua();
        $total = $data["harga_subtotal"];
        foreach ($semuaPesanan as $dt) {
            $total += $dt["harga_subtotal"];
        }
        $transaksiModel = new TransaksiModel();
        $dataTransaksi = [
            "harga_total" => $total,
        ];
        $transaksiModel->ubahData($idTransaksi, $dataTransaksi);
        return $this->insert($data, $returnID);
    }

    public function ubahData($id = null, $data = null)
    {
        $data = (array) $data;
        $idTransaksi = $data["id_transaksi"];
        $semuaPesanan = $this->where("id_transaksi", $idTransaksi)->ambilSemua();
        $total = $data["harga_subtotal"];
        foreach ($semuaPesanan as $dt) {
            if ($dt["id_pesanan"] != $id) {
                $total += $dt["harga_subtotal"];
            }
        }
        $transaksiModel = new TransaksiModel();
        $dataTransaksi = [
            "harga_total" => $total,
        ];
        $transaksiModel->ubahData($idTransaksi, $dataTransaksi);
        return $this->update($id, $data);
    }

    public function hapusData($id, $purge = false)
    {
        $pesanan = $this->ambilData($id);
        $transaksiModel = new TransaksiModel();
        $idTransaksi = $pesanan["id_transaksi"];
        $transaksi = $transaksiModel->ambilData($idTransaksi);
        $dataTransaksi = [
            "harga_total" => $transaksi["harga_total"] - $pesanan["harga_subtotal"],
        ];
        $transaksiModel->ubahData($idTransaksi, $dataTransaksi);
        return $this->delete($id, $purge);
    }
}