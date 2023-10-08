<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends BaseModel
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'id_transaksi',
        'id_pelanggan',
        'tanggal_transaksi',
        'harga_total',
        'status',
    ];

    // Validation
    protected $validationRules = [
        'id_pelanggan' => 'required',
    ];

    public function idTransaksiBaru(\DateTime|string $tanggal = null)
    {
        if (is_null($tanggal)) {
            $idLike = date("ym");
        } else {
            if (is_string($tanggal)) {
                $tanggal = new \DateTime($tanggal);
            }
            $idLike = $tanggal->format("ym");
        }
        $builder = $this->builder();
        $builder->like("id_transaksi", $idLike);
        $builder->orderBy("id_transaksi", "DESC");
        if ($builder->countAllResults(false) == 0) {
            return $idLike . '0001';
        } else {
            $idTransaksi = $builder->get()->getRow()->id_transaksi;
            $idTransaksi += 1;
            return $idTransaksi;
        }
    }

    public function tambahData($data = null, $returnID = true)
    {
        $data = (array) $data;
        if (isset($data["tanggal_transaksi"])) {
            $idTransaksi = $this->idTransaksiBaru($data["tanggal_transaksi"]);
        } else {
            $idTransaksi = $this->idTransaksiBaru();
        }
        $data["id_transaksi"] = (isset($data["id_transaksi"])) ? ($data["id_transaksi"]) : $idTransaksi;
        $data["tanggal_transaksi"] = (isset($data["tanggal_transaksi"])) ? ($data["tanggal_transaksi"]) : date("Y-m-d H:i:s");
        $data["harga_total"] = (isset($data["harga_total"])) ? ($data["harga_total"]) : 0;
        $data["status"] = (isset($data["status"])) ? ($data["status"]) : "pencatatan";

        return $this->insert($data, $returnID);
    }

    public function ambilSemua($limit = 0, $offset = 0)
    {
        return $this->select("transaksi.*, pelanggan.nama_pelanggan")
            ->join("pelanggan", "pelanggan.id_pelanggan = transaksi.id_pelanggan", "LEFT")
            ->orderBy("transaksi.id_transaksi", "DESC")
            ->findAll($limit, $offset);
    }

    public function ambilData($id = null)
    {
        return $this->select("transaksi.*, pelanggan.nama_pelanggan")
            ->join("pelanggan", "pelanggan.id_pelanggan = transaksi.id_pelanggan", "LEFT")
            ->where("transaksi.id_transaksi", $id)
            ->first();

    }
}