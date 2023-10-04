<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    protected $DBGroup = 'default';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Ambil Semua Data dengan opsi Limit dan Offset
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     */
    public function ambilSemua(int|null $limit = 0, int|null $offset = 0)
    {
        return $this->findAll($limit, $offset);
    }

    /**
     * Ambil sebuah baris
     * @param array|int|string|null $id
     * @return array|object|null
     */
    public function ambilData(array|int|string|null $id = null)
    {
        return $this->find($id);
    }

    /**
     * Tambah data ke Database
     * @param array|object|null $data
     * @param bool|null $returnID
     * @return \CodeIgniter\Database\BaseResult|bool|int|object|string
     */
    public function tambahData(array|object|null $data = null, bool|null $returnID = true)
    {
        return $this->insert($data, $returnID);
    }

    /**
     * Ubah data dari database
     * @param array|int|string|null $id
     * @param array|object|null $data
     * @return bool
     */
    public function ubahData(array|int|string|null $id = null, array|object|null $data = null)
    {
        return $this->update($id, $data);
    }

    /**
     * Hapus data dari database
     * @param array|int|string|null $id
     * @param bool|null $purge Jika SOFTDELETE aktif dan purge TRUE maka akan menghapus data didatabase
     * @return \CodeIgniter\Database\BaseResult|bool
     */
    public function hapusData(array|int|string|null $id, bool|null $purge = false)
    {
        return $this->delete($id, $purge);
    }
}