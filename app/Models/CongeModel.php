<?php 

namespace App\Models;
use CodeIgniter\Model;

class CongeModel extends Model
{
    protected $table = 'conges';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'employe_id',
        'type_conge_id',
        'date_debut',
        'date_fin',
        'nb_jours',
        'motif',
        'statut',
        'commentaire_rh',
        'created_at',
        'updated_at',
        'traite_par',
    ];

    public function getCongesByEmployeId(int $employeId): array
    {
        return $this->where('employe_id', $employeId)->findAll();
    }

    public function insertConge(array $data): int
    {
        $this->insert($data);
        return $this->getInsertID();
    }

    public function delete(int $id): bool
    {
        return $this->delete($id);
    }

    public function find(int $id): ?array
    {
        return $this->where('id', $id)->first();
    }

}