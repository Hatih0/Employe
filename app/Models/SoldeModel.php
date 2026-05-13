<?php 

namespace App\Models;
use CodeIgniter\Model;

class SoldeModel extends Model
{
    protected $table = 'soldes';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'employe_id',
        'type_conge_id',
        'annee',
        'jours_attribues',
        'jours_pris',
    ];

    public function getSoldeByEmployeIdAndTypeCongeId(int $employeId, int $typeCongeId): ?array
    {
        return $this->where('employe_id', $employeId)
                    ->where('type_conge_id', $typeCongeId)
                    ->first();

    }

    public function getSoldeByEmployeId(int $employeId): array
    {
        return $this->where('employe_id', $employeId)->findAll();

    }

}