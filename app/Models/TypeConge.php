<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeConge extends Model
{
    protected $table = 'types_conge';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'libelle',
        'jours_annuels',
        'deductible',
    ];

    public function getTypeCongeById(int $id): ?array
    {
        return $this->find($id);
    }

    public function getAllTypesConge(): array
    {
        return $this->findAll();
    }

}