<?php

namespace App\Models;

use CodeIgniter\Model;

class SoldeModel extends Model
{
    protected $table            = 'soldes';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = false;
    protected $allowedFields    = ['employe_id', 'type_conge_id', 'annee', 'jours_attribues', 'jours_pris'];
    protected $skipValidation   = true;

    public function getSoldeEmploye(int $employe_id, int $type_conge_id, int $annee)
    {
        return $this->where('employe_id', $employe_id)
                    ->where('type_conge_id', $type_conge_id)
                    ->where('annee', $annee)
                    ->first();
    }

    public function getAllSoldesEmploye(int $employe_id)
    {
        return $this->where('employe_id', $employe_id)->findAll();
    }

    public function updateSolde(int $employe_id, int $type_conge_id, int $annee, int $jours_pris)
    {
        return $this->where('employe_id', $employe_id)
                    ->where('type_conge_id', $type_conge_id)
                    ->where('annee', $annee)
                    ->increment('jours_pris', $jours_pris);
    }

    public function creerSolde(int $employe_id, int $type_conge_id, int $annee, int $jours_attribues)
    {
        $data = [
            'employe_id'      => $employe_id,
            'type_conge_id'   => $type_conge_id,
            'annee'           => $annee,
            'jours_attribues' => $jours_attribues,
            'jours_pris'      => 0,
        ];
        return $this->insert($data);
    }

    public function jours_restants(int $employe_id, int $type_conge_id, int $annee)
    {
        $solde = $this->getSoldeEmploye($employe_id, $type_conge_id, $annee);
        if (!$solde) {
            return 0;
        }
        return $solde['jours_attribues'] - $solde['jours_pris'];
    }
}
