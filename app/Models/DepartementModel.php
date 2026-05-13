<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartementModel extends Model
{
    protected $table            = 'departements';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = false;
    protected $allowedFields    = ['nom', 'description'];
    protected $skipValidation   = true;

    public function getAllDepartements()
    {
        return $this->findAll();
    }

    public function getDepartementById($id)
    {
        return $this->find($id);
    }

    public function createDepartement($data)
    {
        return $this->insert($data);
    }

    public function updateDepartement($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteDepartement($id)
    {
        return $this->delete($id);
    }
}
