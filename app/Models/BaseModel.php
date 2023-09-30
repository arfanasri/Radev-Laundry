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

    public function ambilSemua(int|null $limit = 0, int|null $offset = 0)
    {
        return $this->findAll($limit, $offset);
    }

    public function ambilData(array|int|string|null $id = null)
    {
        return $this->find($id);
    }

    public function tambahData(array|object|null $data = null, bool|null $returnID = true)
    {
        return $this->insert($data, $returnID);
    }

    public function ubahData(array|int|string|null $id = null, array|object|null $data = null)
    {
        return $this->update($id, $data);
    }

    public function hapusData(array|int|string|null $id, bool|null $purge = false)
    {
        return $this->delete($id, $purge);
    }
}