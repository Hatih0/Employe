<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeCongeModel extends Model
{
    protected $table            = 'types_conge';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = false;
    protected $allowedFields    = ['jours_annuels', 'deductible'];
    protected $skipValidation   = true;

    public function getAllTypeConges()
    {
        return $this->findAll();
    }

    public function getTypeCongeById($id)
    {
        return $this->find($id);
    }

    public function createTypeConge($data)
    {
        return $this->insert($data);
    }

    public function updateTypeConge($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteTypeConge($id)
    {
        return $this->delete($id);
    }
}
