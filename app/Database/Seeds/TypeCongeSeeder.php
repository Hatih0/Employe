<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeCongeSeeder extends Seeder
{
    public function run(): void
    {
        $typesConge = [
            [
                'libelle' => 'Congé annuel',
                'jours_annuels' => 24,
                'deductible' => '1',
            ],
            [
                'libelle' => 'Congé maladie',
                'jours_annuels' => 10,
                'deductible' => '0',
            ],
            [
                'libelle' => 'Congé exceptionnel',
                'jours_annuels' => 5,
                'deductible' => '0',
            ],
            [
                'libelle' => 'Congé maternité/paternité',
                'jours_annuels' => 14,
                'deductible' => '0',
            ],
        ];

        $builder = $this->db->table('types_conge');

        foreach ($typesConge as $typeConge) {
            $builder->insert($typeConge);
        }
    }
}