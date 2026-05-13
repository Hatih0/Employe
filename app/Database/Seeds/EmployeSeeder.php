<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeSeeder extends Seeder
{
    public function run(): void
    {
        $employes = [
            [
                'nom' => 'Rakoto',
                'prenom' => 'Jean',
                'email' => 'employe@techmada.mg',
                'password' => 'emp123',
                'role' => 'Employé',
                'departement_id' => 1,
                'date_embauche' => '2024-01-15',
                'actif' => '1',
            ],
            [
                'nom' => 'Ramiandrisoa',
                'prenom' => 'Marie',
                'email' => 'marie.ramiandrisoa@techmada.mg',
                'password' => 'pass123',
                'role' => 'Employé',
                'departement_id' => 1,
                'date_embauche' => '2023-06-20',
                'actif' => '1',
            ],
            [
                'nom' => 'Razafindraibe',
                'prenom' => 'Pierre',
                'email' => 'pierre.razafindraibe@techmada.mg',
                'password' => 'secure456',
                'role' => 'Employé',
                'departement_id' => 2,
                'date_embauche' => '2023-09-10',
                'actif' => '1',
            ],
            [
                'nom' => 'Andrianampoinimerina',
                'prenom' => 'Sophie',
                'email' => 'sophie.andrian@techmada.mg',
                'password' => 'dev789',
                'role' => 'Employé',
                'departement_id' => 2,
                'date_embauche' => '2024-02-01',
                'actif' => '1',
            ],
            [
                'nom' => 'Randrianampoinimerina',
                'prenom' => 'Luc',
                'email' => 'luc.randrian@techmada.mg',
                'password' => 'admin123',
                'role' => 'RH',
                'departement_id' => 3,
                'date_embauche' => '2022-03-15',
                'actif' => '1',
            ],
        ];

        $builder = $this->db->table('employes');

        foreach ($employes as $employe) {
            $builder->insert($employe);
        }
    }
}
