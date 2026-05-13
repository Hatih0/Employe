<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartementSeeder extends Seeder
{
    public function run(): void
    {
        $departements = [
            [
                'nom' => 'Informatique',
                'description' => 'Département chargé du développement et de la maintenance informatique',
            ],
            [
                'nom' => 'Ressources Humaines',
                'description' => 'Département responsable de la gestion du personnel',
            ],
            [
                'nom' => 'Administration',
                'description' => 'Département administratif et gestion administrative',
            ],
            [
                'nom' => 'Ventes',
                'description' => 'Département commercial et ventes',
            ],
            [
                'nom' => 'Support Client',
                'description' => 'Département support client et assistance',
            ],
        ];

        $builder = $this->db->table('departements');

        foreach ($departements as $departement) {
            $builder->insert($departement);
        }
    }
}
